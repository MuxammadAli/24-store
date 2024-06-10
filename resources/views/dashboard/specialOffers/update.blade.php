@extends('dashboard.layouts.app')
@section('title', trans('admin.edit').' '.$specialOffer->getName(). ' - ')
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
                                <a href="{{ route('dashboard.specialOffers') }}">@lang('admin.specialOffers.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $specialOffer->getName() }}
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
                    <form class="form form-vertical" action="{{ route('dashboard.specialOffers.update', [$specialOffer->id]) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">@lang('admin.categories.name') UZ *</label>
                                                            <input type="text" id="first-name-vertical" required class="form-control @error('name.uz') is-invalid @enderror" name="name[uz]" value="{{ old('name.uz', $specialOffer->name['uz']) }}" placeholder="@lang('admin.categories.name') UZ">
                                                            @error('name.uz')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nameru">@lang('admin.categories.name') RU *</label>
                                                            <input type="text" id="nameru" required class="form-control @error('name.ru') is-invalid @enderror" value="{{ old('name.ru', $specialOffer->name['ru']) }}" name="name[ru]" placeholder="@lang('admin.categories.name') RU">
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
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label>@lang('admin.specialOffers.description') UZ *</label>
                                                        <div class="controls">
                                                            <fieldset class="form-group position-relative">
                                                            <textarea class="form-control @error('description.uz') is-invalid @enderror" required name="description[uz]"
                                                                      placeholder="@lang('admin.specialOffers.description') UZ">{{ old('description.uz', $specialOffer->description['uz']) }}</textarea>
                                                            </fieldset>
                                                            @error('description.uz')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label>@lang('admin.specialOffers.description') RU *</label>
                                                        <div class="controls">
                                                            <fieldset class="form-group position-relative">
                                                            <textarea class="form-control @error('description.ru') is-invalid @enderror" required name="description[ru]"
                                                                      placeholder="@lang('admin.specialOffers.description') RU">{{ old('description.ru', $specialOffer->description['ru']) }}</textarea>
                                                            </fieldset>
                                                            @error('description.ru')
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

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="link">@lang('admin.specialOffers.link') *</label>
                                            <input type="text" id="link" class="form-control @error('link') is-invalid @enderror" required value="{{ old('link', $specialOffer->link) }}" name="link" placeholder="@lang('admin.specialOffers.link')">
                                            @error('link')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">@lang('admin.brands.image') @if(is_file($specialOffer->image)) <a href="/{{ $specialOffer->image }}" target="_blank">@lang('admin.see')</a> @endif</label>
                                            <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" placeholder="@lang('admin.post.image')">
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
                                        <a href="{{ route('dashboard.specialOffers') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
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
