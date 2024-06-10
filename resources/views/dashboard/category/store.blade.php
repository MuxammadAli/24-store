@extends('dashboard.layouts.app')
@section('title', trans('admin.add'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.add')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.categories') }}">@lang('admin.categories.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.add')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/vendors/css/forms/select/select2.min.css">
@endpush

@section('content')
    <div id="app">
        <category-store :brands-data="{{ $brands }}" :categories-data="{{ $parent_categories }}" ></category-store>
    </div>

@endsection

@push('js')

    <script src="{{ mix('js/app.js') }}"></script>

    <script src="/vendor/dashboard/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="/vendor/dashboard/app-assets/js/scripts/forms/select/form-select2.js"></script>

    <script>
        $(document).ready(function(){
            $("#sub_cat").hide();
            $("#remove_cat").hide();
            $("#add_cat").show();

            $("#add_cat").click(function(){
                $("#sub_cat").show();
                $("#remove_cat").show();
                $("#add_cat").hide();
            });
            $("#remove_cat").click(function(){
                $("#sub_cat").hide();
                $("#remove_cat").hide();
                $("#add_cat").show();
            });
        });
    </script>

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
