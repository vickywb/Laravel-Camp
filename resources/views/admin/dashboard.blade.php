@extends('layouts.auth-admin', [
    'headerTitle' => 'Dashboard Admin',
    'breadcrumbs' => [
        [
        'title' => 'Laracamp'
        ]
    ]
])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1 mt-5">
            @include('partials._messages')
            <div class="card">
                <div class="card-header">
                    Dashboard Admin
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> Total Member : </p>
                                </div>
                                <div class="card-body">
                                    <p class="d-flex justify-content-center"> {{ auth()->user()->count() }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> Total Success Transaction : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                            <p class="d-flex justify-content-center"> {{ $checkout->successTransaction }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> Total Pending Transaction : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                            <p class="d-flex justify-content-center"> {{ $checkout->pendingTransaction }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> Total Transaction : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                            <p class="d-flex justify-content-center"> {{ $checkout->count() }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> Today Total Revenue : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                            <p class="d-flex justify-content-center">Rp. {{ $checkout->todayRevenue }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div><div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> 7 Day Total Revenue : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                        <p class="d-flex justify-content-center">Rp. {{ $checkout->oneWeekRevenue }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div><div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> 30 Day Total Revenue : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                        <p class="d-flex justify-content-center">Rp. {{ $checkout->oneMonthRevenue }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    <p class="d-flex justify-content-center"> All Total Revenue : </p>
                                </div>
                                <div class="card-body">
                                    @foreach ($checkouts as $checkout)
                                        <p class="d-flex justify-content-center">Rp. {{ $checkout->totalRevenue }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection