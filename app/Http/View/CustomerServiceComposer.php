<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\CustomerService;

class CustomerServiceComposer
{
    public function compose(View $view)
    {
        $cs = CustomerService::all()->where("status",1);
        if (!$cs->isEmpty()) {
            $cs = CustomerService::all()->where("status",1)->random();
        } else {

        }

        $view->with(compact('cs'));
    }
}
