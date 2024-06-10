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
        </div>
    </div>
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <form method="post" action="{{ route('dashboard.orders.mass_archived') }}">
                        @csrf
                        <div class="table">
                            <table class="table mb-0">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="50">ID</th>
                                    <th scope="col">@lang('admin.orders.user')</th>
                                    <th scope="col">Товар</th>
                                    <th scope="col">Кол-во</th>
                                    <th scope="col">Регион</th>
                                    <th scope="col">@lang('admin.orders.status')</th>
                                    <th scope="col">@lang('admin.orders.date')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($orders) == 0)
                                    <tr>
                                        <td class="text-center" colspan="7">
                                            @lang('admin.no_data')
                                        </td>
                                    </tr>
                                @endif

                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->id }}
                                        </td>
                                        <td>
                                            +{{ $order->user->getPhone() }}
                                        </td>

                                        <td>
                                            <a href="{{ route('coin-product.show', [$order->coin_product->id, $order->coin_product->slug]) }}" target="_blank">{{ $order->coin_product->getName() }}</a>
                                        </td>

                                        <td>
                                            {{ $order->count }}
                                        </td>

                                        <td>{{ $order->getRegion() }}</td>

                                        <td>

                                            <div class="btn-group dropleft mr-1 mb-1">
                                                <button type="button"
                                                        class="btn @if($order->status == 'new') btn-primary
                                                            @elseif($order->status == 'viewed') btn-secondary
                                                            @elseif($order->status == 'processing') btn-warning
                                                            @elseif($order->status == 'completed') btn-success
                                                            @elseif($order->status == 'cancelled') btn-danger
                                                            @endif  dropdown-toggle waves-effect waves-light"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    @switch($order->status)
                                                        @case('new')
                                                        Новый
                                                        @break
                                                        @case('viewed')
                                                        Просмотрен
                                                        @break
                                                        @case('processing')
                                                        На исполнении
                                                        @break
                                                        @case('completed')
                                                        Выполненный
                                                        @break
                                                        @case('cancelled')
                                                        Отменен
                                                        @break
                                                    @endswitch
                                                </button>
                                                <div class="dropdown-menu" x-placement="left-start"
                                                     style="position: absolute; transform: translate3d(-147px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                    @if(!empty(auth()->user()->role->permissions['order_status']['processing']))
                                                        <a class="dropdown-item @if($order->status == 'new') disabled @endif"
                                                           onclick="return confirm('Вы действительно хотите изменить статус?')"
                                                           href="{{ route('dashboard.coin-product-order.status', [$order->id, 'new']) }}">
                                                            Новый
                                                        </a>
                                                    @endif

                                                    @if(!empty(auth()->user()->role->permissions['order_status']['processing']))
                                                        <a class="dropdown-item @if($order->status == 'viewed') disabled @endif"
                                                           onclick="return confirm('Вы действительно хотите изменить статус?')"
                                                           href="{{ route('dashboard.coin-product-order.status', [$order->id, 'viewed']) }}">
                                                            Просмотрен
                                                        </a>
                                                    @endif

                                                    @if(!empty(auth()->user()->role->permissions['order_status']['processing']))
                                                        <a class="dropdown-item @if($order->status == 'processing') disabled @endif"
                                                           onclick="return confirm('Вы действительно хотите изменить статус?')"
                                                           href="{{ route('dashboard.coin-product-order.status', [$order->id, 'processing']) }}">
                                                            В исполнении
                                                        </a>
                                                    @endif

                                                    @if(!empty(auth()->user()->role->permissions['order_status']['processing']))
                                                        <a class="dropdown-item @if($order->status == 'completed') disabled @endif"
                                                           onclick="return confirm('Вы действительно хотите изменить статус?')"
                                                           href="{{ route('dashboard.coin-product-order.status', [$order->id, 'completed']) }}">
                                                            Выполненный
                                                        </a>
                                                    @endif

                                                    @if(!empty(auth()->user()->role->permissions['order_status']['processing']))
                                                        <a class="dropdown-item @if($order->status == 'cancelled') disabled @endif"
                                                           onclick="return confirm('Вы действительно хотите изменить статус?')"
                                                           href="{{ route('dashboard.coin-product-order.status', [$order->id, 'cancelled']) }}">
                                                            Отменен
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>


                                        </td>

                                        <td>
                                            {{ date('H:i - d.m.Y', strtotime($order->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="/vendor/picker/daterangepicker.css"/>

@endpush

@push('js')

    <script type="text/javascript" src="/vendor/picker/moment.min.js"></script>
    <script type="text/javascript" src="/vendor/picker/daterangepicker.js"></script>

    <script type="text/javascript">
        $(function () {

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
                $('#from').val(picker.startDate.format('YYYY-MM-DD'));
                $('#to').val(picker.endDate.format('YYYY-MM-DD'));
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });


            $('.modal-comment').on('click', function (e) {
                var id = $(this).data('id');
                var type = $(this).data('type');

                $('#type_order').val(type);
                $('#id_order').val(id);
            })

        });


    </script>

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
@endpush
