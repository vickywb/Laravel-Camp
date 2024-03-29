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

    public function indexClasses()
    {
        $checkouts = $this->checkoutRepository->get([
            'with' => ['camp'],
            'user_id' => auth()->user()->id,
            'pagination' => 5
        ]);
        
        return view('user.classes.index', [
            'checkouts' => $checkouts
        ]);
    }
}
