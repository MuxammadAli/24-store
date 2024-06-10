<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if(!empty($seo_title) && $seo_title != 'null')
        <title>{{ $seo_title }}</title>
    @else
        <title>@yield('title') | {{ $setting->getTitle() }}</title>
    @endif

    <link rel="apple-touch-icon" sizes="152x152" href="/vendor/site/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/vendor/site/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/vendor/site/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/vendor/site/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/vendor/site/img/favicon/safari-pinned-tab.svg" color="#10182b">
    <link rel="shortcut icon" href="/vendor/site/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#10182b">
    <meta name="msapplication-TileImage" content="/vendor/site/img/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/vendor/site/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#10182b">

    @stack('meta')

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/vendor/site/libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/site/libs/fontawesome/css/all.min.css">
{{--    <link rel="stylesheet" href="/vendor/site/libs/swiper/css/swiper-bundle.min.css">--}}
    <link rel="stylesheet" href="/vendor/site/css/main.min.css">

    @stack('css')

</head>

<body>
<div id="app">
    <div class="top-navbar">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img src="/vendor/site/img/brand-logo.svg" alt="Logo">
            </a>
            <div class="top-navbar--right">
                <a href="tel:{{ $setting->getPhone() }}" class="call-centre">
                    @lang('app.call_center'): {{ $setting->getPhone() }}
                </a>

                <div class="lang">
                    <span>{{ app()->getLocale() === 'ru' ? 'Ru' : 'Uz' }} <i class="far fa-chevron-down"></i></span>
                    <div class="lang-list">
                        <a  @if (app()->getLocale() === 'ru') href="#" @else href="{{ route('site.setLocale', 'ru') }}" @endif>Ru</a>
                        <a @if (app()->getLocale() === 'uz') href="#" @else href="{{ route('site.setLocale', 'uz') }}" @endif>Uz</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar">
        <div class="container position-relative h-100">
            <div class="navbar-inner h-100">
                <div class="mobile-menu h-100">
                    <button class="navbar-close d-flex d-lg-none" type="button">
                        <i class="fal fa-times fa-times fa-2x"></i>
                    </button>

                    <a class="big-menu-dropdown-trigger" href="#0">
                        <div class="menu-open">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p>@lang('app.all_categories')</p>
                    </a>

                    <div class="search d-lg-inline-block d-none">
                        <form action="{{ route('search') }}" method="get">
                            <input type="text" name="name" value="{{ !empty(request()->get('name')) ? request()->get('name') : ''  }}" placeholder="@lang('app.search.products')">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>

                    <div class="d-flex justify-content-between align-items-center widjets">
                        @guest
                            <button class="sign-in" type="button" data-target="#sing-in-1" data-toggle="modal">
                                <i class="fas fa-user"></i>
                                <span class="">@lang('app.layout.login')</span>
                            </button>

                            <div class="favourite mx-4 d-lg-inline-block d-none">
                                <a href="#" data-target="#sing-in-1" data-toggle="modal">
                                    <img src="/vendor/site/img/heart.svg" alt="heart icon">
                                    <span>
                                    <input type="text" id="favorite-count" readonly value="{{ auth()->check() ? auth()->user()->products()->count() : 0 }}">
                                </span>
                                </a>
                            </div>
                        @else
                            <a href="{{ route('profile') }}" class="sign-in" >
                                <i class="fas fa-user"></i>
                                <span class="">@lang('app.auth.profile')</span>
                            </a>

                            <a href="{{ route('logout') }}" class="sign-in ml-1" >
                                <i class="fas fa-sign-out-alt"></i>
                            </a>

                            <div class="favourite mx-2 d-lg-inline-block d-none ml-4">
                                <a href="{{ route('compilation.coin-product') }}">
                                    <img src="/vendor/site/img/profit.svg" alt="heart icon" width="32px">
                                    <span>
                                        <input type="text" id="favorite-count" readonly value="{{ auth()->check() ? auth()->user()->coins : 0 }}">
                                    </span>
                                </a>
                            </div>

                            <div class="favourite mx-2 d-lg-inline-block d-none">
                                <a href="{{ route('favorites') }}">
                                    <img src="/vendor/site/img/heart.svg" alt="heart icon">
                                    <span>
                                    <input type="text" id="favorite-count" readonly value="{{ auth()->check() ? auth()->user()->products()->count() : 0 }}">
                                </span>
                                </a>
                            </div>
                        @endguest





                        <cart-basket :mobile="0" :login-info="{{ json_encode(auth()->check()) }}"></cart-basket>

                    </div>

