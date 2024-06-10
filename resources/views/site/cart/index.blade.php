@extends('site.layouts.app')

@section('title', trans("app.cart.title"))

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">@lang('app.cart.title')</li>
        </ul>
    </div>
@endsection

@section('content')
    <cart-view :cart-data="{{ $cart }}" :prices-data="{{ json_encode($prices) }}" :login-info="{{ json_encode(auth()->check()) }}"></cart-view>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
