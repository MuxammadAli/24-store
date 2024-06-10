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
    <checkout-view  :cart-data="{{ $cart }}" :prices-data="{{ json_encode($prices) }}" :regions-data="{{ json_encode($regions) }}" :login-info="{{ json_encode(auth()->check()) }}" :pickup-info="{{ json_encode($pickup) }}"  :first-name="{{ auth()->check() ? json_encode(auth()->user()->first_name) : json_encode(null) }}" :address-data="{{ auth()->check() ? json_encode(auth()->user()->addresses) : json_encode(null) }}"></checkout-view>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
