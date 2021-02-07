<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Province;

class GuestController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(8);
        return view('customer.index', compact('products'));
    }

    public function shop()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('customer.shop', compact('products','categories'));
    }

    public function categoryProduct($slug)
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(12);
        $products = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('customer.shop', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['category'])->where('slug', $slug)->first();
        $list = Product::where('slug', '!=', $slug)->paginate(4);
        return view('customer.extract.shop_detail', compact('product','list'));
    }

    public function verifyCustomerRegistration($token)
    {
        $customer = Customer::where('activate_token', $token)->first();
        if ($customer) {
            $customer->update([
                'activate_token' => null,
                'status' => 1
            ]);
            return redirect(route('customer.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        }
        return redirect(route('customer.login'))->with(['error' => 'Invalid Verifikasi Token']);
    }

    public function customerSettingForm()
    {
        $customer = auth()->guard('customer')->user()->load('district');
        $provinces = Province::orderBy('name', 'ASC')->get();
        return view('customer.extract.customer_setting', compact('customer', 'provinces'));
    }

    public function customerUpdateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'phone_number' => 'required|max:15',
            'address' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'password' => 'nullable|string|min:6'
        ]);

        $user = auth()->guard('customer')->user();
        $data = $request->only('name', 'phone_number', 'address', 'district_id');
        if ($request->password != '') {
            $data['password'] = $request->password;
        }
        $user->update($data);
        return redirect()->back()->with(['success' => 'Profil berhasil diperbaharui']);
    }

    public function referalProduct($user, $product)
    {
        $code = $user . '-' . $product;
        $product = Product::find($product);
        $cookie = cookie('dw-afiliasi', json_encode($code), 2880);
        return redirect(route('front.show_product', $product->slug))->cookie($cookie);
    }

    public function listCommission()
    {
        $user = auth()->guard('customer')->user();
        $orders = Order::where('ref', $user->id)->where('status', 4)->paginate(10);
        return view('ecommerce.affiliate', compact('orders'));
    }
}
