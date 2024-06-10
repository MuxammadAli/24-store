@extends('dashboard.layouts.app')
@section('title', trans('admin.add'). ' ' .trans('admin.branches.title'). ' - ')
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
                                <a href="{{ route('dashboard.branches') }}">@lang('admin.branches.title')</a>
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
                    <form class="form form-vertical" action="{{ route('dashboard.branches.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.branches.name') UZ *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('name.uz') is-invalid @enderror"
                                                           name="name[uz]" value="{{ old('name.uz') }}" placeholder="@lang('admin.branches.name') UZ">
                                                    @error('name.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nameru">@lang('admin.branches.name') RU *</label>
                                                    <input type="text" id="nameru" required class="form-control @error('name.ru') is-invalid @enderror"
                                                           value="{{ old('name.ru') }}" name="name[ru]" placeholder="@lang('admin.branches.name') RU">
                                                    @error('name.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.branches.address') UZ *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('address.uz') is-invalid @enderror"
                                                           name="address[uz]" value="{{ old('address.uz') }}" placeholder="@lang('admin.branches.address') UZ">
                                                    @error('address.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="addressru">@lang('admin.branches.address') RU *</label>
                                                    <input type="text" id="addressru" required class="form-control @error('address.ru') is-invalid @enderror"
                                                           value="{{ old('address.ru') }}" name="address[ru]" placeholder="@lang('admin.branches.address') RU">
                                                    @error('address.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.branches.orientation') UZ *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('orientation.uz') is-invalid @enderror"
                                                           name="orientation[uz]" value="{{ old('orientation.uz') }}" placeholder="@lang('admin.branches.orientation') UZ">
                                                    @error('orientation.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="orientationru">@lang('admin.branches.orientation') RU *</label>
                                                    <input type="text" id="orientationru" required class="form-control @error('orientation.ru') is-invalid @enderror"
                                                           value="{{ old('orientation.ru') }}" name="orientation[ru]" placeholder="@lang('admin.branches.orientation') RU">
                                                    @error('orientation.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="scheduleuz">@lang('admin.branches.schedule') UZ *</label>
                                                    <input type="text" id="scheduleuz" required class="form-control @error('schedule.uz') is-invalid @enderror"
                                                           name="schedule[uz]" value="{{ old('schedule.uz') }}" placeholder="@lang('admin.branches.schedule') UZ">
                                                    @error('schedule.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="scheduleru">@lang('admin.branches.schedule') RU *</label>
                                                    <input type="text" id="scheduleru" required class="form-control @error('schedule.ru') is-invalid @enderror"
                                                           value="{{ old('schedule.ru') }}" name="schedule[ru]" placeholder="@lang('admin.branches.schedule') RU">
                                                    @error('schedule.ru')
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
                                            <label for="delivery_price">@lang('admin.branches.phone') *</label>
                                            <input type="text" id="delivery_price" required class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone') }}" name="phone" placeholder="@lang('admin.branches.phone')">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="lat">@lang('admin.branches.map') LAT * </label>
                                                    <input type="text" id="lat" required class="form-control @error('map.lat') is-invalid @enderror"
                                                           name="map[lat]" value="{{ old('map.lat') }}" placeholder="@lang('admin.branches.map') LAT">
                                                    @error('map.lat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="long">@lang('admin.branches.map') LONG *</label>
                                                    <input type="text" id="long" required class="form-control @error('map.long') is-invalid @enderror"
                                                           value="{{ old('map.long') }}" name="map[long]" placeholder="@lang('admin.branches.map') LONG">
                                                    @error('map.long')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
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
                                        <a href="{{ route('dashboard.branches') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
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
