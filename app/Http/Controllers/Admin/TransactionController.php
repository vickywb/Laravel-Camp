<?php

namespace App\Http\Controllers\Admin;

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
            'pagination' => 5
        ]);

        return view('admin.transactions.index', [
            'checkouts' => $checkouts
        ]);
    }

    public function show(Checkout $checkout)
    {
        return view('admin.transactions.view', [
            'checkout' => $checkout
        ]);
    }
}
