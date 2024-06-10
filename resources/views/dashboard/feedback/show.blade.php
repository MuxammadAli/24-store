@extends('dashboard.layouts.app')
@section('title', trans('admin.edit').' '.$feedback->id.' - ')

@section('content')
    <section class="input-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name">@lang('admin.edit')</h4>
                        <a href="{{ route('dashboard.feedback.index') }}" class="btn btn-outline-primary">@lang('admin.back')</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="" action="">
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>@lang('admin.feedback.name')</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative has-icon-left input-divider-left">
                                                <input type="text" class="form-control"
                                                       value="{{ $feedback->name }}" disabled>
                                                <div class="form-control-position">
                                                    <i class="feather icon-help-circle"></i>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <label>@lang('admin.feedback.phone')</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative has-icon-left input-divider-left">
                                                <input type="text" class="form-control" disabled
                                                       value="{{ $feedback->phone }}">
                                                <div class="form-control-position">
                                                    <i class="feather icon-phone-call"></i>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <label>@lang('admin.feedback.message')</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative">
                                                <textarea class="form-control" id="description_ru" disabled>{{ $feedback->message }}</textarea>
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>
{{--                                <button type="submit" class="btn btn-primary">@lang('admin.save')</button>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description_ru' ) );
    </script>
@endpush
