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
use App\Models\NewsPost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use willvincent\Rateable\Rating;

class GuestController extends Controller
{
    public function index()
    {
        $news = NewsPost::where('status', 1)->orderBy('created_at', 'DESC')->paginate(3);
        $products = Product::where('status', 1)->orderBy('created_at', 'DESC')->paginate(8);
        return view('customer.index', compact('products', 'news'));
    }

    public function shop()
    {
        // $categories = Category::all();
        $products = Product::where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
        return view('customer.shop', compact('products'));
    }

    public function categoryProduct($slug)
    {
        // $categories = Category::orderBy('created_at', 'DESC')->paginate(12);
        $products = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('customer.shop', compact('products'));
    }

    public function search(Request $request){
        if ($request->ajax()) {
            $output = "";

            $product = Product::where('name', 'LIKE', '%' . $request->search. "%")->paginate(12);

            if ($product) {
                foreach ($product as $key => $value) {
                    $output.=
                    '<div class="col-md-6 col-lg-4">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="'.asset('storage/products/' . $value->image). '" alt="'.$value->name.'">
                            </div>
                            <div class="card-body">
                                <p>'.$value->category->name.'</p>
                                <h4 class="card-product__title"><a href="'.url('/shop/' . $value->slug).'">'.$value->name.'</a></h4>
                                <p class="card-product__price">Rp.'.number_format($value->price).'</p>
                            </div>
                        </div>
                    </div>'
                    ;
                }

                return Response($output);
            }
        }
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
            'password' => 'nullable|string|min:6',
            'image' => 'nullable'
        ]);

        $user = auth()->guard('customer')->user();
        $data = $request->only('name', 'phone_number', 'address', 'district_id','image');
        $filename = $user->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/customer', $filename);
            File::delete(storage_path('app/public/customer/' . $user->image));
        }

        if ($request->image != '') {
            $data['image'] = $filename;
        }

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

    public function newsList()
    {
        $news = NewsPost::where('status', 1)->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $news = $news->where('title', 'LIKE', '%' . request()->q . '%');
        }
        $news = $news->paginate(10);
        return view('customer.extract.news', compact('news'));
    }
}
