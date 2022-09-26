@extends('layouts.auth-admin', [
    'headerTitle' => 'Camp',
    'activePage' => 'camp-edit',
    'breadcrumbs' => [
        [
            'title' => 'State',
            'url' => route('admin.camp.index')
        ],
        [
            'title' => 'Edit Camp: ' . $camp->title,
        ]
    ]
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3">
                    <div class="card-header">
                        Edit Camp id: {{ $camp->name }}
                    </div>
                    <div class="card-body">
                        @include('partials._form-errors')

                        <form action="{{ route('admin.camp.update', $camp) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
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
