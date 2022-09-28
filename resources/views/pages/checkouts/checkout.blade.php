@extends('layouts.app')

@section('content')
<section class="checkout">
    <div class="container">
        <div class="row text-center pb-70">
            <div class="col-lg-12 col-12 header-wrap">
                <p class="story">
                    YOUR FUTURE CAREER
                </p>
                <h2 class="primary-header">
                    Start Invest Today
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="item-bootcamp">
                            <img src="{{ asset('images/item_bootcamp.png') }}" alt="" class="cover">
                            <h1 class="package">
                                {{ $camp->title }}
                            </h1>
                            <p class="description">
                                Bootcamp ini akan mengajak Anda untuk belajar penuh mulai dari pengenalan dasar sampai membangun sebuah projek asli
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-1 col-12"></div>
                    <div class="col-lg-6 col-12">
                        <form action="{{ route('checkout.store', $camp) }}" class="basic-form" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="InputName" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="InputName" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="InputEmail1" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="InputDiscount" class="form-label">Discount</label>
                                <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror" id="InputDiscount" value="{{ old('discount') }}">
                           
                                @if (session('fail'))
                                    <div class="alert alert-light" role="alert" style="padding-top: 0%; padding-bottom:0%">
                                        <strong><p class="text-danger" style="font-size: .875em;">{{ session('fail') }}</p></strong>
                                    </div>
                                @endif

                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button" style="border-radius: 1em">Pay Now!</button>
                              </div>
                            <p class="text-center subheader mt-4">
                                <img src="{{ asset('images/ic_secure.svg') }}" alt=""> Your payment is secure and encrypted.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<script type="text/javascript">
    const dateNow = new Date();
    let date = dateNow.getMonth();
    date += 1
    
    $("#datepicker").datepicker( {
        format: 'mm-yyyy',
        startView: 'months', 
        minViewMode: 'months',
        startDate: `${date}`,
    });
</script>
@endsection