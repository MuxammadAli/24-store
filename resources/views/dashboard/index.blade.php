@extends('dashboard.layouts.app')
@section('title', trans('admin.home'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.home')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('dashboard') }}">@lang('admin.home')</a>
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

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <a href="{{ route('dashboard.users') }}">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-primary font-medium-5"></i>
                            </div>
                        </div>
                    </a>
                    <h2 class="text-bold-700 mt-1">
                        {{ $users }}
                    </h2>
                    <p class="mb-0">Пользователи</p>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <a href="{{ route('dashboard.supplier.index') }}">
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-success font-medium-5"></i>
                            </div>
                        </div>
                    </a>
                    <h2 class="text-bold-700 mt-1">
                        {{ $suppliers }}
                    </h2>
                    <p class="mb-0">Поставщики</p>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <a href="{{ route('dashboard.orders') }}">
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </a>
                    <h2 class="text-bold-700 mt-1">{{ $orders }}</h2>
                    <p class="mb-0">Заказы</p>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <a href="{{ route('dashboard.products') }}">
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-package text-warning font-medium-5"></i>
                            </div>
                        </div>
                    </a>
                    <h2 class="text-bold-700 mt-1">{{ $products }}</h2>
                    <p class="mb-0">Продукты</p>
                </div>
                <br>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Заказы</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>В обработке</th>
                                <th>Собран</th>
                                <th>В пути</th>
                                <th>Закрыт</th>
                                <th>Отменен</th>
                                <th>Сегодня</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ number_format($statuses['processing'], 0, ' ', ' ') }} сум</td>
                                <td>{{ number_format($statuses['collected'], 0, ' ', ' ') }} сум</td>
                                <td>{{ number_format($statuses['in_way'], 0, ' ', ' ') }} сум</td>
                                <td>{{ number_format($statuses['closed'], 0, ' ', ' ') }} сум</td>
                                <td>{{ number_format($statuses['cancelled'], 0, ' ', ' ') }} сум</td>
                                <td>{{ number_format($statuses['today'], 0, ' ', ' ') }} сум</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="app">
        <dashboard-statics :statics="{{ json_encode($statics) }}"></dashboard-statics>
    </div>

@endsection
@push('css')
@endpush
@push('js')
    <script src="{{ mix('js/app.js') }}">

    </script>
@endpush
