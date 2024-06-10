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
                                <a href="{{ route('dashboard.users') }}">@lang('admin.users.title')</a>
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
                    <form class="form form-vertical" action="{{ route('dashboard.users.update', $user->id) }}" method="post">
                        @csrf
                        <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">@lang('admin.users.first_name')</label>
                                                        <input type="text" id="first-name-vertical" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="@lang('admin.users.first_name')">
                                                        @error('first_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="last_name">@lang('admin.users.last_name')</label>
                                                        <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name) }}" name="last_name" placeholder="@lang('admin.users.last_name')">
                                                        @error('last_name')
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
                                                <label for="phone">@lang('admin.users.phone')</label>
                                                <input type="text" id="phone" disabled class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="@lang('admin.users.phone')">
                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="category_id">@lang('admin.users.category')</label>
                                                <select class="form-control" name="category_id">
                                                    <option value="1" @if(old('category_id', $user->category_id) == 1) selected @endif>@lang('admin.users.men')</option>
                                                    <option value="2" @if(old('category_id', $user->category_id) == 2) selected @endif>@lang('admin.users.women')</option>
                                                    <option value="3" @if(old('category_id', $user->category_id) == 3) selected @endif>@lang('admin.users.kids')</option>
                                                </select>

                                                @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="gender">@lang('admin.users.gender')</label>
                                                <select class="form-control" name="gender">
                                                    <option value="1" @if(old('gender', $user->gender) == 1) selected @endif>
                                                        Мужчина
                                                    </option>
                                                    <option value="0" @if(old('gender', $user->gender) == 0) selected @endif>
                                                        Женщина
                                                    </option>
                                                </select>

                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="role_id">@lang('admin.users.role')</label>
                                                <select class="form-control" name="role_id">
                                                    <option value="1" @if(old('role_id', $user->role_id) == 1) selected @endif>@lang('admin.roles.1')</option>
                                                    <option value="3" @if(old('role_id', $user->role_id) == 3) selected @endif>@lang('admin.roles.3')</option>
                                                    <option value="2" @if(old('role_id', $user->role_id) == 2) selected @endif>@lang('admin.roles.2')</option>
                                                </select>

                                                @error('first_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="birth_day">@lang('admin.users.birth_day')</label>
                                                <input type="text" id="birth_day" class="form-control @error('birth_day') is-invalid @enderror" name="birth_day" value="{{ old('birth_day', $user->birth_day) }}" placeholder="@lang('admin.users.birth_day')">
                                                @error('birth_day')
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
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                    <i class="feather icon-save"></i> @lang('admin.save')
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
