@extends('dashboard.layouts.app')
@section('title', 'Редактировать - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Редактировать</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.supplier.index') }}">Поставщики</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Редактировать
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row" id="table-head">
        <div class="col-12">
            <a href="{{ route('dashboard.supplier.index') }}" class="btn btn-danger btn-icon float-right mb-2">
                <i class="feather icon-arrow-left-circle"></i>
                Назад
            </a>
        </div>
    </div>
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-2">Редактировать</h4>
                        <p class="mb-2">Все поля обозначенные * обязательные</p>
                        <form action="" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="login">Логин *</label>
                                        <input type="text" id="login" placeholder="Логин"
                                               name="login" value="{{ old('login', $supplier->login) }}"
                                               class="form-control @error('login') is-invalid @enderror">
                                        @error('login')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="password">Пароль *</label>
                                        <div class="input-group">
                                            <input type="password" value="{{ old('password', $supplier->password) }}"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   placeholder="Пароль" aria-describedby="button-addon2"
                                                   name="password">
                                            <div class="input-group-append" id="button-addon2">
                                                <button class="btn btn-dark waves-effect waves-light btn-icon"
                                                        id="show-password-btn"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Показать"
                                                        onclick="showPassword()" type="button">
                                                    <i id="eye-icon" class="feather icon-eye"></i>
                                                </button>
                                            </div>
                                            <div class="input-group-append" id="button-addon2">
                                                <button class="btn btn-dark waves-effect waves-light btn-icon"
                                                        onclick="generatePassword()" type="button">
                                                    <i class="feather icon-box"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-label-group">
                                        <input type="text" id="name" placeholder="Имя"
                                               name="name" value="{{ old('name', $supplier->name) }}"
                                               class="form-control">
                                        <label for="name">Имя</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-label-group">
                                        <input type="text" id="phone" placeholder="Телефон"
                                               name="phone" value="{{ old('phone', $supplier->phone) }}"
                                               class="form-control">
                                        <label for="phone">Телефон</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-label-group">
                                        <input type="text" id="company" placeholder="Названия компании"
                                               name="company" value="{{ old('company', $supplier->company) }}"
                                               class="form-control">
                                        <label for="company">Названия компании</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-label-group">
                                        <input type="text" id="address" placeholder="Адрес"
                                               name="address" value="{{ old('address', $supplier->address) }}"
                                               class="form-control">
                                        <label for="address">Адрес</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <input type="number" step="0.01" id="percents" placeholder="Проценты"
                                               name="percents" value="{{ old('percents', $supplier->percents) }}"
                                               class="form-control">
                                        <label for="percents">Проценты</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <input type="text" id="location" placeholder="Локация"
                                               name="location" value="{{ old('location', $supplier->location) }}"
                                               class="form-control">
                                        <label for="location">Локация</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-icon">
                                    <i class="feather icon-file-text"></i>
                                    Сохранить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const input = document.querySelector('#password')

        function showPassword() {
            const btn = document.querySelector('#show-password-btn')
            const icon = document.querySelector('#eye-icon')
            if (input.type === 'password') {
                input.type = 'text'
                btn.setAttribute('data-original-title', 'Скрыть')
                icon.setAttribute('class', 'feather icon-eye-off')
            } else if (input.type === 'text') {
                input.type = 'password'
                btn.setAttribute('data-original-title', 'Показать')
                icon.setAttribute('class', 'feather icon-eye')
            }
        }

        function generatePassword() {
            let password = []
            let str = 'abcdefghijklmnopqrstuvwxyz1234567890!@#$%&*()-=_/\\'
            str = str.split('')

            function getRandomInt(max) {
                return Math.floor(Math.random() * max);
            }

            for (let i = 0; i <= 12; i++) {
                let int = getRandomInt(50);
                password.push(str[int])
            }
            password = password.join('')
            input.value = password
            navigator.clipboard.writeText(password);
            alert("Copied");
            if (input.type === 'password') showPassword()
        }
    </script>
@endpush
