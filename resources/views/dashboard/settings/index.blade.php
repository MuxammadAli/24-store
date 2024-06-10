@extends('dashboard.layouts.app')
@section('title', trans('admin.settings.title').' - ')
@section('links')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">
                        @lang('admin.settings.title')
                    </h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    @lang('admin.home')
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                @lang('admin.settings.title')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.settings.title')</h4>
                </div>
                <div class="card-content">
                    <form class="form" action="{{ route('dashboard.settings.update', $setting->id) }}"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="titleuz" required
                                                           class="form-control @error('title.ru') is-invalid @enderror"
                                                           value="{{ old('title.ru', $setting->title['ru']) }}"
                                                           name="title[ru]" placeholder="@lang('admin.settings.name')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-italic"></i>
                                                    </div>
                                                    <label for="titleuz">@lang('admin.settings.name') RU *</label>

                                                    @error('title.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="titleru" required
                                                           class="form-control @error('title.uz') is-invalid @enderror"
                                                           value="{{ old('title.uz', $setting->title['uz']) }}"
                                                           name="title[uz]" placeholder="@lang('admin.settings.name')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-italic"></i>
                                                    </div>
                                                    <label for="titleru">@lang('admin.settings.name') UZ *</label>

                                                    @error('title.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="phone" required
                                                   class="form-control @error('phone.default') is-invalid @enderror"
                                                   value="{{ old('phone.default', $setting->phone['default']) }}"
                                                   name="phone[default]" placeholder="@lang('admin.settings.phone')">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <label for="phone">@lang('admin.settings.phone') *</label>

                                            @error('phone.default')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="phoneother" required
                                                   class="form-control @error('phone.other') is-invalid @enderror"
                                                   value="{{ old('phone.other', $setting->phone['other']) }}"
                                                   name="phone[other]"
                                                   placeholder="@lang('admin.settings.phone_other')">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <label for="phoneother">@lang('admin.settings.phone_other') *</label>

                                            @error('phone.other')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="email" required id="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $setting->email) }}" name="email"
                                                   placeholder="@lang('admin.settings.email')">
                                            <div class="form-control-position">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <label for="email">@lang('admin.settings.email') *</label>

                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="address[ru]"
                                                              id="label-textarea-ru" rows="3"
                                                              placeholder="@lang('admin.settings.address')">{{ old('address.ru', $setting->address['ru']) }}</textarea>
                                                    <label for="label-textarea-ru">@lang('admin.settings.address') RU
                                                        *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" name="address[uz]" required
                                                              id="label-textarea" rows="3"
                                                              placeholder="@lang('admin.settings.address')">{{ old('address.uz', $setting->address['uz']) }}</textarea>
                                                    <label for="label-textarea">@lang('admin.settings.address') UZ
                                                        *</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="landmark" required
                                                           class="form-control @error('landmark.ru') is-invalid @enderror"
                                                           value="{{ old('landmark.ru', $setting->landmark['ru']) }}"
                                                           name="landmark[ru]"
                                                           placeholder="@lang('admin.settings.landmark')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    <label for="landmark">@lang('admin.settings.landmark') RU *</label>

                                                    @error('landmark.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="landmarkru" required
                                                           class="form-control @error('landmark.uz') is-invalid @enderror"
                                                           value="{{ old('landmark.uz', $setting->landmark['uz']) }}"
                                                           name="landmark[uz]"
                                                           placeholder="@lang('admin.settings.landmark')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    <label for="landmarkru">@lang('admin.settings.landmark') UZ
                                                        *</label>

                                                    @error('landmark.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="telegram" required
                                                   class="form-control @error('socials.telegram') is-invalid @enderror"
                                                   value="{{ old('socials.telegram', $setting->socials['telegram']) }}"
                                                   name="socials[telegram]"
                                                   placeholder="@lang('admin.settings.telegram')">
                                            <div class="form-control-position">
                                                <i class="fa fa-telegram"></i>
                                            </div>
                                            <label for="telegram">@lang('admin.settings.telegram') *</label>

                                            @error('socials.telegram')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="facebook" required
                                                   class="form-control @error('socials.facebook') is-invalid @enderror"
                                                   value="{{ old('socials.facebook', $setting->socials['facebook']) }}"
                                                   name="socials[facebook]"
                                                   placeholder="@lang('admin.settings.facebook')">
                                            <div class="form-control-position">
                                                <i class="fa fa-facebook"></i>
                                            </div>
                                            <label for="facebook">@lang('admin.settings.facebook') *</label>

                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="instagram" required
                                                   class="form-control @error('socials.instagram') is-invalid @enderror"
                                                   value="{{ old('socials.instagram', $setting->socials['instagram']) }}"
                                                   name="socials[instagram]"
                                                   placeholder="@lang('admin.settings.instagram')">
                                            <div class="form-control-position">
                                                <i class="fa fa-instagram"></i>
                                            </div>
                                            <label for="instagram">@lang('admin.settings.instagram') *</label>

                                            @error('socials.instagram')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="youtube" required
                                                   class="form-control @error('socials.youtube') is-invalid @enderror"
                                                   value="{{ old('socials.youtube', !empty($setting->socials['youtube']) ? $setting->socials['youtube'] : '') }}"
                                                   name="socials[youtube]" placeholder="Youtube">
                                            <div class="form-control-position">
                                                <i class="fa fa-youtube"></i>
                                            </div>
                                            <label for="youtube">@lang('admin.settings.youtube') *</label>

                                            @error('socials.youtube')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="okru" required
                                                   class="form-control @error('socials.okru') is-invalid @enderror"
                                                   value="{{ old('socials.okru', !empty($setting->socials['okru']) ? $setting->socials['okru'] : '') }}"
                                                   name="socials[okru]" placeholder="OK.RU">
                                            <div class="form-control-position">
                                                <i class="fa fa-odnoklassniki"></i>
                                            </div>
                                            <label for="okru">OK.RU *</label>

                                            @error('socials.okru')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="keywords[ru]"
                                                              id="label-keywords-ru" rows="3"
                                                              placeholder="@lang('admin.settings.address')">{{ old('keywords.ru', $setting->keywords['ru']) }}</textarea>
                                                    <label for="label-keywords-ru">@lang('admin.settings.keywords') RU
                                                        *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="keywords[uz]"
                                                              id="label-keywords" rows="3"
                                                              placeholder="@lang('admin.settings.keywords')">{{ old('keywords.uz', $setting->keywords['uz']) }}</textarea>
                                                    <label for="label-keywords">@lang('admin.settings.keywords') UZ
                                                        *</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="description[ru]"
                                                              id="label-textarea-ru" rows="3"
                                                              placeholder="@lang('admin.settings.description')">{{ old('description.ru', $setting->description['ru']) }}</textarea>
                                                    <label
                                                        for="label-description-ru">@lang('admin.settings.description')
                                                        RU *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="description[uz]"
                                                              id="label-textarea" rows="3"
                                                              placeholder="@lang('admin.settings.description')">{{ old('description.uz', $setting->description['uz']) }}</textarea>
                                                    <label for="label-description">@lang('admin.settings.description')
                                                        UZ *</label>
                                                </fieldset>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="coin_price">Цена монетки</label>
                                            <input type="number" value="{{ old('coin_price', $setting->coin_price) }}"
                                                   class="form-control" name="coin_price">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="region_id">Регион по умолчанию</label>
                                    <select name="region_id" id="region_id" class="form-control">
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}"
                                                    @if ($region->id == $setting->region_id) selected @endif>
                                                {{ $region->getName() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="app">
                                    <settings
                                        :emails-data="{{ json_encode($setting->notification_emails ?? []) }}"></settings>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-12 mb-0">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                            <i class="feather icon-save"></i> @lang('admin.save')
                                        </button>
                                    </div>

                                    <div class="col-9">
                                        <a href="{{ route('dashboard') }}"
                                           class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                            <i class="feather icon-x-circle"></i> @lang('admin.cancel')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
