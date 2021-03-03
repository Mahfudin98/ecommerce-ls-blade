<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use App\Models\DailyStock;
use App\Models\NewsPost;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
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
        $user = User::all();
        $daily = DailyStock::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.dashboard', compact(
            'product', 'order', 'retur',
            'customer', 'user', 'daily'
        ));
    }

    // session cs
    public function cspost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'message' => 'required',
            'status' => 'required',
            'phone' => 'required',
        ]);
        // $message = ;
        $phone_number = preg_replace("/^0/", "62", $request->phone);

        CustomerService::create([
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $phone_number,
            'status' => $request->status,
        ]);

        return redirect(route('other'))->with(['success' => 'CS Baru Ditambahkan']);
    }

    public function csdelete($id)
    {
        $cs = CustomerService::find($id);
        $cs->delete();
        return redirect(route('other'))->with(['success' => 'CS Sudah Dihapus']);
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
            'status' => 'nullable'
        ]);

        $cs = CustomerService::find($id);

        $phone_number = preg_replace("/^0/", "62", $request->phone);
        $cs->update([
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $phone_number,
            'status' => $request->status
        ]);

        return redirect(route('other'))->with(['success' => 'CS berhasil di edit']);
    }
    // end session cs

    // session order
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
    // end session order

    // daily stock for gudang
    public function dailyPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'stock' => 'required',
            'qty' => 'required',
            'catatan' => 'nullable',
        ]);

        DailyStock::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'qty' => $request->qty,
            'catatan' => $request->catatan,
        ]);

        return redirect(route('dashboard'))->with(['success' => 'Stock Harian berhasil di tambahkan']);
    }

    public function dailyUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'stock' => 'required',
            'qty' => 'nullable',
            'catatan' => 'nullable',
        ]);

        $daily = DailyStock::find($id);

        $daily->update([
            'stock' => $request->stock,
            'qty' => $request->qty,
            'catatan' => $request->catatan,
        ]);

        return redirect(route('dashboard'))->with(['success' => 'Stock Harian berhasil di update']);
    }

    public function dailyedit($id)
    {
        $daily = DailyStock::find($id);

        return view('admin.dailystock', compact('daily'));
    }

    public function dailydelete($id)
    {
        $daily = DailyStock::find($id);
        $daily->delete();
        return redirect(route('dashboard'))->with(['success' => 'Stock Harian Sudah Dihapus']);
    }
    // other
    public function other()
    {
        $news = NewsPost::orderBy('created_at', 'DESC')->paginate(10);
        $cs = CustomerService::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.other', compact('cs', 'news'));
    }
    // news
    public function newsPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg',
            'sumber' => 'required',
            'status' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/news', $filename);

            NewsPost::create([
                'title' => $request->title,
                'link' => $request->link,
                'body' => $request->body,
                'image' => $filename,
                'sumber' => $request->sumber,
                'status' => $request->status
            ]);
            return redirect(route('other'))->with(['success' => 'Berita Baru Ditambahkan']);
        }
    }
    public function newsEdit($id)
    {
        $news = NewsPost::find($id);
        return view('admin.beritaedit', compact('news'));
    }
    public function newsUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:png,jpeg,jpg',
            'sumber' => 'required',
            'status' => 'nullable'
        ]);

        $news = NewsPost::find($id);
        $filename = $news->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/news', $filename);
            File::delete(storage_path('app/public/news/' . $news->image));
        }

        $news->update([
            'title'     => $request->title,
            'link'      => $request->link,
            'body'      => $request->body,
            'image'     => $filename,
            'sumber'    => $request->sumber,
            'status'    => $request->status,
        ]);

        return redirect(route('other'))->with(['success' => 'Berita Diperbaharui']);
    }

    public function newsDelete($id)
    {
        $news = NewsPost::find($id);
        File::delete(storage_path('app/public/news/' . $news->image));
        $news->delete();
        return redirect(route('other'))->with(['success' => 'Berita Dihapus']);
    }
}
