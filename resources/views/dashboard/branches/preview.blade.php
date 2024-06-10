@extends('dashboard.layouts.app')
@section('title', trans('admin.branches.title').' '. $branch->name['ru'].' - ')

@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.branches.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.branches') }}">@lang('admin.branches.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $branch->name['ru'] }}
                            </li>
                            {{--                            <li class="breadcrumb-item active">Fixed Layout--}}
                            {{--                            </li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h1>{{ $branch->name['ru'] }}</h1>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12 mb-3 text-center">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2994.9749773783756!2d{{ $branch->getLong() }}!3d{{ $branch->getLat() }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38aef3532b524b23%3A0x3d95e496c20ddf44!2sProf%20Med%20Servis!5e0!3m2!1sru!2s!4v1583579404783!5m2!1sru!2s"
                                    width="600" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>

                        <p><b>@lang('admin.branches.address'):</b>  {{ $branch->address['ru'] }}</p>
                        <p><b>@lang('admin.branches.schedule'):</b> {{ $branch->schedule['ru'] }}</p>

                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <a href="{{ route('dashboard.branches.update', $branch->id) }}" class="btn btn-icon btn-primary"
                               data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('admin.edit')">
                                <i class="fa fa-edit"></i> @lang('admin.edit')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
