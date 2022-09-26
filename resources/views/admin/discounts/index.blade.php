@extends('layouts.auth-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1 mt-5">
            @include('partials._messages')
            <div class="card">
                <div class="card-header">
                  Discount Dashboard
                </div>
                <div class="card-body">
                    <div class="row m3-5">
                   <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.discount.create') }}" class="btn btn-success">Create</a>
                    </div>
                       <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($discounts as $discount)
                            <tbody>
                                   <tr class="align-middle">
                                    <td>
                                        {{ $discount->title }}
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $discount->code }}</span>
                                    </td>
                                    <td>
                                        {{ $discount->type }}
                                    </td>
                                    <td>
                                        {{ number_format($discount->amount, 0,', ', '.') }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary mb-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Action
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <a href="{{ route('admin.discount.edit', $discount) }}" class="btn btn-success btn-sm mb-1 mt-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.discount.delete', $discount) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are u sure delete this?')"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        {{ $discounts->links('components.pagination') }}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection