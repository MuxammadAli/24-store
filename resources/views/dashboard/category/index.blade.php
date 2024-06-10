@extends('dashboard.layouts.app')
@section('title', trans('admin.categories.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.categories.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.categories.title')
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
        <div class="col-md-12 mb-1">
            @can('create', 'categories')
                <a href="{{ route('dashboard.categories.store') }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.add')
                </a>
            @endcan
        </div>
        <div class="col-12">

            <div id="app">
                <category-list :categories-data="{{ $categories }}"></category-list>
            </div>

{{--        <div class="row">--}}
{{--            <div class="cats-table">--}}

{{--            </div>--}}
{{--            <div onclick="save();" class="cats-save">Save</div>--}}
{{--        </div>--}}

        </div>
    </div>
@endsection

@push('css')
    <style type="text/css" media="screen">

        .tree-node-inner {
            background: #fff;
            -webkit-box-shadow: 0 -1px 4px 0 rgba(0, 0, 0, .15);
            box-shadow: 0 -1px 4px 0 rgba(0, 0, 0, .15);
            padding: 10px 15px;
            cursor: grabbing;
        }

        .cats_no_sub{
            width: 100%;
            background: #f3f3f3;
            border-radius: 5px;
            border: 1px solid #cecece;
            padding: 7px 10px 7px 11px;
            float: left;
            margin: 5px 0;
        }
        .cat_name{
            float: left;
            width:50%;
        }

        .cat_right{
            float: right;
            width: 100%;
            text-align: right;
        }

        .cat-buttons{
            float: right;
            margin: -2px 24px 0 0px;
        }

        .cats_sub{
            width: 97%;
            background: #f3f3f3;
            border-radius: 5px;
            border: 1px solid #cecece;
            padding: 7px 10px 7px 11px;
            float: right;
            margin: 5px 0;
        }
    </style>

<link rel="stylesheet" href="/vendor/catman/style.css">
@endpush

@push('js')
{{--    <script type="text/javascript" src="/dashboard/categories/json"></script>--}}
{{--    <script src="/vendor/catman/catman.js"></script>--}}

<script src="{{ mix('js/app.js') }}"></script>

    <script>
            $(document).ready(function () {
                    // load();
                });
        </script>
@endpush

