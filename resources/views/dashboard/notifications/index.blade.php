@extends('dashboard.layouts.app')
@section('title', 'Push-уведомления - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Push-уведомления</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Push-уведомления
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


            <div class="card">
                <div class="card-content">
                    <form action="{{ route('dashboard.notifications.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="text" name="title" class="form-control" placeholder="Названия">

                            <input type="text" name="body" class="form-control mt-2" placeholder="Текст">

                            <select class="form-control mt-2" name="lang">
                                <option value="ru" selected>RU</option>
                                <option value="uz">UZ</option>
                            </select>

                        </div>



                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-icon">
                                <i class="feather icon-send"></i> отправить
                            </button>
                        </div>
                    </form>
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
                                <th scope="col" width="50">ID</th>
                                <th scope="col">Названия</th>
                                <th scope="col">Текст</th>
                                <th scope="col">Язык</th>
                                <th scope="col" class="text-right">Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($notifications) == 0)
                                    <tr>
                                        <td class="text-center" colspan="5">
                                            @lang('admin.no_data')
                                        </td>
                                    </tr>
                                @endif

                                @foreach($notifications as $notification)
                                    <tr>
                                        <td>
                                            {{ $notification->id }}
                                        </td>

                                        <td>
                                            {{ $notification->title }}
                                        </td>

                                        <td>
                                            {{ $notification->body }}
                                        </td>

                                        <td>
                                            {{ $notification->language }}
                                        </td>

                                        <td class="text-right">
                                            {{ $notification->created_at->format('d.m.Y - H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $notifications->links() }}
        </div>
    </div>
@endsection
