@extends('dashboard.layouts.app')
@section('title', 'Причины возврата - ')
@section('content')
    <div id="app">
        <reasons :reasons-data="{{ $reasons }}"></reasons>
    </div>
@endsection
@push('js')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
