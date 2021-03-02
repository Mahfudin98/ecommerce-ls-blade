<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('customer.dashboard'));
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string'
        ]);

        $auth = $request->only('email', 'password');
        $auth['status'] = 1;
        if (auth()->guard('customer')->attempt($auth)) {
            return redirect(route('customer.dashboard'));
        }
        return redirect(route('customer.verify.sms'));
    }

    public function verify()
    {
        return view('customer.extract.verify');
    }

    public function postVerify(Request $request)
    {
        if ($user = Customer::where('activate_token', $request->active_token)->first()) {
            $user->status=1;
            $user->activate_token=null;
            $user->save();
            return redirect(route('customer.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        } else {
            return back()->with(['error' => 'Kode anda salah']);
        }

    }

    public function dashboard()
    {
        $orders = Order::selectRaw('COALESCE(sum(CASE WHEN status = 0 THEN subtotal END), 0) as pending,
            COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
            COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')
            ->where('customer_id', auth()->guard('customer')->user()->id)->get();
        return view('customer.dashboard', compact('orders'));
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect(route('customer.login'));
    }
}
