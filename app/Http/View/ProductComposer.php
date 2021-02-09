<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Product;

class ProductComposer
{
    public function compose(View $view)
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(6);
        $view->with('product', $product);
    }
}
