@extends('dashboard.layouts.app')
@section('title', trans('admin.feedback.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.feedback.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.feedback.title')
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
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">@lang('admin.feedback.name')</th>
                                <th scope="col">@lang('admin.feedback.phone')</th>
                                <th scope="col" class="text-center">@lang('admin.feedback.status')</th>
                                <th scope="col" class="text-center">@lang('admin.feedback.created_at')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($feedbacks) == 0)
                                <tr>
                                    <td class="text-center" colspan="7">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <th scope="row">{{ $feedback->id }}</th>
                                    <td>{{ $feedback->name }}</td>
                                    <td>{{ $feedback->phone }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-icon btn-sm btn-{{ ($feedback->viewed == 1)?'info' : 'warning' }}">
                                            <i class="feather icon-{{ ($feedback->viewed == 1)?'check-circle':'alert-circle' }}">
                                            </i> {{ ($feedback->viewed == 1)? trans('admin.feedback.viewed') : trans('admin.feedback.not_viewed') }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{ $feedback->created_at }}
                                    </td>
                                    <td class="text-right">
                                        @can('view', 'feedback')
                                            <a href="{{ route('dashboard.feedback.show', $feedback->id) }}" class="btn btn-icon btn-info
                                                    btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('admin.feedback.viewed')">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                        @endcan

                                        @can('delete', 'feedback')
                                            <a href="{{ route('dashboard.feedback.delete', $feedback->id) }}" class="btn btn-sm btn-danger btn-icon" data-toggle="tooltip" data-original-title="@lang('admin.delete')">
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

            {{ $feedbacks->links() }}
        </div>
    </div>
@endsection
