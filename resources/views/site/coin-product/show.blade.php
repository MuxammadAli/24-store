@extends('site.layouts.app', ['seo_title' => $product->getTitleSeo()])

@section('title', trans('app.buy').$product->getName())

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.main.page') }}">
                    @lang('app.main')
                </a>
            </li>

            @if($category)
                @if($category->parent)
                    @if($category->parent->parent)
                        <li class="breadcrumb-item">
                            <a href="{{ route('category.view', [$category->parent->parent->id, $category->parent->parent->slug]) }}">
                                {{ $category->parent->parent->getName() }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('category.show', [$category->parent->parent->id, $category->parent->parent->slug, $category->parent->id, $category->parent->slug]) }}">
                                {{ $category->parent->getName() }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('category.showParent', [$category->parent->parent->id, $category->parent->parent->slug, $category->parent->id, $category->parent->slug, $category->id, $category->slug]) }}">
                                {{ $category->getName() }}
                            </a>
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ route('category.view', [$category->parent->id, $category->parent->slug]) }}">
                                {{ $category->parent->getName() }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('category.show', [$category->parent->id, $category->parent->slug, $category->id, $category->slug]) }}">
                                {{ $category->getName() }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ route('category.view', [$category->id, $category->slug]) }}">
                            {{ $category->getName() }}
                        </a>
                    </li>
                @endif
            @endif

            <li class="breadcrumb-item active">{{ $product->getName() }}</li>
        </ul>
    </div>
@endsection

@section('content')
    @auth
        <coin-product-show :product-data="{{ json_encode($product) }}"
                           :products-related="{{ json_encode($popularProducts) }}" :setting-data="{{ $setting }}"
                           :login-info="true" :first-name="{{ json_encode(auth()->user()->first_name) }}"
                           :phone-profile="{{ auth()->user()->phone }}"
                           :coins="{{ auth()->user()->coins }}"></coin-product-show>
    @else
        <coin-product-show :product-data="{{ json_encode($product) }}"
                           :products-related="{{ json_encode($popularProducts) }}" :setting-data="{{ $setting }}"
                           :login-info="false" :first-name="null" :phone-profile="998"></coin-product-show>
    @endauth
@endsection

@push('js')
    <script src="/vendor/site/libs/slick/slick.min.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/jquery.mousewheel.min.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lightgallery.min.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-thumbnail.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-fullscreen.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-video.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-autoplay.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-zoom.js"></script>

    <script>
        // //////////////////////////////////////  Product Slider \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $(".slider-big").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            fade: true,
            asNavFor: ".slider-small",
            infinite: false,
            draggable: false,
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        fade: false,
                        arrows: true,
                        autoplaySpeed: 5000,
                        speed: 750,
                        arrows: true,
                    },
                },
            ],
        });

        $(".slider-small").slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: ".slider-big",
            dots: false,
            focusOnSelect: true,
            arrows: true,
            infinite: false,
            centerPadding: "10px",
            swipe: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 5,
                    },
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 6,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 6,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });

        $(document).ready(() => {
            // $('#aniimated-small').lightGallery({
            //   thumbnail: true,
            //   selector: '.item1',
            //   download: false,
            //   toogleThumb: true

            // });
            $('#aniimated-big').lightGallery({
                thumbnail: true,
                selector: '.item',
                download: false,
                toogleThumb: true
            });
        });

    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="/vendor/site/libs/slick/slick.css">
    <link rel="stylesheet" href="/vendor/site/libs/slick/slick-theme.css">
    <link rel="stylesheet" href="/vendor/site/libs/lightgallery/css/lightgallery.min.css">
@endpush

@push('meta')
    <meta name="description" content="{{ $product->getShortBody() }}">
    <meta name="keywords" content="{{ $product->getKeywords() }}">
    <meta type="image/jpeg" name="link" href="/{{ $product->getPoster() }}" rel="image_src">
    <meta property="og:title" content="{{ $product->getName() }}">
    <meta property="og:description" content="{{ $product->getShortBody() }}">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ route('product.show', [$product->id, $product->slug]) }}">
    <meta property="og:image" content=/{{ $product->getPoster() }}">
    <meta property="og:site_name" content="AliStore.uz">
    <meta name="robots" content="all">
@endpush
