<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutStoreRequest;
use App\Mail\Checkout\AfterCheckout;
use App\Models\Camp;
use App\Models\Checkout;
use App\Models\Discount;
use App\Models\TransactionDetail;
use App\Repositories\CheckoutRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Midtrans;

class CheckoutController extends Controller
{   
    private $checkoutRepository;

    public function __construct(CheckoutRepository $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
        Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function create(Request $request, Camp $camp)
    {   
        if ($camp->isRegistered) {
            $request->session()->flash('errors', "You're already registered on this camp {$camp->title}.");
            return redirect()->route('user.dashboard');
        }

        $discounts = Discount::all();

        return view('pages.checkouts.checkout', [
            'camp' => $camp,
            'discounts' => $discounts
        ]);
    }

    public function store(CheckoutStoreRequest $request, Camp $camp)
    {
        $user = auth()->user();
        $price = (int) $camp->price;
        $discountPrice = 0;
        $total = $price;

        if ($request->discount) {
            $discount = Discount::whereCode($request->discount)->first();

            $code = Checkout::where('discount_id', $discount->id)
                    ->where('user_id', auth()->user()->id)
                    ->exists();

            //Discount check, is user already use the discount or not
            if (!$code) {
                if ($discount->type == 'percentage') {
                    $discountPrice = $price * $discount->amount / 100;
                    $discountAmount = $discount->amount;
                    $total = $price - $discountPrice;
    
                    $request->merge([
                        'discount_id' => $discount->id,
                        'discount_amount' => $discountAmount,
                    ]);
    
                } else {
                    $discountPrice = $price - $discount->amount;
                    $discountAmount = $discount->amount;
                    $total = $discountPrice;
    
                    $request->merge([
                        'discount_id' => $discount->id,
                        'discount_amount' => $discountAmount,
                    ]);
                }
            } else {
                return redirect()->back()->with('fail', 'This Code has been used.');
            }
        }

        $request->merge([
            'user_id' => $user->id,
            'camp_id' => $camp->id,
            'total' => $total,
        ]);

        $data = $request->only([
            'name', 'email', 'user_id', 'camp_id', 'discount',
            'discount_id', 'discount_amount', 'total'
        ]);

        try {
            DB::beginTransaction();
            $checkout = new Checkout($data);
            $checkout = $this->checkoutRepository->store($checkout);

            $checkoutDetail = TransactionDetail::create([
                'checkout_id' => $checkout->id,
                'payment_status' => TransactionDetail::PENDING,
                'price' => $checkout->camp->price,
                'discount_amount' => $checkout->discount_amount,
                'total' => $checkout->total,
            ]);

            $checkoutDetail->save();

            $this->getSnapRedirect($checkout);

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

    //Midtrans Handler
    public function getSnapRedirect(Checkout $checkout)
    {   
        $orderId =  'CAMP' . '-' . mt_rand(0000, 9999) . '-' . $checkout->id;
        $price = (int) $checkout->camp->price;

        $checkout->transaction_code = $orderId;

        $discountPrice = 0;
        
        $itemDetails[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment for {$checkout->camp->title} Camp",
        ];

        if ($checkout->discount) {
            if ($checkout->discount->type == 'percentage') {
                $discountPrice = $price * $checkout->discount->amount / 100;
                $discountAmount = $checkout->discount_amount * $price / 100;
                $discount = number_format($checkout->discount->amount, 0, ', ', '.');
                $total = $price - $discountPrice;
                $itemDetails[] = [
                    'id' => $checkout->discount->code,
                    'price' => -$discountAmount,
                    'quantity' => 1,
                    'name' => "Discount {$checkout->discount->title} ({$discount} %)",
                ];
            
            } else {
                $discountPrice = $price - $checkout->discount->amount;
                $discountAmount = $checkout->discount->amount;
                $discount = number_format($checkout->discount->amount, 0, ', ', '.');
                $total = $price - $discountPrice;
                $itemDetails[] = [
                    'id' => $checkout->discount->code,
                    'price' => -$discountAmount,
                    'quantity' => 1,
                    'name' => "Discount {$checkout->discount->title} ({$discount})",
                ];
            }
        }

        $total = $price - $discountPrice;

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $total
        ];

        $userData = [
            'first_name' => $checkout->name,
            'last_name' => '',
            'address' => $checkout->user->userProfile->address,
            'country_code' => 'IDN',
        ];

        $customerDetails = [
            'first_name' => $checkout->name,
            'last_name' => '',
            'email' => $checkout->email,
            'phone' => $checkout->user->userProfile->phone_number,
            'billing_address' => $userData,
            'shipping_address' => $userData
        ];

        $midtrans_params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'item_details' => $itemDetails
        ];

        try {
            DB::beginTransaction();

            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

           return redirect()->back()->withErrors([
            'errors' => $th->getMessage()
           ]);
        }

        return $paymentUrl;
    }

    public function midtransCallback(Request $request)
    {
        //Instance notification midtrans
        $notification = $request->method() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request->order_id);

        //Assign Variable
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        $checkout_id = explode('-', $notification->order_id) [2];
        $checkout = $this->checkoutRepository->findByColumn($checkout_id, 'id');

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                //TODO Set Payment status in merchant's database to 'challenge'
                $checkout->payment_status = 'pending';
            } else if ($fraudStatus == 'accept') {
                //TODO Set Payment status in merchant's database to 'success'
                $checkout->payment_status = 'success';
            }
        }
        else if ($transactionStatus == 'cancel') {
            if ($fraudStatus == 'challenge') {
            //TODO Set Payment status in merchant's database to 'failed'
                $checkout->payment_status = 'failed';
            } else if ($fraudStatus == 'accept') {
            //TODO Set Payment status in merchant's database to 'failed'
                $checkout->payment_status = 'failed';
            }
        }
        else if ($transactionStatus == 'deny') {
            //TODO Set Payment status in merchant's database to 'failed'
            $checkout->payment_status = 'failed';
        }
        else if ($transactionStatus == 'settlement') {
            //TODO Set Payment status in merchant's database to 'settlement'
            $checkout->payment_status = 'success';
        }
        else if ($transactionStatus == 'pending') {
            //TODO Set Payment status in merchant's database to 'pending'
            $checkout->payment_status = 'pending';
        }
        else if ($transactionStatus == 'expire') {
            //TODO Set Payment status in merchant's database to 'failed'
            $checkout->payment_status = 'failed';
        }

        $checkout->save();
        
        return view('pages.checkouts.success-payment');
    }

    public function success()
    {
        return view('pages.checkouts.success-checkout');
    }

    public function manualPayment(Checkout $checkout)
    {
        return view('pages.checkouts.manual-payment', [
            'checkout' => $checkout
        ]);
    }
}
