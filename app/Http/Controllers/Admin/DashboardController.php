<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Repositories\CampRepository;
use App\Repositories\CheckoutRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    private $checkoutRepository;
    private $campRepository;

    public function __construct(
        CheckoutRepository $checkoutRepository,
        CampRepository $campRepository
    )
    {
        $this->checkoutRepository = $checkoutRepository;
        $this->campRepository = $campRepository;
    }

    public function index()
    {  
        $camps = $this->campRepository->get([
            'pagination' => 1
        ]);
 
        $checkouts = $this->checkoutRepository->get([
            'pagination' => 1,
        ]);
    
        return view('admin.dashboard', [
            'camps' => $camps,
            'checkouts' => $checkouts,
       ]);
    }
}
