@extends('site.layouts.app', ['seo_title' => $page_name])

@section('breadcrumb')
    <div class="container pt-md-4 pt-lg-5 pt-2">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('categories') }}">@lang('app.categories.title')</a>
            </li>

            @if($page == 'main')
                <li class="breadcrumb-item active">@lang('app.all') {{ $category->getName() }}</li>
                @php($page_name = $category->getTitleSeo())
            @elseif($page == 'show')
                <li class="breadcrumb-item">
                    <a href="{{ route('category.view', ['category' => $category->id, 'slug' => $category->slug]) }}">{{ $category->getName() }}</a>
                </li>

                <li class="breadcrumb-item active">@lang('app.all') {{ $Category->getName() }}</li>
                @php($page_name = $Category->getTitleSeo())
            @elseif($page == 'showCatalog')
                <li class="breadcrumb-item">
                    <a href="{{ route('category.view', ['category' => $category->id, 'slug' => $category->slug]) }}">{{ $category->getName() }}</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('category.show', [
                        'category' => $category->id,
                        'slug' => $category->slug,
                        'Category' => $catalog->id,
                        'slug_2' => $catalog->slug
                     ]) }}">{{ $catalog->getName() }}</a>
                </li>
                <li class="breadcrumb-item active">@lang('app.all') {{ $Category->getName() }}</li>
                @php($page_name = $Category->getTitleSeo())
            @endif
        </ul>
    </div>
@endsection

@section('title', $page_name)


@section('content')
    <catalog-show :products-data="{{ json_encode($products) }}" :categories-data="{{ $categories }}" :login-info="{{ json_encode(auth()->check()) }}" :characteristics-data="{{ $characteristics }}" :category-data="{{ $page == 'main' ? $category : $Category }}" :page="{{ json_encode($page) }}"></catalog-show>
@endsection

@push('js')

@endpush

@push('meta')
    <meta name="description" content="{{ $descriptions }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta property="og:title" content="{{ $page_name }}">
    <meta property="og:description" content="{{ $descriptions }}">
    <meta property="og:type" content="category">
    <meta property="og:url" content="{{ env('APP_URL').$_SERVER['REQUEST_URI'] }}">
    <meta property="og:site_name" content="AliStore.uz">
    <meta name="robots" content="all">
@endpush
