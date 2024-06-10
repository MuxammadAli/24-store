@extends('dashboard.layouts.app')
@section('title', trans('admin.files.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.files.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.files.title')
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
        @can('create', 'files')
            <div class="col-md-12 mb-1">


                <div class="card">
                    <div class="card-content">
                        <form action="{{ route('dashboard.file.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-icon">
                                    <i class="feather icon-save"></i> @lang('admin.save')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        @endcan
        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col" width="50">@lang('admin.brands.image')</th>
                                <th scope="col">@lang('admin.brands.name')</th>
                                <th scope="col">@lang('admin.files.path')</th>
                                <th scope="col">@lang('admin.files.size')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($files) == 0)
                                <tr>
                                    <td class="text-center" colspan="6">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($files as $file)
                                <tr>
                                    <th scope="row">{{ $file->id }}</th>
                                    <td>
                                        <img src="/{{ $file->getPath() }}" width="100%" alt="">
                                    </td>
                                    <td>
                                        {{ $file->getName() }}
                                    </td>
                                    <td>
                                        <a href="/{{ $file->getPath() }}" target="_blank">
                                            {{ $file->getPath() }}
                                        </a>
                                    </td>
                                    <td>{{ round($file->getSize() / 1024) }} kbayt</td>
                                    <td class="text-right">

                                        @can('delete', 'files')
                                            <a href="{{ route('dashboard.file.delete', $file->id) }}" class="btn btn-sm btn-danger btn-icon" data-toggle="tooltip" data-original-title="@lang('admin.delete')">
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

            {{ $files->links() }}
        </div>
    </div>
@endsection
