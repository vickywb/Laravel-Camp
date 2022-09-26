@extends('layouts.auth-admin', [
    'headerTitle' => 'Camp Benefit',
    'activePage' => 'camp-benefit-edit',
    'breadcrumbs' => [
        [
            'title' => 'Camp Benefit',
            'url' => route('admin.camp-benefit.index')
        ],
        [
            'title' => 'Edit Camp Benefit: ' . $campBenefit->name,
        ]
    ]
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3">
                    <div class="card-header">
                        Edit Camp Benefit name: {{ $campBenefit->name }}
                    </div>
                    <div class="card-body">
                        @include('partials._form-errors')

                        <form action="{{ route('admin.camp-benefit.update', $campBenefit) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            @include('admin.campbenefits.form', [
                                'camps' => $camps,
                                'campBenefit' => $campBenefit
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

