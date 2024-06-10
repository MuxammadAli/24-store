@extends('dashboard.layouts.app')
@section('title', trans('admin.delivery.title').' - ')
@section('links')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">
                        @lang('admin.settings.title')
                    </h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    @lang('admin.home')
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                @lang('admin.delivery.title')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.delivery.title')</h4>
                </div>
                <div class="card-content">
                    <form class="form" action="{{ route('dashboard.settings.delivery') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">

                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="day_delivery" required class="form-control @error('day_delivery') is-invalid @enderror" value="{{ old('day_delivery', $setting->day_delivery) }}" name="day_delivery"  placeholder="@lang('admin.settings.day_delivery')">
                                            <div class="form-control-position">
                                                <i class="fa fa-car"></i>
                                            </div>
                                            <label for="day_delivery">@lang('admin.settings.day_delivery') *</label>

                                            @error('day_delivery')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="price_delivery" required class="form-control @error('price_delivery') is-invalid @enderror" value="{{ old('price_delivery', $setting->price_delivery) }}" name="price_delivery"  placeholder="@lang('admin.settings.price_delivery')">
                                            <div class="form-control-position">
                                                <i class="fa fa-dollar"></i>
                                            </div>
                                            <label for="price_delivery">@lang('admin.settings.price_delivery') *</label>

                                            @error('price_delivery')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="delivery" @if($setting->delivery == 1) checked @endif value="1">
                                                        <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>

                                                        <span class="">Доставка курьером</span>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-12">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="pickup" @if($setting->pickup == 1) checked @endif value="1">
                                                        <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>

                                                        <span class="">Самовывоз</span>
                                                    </div>
                                                </fieldset>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link active" id="ru-tab" data-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="true">RU</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="uz-tab" data-toggle="tab" href="#uz" role="tab" aria-controls="uz" aria-selected="false">UZ</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="row">
                                                    <div class="tab-content w-100" id="myTabContent">

                                                        <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab">

                                                            <div class="col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="delivery_product" required class="form-control @error('other.delivery.ru') is-invalid @enderror" value="{{ old('other.delivery.ru', $setting->other['delivery']['ru']) }}" name="other[delivery][ru]" >

                                                                    <label for="delivery_product">Доставка при просмотра продукта  RU*</label>

                                                                    @error('other.delivery.ru')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="pickup_product" required class="form-control @error('other.pickup.ru') is-invalid @enderror" value="{{ old('other.pickup.ru', $setting->other['pickup']['ru']) }}" name="other[pickup][ru]" >

                                                                    <label for="pickup_product">Самовывоз при просмотра продукта  RU*</label>

                                                                    @error('other.pickup.ru')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>



                                                            <div class="col-12 mt-2">
                                                                <label>При покупке описания самовывоза RU *</label>
                                                                <div class="controls">
                                                                    <fieldset class="form-group position-relative">
                                                                        <textarea class="form-control @error('pickup_text.ru') is-invalid @enderror" required name="pickup_text[ru]"
                                                                            placeholder="@lang('admin.pages.description') RU" id="description_ru">{{ old('pickup_text.ru', $setting->pickup_text['ru']) }}</textarea>
                                                                    </fieldset>
                                                                    @error('pickup_text.ru')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz-tab">

                                                            <div class="col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="delivery_product_uz" required class="form-control @error('other.delivery.uz') is-invalid @enderror" value="{{ old('other.delivery.uz', $setting->other['delivery']['uz']) }}" name="other[delivery][uz]" >

                                                                    <label for="delivery_product_uz">Доставка при просмотра продукта  UZ *</label>

                                                                    @error('other.delivery.uz')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="pickup_product_uz" required class="form-control @error('other.pickup.uz') is-invalid @enderror" value="{{ old('other.pickup.uz', $setting->other['pickup']['uz']) }}" name="other[pickup][uz]" >

                                                                    <label for="pickup_product_uz">Самовывоз при просмотра продукта  UZ *</label>

                                                                    @error('other.pickup.uz')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-12">
                                                                <label>При покупке описания самовывоза UZ *</label>
                                                                <div class="controls">
                                                                    <fieldset class="form-group position-relative">
                                                                        <textarea class="form-control @error('pickup_text.uz') is-invalid @enderror" required name="pickup_text[uz]"
                                                                                  placeholder="@lang('admin.pages.description') RU" id="description_uz">{{ old('pickup_text.uz', $setting->pickup_text['uz']) }}</textarea>
                                                                    </fieldset>
                                                                    @error('pickup_text.uz')
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
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
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
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
    <link href="{{ asset('vendor/editor/dist/summernote.min.css') }}" rel="stylesheet">
@endpush

@push('js')

    <script src="{{ asset('vendor/editor/dist/summernote.min.js') }}"></script>

    <script>

        $(document).ready(function () {

            $('#description_ru').summernote({
                height: 100,
                callbacks: {
                    onImageUpload: function (files) {
                        var that = $(this);

                        sendFile(files[0], that);
                    }
                }
            });

            $('#description_uz').summernote({
                height: 100,
                callbacks: {
                    onImageUpload: function (files) {
                        var that = $(this);

                        sendFile(files[0], that);
                    }
                }
            });

            function sendFile(file, that) {



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
