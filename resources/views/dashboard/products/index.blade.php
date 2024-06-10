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
{{--            @can('create', 'products')--}}
{{--                <a href="{{ route('dashboard.product.store') }}" class="btn btn-icon btn-success float-right">--}}
{{--                    <i class="feather icon-plus"></i> @lang('admin.add')--}}
{{--                </a>--}}
{{--            @endcan--}}
{{--            <a href="{{ route('dashboard.products.import') }}" class="btn btn-icon btn-primary float-right mr-1"> --}}
{{--                <i class="feather icon-inbox"></i> Import --}}
{{--            </a> --}}

            <a href="#" data-toggle="modal" data-target="#export-modal"
               class="btn btn-icon btn-primary float-right mr-1">
                <i class="feather icon-inbox"></i> Export
            </a>

            <form action="{{ route('dashboard.products') }}" class="col-2" method="get" id="paginate_id">
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
                            <form method="get" action="{{ route('dashboard.product.search') }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="id">ID продукта</label>
                                                <input type="number" id="id" class="form-control"
                                                       value="{{ request()->get('id') }}" placeholder="ID продукта"
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

                                        {{--                                        <div class="col-md-6 col-12">--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <label for="brand">Бренд</label>--}}
                                        {{--                                                <input type="text" id="brand" class="form-control" value="{{ request()->get('brand') }}" placeholder="Бренд" name="brand">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="category">Категории</label>
                                                <select class="form-control" id="category" name="category">
                                                    <option selected disabled>Не выбрано</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                                @if(request('category') == $category->id) selected @endif>
                                                            {{ $category->getName() }}
                                                        </option>

                                                        @foreach($category->parents as $parent)
                                                            <option value="{{ $parent->id }}"
                                                                    @if(request('category') == $parent->id) selected @endif>
                                                                {{ $parent->getName() }}
                                                            </option>

                                                            @foreach($parent->parents as $parentt)
                                                                <option value="{{ $parentt->id }}"
                                                                        @if(request('category') == $parentt->id) selected @endif>
                                                                    {{ $parentt->getName() }}
                                                                </option>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                </select>
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

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="article_number">Артикул</label>
                                                <input type="text" id="article_number" class="form-control"
                                                       value="{{ request()->get('article_number') }}"
                                                       placeholder="Артикул" name="article_number">
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
                    <form method="post" action="{{ route('dashboard.products.mass.action') }}">
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
                                        <a href="{{ request()->fullUrlWithQuery(['column' => 'id', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">ID</a>
                                        @if (request('column') === 'id')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col" width="50">@lang('admin.products.image')</th>
                                    <th scope="col">
                                        <a href="{{ request()->fullUrlWithQuery(['column' => 'name->ru', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">
                                            @lang('admin.products.name')
                                        </a>
                                        @if (request('column') === 'name->ru')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col">@lang('admin.products.category')</th>
                                    <th scope="col">@lang('admin.units.title')</th>
                                    <th scope="col">
                                        <a href="{{ request()->fullUrlWithQuery(['column' => 'price', 'direction' => $direction]) }}"
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
                                        <a href="{{ request()->fullUrlWithQuery(['column' => 'count', 'direction' => $direction]) }}"
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
                                        <a href="{{ request()->fullUrlWithQuery(['column' => 'published', 'direction' => $direction]) }}"
                                           style="color: #ffffff;">
                                            @lang('admin.billing.status')
                                        </a>
                                        @if (request('column') === 'published')
                                            @if (request('direction') === 'asc') <i class="feather icon-arrow-down"></i>
                                            @else <i class="feather icon-arrow-up"></i>
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col">
                                        Диллер
                                    </th>
                                    <th scope="col" class="text-right">@lang('admin.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($products) == 0)
                                    <tr>
                                        <td class="text-center" colspan="9">
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
                                            @if(!$product->isAviable())
                                                <i class="fa fa-info-circle text-danger" data-toggle="tooltip"
                                                   data-original-title="@lang('admin.no_publish')"></i>
                                            @endif
                                            {{ Str::limit($product->getName(), 30) }}
                                        </td>

                                        <td>
                                            @foreach($product->categories as $category)
                                                {{ $category->getName() }}
                                            @endforeach
                                        </td>

                                        <td>
                                            {{ $product->unit ? $product->unit->getName() : '' }}
                                        </td>

                                        <td>
                                            @if ($product->price_discount)
                                                <strike>{{ $product->price }}</strike>
                                                @lang('admin.ye')
                                                <br>
                                                {{ $product->price_discount }} @lang('admin.ye')


                                            @else
                                                {{ $product->price }} @lang('admin.ye')
                                            @endif
                                        </td>

                                        <td>
                                            {{ $product->count }}
                                        </td>

                                        <td>
                                            @if(!$product->isAviable())
                                                @lang('admin.no_publish')
                                            @else
                                                Опубликовано
                                            @endif
                                        </td>

                                        <td>
                                            {{ $product->supplier->name ?? '24seven' }}
                                        </td>

                                        <td class="text-right">
                                            {{--                                            <a href="" class="btn btn-icon btn-info btn-sm" data-toggle="tooltip" data-original-title="@lang('admin.see')">--}}
                                            {{--                                                <i class="feather icon-link"></i>--}}
                                            {{--                                            </a>--}}
                                            @if ($product->isEditable())
                                                @can('update', 'products')
                                                    <a href="{{ route('dashboard.product.update', $product->id) }}"
                                                       class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip"
                                                       data-original-title="@lang('admin.edit')">
                                                        <i class="feather icon-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('delete', 'products')
                                                    <a href="{{ route('dashboard.product.delete', $product->id) }}"
                                                       class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip"
                                                       onclick="return confirm('@lang('admin.are_you_sure')')"
                                                       data-original-title="@lang('admin.delete')">
                                                        <i class="feather icon-trash"></i>
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" id="show-action">
                            <button type="submit" name="action" value="delete"
                                    class="btn btn-danger">@lang('admin.products.delete_mass')</button>
                            {{--                            <button type="submit" name="action" value="status-active" class="btn btn-success">@lang('admin.products.status_active')</button>--}}
                            <button type="submit" name="action" value="status-deactivate"
                                    class="btn btn-warning">@lang('admin.products.deactivate')</button>
                        </div>
                    </form>
                </div>
            </div>

            {{ $products->appends(request()->all())->links() }}

        </div>
    </div>
    <div id="app">
        <products-export :categories-data="{{ $export_categories }}"></products-export>
    </div>
@endsection

@push('js')
    <script>
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#show-action").hide();

            $(".change-check").change(function () {
                $("#show-action").show();
            });
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
