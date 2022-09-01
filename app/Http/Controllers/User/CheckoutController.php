<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutStoreRequest;
use App\Mail\Checkout\AfterCheckout;
use App\Models\Camp;
use App\Models\Checkout;
use App\Repositories\CheckoutRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{   
    private $checkoutRepository;

    public function __construct(CheckoutRepository $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }

    public function create(Request $request, Camp $camp)
    {   
        if ($camp->isRegistered) {
            $request->session()->flash('errors', "You're already registered on this camp {$camp->title}.");
            return redirect()->route('user.dashboard');
        }

        return view('pages.checkouts.checkout', [
            'camp' => $camp
        ]);
    }

    public function store(CheckoutStoreRequest $request, Camp $camp)
    {   
        $user = auth()->user();
       
        $request->merge([
            'user_id' => $user->id,
            'camp_id' => $camp->id
        ]);

        $data = $request->only([
            'name', 'email', 'user_id', 'camp_id', 'card_number',
            'cvc', 'expired_date'
        ]);

        try {
            DB::beginTransaction();

            $checkout = new Checkout($data);
            $checkout = $this->checkoutRepository->store($checkout);

            //sending email
            Mail::to(auth()->user()->email)->send(new AfterCheckout($checkout));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('pages.checkouts.success-checkout');
    }
}