{{--                    <div class="navmenu d-lg-none mt-3 border-top">--}}
{{--                        <x-popular-category></x-popular-category>--}}
{{--                    </div>--}}

                    <a href="tel:{{ $setting->getPhone() }}" class="call-centre">@lang('app.call_centre'): {{ $setting->getPhone() }}</a>
                </div>

                <div class="d-flex justify-content-md-between align-items-center flex-grow-1 d-lg-none">
                    @guest
                        <button class="sign-in d-lg-flex d-none" type="button" data-target="#sing-in-1" data-toggle="modal">
                            <i class="fas fa-user"></i>
                            <span class="">@lang('app.layout.login')</span>
                        </button>
                    @else
                        <a href="{{ route('profile') }}" class="sign-in d-lg-flex d-none" >
                            <i class="fas fa-user"></i>
                            <span class="">@lang('app.auth.profile')</span>
                        </a>

                        <a href="{{ route('logout') }}" class="sign-in d-lg-flex d-none ml-1" >
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    @endguest

                    <div class="search d-md-inline-block d-none">
                        <form action="">
                            <input type="text" placeholder="@lang('app.search.products')">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>


                        <div class="favourite">
                            <a href="{{ route('favorites') }}">
                                <img src="/vendor/site/img/heart.svg" alt="heart icon">
                                <span>
                                    <input type="text" id="favorite-count" readonly
                                           value="{{ auth()->check() ? auth()->user()->products()->count() : 0 }}">
                                </span>
                            </a>

                        </div>


                    <cart-basket :mobile="1" :login-info="{{ json_encode(auth()->check()) }}"></cart-basket>

                </div>

                <button class="navbar-toggler p-0 d-flex d-lg-none ml-auto" type="button">
                    <div class="hamburger">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </button>

                <x-categories-header/>
            </div>

            <div class="search d-inline-block d-md-none w-100 mx-auto mt-2">
                <form action="">
                    <input type="text" placeholder="@lang('app.search.products')">
                    <button type="submit"><i class="far fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="navbar-second">
        <!-- Nav -->
        <div class="container">
{{--            <x-popular-category-mobile></x-popular-category-mobile>--}}
        </div>
    </div>
    <header >
        @if(request()->is('/'))
            <header-slider :slider-data="{{ $sliders }}"></header-slider>
        @endif
    </header>
    <main>
        @yield('breadcrumb')

        @yield('content')
    </main>

    @guest
        <login></login>
    @endguest

    <cart-preview :login-info="{{ json_encode(auth()->check()) }}"></cart-preview>
    <x-region-modal></x-region-modal>
</div>

<script src="{{ mix('js/vendor.js') }}"></script>

<script src="/vendor/site/libs/jquery/jquery.min.js"></script>
<script src="/vendor/site/libs/popper/popper.min.js"></script>
<script src="/vendor/site/libs/bootstrap/bootstrap.min.js"></script>
<script src="/vendor/site/libs/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="/vendor/site/libs/swiper/js/swiper-bundle.min.js"></script>
<script src="/vendor/site/js/main.js"></script>

@auth
    @if (empty(auth()->user()->region_id))
        <script>
            $('#region').modal('show')
        </script>
    @endif
@endauth
@guest
    @if (!\Illuminate\Support\Facades\Cookie::has('region'))
        <script>
            $('#region').modal('show')
        </script>
    @endif
@endguest

@stack('js')


</body>

</html>
