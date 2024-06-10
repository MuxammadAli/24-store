@extends('site.layouts.app')

@section('title', trans("app.auth.profile"))

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.main.page') }}">
                    @lang('app.main')
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('profile') }}">
                    @lang('app.auth.profile')
                </a>
            </li>

            <li class="breadcrumb-item active">
                @lang('app.profile.orders.title')
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="section-cabinet">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-5 col-md-6">
                    @include('site.includes.cabinetMenu')
                </div>

                <div class="col-xl-9 col-lg-7 mt-lg-0 mt-4">

                    @if(session()->get('info'))
                        <div class="alert-info alert">
                            <i class="fa fa-info-circle"></i> {{ session()->get('info') }}
                        </div>
                    @endif

                    <ul class="orders-nav">
                        <li class="order-active @if(!request()->get('type')) active  @endif"><a href="{{ route('profile.orders') }}">@lang('app.profile.waiting_orders')</a></li>
                        <li class="order-done @if(request()->get('type') == 'active') active  @endif"><a href="{{ route('profile.orders') }}?type=active">@lang('app.profile.active_orders')</a></li>
                        <li class="order-cancelled @if(request()->get('type') == 'closed') active  @endif"><a href="{{ route('profile.orders') }}?type=closed">@lang('app.profile.closed_orders')</a></li>
                    </ul>

                    @if(count($orders) == 0)
                        @lang('app.profile.empty_orders')
                    @endif

                    @foreach($orders as $order)
                            <div class="cabinet-content">
                                <h6 class="mb-4">Номер заказа №{{ $order->id }}</h6>

                                <div class="row">
                                    <div class="col-xl-6">
                                        @foreach($order->products as $product)
                                            <div class="card-products">
                                                <div class="cart-product d-flex align-items-end">
                                                    <div class="cart-product__img">
                                                        <img src="{{ empty($product->product->images) ? '/'.$product->product->screen->path : $product->product->images[0]->path }}" alt="{{ $product->product->getName() }}">
                                                    </div>
                                                    <div>
                                                        <h5>{{ $product->count }}x {{ number_format($product->product->price_discount ?? $product->product->price, 0, '', ' ' ) }} сум за 1 {{ $product->product->unit->getName() }}</h5>
                                                        <p class="cart-product__title m-0">{{ $product->product->getName() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-xl-6 pl-md-0 mt-xl-0 mt-4">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Номер заказа:</h6>
                                                </td>
                                                <td>
                                                    <h6>№{{ $order->id }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Время заказа:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ date('H:i d.m.Y', strtotime($order->created_at)) }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Количество:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ count($order->products) }} товаров</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Адрес доставки:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $order->address->getCity() }}, {{ $order->address->getRegion() }}, {{ $order->address->address }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Способ оплаты:</h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        {{ $order->payment_type == 'cash' ? 'Наличные' : $order->payment_type }}
                                                    </h6>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Цена за продукты:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ number_format($order->price_product, 0, '', ' ') }} сум</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Цена за доставку:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ number_format(\App\Models\Setting::first()->price_delivery, 0, '', ' ') }} сум</h6>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h6 class="text-secondary font-weight-normal">Итоговая цена:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ number_format($order->price_product + $order->price_delivery, 0, '', ' ') }} сум</h6>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex justify-content-end flex-md-row flex-column">
                                    @if($order->status == 'processing')
                                        <a href="{{ route('profile.orders.cancel', $order->id) }}" class="btn px-md-5 btn-danger d-flex justify-content-center align-items-center">
                                            Отменить заказ
                                        </a>
                                    @endif
                                </div>
                            </div>
                    @endforeach

                </div>


            </div>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
