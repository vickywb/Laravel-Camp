<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('pages.checkouts.checkout');
    }

    public function successCheckout()
    {
        return view('pages.checkouts.success-checkout');
    }
}
