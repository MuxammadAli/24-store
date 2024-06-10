@extends('dashboard.layouts.app')
@section('title', 'Продукты - ')
@section('content')
    <div class="row" id="table-head">
        <div class="col-md-12 mb-1">
            @can('create', 'products')
                <a href="{{ route('dashboard.coin-product.store') }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.add')
                </a>
            @endcan

            <form action="{{ route('dashboard.coin-product.index') }}" class="col-2" method="get" id="paginate_id">
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

        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                <div class="collapse-margin">
                    <div class="card-header" id="headingOne" data-toggle="collapse" role="button"
                         data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span class="lead collapse-title">
                            <i class="fa fa-filter"></i> Фильтр
                        </span>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <form method="get" action="{{ route('dashboard.coin-product.search') }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="id">ID продукта</label>
                                                <input type="number" id="id" class="form-control"
                                                       value="{{ request()->get('id') }}" placeholder="ID заказа"
                                                       name="id">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Названия</label>
                                                <input type="text" id="name" class="form-control"
                                                       value="{{ request()->get('name') }}" placeholder="Названия"
                                                       name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="in_stock">В наличии</label>
                                                <select class="form-control" id="in_stock" name="in_stock">
                                                    <option selected value="2">Не выбрано</option>
                                                    <option value="1" @if(request('in_stock') == '1') selected @endif>В
                                                        наличии
                                                    </option>
                                                    <option value="0" @if(request('in_stock') == '0') selected @endif>
                                                        нет в наличии
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="published">Статус модерации</label>
                                                <select class="form-control" id="published" name="published">
                                                    <option selected disabled>Не выбрано</option>
                                                    <option value="1" @if(request('published') == '1') selected @endif>
                                                        Опубликованно
                                                    </option>
                                                    <option value="0" @if(request('published') == '0') selected @endif>
                                                        Неопубликованно
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                    class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i
                                                    class="fa fa-filter"></i> Применить
                                            </button>
                                            <a href="{{ route('dashboard.products') }}"
                                               class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Сброс</a>
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
                    <form method="post" action="{{ route('dashboard.coin-product.mass.action') }}">
                        @csrf
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-dark">
                                <tr>
                                    @can('delete', 'products')
                                        <th scope="col" width="50" class="text-right">
                                            <div class="form-group text-right">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="prod_id[]" class="change-check"
                                                               id="select-all">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </th>
                                    @endcan
                                    <th scope="col" width="60">
                                        <a href="{{ route('dashboard.coin-product.index', ['column' => 'id', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">ID</a>
                                        @if (request('column') === 'id')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col" width="50">@lang('admin.products.image')</th>
                                    <th scope="col">
                                        <a href="{{ route('dashboard.coin-product.index', ['column' => 'name->ru', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">
                                            @lang('admin.products.name')
                                        </a>
                                        @if (request('column') === 'name->ru')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col">
                                        <a href="{{ route('dashboard.coin-product.index', ['column' => 'price', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">
                                            @lang('admin.products.price')
                                        </a>
                                        @if (request('column') === 'price')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col">
                                        <a href="{{ route('dashboard.coin-product.index', ['column' => 'count', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">
                                            @lang('admin.orders.count')
                                        </a>
                                        @if (request('column') === 'count')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col">
                                        <a href="{{ route('dashboard.coin-product.index', ['column' => 'published', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">
                                            @lang('admin.billing.status')
                                        </a>
                                        @if (request('column') === 'published')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col" class="text-right">@lang('admin.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($products) == 0)
                                    <tr>
                                        <td class="text-center" colspan="8">
                                            @lang('admin.no_data')
                                        </td>
                                    </tr>
                                @endif
                                @foreach($products as $product)
                                    <tr>
                                        @can('delete', 'products')
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" value="{{ $product->id }}"
                                                                   name="prod_id[]" class="change-check"
                                                                   id="checkbox-{{ $loop->iteration }}">
                                                            <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </td>
                                        @endcan
                                        <td>
                                            {{ $product->id }}
                                        </td>

                                        <td>
                                            <img src="{{ $product->getPoster() }}" class="w-100">
                                        </td>

                                        <td>
                                            @if(!$product->isAvailable())
                                                <i class="fa fa-info-circle text-danger" data-toggle="tooltip"
                                                   data-original-title="@lang('admin.no_publish')"></i>
                                            @endif
                                            {{ Str::limit($product->getName(), 30) }}
                                        </td>
                                        <td>
                                            @if ($product->price_discount)
                                                <strike>{{ $product->price }}</strike>
                                                <br>
                                                {{ $product->price_discount }}


                                            @else
                                                {{ $product->price }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $product->count }}
                                        </td>

                                        <td>
                                            @if(!$product->isAvailable())
                                                @lang('admin.no_publish')
                                            @else
                                                Опубликовано
                                            @endif
                                        </td>

                                        <td class="text-right">
                                                @can('update', 'products')
                                                    <a href="{{ route('dashboard.coin-product.update', $product->id) }}"
                                                       class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip"
                                                       data-original-title="@lang('admin.edit')">
                                                        <i class="feather icon-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('delete', 'products')
                                                    <a href="{{ route('dashboard.coin-product.delete', $product->id) }}"
                                                       class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip"
                                                       onclick="return confirm('@lang('admin.are_you_sure')')"
                                                       data-original-title="@lang('admin.delete')">
                                                        <i class="feather icon-trash"></i>
                                                    </a>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" id="show-action">
                            <button type="submit" name="action" value="delete"
                                    class="btn btn-danger">@lang('admin.products.delete_mass')</button>
                            <button type="submit" name="action" value="status-deactivate"
                                    class="btn btn-warning">@lang('admin.products.deactivate')</button>
                        </div>
                    </form>
                </div>
            </div>

            {{ $products->appends(request()->all())->links() }}

        </div>
    </div>
@endsection
