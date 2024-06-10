@extends('dashboard.layouts.app')
@section('title', trans('admin.compilations.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.compilations.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.compilations.title')
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
            @can('create', 'compilations')
                <a href="{{ route('dashboard.compilations.store') }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.add')
                </a>
            @endcan
        </div>

        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">@lang('admin.products.name')</th>
                                <th scope="col">@lang('admin.orders.count')</th>
                                <th scope="col">@lang('admin.products.category')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($compilations) == 0)
                                <tr>
                                    <td class="text-center" colspan="4">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif

                            @foreach($compilations as $compilation)
                                <tr>
                                    <td>
                                        {{ $compilation->id }}
                                    </td>

                                    <td>
                                        @if(!$compilation->isAviable())
                                            <i class="fa fa-info-circle text-danger" data-toggle="tooltip" data-original-title="@lang('admin.no_publish')"></i>
                                        @endif
                                        {{ $compilation->getTitle() }}
                                    </td>

                                    <td>
                                        @if ($compilation->type == 'default')
                                            {{ $compilation->products->count() }}
                                        @elseif ($compilation->type == 'coin')
                                            {{ $compilation->coin_products->count() }}
                                        @endif
                                    </td>

                                    <td>
                                        @if($compilation->category_id > 0)
                                            {{ $compilation->category->getName() }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @can('update', 'compilations')
                                        <a href="{{ route('dashboard.compilations.update', $compilation->id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-original-title="@lang('admin.edit')">
                                            <i class="feather icon-edit"></i>
                                        </a>
                                        @endcan

                                        @can('delete', 'compilations')
                                            @if(!in_array($compilation->id, [1,2,3]) and $compilation->type != 'coin')
                                                <a href="{{ route('dashboard.compilations.delete', $compilation->id) }}" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" onclick="return confirm('@lang('admin.are_you_sure')')" data-original-title="@lang('admin.delete')">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endif
                                        @endcan
                                    </td>
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
