@extends('layouts.app', [
    'headerTitle' => 'Index',
    'activePage' => 'Index',
    'breadcrumbs' => [
        [
        'title' => 'Laracamp'
        ]
    ]
])
@section('content')

    {{-- Banner Page --}}
    @include('pages.banner')

    @include('pages.benefits')

    @include('pages.step')

    @include('pages.pricing')

    @include('pages.testimonials')

@endsection