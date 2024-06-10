@extends('dashboard.layouts.app')
@section('title', 'Push-уведомления - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.notification_available.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Push-уведомления
                            </li>
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
                                <th scope="col">@lang('admin.products.name')</th>
                                <th scope="col">@lang('admin.orders.count')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($notifications) == 0)
                                <tr>
                                    <td class="text-center" colspan="2">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($notifications as $notification)
                                <tr>
                                    <td>
                                        {{ $notification->product->getName() }}
                                    </td>

                                    <td>
                                        {{ $notification->count }}
                                    </td>

                                    <td class="text-right">
                                        <a class="btn btn-sm btn-icon btn-primary" href="{{ route('dashboard.notification_available.view', $notification->product_id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
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
