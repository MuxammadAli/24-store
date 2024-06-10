@extends('dashboard.layouts.app')
@section('title', 'Пользователь № ' . $user->id . ' - ')
@section('content')
    <div class="row">
        <div class="col-12 mb-1">
            <h2>Пользователь № {{ $user->id }}</h2>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>
                                <b>Ф.И.О:</b>
                                {{ $user->getFullName() }}
                            </p>
                            <p>
                                <b>Название магазина:</b>
                                {{ $user->name }}
                            </p>
                            <p>
                                <b>Телефон:</b>
                                <a href="tel:+{{ $user->phone }}">+{{ $user->phone }}</a>
                            </p>
                            <p>
                                <b>Email:</b>
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </p>
                            <p>
                                <b>ИНН:</b>
                                <a href="{{ $user->inn }}">{{ $user->inn }}</a>
                            </p>
                            <p>
                                <b>Регион:</b>
                                {{ $user->region->getName() }}
                            </p>
                        </div>
                        <div class="col-12 d-md-none">
                            <hr>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p>
                                <b>Кол-во заказов:</b>
                                {{ $user->orders()->count() }}
                            </p>
                            <p>
                                <b>Общая сумма заказов:</b>
                                {{ number_format($user->getOrdersPrice(), 0, ' ', ' ') }} сум
                            </p>
                            <p>
                                <b>Кол-во монеток:</b>
                                {{ $user->coins }}
                            </p>
                            <p>
                                <b>Дата регистрации:</b>
                                {{ date('H:i, d.m.Y', strtotime($user->created_at)) }}
                            </p>
                            <p>
                                <b>Дата последнего посещения:</b>
                                {{ date('H:i, d.m.Y', strtotime($user->updated_at)) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">История заказов</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">Стоимость</th>
                                <th scope="col">Регион</th>
                                <th scope="col">@lang('admin.orders.status')</th>
                                <th scope="col">@lang('admin.orders.date')</th>
                                <th class="text-right">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ number_format($order->price_product, 0, ' ', ' ') }} сум</td>
                                    <td>{{ $order->address->getRegion() }}</td>
                                    <td><b class="text-{{ $order->getStatusColor() }}">{{ $order->getStatus() }}</b></td>
                                    <td>{{ date('H:i, d.m.Y', strtotime($order->created_at)) }}</td>
                                    <td class="text-right">
                                        @can('view', 'orders')
                                            <a href="{{ route('dashboard.orders.view', $order->id) }}"
                                               class="btn btn-primary btn-icon btn-sm"
                                               data-toggle="tooltip" title="Просмотр">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
