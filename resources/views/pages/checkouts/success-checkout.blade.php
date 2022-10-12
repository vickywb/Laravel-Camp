@extends('layouts.app')

@section('content')
<section class="checkout">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12 col-12">
                <img src="{{ asset('images/ill_register.png') }}" height="400" class="mb-5" alt=" ">
            </div>
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    WHAT A DAY!
                </p>
                <h2 class="primary-header ">
                   Checkout Success
                </h2>
                <p>Please, Make a Payment now </p>
                <a href="{{ route('user.transaction.index') }}" class="btn btn-primary mt-3">
                    Transaction Dashboard
                </a>
            </div>
        </div>
    </div>
</section>
@endsection