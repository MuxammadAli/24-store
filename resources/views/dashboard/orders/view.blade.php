@extends('dashboard.layouts.app')
@section('title', trans('admin.orders.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.orders.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.orders.title')
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
    @if($order->payment_type == 'credit' && !empty($order->apelsin_data) && (!empty($order->apelsin_data['body']) ? !$order->apelsin_data['status'] : !$order->apelsin_data['result'] ))
        <div class="alert alert-danger">
            @if(!empty($order->apelsin_data['body']['errorMessage']) && $order->apelsin_data['body']['errorMessage'] == 'NOT_FOUND')
                <i class="fa fa-info-circle"></i> Было проблема с Apelsin кредитом<br>
            @endif

            @if(!empty($order->apelsin_data['body']['reason']))
                <i class="fa fa-info-circle"></i> Кредит причина отказа: {{ $order->apelsin_data['body']['reason'] }}
            @endif

            @if(empty($order->apelsin_data['reason']) || empty($order->apelsin_data['status']))
                <i class="fa fa-info-circle"></i> Кредит причина отказа:
                {{ !empty($order->apelsin_data['body']['reason']) ? $order->apelsin_data['body']['reason'] : (!empty($order->apelsin_data['reason']) ? $order->apelsin_data['reason'] : '') }}
            @endif
        </div>
    @endif
    <section class="card invoice-page">
        <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            {{--            <div id="invoice-company-details" class="row">--}}

            <div class="row">
                <div class="col-md-6 text-left pt-1 mb-3">
                    <div class="col-12">
                        <div class="media pt-1">
                            <img src="/vendor/dashboard/logo-24.png" alt="company logo" width="100" class=""/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-right pt-1 mb-3">
                    @if(!empty(auth()->user()->role->permissions['order_status']['replacement']) && $order->status == 'replacement' || !empty(auth()->user()->role->permissions['order_status']['closed']) && $order->status == 'replacement')
                        <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Редактировать
                        </a>
                    @endif

                    @if(!empty(auth()->user()->role->permissions['orders']['print']))
                        <a href="{{ route('dashboard.invoice_print', $order->id) }}" target="_blank"
                           class="btn btn-success">
                            <i class="fa fa-print"></i> Печатать
                        </a>
                    @endif

                    <button type="button" class="btn btn-secondary">
                        <i class="feather icon-box"></i> В архиве
                    </button>
                </div>
            </div>
            <div class="col-6 float-left text-left">
                <h5>@lang('admin.orders.client')</h5>
                <div class="recipient-info my-2">
                    <p>
                        <b>@lang('admin.orders.first_name'):</b>
                        {{ $order->getFirstName() }}
                    </p>
                    <p>
                        <b>@lang('admin.orders.last_name'):</b>
                        {{ $order->getLastName() }}
                    </p>
                    <p>
                        <b>@lang('admin.orders.phone'):</b> +{{ $order->user->phone }}
                    </p>
                    @if($order->type_delivery == 'delivery')
                        <p>
                            <b>Дополнительный контакт:</b>
                            {{ !empty($order->address) ? '+'. $order->address->phone_other : '' }}
                        </p>
                        <p>
                            <b>Регион:</b>
                            {{ $order->getRegion() }}</p>
                        <p>
                            <b>@lang('admin.orders.address'):</b>
                            {{ !empty($order->address) ? $order->address->address : '' }}
                            @if (isset($order->address->location['lng']))
                                ,
                                <a href="{{ $order->address->getUrl() }}" target="_blank">Показать на карте</a>
                            @endif
                        </p>
                    @else
                        <p>
                            <b>@lang('admin.orders.branch'):</b>
                            {{ $order->getAddress() }}
                        </p>
                    @endif
                    @if (isset($order->agent))
                        <p>
                            <b>Агент:</b>
                            {{ $order->agent->getFullName() }}
                        </p>
                    @endif

                    <p><b>@lang('admin.orders.comment'):</b> {{ $order->comment }}</p>
                </div>

            </div>

            <div class="col-6 float-left text-right">
                <h1>
                    @lang('admin.orders.order')

                    @if($order->payment_type == 'cash')
                        (Наличный расчет)
                    @else
                        @switch($order->payment_status)
                            @case('cancelled')
                            (Отменено)
                            @break
                            @case('payed')
                            (Оплачено)
                            @break
                            @case('waiting')
                            (Не оплачено)
                            @break
                            @case('cash')
                            (Наличный)
                            @break
                            @case('review')
                            На рассмотрение
                            @break;
                        @endswitch
                    @endif
                </h1>
                @if($order->type == 'one_click')
                    <br><span class="text-danger">(Купить в 1 клик)</span>
                @endif
                <div class="invoice-details mt-2">
                    <h6>@lang('admin.orders.order_number', ['number' => $order->id])</h6>
                    <h6 class="mt-2">@lang('admin.orders.date')</h6>
                    <p>{{ date('H:i - d.m.Y', strtotime($order->created_at)) }}</p>
                    <h6 class="mt-2">@lang('admin.orders.payment_system')</h6>
                    <p>
                        @if($order->payment_type == 'cash')
                            Наличный расчет
                        @else
                            {{ $order->payment_type }}
                        @endif

                    </p>

                    @if($order->payment_type != 'credit')
                        @if($order->payment_status == 'payed' || $order->payment_status == 'cancelled')
                            <h6 class="mt-2">@lang('admin.orders.transaction')</h6>
                            <p>
                                {{ $order->billing->transaction_id }}
                            </p>
                        @endif
                    @endif

                    <h6 class="mt-2">@lang('admin.orders.status')</h6>
                    <p>
                    @if ($order->isEditable())
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown"
                                    class="btn btn-{{ $order->getStatusColor() }} waves-effect waves-light">
                                {{ $order->getStatus() }}
                                <i class="feather icon-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if ($order->status !== 'processing')
                                    <a class="dropdown-item"
                                       href="{{ route('dashboard.orders.status', [$order->id, 'processing']) }}">
                                        В обработке
                                    </a>
                                @endif
                                @if ($order->status !== 'collected')
                                    <a class="dropdown-item"
                                       href="{{ route('dashboard.orders.status', [$order->id, 'collected']) }}">
                                        Готов к доставке
                                    </a>
                                @endif
                                @if ($order->status !== 'delivery')
                                    <a class="dropdown-item"
                                       href="{{ route('dashboard.orders.status', [$order->id, 'delivery']) }}">
                                        На доставке
                                    </a>
                                @endif
                                @if ($order->status !== 'closed')
                                    <a class="dropdown-item"
                                       href="{{ route('dashboard.orders.status', [$order->id, 'closed']) }}">
                                        Закрыт
                                    </a>
                                @endif
                                @if ($order->status !== 'cancelled')
                                    <a class="dropdown-item"
                                       href="{{ route('dashboard.orders.status', [$order->id, 'cancelled']) }}">
                                        Отменен
                                    </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <button type="button" data-toggle="dropdown"
                                class="btn btn-{{ $order->getStatusColor() }} waves-effect waves-light">
                            {{ $order->getStatus() }}
                        </button>
                        @endif
                        </p>
                </div>
            </div>

            {{--            </div>--}}
        <!--/ Invoice Recipient Details -->

            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-1 col-12 float-left invoice-items-table">
                <div class="row">
                    <div class="table-responsive col-sm-12 ">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('admin.orders.article_number')</th>
                                <th>Фото</th>
                                <th width="300">@lang('admin.orders.product')</th>

                                <th>@lang('admin.orders.price')</th>
                                <th>@lang('admin.slider.discount')</th>
                                {{--                                <th>@lang('admin.orders.size')</th>--}}
                                <th>@lang('admin.orders.count')</th>
                                <th>Поставщик</th>
                                {{--                                <th>@lang('admin.orders.color')</th>--}}

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->product->id }}
                                    </td>

                                    <td>
                                        {{ $product->product->article_number }}
                                    </td>

                                    <td>
                                        <img src="{{ $product->product->getPosterThumb() }}" style="max-height: 150px; object-fit: contain;" width="100" alt="">
                                    </td>

                                    <td>
                                        {{ $product->product->getName() }}
                                    </td>

                                    <td>
                                        @if($product->product->getPriceDiscount() || $product->discount)
                                            <strike>
                                                {{ number_format($product->product->price, 0, '.', ' ') }}
                                                @lang('admin.ye')

                                            </strike><br>
                                            {{ number_format($product->price, 0, '.', ' ') }}
                                            @lang('admin.ye')
                                        @else
                                            {{ number_format($product->price, 0, '.', ' ') }}
                                            @lang('admin.ye')
                                        @endif
                                    </td>

                                    <td>
                                        {{ $product->discount }}%
                                    </td>

                                    <td>{{ $product->getCount() }} {{ $product->product->unit ? $product->product->unit->getName() : '' }}</td>

                                    <td>{{ $product->supplier ? $product->supplier->name : 'Склад' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="pt-1 col-12 float-left invoice-items-table"></div>
            <div id="invoice-items-details" class="pt-1 col-12 float-left invoice-items-table">
                <b>Поставщики</b>
                <div class="row">
                    <div class="table-responsive col-sm-12 ">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Названия</th>
                                <th>Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>{{ $status->name }}</td>
                                    <td><b class="text-{{ $status->status_color }}">{{ $status->status_text }}</b></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="invoice-total-details" class="invoice-total-table">
                <div class="row">
                    <div class="col-7 offset-5">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>

                                <tr class="text-right">
                                    <th>@lang('admin.orders.product')</th>
                                    <td width="150">{{ number_format($order->price_product, 0, '', ' ') }} @lang('admin.ye')</td>

                                </tr>


{{--                                <tr class="text-right">--}}
{{--                                    <th>@lang('admin.orders.delivery')</th>--}}
{{--                                    <td width="150">{{ number_format(\App\Models\Setting::first()->price_delivery, 0, '', ' ') }} @lang('admin.ye')</td>--}}
{{--                                </tr>--}}

                                <tr class="text-right">
                                    <th>@lang('admin.slider.discount')</th>
                                    <td width="150">{{ $order->discount }} %</td>
                                </tr>

                                <tr class="text-right">
                                    <th>@lang('admin.orders.total')</th>
                                    <td width="150">{{ number_format($order->price_product, 0, '', ' ') }} @lang('admin.ye')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success mb-1" data-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-plus-circle"></i> Добавить комментарий
            </button>

            <div class="collapse" id="collapseExample">
                <div class="card ">
                    <div class="card-content">
                        <form action="{{ route('dashboard.orders.comments_status') }}" method="post">
                            <div class="card-body">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="type" value="default">
                                    <label>Комментария</label>
                                    <textarea name="comment" id="" class="form-control" cols="3" rows="3"></textarea>

                                    <button class="btn btn-primary mt-2">
                                        <i class="fa fa-save"></i> Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            @if(count($order->comments) > 0)
                <h2>Комментарии</h2>
                <ul class="activity-timeline timeline-left list-unstyled mt-2">
                    @foreach($order->comments as $comment)
                        <li>
                            @switch($comment->type)
                                @case('cancelled')
                                <div class="timeline-icon bg-danger">
                                    <i class="feather icon-archive font-medium-2 align-middle"></i>
                                </div>
                                @break

                                @case('replacement')
                                <div class="timeline-icon bg-warning">
                                    <i class="feather icon-refresh-ccw font-medium-2 align-middle"></i>
                                </div>
                                @break

                                @case('closed')
                                <div class="timeline-icon bg-success">
                                    <i class="feather icon-archive font-medium-2 align-middle"></i>
                                </div>
                                @break
                                @case('default')
                                <div class="timeline-icon bg-primary">
                                    <i class="fa fa-comment font-medium-2 align-middle"></i>
                                </div>
                                @break
                            @endswitch


                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">
                                    @switch($comment->type)
                                        @case('cancelled')
                                        Отменен
                                        @break

                                        @case('replacement')
                                        Замена
                                        @break
                                    @endswitch
                                </p>
                                <span class="font-small-3">
                                    {{ $comment->comment }}
                                </span>
                            </div>
                            <small class="text-muted">{{ date('H:i, d.m.Y', strtotime($comment->created_at)) }} |
                                Пользователь: <b>{{ $comment->user->username }}</b> </small>
                        </li>
                    @endforeach

                </ul>
            @endif

            @if(count($logs) > 0)
                <h2>@lang('admin.logs.title')</h2>
                <ul class="activity-timeline timeline-left list-unstyled mt-2">
                    @foreach($logs as $log)
                        <li>
                            @if(!empty($log->properties['old']['payment_status']))
                                <div class="timeline-icon bg-success">
                                    <i class="feather icon-credit-card font-medium-2 align-middle"></i>
                                </div>
                            @else
                                @switch($log->description)
                                    @case('created')
                                    <div class="timeline-icon bg-success">
                                        <i class="feather icon-plus-circle font-medium-2 align-middle"></i>
                                    </div>
                                    @break

                                    @case('updated')
                                    <div class="timeline-icon bg-primary">
                                        <i class="feather icon-refresh-ccw font-medium-2 align-middle"></i>
                                    </div>
                                    @break
                                @endswitch
                            @endif


                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">
                                    @if(!empty($log->properties['old']['payment_status']))
                                        Статус оплаты
                                    @else
                                        @switch($log->description)
                                            @case('created')
                                            Cоздан
                                            @break
                                            @case('updated')
                                            Изменено
                                            @break
                                        @endswitch
                                    @endif
                                </p>
                                <span class="font-small-3">
                                    @if($log->description == 'updated')
                                        @if(!empty($log->properties['old']['status']))
                                            Статус
                                            <span class="text-danger">
                                               @switch($log->properties['old']['status'])
                                                    @case('processing')
                                                    В обработке
                                                    @break
                                                    @case('collected')
                                                    Собран
                                                    @break
                                                    @case('waiting_buyer')
                                                    Ожидает покупателя
                                                    @break
                                                    @case('in_way')
                                                    В пути
                                                    @break
                                                    @case('closed')
                                                    Закрыт
                                                    @break
                                                    @case('cancelled')
                                                    Отменен
                                                    @break
                                                    @case('replacement')
                                                    Замена
                                                    @break
                                                @endswitch
                                            </span>

                                            изменено на

                                            <span class="text-success">
                                                @switch($log->properties['attributes']['status'])
                                                    @case('processing')
                                                    В обработке
                                                    @break
                                                    @case('collected')
                                                    Собран
                                                    @break
                                                    @case('waiting_buyer')
                                                    Ожидает покупателя
                                                    @break
                                                    @case('in_way')
                                                    В пути
                                                    @break
                                                    @case('closed')
                                                    Закрыт
                                                    @break
                                                    @case('cancelled')
                                                    Отменен
                                                    @break
                                                    @case('replacement')
                                                    Замена
                                                    @break
                                                @endswitch
                                            </span>
                                        @endif

                                        @if(!empty($log->properties['old']['payment_status']))
                                            @switch($log->properties['attributes']['payment_status'])
                                                @case('waiting')
                                                Ожидается оплата
                                                @break
                                                @case('cancelled')
                                                Отказано оплата
                                                @break
                                                @case('payed')
                                                @if($order->payment_type == 'credit')
                                                    Кредит одобрен
                                                @else
                                                    Оплачено
                                                @endif
                                                @break
                                                @case('cash')
                                                Наличный расчет
                                                @break
                                                @case('review')
                                                Кредит на рассмотрение
                                                @break
                                            @endswitch
                                        @endif
                                    @endif
                                </span>
                            </div>
                            <small class="text-muted">
                                {{ date('H:i, d.m.Y', strtotime($log->created_at)) }} |
                                Пользователь:
                                <b>
                                    @if($log->description == 'created')
                                        @if(!empty($log->causer))
                                            {{ $log->causer->phone }}
                                        @else
                                            без авторизации
                                        @endif
                                    @else
                                        @if(!empty($log->causer->username))
                                            {{ $log->causer->username }}
                                        @endif
                                    @endif
                                </b>
                            </small>
                        </li>
                    @endforeach
                </ul>
            @endif


            @if($order->payment_type == 'credit')
                <h2>Комментарии от Банка</h2>
                <ul class="activity-timeline timeline-left list-unstyled mt-2">
                    <li>
                        <div class="timeline-icon bg-warning">
                            <i class="fa fa-bank font-medium-2 align-middle"></i>
                        </div>

                        <div class="timeline-info">
                            <p class="font-weight-bold mb-0"></p>
                            <span class="font-small-3">
                                Клиент перешел на сайт банка
                            </span>
                        </div>
                        <small class="text-muted">{{ date('H:i, d.m.Y', strtotime($order->created_at)) }} |
                            Пользователь: <b>Alistore-bot</b> </small>
                    </li>

                    @foreach($order->comments_bank as $comment)
                        <li>
                            <div class="timeline-icon bg-warning">
                                <i class="fa fa-bank font-medium-2 align-middle"></i>
                            </div>

                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0"></p>
                                <span class="font-small-3">
                                    {{ $comment->comment }}
                                </span>
                            </div>
                            <small class="text-muted">{{ date('H:i, d.m.Y', strtotime($comment->created_at)) }} |
                                Пользователь: <b>Apelsin-bot</b> </small>
                        </li>
                    @endforeach

                </ul>
        @endif
        <!-- Invoice Footer -->

            <!--/ Invoice Footer -->

        </div>
    </section>
@endsection


@push('js')
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.orders.comments_status') }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Написать комментарий</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="order_id" value="" id="id_order">
                        <input type="hidden" name="type" value="" id="type_order">
                        <textarea cols="3" class="form-control" name="comment"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-secondary">Изменить статус</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('.modal-comment').on('click', function (e) {
                var id = $(this).data('id');
                var type = $(this).data('type');

                $('#type_order').val(type);
                $('#id_order').val(id);
            })

        })
    </script>
@endpush
