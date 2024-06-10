@extends('dashboard.layouts.app')
@section('title', trans('admin.branches.title'). ' - ')
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
                            <li class="breadcrumb-item active">
                                @lang('admin.branches.title')
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
            <div class="mb-1 text-right">
                @can('create', 'branches')
                    <a href="{{ route('dashboard.branches.store') }}" class="btn btn-icon btn-success">
                        <i class="fa fa-plus-square"></i> @lang('admin.add')
                    </a>
                @endcan
            </div>
            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="50">ID</th>
                                    <th scope="col">@lang('admin.branches.name')</th>
                                    <th scope="col" >@lang('admin.branches.phone')</th>
                                    <th scope="col" class="text-right">@lang('admin.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($branches) == 0)
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            @lang('admin.no_data')
                                        </td>
                                    </tr>
                                @endif
                                @foreach($branches as $branch)
                                    <tr>
                                        <th scope="row">{{ $branch->id }}</th>

                                        <td>{{ $branch->name['ru'] }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td class="text-right">
                                            @can('update', 'branches')
                                                <a href="{{ route('dashboard.branches.update', $branch->id) }}" class="btn btn-sm btn-info btn-icon"
                                                   data-toggle="tooltip" data-original-title="@lang('admin.edit')">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endcan

                                            @can('view', 'branches')
                                                <a href="{{ route('dashboard.branches.show', $branch->id) }}" class="btn btn-sm btn-primary btn-icon"
                                                   data-toggle="tooltip" data-original-title="@lang('admin.see')">
                                                    <i class="feather icon-eye"></i>
                                                </a>
                                            @endcan

                                            @can('delete', 'branches')
                                                <a href="{{ route('dashboard.branches.delete', $branch->id) }}" class="btn btn-sm btn-danger btn-icon"
                                                    onclick="return confirm('@lang('admin.are_you_sure')')" data-toggle="tooltip" data-original-title="@lang('admin.delete')">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
