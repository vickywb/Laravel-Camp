@extends('layouts.auth-admin', [
    'headerTitle' => 'Discount'
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3">
                    <div class="card-header">
                        Insert a New Discount

                    </div>
                    <div class="card-body">
                        @include('partials._form-errors')

                        <form action="{{ route('admin.discount.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            @include('admin.discounts.form', [
                                'discount' => $discount,
                                'typeMaps' => $typeMaps
                            ])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection