@extends('dashboard.layouts.app')
@section('title', trans('admin.staffs.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.staffs.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.staffs.title')
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
        @can('store', 'staffs')
        <div class="col-md-12 mb-1">
            <a href="{{ route('dashboard.staffs.store') }}" class="btn btn-icon btn-success float-right">
                <i class="feather icon-plus"></i> @lang('admin.add')
            </a>
        </div>
        @endcan
        <div class="col-12">
            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">@lang('admin.users.username')</th>
                                <th scope="col" class="text-center">@lang('admin.users.role')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($staffs) == 0)
                                <tr>
                                    <td class="text-center" colspan="5">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($staffs as $staff)
                                <tr>
                                    <th scope="row">{{ $staff->id }}</th>
                                    <td>{{ $staff->username }}</td>
                                    <td class="text-center">
                                        {{ $staff->role->name }}
                                    </td>
                                    <td class="text-right">
                                        @can('update', 'staffs')
                                            @if(auth()->user()->id != $staff->id)
                                                @if ($staff->block)
                                                    <a  href="{{ route('dashboard.staffs.block', $staff->id) }}" onclick="return confirm(@lang('admin.are_you_sure_block_raz')" class="btn btn-sm btn-warning btn-icon" >
                                                        <i class="feather icon-unlock"></i>
                                                    </a>
                                                @else
                                                    <a  href="{{ route('dashboard.staffs.block', $staff->id) }}" onclick="return confirm(@lang('admin.are_you_sure_block')" class="btn btn-sm btn-primary btn-icon" >
                                                        <i class="feather icon-lock"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        @endcan

                                        @can('update', 'staffs')
                                            @if(auth()->user()->id != $staff->id)
                                                <a  href="{{ route('dashboard.staffs.update', $staff->id) }}" class="btn btn-sm btn-success btn-icon" data-toggle="tooltip" data-original-title="@lang('admin.edit')">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $staffs->links() }}
        </div>
    </div>
@endsection
