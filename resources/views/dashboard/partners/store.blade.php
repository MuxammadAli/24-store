@extends('dashboard.layouts.app')
@section('title', trans('admin.add'). ' - ')
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
                                <a href="{{ route('dashboard.partners') }}">@lang('admin.partners.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.add')
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
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.add')</h4>
                </div>
                <div class="card-content">
                    <form class="form form-vertical" action="{{ route('dashboard.partner.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.partners.name') *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('admin.partners.name')">
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">@lang('admin.partners.image') *</label>
                                            <input type="file" id="image" required class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" placeholder="@lang('admin.partners.image')">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
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
                                        <a href="{{ route('dashboard.partners') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
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
@endsection
