@extends('dashboard.layouts.app')
@section('title', trans('admin.add'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Import</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.products') }}">@lang('admin.products.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Import
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('dashboard.products.import') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>Категория</label>
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" disabled="">
                        {{ $category->getName() }}
                    </option>

                    @foreach($category->parents as $parent)
                        <option value="{{ $parent->id }}">
                            {{ $parent->getName() }}
                        </option>
                    @endforeach

                @endforeach
            </select>
        </div>
        @csrf
        <fieldset class="form-group">
            <label for="basicInputFile">Выберите файл</label>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Загрузить
        </button>
    </form>
@endsection

@push('css')

@endpush

@push('js')



@endpush
