<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Comment;
use App\Models\ImageComment;
use Illuminate\Support\Facades\Storage;
use willvincent\Rateable\Rating;

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
        $comment = Comment::where('product_id', $product->id)->get();
        $image = ImageComment::all();
        /* ratting */
        $average = Comment::where('product_id', $product->id)->avg('rating');
        return view('customer.extract.shop_detail', compact(
            'product',
            'list',
            'comment',
            'average',
            'image'
        ));
    }

    public function formComment($slug)
    {
        $product = Product::with(['category'])->where('slug', $slug)->first();
        return view('customer.extract.comment', compact('product'));
    }

    public function coment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'nullable'
        ]);

        try {
            $comment = Comment::create([
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'rating' => $request->rate,
                'comment' => $request->comment,
                'status' => true,
            ]);

            $comments = Comment::find($comment->id);
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    $name = rand(1,99999);
                    $extension = $file->getClientOriginalExtension();
                    $newName = $name . '.' .$extension;
                    $size = $file->getSize();
                    $file->storeAs('public/comment', $newName);

                    $data = [
                        'comment_id' => $comments->id,
                        'path' => $newName,
                        'size' => $size
                    ];

                    ImageComment::create($data);
                }

                return redirect()->back()->with(['success' => 'Komentar Ditambahkan']);
            }


            return redirect()->back()->with(['success' => 'Komentar Ditambahkan']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
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
