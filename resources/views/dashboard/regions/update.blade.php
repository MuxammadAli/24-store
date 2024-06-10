@extends('dashboard.layouts.app')
@section('title', trans('admin.edit'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.edit')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.regions') }}">@lang('admin.regions.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.edit')
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
                    <h4 class="card-title">@lang('admin.edit')</h4>
                </div>
                <div class="card-content">
                    <form class="form form-vertical" action="{{ route('dashboard.region.update', $region->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.regions.name') UZ *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('name.uz') is-invalid @enderror"
                                                           name="name[uz]" value="{{ old('name.uz', $region->name['uz']) }}" placeholder="@lang('admin.regions.name') UZ">
                                                    @error('name.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nameru">@lang('admin.regions.name') RU *</label>
                                                    <input type="text" id="nameru" required class="form-control @error('name.ru') is-invalid @enderror"
                                                           value="{{ old('name.ru', $region->name['ru']) }}" name="name[ru]" placeholder="@lang('admin.regions.name') RU">
                                                    @error('name.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" name="cash" @if($region->cash) checked @endif value="1">
                                                <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>

                                                <span class="">Принимать наличные</span>
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
                                        <a href="{{ route('dashboard.regions') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
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
