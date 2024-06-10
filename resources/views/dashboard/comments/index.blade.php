@extends('dashboard.layouts.app')
@section('title', trans('admin.comments.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.comments.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.comments.title')
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
        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col" width="50">@lang('admin.specialOffers.image')</th>
                                <th scope="col" width="200" class="text-center">@lang('admin.products.name')</th>
                                <th scope="col" class="text-center">@lang('admin.comments.full_name')</th>
                                <th scope="col" class="text-center">@lang('admin.comments.status')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($comments) == 0)
                                <tr>
                                    <td class="text-center" colspan="6">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        {{ $comment->id }}
                                    </td>

                                    <td>
                                        @if(!empty($comment->product))
                                            <img src="{{ $comment->product->getPoster() ?? 'images/no_product.jpg' }}" class="w-100">
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if(!empty($comment->product))
                                            {{ $comment->product->getName() }}
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        {{ $comment->first_name }}
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-icon btn-sm btn-{{ ($comment->publish == 1)?'info' : 'warning' }}">
                                            <i class="feather icon-{{ ($comment->publish == 1)?'check-circle':'alert-circle' }}">
                                            </i> {{ ($comment->publish == 1)? trans('admin.comments.published') : trans('admin.comments.not_published') }}
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        @can('update', 'comments')
                                            <a href="{{ route('dashboard.comment.update', $comment->id) }}" class="btn btn-icon btn-info btn-sm" data-toggle="tooltip" data-original-title="@lang('admin.preview')">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                        @endcan

                                        @can('delete', 'comments')
                                            <a href="{{ route('dashboard.comment.delete', $comment->id) }}" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" onclick="return confirm('@lang('admin.are_you_sure')')" data-original-title="@lang('admin.delete')">
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

            {{ $comments->appends(request()->all())->links() }}

        </div>
    </div>
@endsection
