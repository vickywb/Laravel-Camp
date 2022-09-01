<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Repositories\CheckoutRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        
        return view('user.dashboard', [
            'checkouts' => $checkouts
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
