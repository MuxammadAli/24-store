@extends('dashboard.layouts.app')
@section('title', trans('admin.edit'). ' ' .$page->name['ru']. ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.edit')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="">@lang('admin.pages.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $page->name['ru'] }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('vendor/editor/dist/summernote.min.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="row" id="table-head">
        <div class="col-md-12 mb-1">
            @can('delete', 'pages')
                <a href="{{ route('dashboard.pages.destroy', [$page->id]) }}" class="btn btn-icon btn-danger float-right mr-1">
                    <i class="feather icon-delete"></i> Удалить
                </a>
            @endcan
        </div>
    </div>


    <div class="row">
        <form class="form form-vertical" action="{{ route('dashboard.pages.update', $page->id) }}" method="post" enctype="multipart/form-data">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('admin.edit')</h4>
                    </div>
                    <div class="card-content">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.pages.name') UZ *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('name.uz') is-invalid @enderror"
                                                           name="name[uz]" value="{{ old('name.uz', $page->name['uz']) }}" placeholder="@lang('admin.pages.name') UZ">
                                                    @error('name.uz')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nameru">@lang('admin.pages.name') RU *</label>
                                                    <input type="text" id="nameru" required class="form-control @error('name.ru') is-invalid @enderror"
                                                           value="{{ old('name.ru', $page->name['ru']) }}" name="name[ru]" placeholder="@lang('admin.pages.name') RU">
                                                    @error('name.ru')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label>@lang('admin.pages.description') RU *</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative">
                                                <textarea class="form-control @error('body.ru') is-invalid @enderror" required name="body[ru]"
                                                    placeholder="@lang('admin.pages.description') RU" id="description_ru">{{ old('body.ru', $page->body['ru']) }}</textarea>
                                            </fieldset>
                                            @error('body.ru')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label>@lang('admin.pages.description') UZ *</label>
                                        <div class="controls">
                                            <fieldset class="form-group position-relative">
                                                        <textarea class="form-control @error('body.uz') is-invalid @enderror" required name="body[uz]"
                                                                  placeholder="@lang('admin.pages.description') UZ" id="description_uz">{{ old('body.uz', $page->body['uz']) }}</textarea>
                                            </fieldset>
                                            @error('body.uz')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">SEO</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control" name="keywords[ru]" id="label-keywords-ru" rows="3" placeholder="@lang('admin.settings.keywords')  RU">{{ old('keywords.ru', $page->keywords['ru']) }}</textarea>
                                                <label for="label-keywords-ru">@lang('admin.settings.keywords') RU *</label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control" name="keywords[uz]" id="label-keywords" rows="3" placeholder="@lang('admin.settings.keywords') UZ">{{ old('keywords.uz', $page->keywords['uz']) }}</textarea>
                                                <label for="label-keywords">@lang('admin.settings.keywords') UZ *</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control"  name="descriptions[ru]" id="label-description-ru" rows="3" placeholder="@lang('admin.settings.description') RU">{{ old('descriptions.ru', $page->descriptions['ru']) }}</textarea>
                                                <label for="label-description-ru">@lang('admin.settings.description') RU *</label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control"  name="descriptions[uz]" id="label-description" rows="3" placeholder="@lang('admin.settings.description') UZ">{{ old('descriptions.uz', $page->descriptions['uz']) }}</textarea>
                                                <label for="label-description">@lang('admin.settings.description') UZ *</label>
                                            </fieldset>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer pb-0 pl-0 pt-1">
                        <div class="col-12 mb-0">
                            <div class="row">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                        <i class="feather icon-save"></i> @lang('admin.save')
                                    </button>
                                </div>

                                <div class="col-9">
                                    <a href="{{ route('dashboard') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                        <i class="feather icon-x-circle"></i> @lang('admin.cancel')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('js')

    <script src="{{ asset('vendor/editor/dist/summernote.min.js') }}"></script>

    <script>

        $(document).ready(function () {

            $('#description_ru').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function (files) {
                        var that = $(this);

                        sendFile(files[0], that);
                    }
                }
            });

            $('#description_uz').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function (files) {
                        var that = $(this);

                        sendFile(files[0], that);
                    }
                }
            });

            function sendFile(file, that) {
                console.log(that);
                // console.log(welEditable);
                console.log(1);



                let data = new FormData();
                data.append('file', file);

                $.ajax({
                    url: "{{ route('dashboard.pages.image_upload') }}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        $(that).summernote('insertImage', location.origin+'/'+data.image, '')
                    },

                    error: function (data) {

                    }
                })

            }
        });

        // ClassicEditor
        //     .create( document.querySelector( '#editor' ) )
        //     .catch( error => {
        //         console.error( error );
        //     } );
    </script>

    <script>
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        }
    </script>
@endpush
