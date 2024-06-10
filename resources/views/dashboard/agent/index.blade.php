@extends('dashboard.layouts.app')
@section('title', 'Агенты - ')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Агенты</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изобрежения</th>
                                <th>ФИО</th>
                                <th>Телефон</th>
                                <th>Регион</th>
                                <th>Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agents as $agent)
                                <tr @if ($agent->blocked) class="alert alert-danger"
                                    style="filter: grayscale(1)" data-toggle="tooltip" title="Агент заблокирован" @endif>
                                    <td>{{ $agent->id }}</td>
                                    <td>
                                        <img src="{{ $agent->getImage() }}" width="120px" height="120px"
                                             style="object-fit: cover" alt="">
                                    </td>
                                    <td>{{ $agent->getFullName() }}</td>
                                    <td><a href="tel:{{ $agent->phone }}">{{ $agent->phone }}</a></td>
                                    <td>{{ $agent->region->name['ru'] }}</td>
                                    <td>{{ $agent->getStatus() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
