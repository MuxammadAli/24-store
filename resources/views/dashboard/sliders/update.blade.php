@extends('dashboard.layouts.app')
@section('title', trans('admin.edit').' '.$slider->name. ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.add')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.sliders') }}">@lang('admin.sliders.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $slider->name }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/dashboard/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.edit')</h4>
                </div>
                <div class="card-content">
                    <form class="form form-vertical" action="{{ route('dashboard.slider.update', [$slider->id]) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.slider.name') *</label>
                                                    <input type="text" required id="first-name-vertical" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $slider->name) }}" placeholder="@lang('admin.sliders.name')">
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.slider.link')</label>
                                                    <input type="text" id="first-name-vertical" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link', $slider->link) }}" placeholder="@lang('admin.slider.link')">
                                                    @error('link')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>@lang('admin.posts.language') *</label>
                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" required name="language">
                                                        <option disabled>@lang('admin.posts.language')</option>
                                                        <option value="ru" @if($slider->language == 'ru') selected @endif>RU</option>
                                                        <option value="uz" @if($slider->language == 'uz') selected @endif>UZ</option>
                                                    </select>
                                                </fieldset>
                                            </div>

                                            <div class="col-12">
                                                <label>@lang('admin.slider.type') *</label>
                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" name="type" required>
                                                        <option disabled selected>@lang('admin.slider.type')</option>
                                                        <option value="desktop" {{ $slider->type === 'desktop' ? 'selected' : '' }}>Desktop</option>
                                                        <option value="mobile" {{ $slider->type === 'mobile' ? 'selected' : '' }}>Mobile</option>
                                                    </select>
                                                </fieldset>
                                            </div>

                                            <div class="col-12">
                                                <label>@lang('admin.slider.placement.title') *</label>
                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" name="placement" required>
                                                        <option disabled selected>@lang('admin.slider.placement.choose')</option>
                                                        <option value="top" {{ $slider->placement === 'top' ? 'selected' : '' }}>@lang('admin.slider.placement.top')</option>
                                                        <option value="middle" {{ $slider->placement === 'middle' ? 'selected' : '' }}>@lang('admin.slider.placement.middle')</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">@lang('admin.brands.image') @if(is_file($slider->image)) <a href="/{{ $slider->image }}" target="_blank">@lang('admin.see')</a> @endif</label>
                                            <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" placeholder="@lang('admin.sliders.image')">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" @if($slider->published) checked @endif value="1" name="published">
                                                <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                                <span class="">Публиковать</span>
                                            </div>
                                        </fieldset>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-0 pl-0 pt-1">
                            <div class="col-12 mb-0">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                            <i class="feather icon-save"></i> @lang('admin.save')
                                        </button>
                                    </div>

                                    <div class="col-9">
                                        <a href="{{ route('dashboard.sliders') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
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
    <script src="{{ asset('/vendor/dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/vendor/dashboard/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
