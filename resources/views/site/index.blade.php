@extends('site.layouts.app')

@section('title', trans('app.main'))

@section('content')
    @foreach($compilations as $compilation)
        <section class="section-popular-product products">
            <div class="container">
                <a href="{{ route('compilation.view', $compilation->id) }}">
                    <h2 class="section-title">{{ $compilation->getTitle() }}</h2>
                </a>
                <products-slider
                    @if ($compilation->type == 'default')
                        :products-data="{{ json_encode($compilation->products) }}"
                    @elseif ($compilation->type == 'coin')
                        :products-data="{{ json_encode($compilation->coin_products) }}"
                    @endif
                    :login-info="{{ json_encode(auth()->check()) }}"></products-slider>
            </div>
        </section>
    @endforeach

    <section class="section-popular-product products mb-5">
        <div class="container">
            <h2 class="section-title">@lang('app.partners')</h2>
            <partner-slider :brands-data="{{ json_encode($brands) }}"></partner-slider>
        </div>
    </section>

@endsection

@push('js')

@endpush

@push('meta')
    <meta name="robots" content="all">
    <meta name="description" content="{{ $setting->getDescription() }}">
    <meta name="keywords" content="{{ $setting->getKeywords() }}">
    <meta property="og:title" content="{{ $setting->getTitle() }}">
    <meta property="og:description" content="{{ $setting->getDescription() }}">
    <meta property="og:type" content="site">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:site_name" content="{{ env('APP_LINK') }}">
@endpush
