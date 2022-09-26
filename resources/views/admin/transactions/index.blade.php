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
                    Transaction Dashboard
                </div>
                <div class="card-body">
                    <div class="row my-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Camp</th>
                                        <th>Price</th>
                                        <th>Register Data</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($checkouts as $checkout)
                                        <tr class="align-middle">
                                            <td>
                                               {{ $checkout->user->name }}
                                            </td>
                                            <td>
                                                {{ $checkout->camp->title }}
                                            </td>
                                            <td>
                                                <strong>Rp. {{ number_format($checkout->total, 0,', ', '.') }}</strong>
                                            </td>
                                            <td>
                                                {{ $checkout->created_at->format('M d, Y') }}
                                            </td>
                                            <td>
                                                @if ($checkout->payment_status === 'success')
                                                    <strong class="text-success">SUCCESS</strong>
                                                @else
                                                    <strong class="text-danger">PENDING</strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary mb-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    Action
                                                </a>
                                                <div class="collapse" id="collapseExample">
                                                    <a href="{{ route('admin.transaction.show', $checkout) }}" class="btn btn-success btn-sm mb-1 mt-1">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                @if ($checkout->payment_status != 'success')
                                                    <form action="{{ route('admin.update.checkout', $checkout->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary btn-sm">Update Payment</button>
                                                    </form>
                                                @endif
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $checkouts->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection