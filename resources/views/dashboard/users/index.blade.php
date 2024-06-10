@extends('dashboard.layouts.app')
@section('title', trans('admin.users.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.users.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.users.title')
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

@push('css')
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/vendors/css/pickers/pickadate/pickadate.css">
@endpush

@section('content')
    <div class="row" id="table-head">

        <div class="col-md-12 mb-1">
            <a href="{{ route('dashboard.users.export') }}" class="btn btn-icon btn-success float-right">
                <i class="feather icon-file"></i> Экспортировать все
            </a>
        </div>

        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                <div class="collapse-margin">
                    <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span class="lead collapse-title">
                            <i class="fa fa-filter"></i> Фильтр
                        </span>
                    </div>

                    <div id="collapseOne" class="collapse @if(request()->date_from || request()->date_to || request()->search_id || request()->search_phone || request()->search_ip) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <form action="{{ route('dashboard.users') }}"  method="get" >
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12 mb-1">
                                            <label >Выберите дату "от"</label>
                                            <input type='text' name="date_from" value="{{ old('date_from', request()->date_from ?? '') }}"
                                                   class="form-control pickadate-months-year" />
                                        </div>

                                        <div class="col-md-4 col-12 mb-1">
                                            <label >Выберите дату "до"</label>
                                            <input type='text' name="date_to" value="{{ old('date_to', request()->date_to ?? '') }}"
                                                   class="form-control pickadate-months-year" />
                                        </div>

                                        <div class="col-md-4 col-12 mb-1">
                                            <label >Тип сортировки</label>
                                            <select class="form-control" name="sort_type">
                                                <option value="created_at" {{ request()->sort_type ?? '' === 'created_at' ? 'selected' : '' }}>По дате регистрации</option>
                                                <option value="updated_at" {{ request()->sort_type ?? '' === 'updated_at' ? 'selected' : '' }}>По дате последнего визита</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 col-12 mb-1">
                                            <label>Поиск по id</label>
                                            <input type='text' name="search_id" value="{{ old('search_id', request()->search_id ?? '') }}"
                                                   class="form-control" />
                                        </div>

                                        <div class="col-md-5 col-12 mb-1">
                                            <label >Поиск по номеру</label>
                                            <input type='text' name="search_phone" value="{{ old('search_phone', request()->search_phone ?? '') }}"
                                                   class="form-control" />
                                        </div>
                                        <div class="col-md-5 col-12 mb-1">
                                            <label >Поиск по ip</label>
                                            <input type='text' name="search_ip" value="{{ old('search_ip', request()->search_ip ?? '') }}"
                                                   class="form-control" />
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-filter"></i> Применить</button>
                                            <a href="{{ route('dashboard.users') }}" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Сброс</a>
                                                <a href="{{ route('dashboard.users.export', [
                                                    'date_from' => request()->date_from ?? '',
                                                    'date_to' => request()->date_to ?? '',
                                                    'search_id' => request()->search_id ?? '',
                                                    'search_phone' => request()->search_phone ?? '',
                                                     'search_ip' => request()->search_ip ?? '',
                                                     'sort_type' => request()->sort_type ?? ''
                                                 ]) }}" class="btn btn-success mr-1 mb-1"><i class="fa fa-file"></i> Экспорт из фильтра</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">
                                    <a href="{{ request()->fullUrlWithQuery(['column' => 'id', 'direction' => $direction]) }}" style="color: #ffffff;">ID</a>
                                    @if (request('column') === 'id')
                                        @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                        @else <i class="feather icon-arrow-up"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="text-center">@lang('admin.users.fio')</th>
                                <th scope="col" class="text-center">@lang('admin.users.phone')</th>
                                <th scope="col" class="text-center">@lang('admin.users.ip')</th>
                                <th scope="col" class="text-center">
                                    <a href="{{ request()->fullUrlWithQuery(['column' => 'coins', 'direction' => $direction]) }}" style="color: #ffffff;">Монеты</a>
                                    @if (request('column') === 'coins')
                                        @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                        @else <i class="feather icon-arrow-up"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="text-center">@lang('admin.users.date_reg')</th>
                                <th scope="col" class="text-center">@lang('admin.users.date_online')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td  class="text-center">{{ $user->getFullName() }}</td>
                                    <td  class="text-center">+{{ $user->getPhone() }}</td>
                                    <td  class="text-center">{{ $user->getIp() }}</td>
                                    <td  class="text-center">{{ $user->coins }}</td>
                                    <td class="text-center">{{ date('H:i, d.m.Y', strtotime($user->created_at)) }}</td>
                                    <td class="text-center">{{ date('H:i, d.m.Y', strtotime($user->updated_at)) }}</td>
                                    <td class="text-right">
{{--                                        @can('update', 'users')--}}
{{--                                            <a href="{{ route('dashboard.users.update', $user->id) }}" class="btn btn-sm btn-success btn-icon" data-toggle="tooltip" data-original-title="@lang('admin.edit')">--}}
{{--                                                <i class="feather icon-edit"></i>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}
                                        @can('view', 'users')
                                            <a href="{{ route('dashboard.users.view', $user->id) }}" class="btn btn-sm btn-success btn-icon" data-toggle="tooltip" data-original-title="Посмотреть">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $users->links() }}
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendor/dashboard/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/dashboard/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="/vendor/dashboard/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="/vendor/dashboard/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>

    <script src="/vendor/dashboard/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
@endpush
