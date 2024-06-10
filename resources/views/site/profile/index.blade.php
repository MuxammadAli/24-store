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
            <li class="breadcrumb-item active">
                @lang('app.auth.profile')
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

                    @if(session()->get('info'))
                        <div class="alert-info alert">
                            <i class="fa fa-info-circle"></i> {{ session()->get('info') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert-danger alert">
                            @foreach($errors->all() as $error)
                                <i class="fa fa-info-circle"></i> {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="cabinet-content">
                        <h6 class="mb-4">
                            @lang('app.profile.personal_data')
                        </h6>

                        <form action="{{ route('profile.update') }}" method="post" class="my-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="name">@lang('app.profile.name')</label>
                                        <input type="text" placeholder="" id="name" name="name"
                                               value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="fist-name">@lang('app.profile.first')</label>
                                        <input type="text" placeholder="" id="fist-name" name="first_name"
                                               value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="last-name">@lang('app.profile.last')</label>
                                        <input type="text" placeholder="" id="last-name" name="last_name"
                                               value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="birthday">@lang('app.profile.birth')</label>
                                        <input type="date" placeholder="" id="birthday" name="birth_day"
                                               value="{{ old('birthday', auth()->user()->birth_day) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="gender">@lang('app.profile.sex')</label>
                                        <div class="genders pt-1">
                                            <div class="custom-control custom-radio custom-control-inline mr-4">
                                                <input type="radio" class="custom-control-input" id="gender"
                                                       name="gender" value="1"
                                                       @if(old('gender', auth()->user()->gender)) checked @endif>
                                                <label class="custom-control-label"
                                                       for="gender"><span>@lang('app.profile.male')</span></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline mr-4">
                                                <input type="radio" class="custom-control-input" id="gender2"
                                                       name="gender" value="0"
                                                       @if(!old('gender', auth()->user()->gender)) checked @endif>
                                                <label class="custom-control-label"
                                                       for="gender2"><span>@lang('app.profile.female')</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="saved-phone">@lang('app.profile.phone')</label>
                                        <input type="tel" class="saved-phone" placeholder=""
                                               value="+{{ auth()->user()->phone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="email">@lang('app.profile.email')</label>
                                        <input type="email" class="email" name="email" placeholder=""
                                               value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="inn">@lang('app.profile.inn')*</label>
                                        <input type="text" name="inn" required class="inn" id="inn"
                                               value="{{ old('inn', auth()->user()->inn) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group mb-0">
                                        <label for="region_id">@lang('app.profile.region')</label>
                                        <select name="region_id" id="region_id">
                                            @foreach($regions as $region)
                                                <option
                                                    @if (old('region_id', auth()->user()->region_id) == $region->id) selected
                                                    @endif value="{{ $region->id }}">
                                                    {{ $region->name['ru'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-md-start justify-content-center mt-4">
                                        <button type="submit" class="btn btn-dark">
                                            @lang('app.profile.save')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
@push('js')
    <script>
        $(function ($) {
            $("#inn").mask("999999999", {placeholder: "_________ "});
        });
    </script>
@endpush
