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
                                <th scope="col">Картинка</th>
                                <th scope="col">Название</th>
                                <th scope="col">Кол-во</th>
                                <th scope="col" class="text-center">Последнее изменение</th>
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
                                        {{ $cart->id }}
                                    </td>
                                    <td>
                                        <img src="{{ $cart->product->getPoster() }}" width="100px" height="100px"
                                             style="object-fit: cover" alt="">
                                    </td>
                                    <td>
                                        {{ $cart->product->name['ru'] }}
                                    </td>
                                    <td>
                                        {{ $cart->count }}
                                    </td>
                                    <td class="text-center">{{ date('H:i d.m.Y', strtotime($cart->updated_at)) }}</td>
                                    <td class="text-right">
                                        @can('show', 'users')
                                            <button class="btn btn-primary btn-icon btn-sm"
                                                    onclick="minusCount({{ $cart->id.','.$cart->product->unit->count }})">
                                                <i class="feather icon-minus"></i>
                                            </button>
                                            <input type="number" id="count-{{ $cart->id }}"
                                                   style="border: 1px #4839eb solid; border-radius: 5px; height: 31px; width: 31px; text-align: center;"
                                                   disabled value="{{ $cart->count }}">
                                            <button class="btn btn-primary btn-icon btn-sm"
                                                    onclick="addCount({{ $cart->id.','.$cart->product->unit->count }})">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                            <a href="{{ route('dashboard.cart.delete', $cart->id) }}"
                                               class="btn btn-icon btn-danger btn-sm ml-1" data-toggle="tooltip"
                                               data-original-title="Удалить"
                                               onclick="return confirm('Вы действительно хотите удалить?')"
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
                    <div class="card-body">
                        <a href="{{ route('dashboard.cart.clear', $key) }}"
                           class="btn btn-danger btn-icon"
                           onclick="return confirm('Вы действительно хотите очистить?')">
                            <i class="feather icon-trash"></i> Очистить
                        </a>
                    </div>
                </div>
            </div>
            {{ $carts->links() }}
        </div>
    </div>
@endsection
@push('js')
    <script>
        function addCount(id, unit) {
            const input = document.querySelector('#count-' + id)
            let count = +input.value
            count += unit
            input.value = count
            xhr = new XMLHttpRequest()
            xhr.open('post', `/dashboard/carts/${id}/add/${unit}`)
            const form = new FormData
            form.append('_token', '{{ csrf_token() }}')
            xhr.send(form)
        }

        function minusCount(id, unit) {
            const input = document.querySelector('#count-' + id)
            let count = +input.value
            count -= unit
            input.value = count
            xhr = new XMLHttpRequest()
            xhr.open('post', `/dashboard/carts/${id}/minus/${unit}`)
            const form = new FormData
            form.append('_token', '{{ csrf_token() }}')
            xhr.send(form)
        }
    </script>
@endpush
