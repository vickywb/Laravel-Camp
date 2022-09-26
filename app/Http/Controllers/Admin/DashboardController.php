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
        // $checkout = Checkout::where('payment_status', 'success')->count();
        // dd($checkout);
        $camps = $this->campRepository->get([
            'pagination' => 1
        ]);
 
        $checkouts = $this->checkoutRepository->get([
            'pagination' => 1,
        ]);
        // $today = Carbon::today()->subDays(30);
        // $todayRevenues = Checkout::where('created_at', '>=', $today)->get();
        // foreach ($todayRevenues as $todayRevenue) {
        //     dd($todayRevenue->total);
        // }

        return view('admin.dashboard', [
            'camps' => $camps,
            'checkouts' => $checkouts,
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
create table transaction
-checkout_id
-payment_status
-total
-timestamps

payment_transaction :
berlaku saat update satus?
-sub total
-total
-harga yang harus dibayar? amount_paid
sub_total = normal price?
total = sub total + (discount)?
amount_paid = harga asli  - kalau ada ( Discount)

if ($total != amount_paid) {
	$checkout->payment_status == 'pending'
} else {
	$checkout->payment_status == 'paid'
} 
