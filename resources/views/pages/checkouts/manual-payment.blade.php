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
                        {{-- <div class="col-3">
                            @if ($checkout->payment_status == 'pending')
                            <form action="{{ route('admin.update.checkout', $checkout) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-md">Update Payment Status</button>
                            </form>
                            @endif
                        </div> --}}
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
                                        <b>Expired in: {{ $checkout->paymentTimeExpired }}</b></p>
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
                                        <b>Payment Method:</b></p>
                                </span>
                            </div>
                            <div class="col-3">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Manual</b></p>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Payment Status</b></p>
                                </span>
                            </div>
                            <div class="col-3">
                                @if ($checkout->payment_status == 'success')
                                <span class="text-success">
                                    <h6><b>{{ $checkout->transaction->payment_status }}</b></h6>
                                </span>
                                @elseif ($checkout->payment_status == 'pending')
                                <span class="text-warning">
                                    <h6><b>{{ $checkout->transaction->payment_status }}</b></h6>
                                </span>
                                @else
                                <span class="text-danger">
                                    <h6><b>{{ $checkout->transaction->payment_status }}</b></h6>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-left: 1.7em">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Bank Name</b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Bank Number</b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b></b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Name</b>
                                    </p>
                                </span>
                            </div>
                            <div class="col-3">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b><img src="{{ asset('images/bca.svg') }}" width="75px"></b>
                                    </p>
                                </span>
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>01010101011</b>
                                    </p>
                                    <p
                                    style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                    <b>Pikio</b>
                                </p>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9" style="padding-left: 1.7em">   
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>Admin Operational Time</b>
                                    </p>
                                </span>
                            </div>
                            <div class="col-3">
                                <span>
                                    <p
                                        style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left:0.2em">
                                        <b>09.00AM - 16.00PM</b>
                                    </p>
                                </span></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-2 d-flex" style="padding-left: 1em">
                            <a class="btn btn-primary"
                                href="https://wa.me/08xxxxxxxx?text=Hi Admin, Saya ingin Konfirmasi pembayaran kelas {{ $checkout->camp->title }}, terimakasih">
                                Confirmation Manual Payment
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end" style="padding-right: 1em"><a href="{{ route('user.transaction.index') }}" class="btn btn-success col-md-10" role="button">Oke</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
{{-- <div class="card">
    <div class="row">
        <span style="margin-left: 1em; margin-top: 1em">
            <h6>Choose your Payment</h6>
        </span>
    </div>
    <div class="card-body">
        <div class="row">
            <ul class="mb-3 nav nav-tabs" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-otomatis-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-otomatis" type="button" role="tab" aria-controls="pills-otomatis"
                        aria-selected="true">Otomatis</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-manual-tab" data-bs-toggle="pill" data-bs-target="#pills-manual"
                        type="button" role="tab" aria-controls="pills-manual" aria-selected="false" tabindex="-1">
                        Manual Transfer
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-otomatis" role="tabpanel"
                    aria-labelledby="pills-otomatis-tab">
                    <div class="my-4">
                        <button type="button" class="btn button-promo" data-bs-toggle="modal"
                            data-bs-target="#promoModal">
                            <div class="flex-row content d-flex justify-content-between align-items-center">
                                <div class="pe-3">
                                    <img src="https://buildwithangga.com/themes/front/images/ic_promo.svg" alt="promo"
                                        class="w-7">
                                </div>
                                <input type="text" id="kode_promo_tab_otomatis"
                                    class="flex-fill input-promo fw-bold text-uppercase promo_code"
                                    placeholder="Pakai promo agar lebih hemat" value="JADICEPE">
                                <div>
                                    <img src="https://buildwithangga.com/themes/front/images/chevron-right.svg"
                                        alt="promo" height="24">
                                </div>
                            </div>
                        </button>
                    </div>
                    <h5 class="header-title">
                        Payment details
                    </h5>
                    <div class="item">
                        <p class="title">
                            Harga kelas
                        </p>
                        <p class="value">
                            Rp 599,000
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <p class="title">
                            Kode unik
                        </p>
                        <p class="value text-green">
                            - Rp 114
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <p class="title">
                            Midtrans &amp; service fee
                        </p>
                        <p class="value text-green">
                            +
                            Rp 10,000
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <p class="title">
                            Total transfer
                        </p>
                        <input id="default_midatrans_price" name="default_midatrans_price" value="608886" hidden="">
                        <p class="value">
                            <strong id="midtransPrice">Rp 109.886</strong>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <a class="mt-4 mb-4 btn btn-primary btn-midtrans" href="#">
                        Bayar Menggunakan Midtrans
                    </a>
                </div>
                <div class="tab-pane fade" id="pills-manual" role="tabpanel" aria-labelledby="pills-manual-tab">
                    <div class="my-4">
                        <button type="button" class="btn button-promo" data-bs-toggle="modal"
                            data-bs-target="#promoModal">
                            <div class="flex-row content d-flex justify-content-between align-items-center">
                                <div class="pe-3">
                                    <img src="https://buildwithangga.com/themes/front/images/ic_promo.svg" alt="promo"
                                        class="w-7">
                                </div>
                                <input type="text" id="kode_promo_tab_manual"
                                    class="flex-fill input-promo fw-bold text-uppercase promo_code"
                                    placeholder="Pakai promo agar lebih hemat" value="JADICEPE">
                                <div>
                                    <img src="https://buildwithangga.com/themes/front/images/chevron-right.svg"
                                        alt="promo" height="24">
                                </div>
                            </div>
                        </button>
                    </div>
                    <h5 class="header-title">
                        Payment details
                    </h5>
                    <div class="item">
                        <p class="title">
                            Camp Price
                        </p>
                        <p class="value">
                            Rp. {{ number_format($camp->price, 0, ', ', '.') }}
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <p class="title">
                            Discount Title
                        </p>
                        <p class="value text-green">
                            - Rp 114
                        </p>
                    </div>
                    <div class="item">
                        <p class="title">
                            Service fee
                        </p>
                        <p class="value text-green">
                            +
                            Rp 6,000
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <p class="title">
                            Total transfer
                        </p>
                        <p class="value">
                            <input type="text" id="default_manual_price" name="default_manual_price" value="598886"
                                hidden="">
                            <strong id="manualPrice">Rp 105.886</strong>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="my-5"></div>
                    <h5 class="mb-4 header-title">
                        Transfer pembayaran
                    </h5>
                    <div class="mb-4 item-bank">
                        <img src="{{ asset('images/logo_bca.png') }}" class="mb-2 logo">
                        <p class="info">
                            PT Angga Membangun Indonesia (Admin Shalsa)
                        </p>
                        <p class="info">
                            <strong>123456789</strong>
                        </p>
                    </div>
                    <a class="mt-2 mb-4 btn btn-primary btn-confirmation"
                        href="https://wa.me/08xxxxxxxx?text=Hi Admin, Saya ingin Konfirmasi pembayaran kelas {{ $camp->title }}, terimakasih">
                        Konfirmasi Pembayaran Manual
                    </a>
                    <div class="div">
                        <span><b>Jam Operational 09.00 AM - 16.00 PM</b></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> --}}