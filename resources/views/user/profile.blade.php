@extends('layouts.auth-user')

@section('content')
<section class="dashboard my-5">
    <div class="container">
        <div class="card">
            <div class="row">
                 <div class="col-md-12">
                     <div class="card-body mb-3">
                        <label for="formFile" class="form-label"><img src="{{ $user->fileUrl ?? asset('images/beatrice.png') }}" alt="" width="100px" height="100px"></label>
                        <input class="form-control" type="file" id="formFile" name="image">
                        <span><h6><p>abcd</p></h6></span>
                     </div>
                 </div>
            </div>
         </div>
    </div>
</section>
@endsection