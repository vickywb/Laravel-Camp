<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Repositories\CheckoutRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $checkoutRepository;

    public function __construct(CheckoutRepository $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }
    public function index()
    {
        $checkouts = $this->checkoutRepository->get([
            'with' => ['camp'],
            'user_id' => auth()->user()->id,
            'pagination' => 5
        ]);
        
        return view('user.transactions.index', [
            'checkouts' => $checkouts
        ]);
    }

    public function show(Checkout $checkout)
    {
        return view('user.transactions.show', [
            'checkout' => $checkout
        ]);
    }
}
