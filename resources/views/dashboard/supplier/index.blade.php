@extends('dashboard.layouts.app')
@section('title', 'Поставщики - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Поставщики</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Поставщики
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
            <a href="{{ route('dashboard.supplier.store') }}" class="btn btn-primary btn-icon float-right mb-2">
                <i class="feather icon-plus-circle"></i>
                Добавить
            </a>
        </div>
    </div>
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Логин</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Названия компании</th>
                                <th>Адрес</th>
                                <th class="text-right">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->id }}</td>
                                    <td>{{ $supplier->login }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->company }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td class="text-right" style="min-width: 120px">
                                        <a href="{{ route('dashboard.supplier.update', $supplier->id) }}"
                                           class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip"
                                           data-placement="top" title="Редактировать">
                                            <i class="feather icon-edit"></i>
                                        </a>
                                        @if (!$supplier->blocked)
                                            <a href="{{ route('dashboard.supplier.block', $supplier->id) }}"
                                               class="btn btn-danger btn-icon btn-sm" data-toggle="tooltip"
                                               data-placement="top" title="Заблокировать">
                                                <i class="feather icon-minus-circle"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard.supplier.block', $supplier->id) }}"
                                               class="btn btn-success btn-icon btn-sm" data-toggle="tooltip"
                                               data-placement="top" title="Разблокировать">
                                                <i class="feather icon-check-circle"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
