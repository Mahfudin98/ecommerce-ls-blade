<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Payment;
use Carbon\Carbon;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Twilio\Rest\Client;

class CartController extends Controller
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('ls-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $carts = $this->getCarts();
        if ($carts && array_key_exists($request->product_id, $carts)) {
            $carts[$request->product_id]['qty'] += $request->qty;
        } else {
            $product = Product::find($request->product_id);
            $carts[$request->product_id] = [
                'qty' => $request->qty,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->image,
                'weight' => $product->weight
            ];
        }

        $cookie = cookie('ls-carts', json_encode($carts), 2880);
        return redirect()->back()->with(['success' => 'Produk Ditambahkan ke Keranjang'])->cookie($cookie);
    }

    public function listCart()
    {
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price'];
        });
        return view('customer.cart', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $carts = $this->getCarts();
        foreach ($request->product_id as $key => $row) {
            if ($request->qty[$key] == 0) {
                unset($carts[$row]);
            } else {
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }
        $cookie = cookie('ls-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }

    public function checkout()
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price'];
        });
        $weight = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['weight'];
        });
        return view('customer.extract.checkout', compact('provinces', 'carts', 'subtotal', 'weight'));
    }

    public function getCity()
    {
        $cities = City::where('province_id', request()->province_id)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function processCheckout(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'courier' => 'required',
            'metode' => 'required',
        ]);

        DB::beginTransaction();
        try {

            // twilio sms

            $active_token = rand(1111,9999);
            $phone_number = preg_replace("/^0/", "62", $request->customer_phone);
            $twilio_phone = getenv("TWILIO_WHATSAPP_NUMBER");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $account_sid = getenv("TWILIO_ACCOUNT_SID");

            // end twilio sms

            $affiliate = json_decode(request()->cookie('ls-afiliasi'), true);
            $explodeAffiliate = explode('-', $affiliate);

            $customer = Customer::where('email', $request->email)->first();
            if (!auth()->guard('customer')->check() && $customer) {
                return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
            }

            $carts = $this->getCarts();
            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            if (!auth()->guard('customer')->check()) {
                $password = Str::random(8);
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'email' => $request->email,
                    'password' => $password,
                    'phone_number' => $phone_number,
                    'address' => $request->customer_address,
                    'district_id' => $request->district_id,
                    'activate_token' => $active_token,
                    'status' => false
                ]);
            }

            if ($request->metode != 'cod') {
                $status = 0;
            } else {
                $status = 1;
            }

            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(),
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_phone' => $phone_number,
                'customer_address' => $request->customer_address,
                'district_id' => $request->district_id,
                'subtotal' => $subtotal,
                'cost' => $request->ongkos,
                // 'shipping' => $shipping[0] . '-' . $shipping[0],
                'status' => $status,
                'ref' => $affiliate != '' && $explodeAffiliate[0] != auth()->guard('customer')->user()->id ? $affiliate:NULL
            ]);

            if ($request->metode == 'cod') {
                Payment::create([
                    'order_id' => $order->id,
                    'name' => $customer->name,
                    'transfer_to' => $request->metode,
                    'transfer_date' => Carbon::parse($request->transfer_date)->format('Y-m-d'),
                    'amount' => $subtotal,
                    'status' => false
                ]);
            }

            foreach ($carts as $row) {
                $product = Product::find($row['product_id']);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'price' => $row['product_price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);

                $product->update([
                    'stock' => $product['stock'] - $row['qty'],
                ]);
            }

            DB::commit();

            $carts = [];
            $cookie = cookie('ls-carts', json_encode($carts), 2880);
            Cookie::queue(Cookie::forget('ls-afiliasi'));

            if (!auth()->guard('customer')->check()) {
                $client = new Client($account_sid, $auth_token);
                $client->messages->create(
                    '+'.$phone_number,
                    array(
                        'from' => '',
                        'messagingServiceSid' => 'MG1bda3d5469ac73407c1fc1746e4832e7',
                        'body' => 'Ini password anda untuk Login: '. $password .', Code verifikasi anda: '. $active_token,
                    )
                );
                Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            }
            return redirect(route('guest.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
        $orderdetail = OrderDetail::where('order_id', $order->id)->first();
        return view('customer.extract.checkoutfinish', compact('order', 'orderdetail'));
    }

    public function getCourier(Request $request)
    {
        // jika memeakai akun pro dissable komentar
        // ganti destination dari city ke district
        $cost = RajaOngkir::ongkosKirim([
            'origin'       => 252,
            'originType'   => 'city',
            'destination'  => $request->destination,
            'destinationType' => 'subdistrict',
            'weight'       => $request->weight,
            'courier'      => $request->courier,
        ])->get();

        return response()->json($cost[0]['costs'][0]['cost']);
    }
}
