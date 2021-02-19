<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $product = Product::all();
        $order = Order::where('status', 0)->get();
        $retur = OrderReturn::all();
        $customer = Customer::all();
        $cs = CustomerService::orderBy('created_at', 'DESC')->paginate(10);
        $user = User::all();
        return view('admin.dashboard', compact(
            'product', 'order', 'retur',
            'customer', 'user', 'cs'
        ));
    }

    public function cspost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'message' => 'required',
            'phone' => 'required',
        ]);
        // $message = ;
        $phone_number = preg_replace("/^0/", "62", $request->phone);

        CustomerService::create([
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $phone_number
        ]);

        return redirect(route('dashboard'))->with(['success' => 'CS Baru Ditambahkan']);
    }

    public function csdelete($id)
    {
        $cs = CustomerService::find($id);
        $cs->delete();
        return redirect(route('dashboard'))->with(['success' => 'CS Sudah Dihapus']);
    }

    public function csedit($id)
    {
        $cs = CustomerService::find($id);

        return view('admin.csedit', compact('cs'));
    }

    public function csupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'message' => 'required',
            'phone' => 'required',
        ]);

        $cs = CustomerService::find($id);

        $phone_number = preg_replace("/^0/", "62", $request->phone);
        $cs->update([
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $phone_number
        ]);

        return redirect(route('dashboard'))->with(['success' => 'CS berhasil di edit']);
    }

    public function orderReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = Order::with(['customer.district'])->whereBetween('created_at', [$start, $end])->get();
        return view('admin.report.order', compact('orders'));
    }

    public function orderReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $orders = Order::with(['customer.district'])->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('admin.report.order_pdf', compact('orders', 'date'));
        return $pdf->stream();
    }

    public function returnReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = Order::with(['customer.district'])->has('return')->whereBetween('created_at', [$start, $end])->get();
        return view('admin.report.return', compact('orders'));
    }

    public function returnReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $orders = Order::with(['customer.district'])->has('return')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('admin.report.return_pdf', compact('orders', 'date'));
        return $pdf->stream();
    }
}
