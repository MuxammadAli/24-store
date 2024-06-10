@extends('dashboard.layouts.app')
@section('title', 'Корзина - ')
@section('content')
    <div class="row" id="table-head">
        <div class="col-md-12 mb-1">
            <form action="{{ route('dashboard.cart.index') }}" class="col-2" method="get" id="paginate_id">
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
                                <th scope="col" width="60">ID</th>
                                <th scope="col">Пользователь</th>
                                <th scope="col">Регион</th>
                                <th scope="col">Кол-во товаров</th>
                                <th scope="col" class="text-center">Последнее изменение</th>
                                <th scope="col" class="text-center">Оставшееся время</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($carts) == 0)
                                <tr>
                                    <td class="text-center" colspan="5">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($carts as $cart)
                                <tr>
                                    <td>
                                        {{ $cart->user_id }}
                                    </td>
                                    <td>
                                        {{ $cart->phone }}
                                    </td>
                                    <td>
                                        {{ $cart->region->name['ru'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $cart->cart_count }}
                                    </td>
                                    <td class="text-center">{{ $cart->update }}</td>
                                    <td class="text-center">{{ $cart->deadline }}</td>
                                    <td class="text-right">
                                        @can('show', 'users')
                                            <a href="{{ route('dashboard.cart.show', $cart->user_id ?? $cart->token) }}"
                                               class="btn btn-icon btn-success btn-sm" data-toggle="tooltip"
                                               data-original-title="Посмотреть">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.cart.clear', $cart->user_id ?? $cart->token) }}"
                                               class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip"
                                               data-original-title="Очистить"
                                               onclick="return confirm('Вы действительно хотите очистить корзину?')"
                                            >
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
            {{ $carts->links() }}
        </div>
    </div>
@endsection
