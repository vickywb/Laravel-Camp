@extends('layouts.auth-admin', [
    'headerTitle' => 'Discount'
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3">
                    <div class="card-header">
                        Edit Discount id: {{ $discount->id }}
                    </div>
                    <div class="card-body">
                        @include('partials._form-errors')

                        <form action="{{ route('admin.discount.update', $discount) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
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