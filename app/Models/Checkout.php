<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'camp_id', 'name', 'email', 'payment_status', 'midtrans_url',
        'transaction_code', 'discount_id', 'discount_amount', 'total',
    ];

    // protected $casts = [
    //     'expired_date' => 'datetime',
    // ];

    const PENDING = 'pending';
    const SUCCESS = 'success';

    const MIDTRANS = 'midtrans';
    const MANUAL = 'manual';

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function transaction()
    {
        return $this->hasOne(TransactionDetail::class);
    }

    //Attribute
    public function getTodayRevenueAttribute()
    {   
        $today = Carbon::today();
        $todayRevenue = $this->whereDate('created_at', $today)
            ->where('payment_status', 'success')
            ->sum('total');

        if (!$todayRevenue) {
            return 0;
        }

        return number_format($todayRevenue, 0, ', ', '.');
    }

    public function getOneWeekRevenueAttribute()
    {   
        $oneWeek = Carbon::today()->subDays(7);
        $oneWeekRevenue = $this->where('created_at', '>=', $oneWeek)
            ->where('payment_status', 'success')
            ->sum('total');

        return number_format($oneWeekRevenue, 0, ', ', '.');
    }

    public function getOneMonthRevenueAttribute()
    {
        $oneMonth = Carbon::today()->subDays(30);
        $oneMonthRevenue = $this->where('created_at', '>=', $oneMonth)
            ->where('payment_status', 'success')
            ->sum('total'); 
        
        return number_format($oneMonthRevenue, 0, ', ', '.');
    }

    public function getTotalRevenueAttribute()
    {
        $totalRevenue = $this->where('payment_status', 'success')
            ->sum('total');

        return number_format($totalRevenue, 0, ', ', '.');
    }

    public function getSuccessTransactionAttribute()
    {
        $successTransaction = $this->where('payment_status', 'success')->count();

        return $successTransaction;
    }

    public function getPendingTransactionAttribute()
    {
        $pendingTransaction = $this->where('payment_status', 'pending')->count();
        
        return $pendingTransaction;
    }

    public function getPaymentTimeExpiredAttribute()
    {
        $expiredTime = Carbon::parse($this->created_at)->addDays(1)->format('M j Y H:i');
     
        return $expiredTime;
    }

    public function getDiscountTypeAttribute()
    {
        $price = (int) $this->camp->price;

        if ($this->discount) {
            if ($this->discount->type == 'percentage') {
                $discountAmount = $this->discount_amount * $price / 100;
                $total = $discountAmount;
            } else {
                $discountAmount = $this->discount->amount;
                $total = $discountAmount;
            }
        }

        return $total;
    }
}
