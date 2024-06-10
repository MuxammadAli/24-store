@extends('site.layouts.app')

@section('title', trans("app.sales.title"))

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.main.page') }}">
                    @lang('app.main')
                </a>
            </li>
            <li class="breadcrumb-item active">
                @lang('app.sales.title')
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="section-all-product">
        <stocks-block :search-data="{{ json_encode($products) }}" :login-info="{{ json_encode(auth()->check()) }}" ></stocks-block>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
