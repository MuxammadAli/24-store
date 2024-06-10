@extends('dashboard.layouts.app')
@section('title', trans('admin.add'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.add')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.products') }}">@lang('admin.products.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.add')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        #parent {
            position: absolute;
            left: 0;
            top: 0;
            width: 80vw;
            height: 75vh;
            overflow: hidden;
        }

        table {
            display: flex;
            flex-direction: column;
            flex: 1 1 auto;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        thead {

            flex: 1 0 auto;
            display: block;
            overflow-x: hidden;

            overflow-y: scroll;

        }



        /* Scroll the actual tbody (second child on all browsers) */
        tbody {
            display: block;
            overflow: scroll;
        }

        tbody:nth-child(3) {
            display: none;
        }

        td,
        th {
        }

        th {
            background-color: #f7f7f7;
            height: auto;
            min-height: 50px;
        }

        td:first-child,
        th:first-child {
            position: sticky;
            position: -webkit-sticky;
            left: 0;
        }

        input {
            display: block;
            max-width: 10em;
            margin: 0 auto;
        }
    </style>
@endpush
@section('content')
    <div class="card position-relative">
        <div class="card-content" >
            <div id="parent">
                <div>
                    <table class="table mb-0">
                        <thead class="thead-dark" id="myhead">
                            <tr>
                            <th scope="col">№</th>
                            <th scope="col">Названия RU *</th>
                            <th scope="col">Названия RU *</th>
                            <th scope="col">Бренд *</th>
                            <th scope="col">Цена *</th>
                            <th scope="col">Цена со скидкой</th>
                            <th scope="col">Артикул *</th>
                            <th scope="col">Сканер отпечатков пальцев (1,0)</th>
                            <th scope="col">Размер диагонали</th>
                            <th scope="col">Количество SIM-карт</th>
                            <th scope="col">Слот для карты памяти (1,0)</th>
                        </tr>
                        </thead>
                        <tbody id="mybody" onscroll="fixscroll()">
                            <tr>
                                <td>
                                    1
                                </td>

                                <td>
                                    <input type="text" class="form-control">
                                </td>

                                <td>
                                    <input type="text" class="form-control">
                                </td>

                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>

                                <td>
                                    <input type="text" class="form-control">
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection



@push('js')

    <script>
        function fixscroll() {
            var thead = document.getElementById("myhead");
            var tbodyScroll = document.getElementById("mybody").scrollLeft;
            thead.scrollLeft = tbodyScroll;
            //document.getElementById("frozen").scrollLeft = 0;
        }
    </script>
    <script src="{{ mix('js/app.js') }}"></script>


@endpush
