@extends('dashboard.layouts.app')
@section('title', trans('admin.edit').' '.$comment->id.' - ')

@section('content')
    <section class="input-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name">@lang('admin.edit')</h4>
                        <a href="{{ route('dashboard.comments') }}" class="btn btn-outline-primary">@lang('admin.back')</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('dashboard.comment.update', $comment->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>@lang('admin.name')</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative has-icon-left input-divider-left">
                                                <input type="text" class="form-control"
                                                       value="{{ $comment->first_name }}" disabled>
                                                <div class="form-control-position">
                                                    <i class="feather icon-help-circle"></i>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <label>@lang('admin.feedback.message')</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative">
                                                <textarea class="form-control" disabled>{{ $comment->body }}</textarea>
                                            </fieldset>
                                        </div>

                                        <fieldset class="checkbox">
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" value="1" {{ $comment->publish ? 'checked' : '' }} name="publish">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span>

                                                <span class="">
                                                    @lang('admin.comments.publish')
                                                </span>
                                            </div>
                                        </fieldset>
                                        <br>

                                    </div>

                                    <div class="col-md-3">
                                        <a href="{{ route('dashboard.comment.publish', $comment->id) }}" class="btn btn-primary">@lang('admin.save')</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('dashboard.comment.delete', $comment->id) }}" class="btn btn-danger">@lang('admin.delete')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
