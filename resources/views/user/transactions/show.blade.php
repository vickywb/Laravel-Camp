@extends('layouts.auth-user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            @include('partials._form-errors')
            <div class="card mt-3">
                <div class="card-header" style="background-color:#631bab;">
                    <div class="row">
                        <div class="col-9 px-2 mb-3">
                            <img src="{{ asset('images/logo.png') }}" alt="logo" style="height:40px;">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="row">
                            <div class="col-7">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:1em; margin-top:1em">
                                        <b>Total</b></p>
                                </span>
                            </div>
                            <div class="col-5">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:1em; margin-top:1em">
                                        <b>Transaction Date: {{ $checkout->created_at->format('M j Y H:i') }}</b></p>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10" style="padding-left: 1.7em">
                                <span>
                                    <h3><b>Rp. {{ number_format($checkout->total, 0, ', ', '.') }}</b></h3>
                                </span>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-6" style="padding-left: 1.5em">
                                <span class="text-muted">
                                    <p style="font-size: 0.8em; padding-left: 0.2em"><b>Order ID #{{
                                            $checkout->transaction_code }}</b></p>
                                </span>
                            </div>
                        </div>
                        <hr style="margin-top: 0px">
                        <div class="row mb-0">
                            <div class="col-6" style="padding-left: 1.5em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Order Items</b></p>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        1 Payment for {{ $checkout->camp->title }}</p>
                                </span>
                            </div>
                            <div class="col-3" style="padding-bottom:1em">
                                <span><b>Rp. {{ number_format($checkout->camp->price, 0, ', ', '.') }}</b></span>
                            </div>
                            @if ($checkout->discount)
                            @if ($checkout->discount->type == 'percentage')
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        1 Discount {{ $checkout->discount->title }} ({{
                                        number_format($checkout->discount_amount, 0, ', ', '.') }}%)</p>
                                </span>
                            </div>
                            <div class="col-3" style="padding-bottom:1em">
                                <span><b> -Rp. {{ number_format($checkout->discountType, 0, ', ', '.') }}</b></span>
                            </div>
                            @else
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        1 Discount {{ $checkout->discount->title }} (Rp. {{
                                        number_format($checkout->discount_amount, 0, ', ', '.') }})</p>
                                </span>
                            </div>
                            <div class="col-3" style="padding-bottom:1em">
                                <span><b> -Rp. {{ number_format($checkout->discountType, 0, ', ', '.') }}</b></span>
                            </div>
                            @endif
                            @endif
                        </div>
                        <hr style="margin-top: 0px;border-top:0.2em dotted;">
                        <div class="row">
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Total</b></p>
                                </span>
                            </div>
                            <div class="col-3" style="padding-bottom:1em">
                                <span><b>Rp. {{ number_format($checkout->total, 0, ', ', '.') }}</b></span>
                            </div>
                        </div>
                        <hr style="margin-top: 0px">
                        <div class="row">
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Customer Detail:</b></p>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Payment Status</b></p>
                                </span>
                            </div>
                            <div class="col-4">
                                @if ($checkout->payment_status == 'success')
                                <span class="text-success">
                                    <h6><b>{{ $checkout->transaction->payment_status }}</b></h6>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>User Name</b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Email</b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Phone Number</b>
                                    </p>
                                </span>
                            </div>
                            <div class="col-4">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>{{ auth()->user->name ?? $checkout->name }}</b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>{{ auth()->user->email ?? $checkout->email }}</b>
                                    </p>
                                    <p
                                    style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                    <b>{{ auth()->user()->userProfile->phone_number }}</b>
                                </p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="d-flex justify-content-end mb-2" style="padding-right: 1em"><a href="{{ route('user.transaction.index') }}" class="btn btn-success col-md-6" role="button">Oke</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
