<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Repositories\CheckoutRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{   
    private $checkoutRepository;

    public function __construct(CheckoutRepository $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }

    public function updateCheckout(Request $request, Checkout $checkout)
    {   
        $request->merge([
          'payment_status' => 'success',
          'created_at' => Carbon::now()
        ]);

        $data = $request->only([
            'payment_status', 'created_at'
        ]);
        
      try {
        DB::beginTransaction();

        $checkout = $checkout->fill($data);
        $this->checkoutRepository->store($checkout);
        
        DB::commit();
      } catch (\Throwable $th) {
        DB::rollBack();
        
        return redirect()->back()->withErrors([
            'errors' => $th->getMessage()
        ]);
      }

      return redirect()->route('admin.dashboard')->with([
        'success' => "Payment Status from id: $checkout->id has beed updated."
      ]);
    }
}
