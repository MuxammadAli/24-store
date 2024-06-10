@extends('site.layouts.app')

@section('title', trans("app.auth.profile"))

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.main.page') }}">
                    @lang('app.main')
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('profile') }}">
                    @lang('app.auth.profile')
                </a>
            </li>

            <li class="breadcrumb-item active">
                @lang('app.profile.address.title')
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="section-cabinet">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-5 col-md-6">
                    @include('site.includes.cabinetMenu')
                </div>
                <div class="col-xl-9 col-lg-7 col-md-6 mt-md-0 mt-4">

                    @if(session()->has('info'))
                        <div class="alert-info alert">
                            <i class="fa fa-info-circle"></i> {{ session()->pull('info') }}
                        </div>
                    @endif

                    <div class="cabinet-content"   style="min-height: 65vh;">
                        <h6 class="mb-4">@lang('app.profile.address.title')</h6>
                        <profile-address :addresses="{{ auth()->user()->addresses }}"></profile-address>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush

@push('css')

{{--<script src="https://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU&apikey=6f93606d-8948-4c52-8db6-363d427c0571" type="text/javascript">--}}
{{--</script>--}}

{{--    <script>--}}
{{--        var myMap, myPlacemark, coords;--}}
{{--        var coords = [41.311151, 69.279737];--}}

{{--        ymaps.ready(init);--}}
{{--        function init(){--}}

{{--            myMap = new ymaps.Map('map', {--}}
{{--                center: coords,--}}
{{--                zoom: 11,--}}
{{--                behaviors: ['default', 'scrollZoom']--}}
{{--            });--}}

{{--            myPlacemark = new ymaps.Placemark(coords,{}, {preset: "twirl#redIcon", draggable: true});--}}

{{--            myMap.controls.add('zoomControl');--}}

{{--            myPlacemark.events.add('dragend', function(e){--}}
{{--                var cord = e.get('target').geometry.getCoordinates();--}}
{{--                savecoordinats(cord);--}}
{{--            });--}}

{{--            myMap.geoObjects.add(myPlacemark);--}}

{{--            myMap.events.add('click', function (e) {--}}
{{--                var cord = e.get('coordPosition');--}}
{{--                savecoordinats(cord);--}}
{{--            });--}}
{{--        }--}}

{{--        function savecoordinats(cord){--}}
{{--            console.log(cord);--}}
{{--            $('#ypoint').val(cord);--}}
{{--            ymaps.geocode(cord).then(function(res) {--}}
{{--                var data = res.geoObjects.get(0).properties.getAll();--}}
{{--                $('#address').val(data.text);--}}
{{--            });--}}
{{--            myPlacemark.getOverlay().getData().geometry.setCoordinates(cord);--}}
{{--        }--}}
{{--    </script>--}}

@endpush

