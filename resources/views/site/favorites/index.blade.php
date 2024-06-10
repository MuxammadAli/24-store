@extends('site.layouts.app')

@section('title', trans("app.auth.profile"))

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.main.page') }}">
                    @lang('app.main')
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('profile') }}">
                    @lang('app.auth.profile')
                </a>
            </li>

            <li class="breadcrumb-item active">
                @lang('app.profile.favorites.title')
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="section-cabinet">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-5 col-md-6">
                    @include('site.includes.cabinetMenu')
                </div>
                <div class="col-xl-9 col-lg-7 col-md-6 mt-md-0 mt-4">

                    @if(session()->has('info'))
                        <div class="alert-info alert">
                            <i class="fa fa-info-circle"></i> {{ session()->pull('info') }}
                        </div>
                    @endif

                    <div class="cabinet-content">
                        <favorite-block :products="{{ json_encode($favorites) }}" :login-info="{{ json_encode(auth()->check()) }}"></favorite-block>

                        {{ $favorites->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush

@push('css')

@endpush

