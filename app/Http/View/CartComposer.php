<?php

namespace App\Http\View;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;

class CartComposer
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('ls-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function compose(View $view)
    {
        $carts = $this->getCarts();
        $view->with('carts', $carts);
    }

}
