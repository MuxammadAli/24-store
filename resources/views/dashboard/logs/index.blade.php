@extends('dashboard.layouts.app')
@section('title', trans('admin.logs.title').' - ')
@section('links')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">
                        @lang('admin.logs.title')
                    </h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    @lang('admin.home')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.logs.title')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/vendors/css/pickers/pickadate/pickadate.css">
@endpush

@section('content')

{{--    <div class="col-md-12 mb-1">--}}
{{--        <a href="{{ route('dashboard.users.export') }}" class="btn btn-icon btn-success float-right">--}}
{{--            <i class="feather icon-file"></i> Экспортировать все--}}
{{--        </a>--}}
{{--    </div>--}}

    <div class="col-md-12">
        <div class="accordion" id="accordionExample">
            <div class="collapse-margin">
                <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span class="lead collapse-title">
                            <i class="fa fa-filter"></i> Фильтр
                        </span>
                </div>

                <div id="collapseOne" class="collapse @if(request()->date_from || request()->user_id || request()->log_name || request()->subject_id) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="{{ route('dashboard.logs') }}"  method="get" >
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-1">
                                        <label >Действие</label>
                                        <select class="form-control" name="description">
                                            <option selected disabled>Выберите действие</option>
                                            <option></option>
                                            <option value="created" {{ !empty(request()->description) && request()->description == 'created' ? 'selected' : '' }}>Создано</option>
                                            <option value="updated" {{ !empty(request()->description) && request()->description == 'updated' ? 'selected' : '' }}>Отредактировано</option>
                                            <option value="deleted" {{ !empty(request()->description) && request()->description == 'deleted' ? 'selected' : '' }}>Удалено</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 mb-1">
                                        <label >Выберите дату "от"</label>
                                        <input type='text' name="date_from" value="{{ old('date_from', request()->date_from ?? '') }}"
                                               class="form-control pickadate-months-year" />
                                    </div>

                                    <div class="col-md-3 col-12 mb-1">
                                        <label>ID пользователя</label>
                                        <input type='number' name="user_id" value="{{ old('user_id', request()->user_id ?? '') }}"
                                               class="form-control" />
                                    </div>

                                    <div class="col-md-6 col-12 mb-1">
                                        <label >Раздел</label>
                                        <select class="form-control" name="log_name">
                                            <option selected disabled>Выберите раздел</option>
                                            <option></option>
                                            <option value="roles" {{ !empty(request()->log_name) && request()->log_name === 'roles' ? 'selected' : '' }}>Роли</option>
                                            <option value="products" {{ !empty(request()->log_name) && request()->log_name === 'products' ? 'selected' : '' }}>Продукты</option>
                                            <option value="orders" {{ !empty(request()->log_name) && request()->log_name === 'orders' ? 'selected' : '' }}>Заказы</option>
                                            <option value="staffs" {{ !empty(request()->log_name) && request()->log_name === 'staffs' ? 'selected' : '' }}>Стаф</option>
                                            <option value="users" {{ !empty(request()->log_name) && request()->log_name === 'users' ? 'selected' : '' }}>Пользователи</option>
                                            <option value="posts" {{ !empty(request()->log_name) && request()->log_name === 'posts' ? 'selected' : '' }}>Посты</option>
{{--                                            <option value="sliders" {{ request()->log_name ?? '' === 'sliders' ? 'selected' : '' }}>Баннеры</option>--}}
                                            <option value="categories" {{ !empty(request()->log_name) && request()->log_name === 'categories' ? 'selected' : '' }}>Категории</option>
{{--                                            <option value="billings" {{ request()->log_name ?? '' === 'billings' ? 'selected' : '' }}>История оплаты</option>--}}
                                            <option value="regions" {{ !empty(request()->log_name) && request()->log_name === 'regions' ? 'selected' : '' }}>Регионы</option>
                                            <option value="cities" {{ !empty(request()->log_name) && request()->log_name === 'cities' ? 'selected' : '' }}>Города</option>
                                            <option value="settings" {{ !empty(request()->log_name) && request()->log_name === 'settings' ? 'selected' : '' }}>Настройки</option>
                                            <option value="addresses" {{ !empty(request()->log_name) && request()->log_name === 'addresses' ? 'selected' : '' }}>Адреса</option>
                                            <option value="brands" {{ !empty(request()->log_name) && request()->log_name === 'brands' ? 'selected' : '' }}>Бренды</option>
                                            <option value="pages" {{ !empty(request()->log_name) && request()->log_name === 'pages' ? 'selected' : '' }}>Страницы</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-12 mb-1">
                                        <label>ID</label>
                                        <input type='text' name="subject_id" value="{{ old('subject_id', request()->subject_id ?? '') }}"
                                               class="form-control" />
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-filter"></i> Применить</button>
                                        <a href="{{ route('dashboard.logs') }}" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Сброс</a>
{{--                                        <a href="{{ route('dashboard.users.export', [--}}
{{--                                                    'date_from' => request()->date_from ?? '',--}}
{{--                                                    'date_to' => request()->date_to ?? '',--}}
{{--                                                    'search_id' => request()->search_id ?? '',--}}
{{--                                                    'search_phone' => request()->search_phone ?? '',--}}
{{--                                                     'search_ip' => request()->search_ip ?? '',--}}
{{--                                                     'sort_type' => request()->sort_type ?? ''--}}
{{--                                                 ]) }}" class="btn btn-success mr-1 mb-1"><i class="fa fa-file"></i> Экспорт из фильтра</a>--}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-12 col-12">
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    <h4 class="card-title">Журнал действий</h4>
                </div>
                <div class="card-content">
                    <div class="card-body" id="app">
                        <logs-block :logs-data="{{ json_encode($logs) }}"></logs-block>
                    </div>
                </div>
            </div>

            {{ $logs->links() }}
        </div>
    </div>


@endsection

@push('js')
    <script src="{{ asset('vendor/dashboard/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/dashboard/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="/vendor/dashboard/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="/vendor/dashboard/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>

    <script src="/vendor/dashboard/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    {{--    <script type="text/javascript" src="/dashboard/categories/json"></script>--}}
    {{--    <script src="/vendor/catman/catman.js"></script>--}}

    <script src="{{ mix('js/app.js') }}"></script>

@endpush

