<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with(['customer.district.city.province'])
            ->withCount('return')
            ->orderBy('created_at', 'DESC');

        if (request()->q != '') {
            $orders = $orders->where(function($q) {
                $q->where('customer_name', 'LIKE', '%' . request()->q . '%')
                ->orWhere('invoice', 'LIKE', '%' . request()->q . '%')
                ->orWhere('customer_address', 'LIKE', '%' . request()->q . '%');
            });
        }

        if (request()->status != '') {
            $orders = $orders->where('status', request()->status);
        }
        $orders = $orders->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function view($invoice)
    {
        $order = Order::with(['customer.district.city.province', 'payment', 'details.product'])->where('invoice', $invoice)->first();
        return view('admin.order.view', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->details()->delete();
        $order->payment()->delete();
        $order->delete();
        return redirect(route('orders.index'));
    }

    public function acceptPayment($invoice)
    {
        $order = Order::with(['payment'])->where('invoice', $invoice)->first();
        $order->payment()->update(['status' => 1]);
        $order->update(['status' => 2]);
        return redirect(route('orders.view', $order->invoice));
    }

    public function shippingOrder(Request $request)
    {
        $order = Order::with(['customer'])->find($request->order_id);
        $order->update(['tracking_number' => $request->tracking_number, 'status' => 3]);

        // twilio sms

        $phone_number = preg_replace("/^0/", "62", $order->customer_phone);
        $twilio_phone = getenv("TWILIO_WHATSAPP_NUMBER");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $account_sid = getenv("TWILIO_ACCOUNT_SID");

        // end twilio sms

        $client = new Client($account_sid, $auth_token);
            $client->messages->create(
            '+'.$phone_number,
            array(
                'from' => $twilio_phone,
                'body' => 'Terima kasih telah melakukan transaksi pada aplikasi kami, berikut nomor resi dari pesanan anda: '. $order->tracking_number .', invoice: '. $order->invoice,
            )
        );

        Mail::to($order->customer->email)->send(new OrderMail($order));
        return redirect()->back();
    }

    public function return($invoice)
    {
        $order = Order::with(['return', 'customer'])->where('invoice', $invoice)->first();
        return view('admin.order.return', compact('order'));
    }

    public function approveReturn(Request $request)
    {
        $this->validate($request, ['status' => 'required']);
        $order = Order::find($request->order_id);
        $order->return()->update(['status' => $request->status]);
        $order->update(['status' => 4]);
        return redirect()->back();
    }
}
