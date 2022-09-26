@extends('layouts.auth-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-2">
            @include('partials._form-errors')
            <div class="card mt-3">
                <div class="card-header">
                   <div class="row">
                    <div class="col-9">
                        <p>Transaction Detail id : {{ $checkout->id }}</p>
                    </div>
                    <div class="col-3">
                        @if ($checkout->payment_status == 'pending')
                        <form action="{{ route('admin.update.checkout', $checkout) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-md">Update Payment Status</button>
                        </form>
                        @endif
                    </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <p>Transaction Code : {{ $checkout->midtrans_booking_code }}</p>
                        </div>
                        <div class="col-3">
                            <p>Payment Status : 
                                @if ($checkout->payment_status === 'success')
                                <strong class="text-success">SUCCESS</strong>
                                @else
                                    <strong class="text-danger">PENDING</strong>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p>Name : {{ $checkout->user->name }}</p>
                                <p>Email : {{ $checkout->user->email }}</p>
                                <p>Camp Title : {{ $checkout->camp->title }}</p>
                                <p>Price : Rp. {{ number_format($checkout->camp->price, 0, ', ', '.') }}</p>
                                @if ($checkout->discount)
                                    @if ($checkout->discount->type == 'percentage')
                                        <p>Discount Amount : {{ number_format($checkout->discount_amount, 0, ', ', '.') }}%</p>
                                    @else
                                        <p>Discount Amount : Rp. {{ number_format($checkout->discount_amount, 0, ', ', '.') }}</p>
                                    @endif
                                @else
                                    <p>Discount Amount : Rp. {{ number_format($checkout->discount_amount, 0, ', ', '.') }}</p>
                                @endif
                                <p>Total Price : Rp. {{ number_format($checkout->total, 0, ', ', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection