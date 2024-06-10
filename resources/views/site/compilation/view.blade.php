@extends('site.layouts.app', ['seo_title' => $compilation->title['ru']])

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('categories') }}">@lang('app.categories.title')</a>
            </li>

            <li class="breadcrumb-item active">{{ $compilation->title[app()->getLocale()] ?? $compilation->title['ru'] }}</li>
        </ul>
    </div>
@endsection

@section('title', $compilation->title['ru'])


@section('content')
    <compilation-view :products-data="{{ json_encode($products) }}" :login-info="{{ json_encode(auth()->check()) }}"></compilation-view>
@endsection

@push('js')

@endpush

{{--@push('meta')--}}
{{--    <meta name="description" content="{{ $descriptions }}">--}}
{{--    <meta name="keywords" content="{{ $keywords }}">--}}
{{--    <meta property="og:title" content="{{ $page_name }}">--}}
{{--    <meta property="og:description" content="{{ $descriptions }}">--}}
{{--    <meta property="og:type" content="category">--}}
{{--    <meta property="og:url" content="{{ env('APP_URL').$_SERVER['REQUEST_URI'] }}">--}}
{{--    <meta property="og:site_name" content="AliStore.uz">--}}
{{--    <meta name="robots" content="all">--}}
{{--@endpush--}}
