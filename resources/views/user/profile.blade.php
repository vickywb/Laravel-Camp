@extends('layouts.auth-user')

@section('content')
<div class="container py-5">
    @include('partials._messages')
    <div class="card">
       <div class="card-body">
        <form action="{{ route('user.upload-profile', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row col-12">
                <div class="col-md-12">
                    <div class="card-body">
                        <label for="formFile" class="form-label"><img src="{{ $user->userProfile->fileUrl ?? asset('images/beatrice.png') }}" alt="" width="100px" height="100px" class="rounded-circle"></label>
                        <input class="form-control" type="file" id="formFile" name="image" accept=".png, .jpg">
                        <span><p style="font-size:0.7rem" class="text-danger">File should be: jpg, png and max 2mb.</p></span>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-6" style="padding-left: 2%; padding-right: 2%;">
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ $user->name }}" placeholder="Name" aria-label="Name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6">
                  <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ $user->occupation }}" placeholder="Occupation" aria-label="Occupation">

                    @error('occupation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-6" style="padding-left: 2%; padding-right: 2%;">
                    <input id="phone_number" type="text" maxlength="13" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->userProfile->phone_number }}" placeholder="Phone Number" aria-label="Phone Number">

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->userProfile->address }}" placeholder="Address" aria-label="Address">
                    
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
            </div>
            <div class="row">
                <div class="col-6 d-md-flex justify-content-md-start" style="padding-left: 2%;">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary me-md-2" style="width: 10rem;">Cancel</a>
                </div>
                <div class="col-6 d-md-flex justify-content-md-end" >
                    <button class="btn btn-primary me-md-2" type="submit" style="width: 10rem;">Save</button>
                </div>
            </div>
            {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2" style="padding-left: 1%; padding-right: 1%;">
                <button class="btn btn-primary me-md-2" type="submit" style="width: 10rem;">Save</button>
            </div> --}}
        </form>
       </div>
    </div>
</div>
@endsection