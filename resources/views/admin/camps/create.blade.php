@extends('layouts.auth-admin', [
    'headerTitle' => 'Camp',
    'activePage' => 'camp-create',
    'breadcrumbs' => [
        [
            'title' => 'Camp',
            'url' => route('admin.camp.index')
        ],
        [
            'title' => 'New Camp',
        ]
    ]
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3">
                    <div class="card-header">
                        Insert a new camp
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.camp.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('admin.camps.form', [
                                'camp' => $camp,
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection