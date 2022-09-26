@extends('layouts.auth-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1 mt-5">
            @include('partials._messages')
            <div class="card">
                <div class="card-header">
                    Camp Benefit Dashboard
                </div>
                <div class="card-body">
                    <div class="row m3-5">
                   <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.camp-benefit.create') }}" class="btn btn-success">Create</a>
                    </div>
                       <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Camp Title</th>
                                    <th>Name</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campBenefits as $campBenefit)
                                    <tr class="align-middle">
                                        <td>
                                            {{ $campBenefit->camp->title }}
                                        </td>
                                        <td>
                                            {{ $campBenefit->name }}
                                        </td>
                                        <td>
                                            {{ $campBenefit->created_at->format('M d, Y') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-primary mb-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Action
                                            </a>
                                            <div class="collapse" id="collapseExample">
                                                <a href="{{ route('admin.camp-benefit.edit', $campBenefit) }}" class="btn btn-success btn-sm mb-1 mt-1">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('admin.camp-benefit.delete', $campBenefit) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are u sure delete this?')"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $campBenefits->links('components.pagination') }}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection