@extends('dashboard.layouts.app')
@section('title', trans('admin.products.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.products.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.products.title')
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
            @can('create', 'products')
                <a href="{{ route('dashboard.product.store') }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.add')
                </a>
            @endcan
            <a href="{{ route('dashboard.products.import') }}" class="btn btn-icon btn-primary float-right mr-1">
                <i class="feather icon-inbox"></i> Import
            </a>

            <a href="#" data-toggle="modal" data-target="#export-modal"
               class="btn btn-icon btn-primary float-right mr-1">
                <i class="feather icon-inbox"></i> Export
            </a>

            <form action="{{ route('dashboard.product-notification.index') }}" class="col-2" method="get" id="paginate_id">
                <select name="paginate" class="form-control" onchange="this.form.submit()">
                    <option disabled selected>Отображать по</option>
                    <option @if(!empty(request()->get('paginate')) && request()->get('paginate') == 10) selected @endif>
                        10
                    </option>
                    <option @if(!empty(request()->get('paginate')) && request()->get('paginate') == 20) selected @endif>
                        20
                    </option>
                    <option @if(!empty(request()->get('paginate')) && request()->get('paginate') == 50) selected @endif>
                        50
                    </option>
                </select>
            </form>
        </div>

        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    @csrf
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Названия</th>
                                <th scope="col">Количество</th>
                                <th scope="col" class="text-right">Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($notifications) == 0)
                                <tr>
                                    <td class="text-center" colspan="3">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->product->getName() }}</td>
                                    <td>{{ $notification->count }}</td>
                                    <td class="text-right">{{ $notification->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $notifications->links() }}

        </div>
    </div>
@endsection
