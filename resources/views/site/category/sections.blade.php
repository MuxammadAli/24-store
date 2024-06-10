@extends('site.layouts.app')
@section('title', 'Разделы')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($parents as $category)
                <div class="col-3 mb-4">
                    <div class="product h-100">
                        <div class="product-header">
                            <a href="{{ route('category.view', [$category->id, $category->slug]) }}">
                                <img src="/{{ $category->getImage() }}" alt="">
                            </a>
                        </div>
                        <div class="product-body pb-2">
                            <h4 class="product-title mb-2">{{ $category->getName() }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
