@extends('dashboard.layouts.app')
@section('title', trans('admin.edit'). ' - ')
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
                                <a href="{{ route('dashboard.products') }}">@lang('admin.products.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.edit')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div id="app">
        <coin-product-update :categories="{{ json_encode($categories) }}" :product="{{ json_encode($product) }}"></coin-product-update>
    </div>
@endsection

@push('js')
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        $(document).ready(function(){
            $("#image_cat").hide();
            $("#remove_img").hide();
            $("#add_img").show();

            $("#add_img").click(function(){
                $("#image_cat").show();
                $("#remove_img").show();
                $("#add_img").hide();
            });
            $("#remove_img").click(function(){
                $("#image_cat").hide();
                $("#remove_img").hide();
                $("#add_img").show();
            });
        });
    </script>

    <script type="text/javascript">

        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };
    </script>
@endpush
