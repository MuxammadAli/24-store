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
                                <a href="{{ route('dashboard.roles') }}">@lang('admin.roles.title')</a>
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

@section('content')
    <section>
        <form class="form form-vertical" action="{{ route('dashboard.role.store') }}" method="post">
        @csrf
        <!-- Account-begins -->
            <div class="settings-account">
                <!-- <h6 class="mb-1">Account</h6> -->
                <div class="card user-form">
                    <div class="card-header">
                        <h4 class="card-title">@lang('admin.add')</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <p>@lang('admin.all_fields_with')</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">@lang('admin.roles.name') *</label>
                                                <input type="text" id="first-name-vertical" required class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('admin.roles.name')">
                                                @error('name')
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

            <div id="sub_ceo" class="controls">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab"
                           aria-controls="users" aria-selected="true">@lang('admin.users.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="staffs-tab" data-toggle="tab" href="#staffs" role="tab"
                           aria-controls="staffs" aria-selected="false">@lang('admin.staffs.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="roles-tab" data-toggle="tab" href="#roles" role="tab"
                           aria-controls="roles" aria-selected="false">@lang('admin.roles.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab"
                           aria-controls="products" aria-selected="false">@lang('admin.products.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="compilations-tab" data-toggle="tab" href="#compilations" role="tab"
                           aria-controls="compilations" aria-selected="false">@lang('admin.compilations.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                           aria-controls="orders" aria-selected="false">@lang('admin.orders.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="branches-tab" data-toggle="tab" href="#branches" role="tab"
                           aria-controls="branches" aria-selected="false">@lang('admin.branches.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="partners-tab" data-toggle="tab" href="#partners" role="tab"
                           aria-controls="partners" aria-selected="false">@lang('admin.brands.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                           aria-controls="posts" aria-selected="false">@lang('admin.posts.title')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="units-tab" data-toggle="tab" href="#units" role="tab"
                           aria-controls="posts" aria-selected="false">@lang('admin.units.title')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="sliders-tab" data-toggle="tab" href="#sliders" role="tab"
                           aria-controls="sliders" aria-selected="false">@lang('admin.slider.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab"
                           aria-controls="categories" aria-selected="false">@lang('admin.categories.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="specialoffers-tab" data-toggle="tab" href="#specialoffers" role="tab"
                           aria-controls="specialoffers" aria-selected="false">@lang('admin.specialOffers.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pages-tab" data-toggle="tab" href="#pages" role="tab"
                           aria-controls="pages" aria-selected="false">@lang('admin.pages.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="feedback-tab" data-toggle="tab" href="#feedback" role="tab"
                           aria-controls="feedback" aria-selected="false">@lang('admin.feedback.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                           aria-controls="comments" aria-selected="false">@lang('admin.comments.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="billings-tab" data-toggle="tab" href="#billings" role="tab"
                           aria-controls="billings" aria-selected="false">@lang('admin.billing.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="colors-tab" data-toggle="tab" href="#colors" role="tab"
                           aria-controls="colors" aria-selected="false">@lang('admin.colors.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="regions-tab" data-toggle="tab" href="#regions" role="tab"
                           aria-controls="regions" aria-selected="false">@lang('admin.regions.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cities-tab" data-toggle="tab" href="#cities" role="tab"
                           aria-controls="cities" aria-selected="false">@lang('admin.cities.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab"
                           aria-controls="files" aria-selected="false">@lang('admin.files.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="currencies-tab" data-toggle="tab" href="#currencies" role="tab"
                           aria-controls="currencies" aria-selected="false">@lang('admin.currency.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="logs-tab" data-toggle="tab" href="#logs" role="tab"
                           aria-controls="logs" aria-selected="false">@lang('admin.logs.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                           aria-controls="settings" aria-selected="false">@lang('admin.settings.title')</a>
                    </li>
                </ul>
            <!-- Account-end -->
            <!-- Notification-begins -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                        <div class="settings-notification mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.users.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group notification">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[users][view]" value="true" class="custom-control-input" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[users][update]" value="true" class="custom-control-input" id="customSwitch2">
                                                <label class="custom-control-label" for="customSwitch2"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            <!-- Notification-end -->
            <!-- Emails-begins -->
                    <div class="tab-pane fade" id="staffs" role="tabpanel" aria-labelledby="staffs-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.staffs.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[staffs][view]" value="true" class="custom-control-input" id="customSwitch3">
                                                <label class="custom-control-label" for="customSwitch3"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[staffs][create]" value="true" class="custom-control-input" id="customSwitch4">
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[staffs][update]" value="true" class="custom-control-input" id="customSwitch5">
                                                <label class="custom-control-label" for="customSwitch5"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[staffs][delete]" value="true" class="custom-control-input" id="customSwitch6">
                                                <label class="custom-control-label" for="customSwitch6"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- Emails-end -->
        <!-- Security-begins -->
                    <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.roles.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[roles][view]" value="true" class="custom-control-input" id="customSwitch7">
                                                <label class="custom-control-label" for="customSwitch7"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[roles][create]" value="true" class="custom-control-input" id="customSwitch8">
                                                <label class="custom-control-label" for="customSwitch8"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[roles][update]" value="true" class="custom-control-input" id="customSwitch9">
                                                <label class="custom-control-label" for="customSwitch9"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[roles][delete]" value="true" class="custom-control-input" id="customSwitch10">
                                                <label class="custom-control-label" for="customSwitch10"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.products.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[products][view]" value="true" class="custom-control-input" id="customSwitch11">
                                                <label class="custom-control-label" for="customSwitch11"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[products][create]" value="true" class="custom-control-input" id="customSwitch12">
                                                <label class="custom-control-label" for="customSwitch12"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[products][update]" value="true" class="custom-control-input" id="customSwitch14">
                                                <label class="custom-control-label" for="customSwitch14"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[products][delete]" value="true" class="custom-control-input" id="customSwitch15">
                                                <label class="custom-control-label" for="customSwitch15"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="compilations" role="tabpanel" aria-labelledby="compilations-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.compilations.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[compilations][view]" value="true" class="custom-control-input" id="customSwitch16">
                                                <label class="custom-control-label" for="customSwitch16"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[compilations][create]" value="true" class="custom-control-input" id="customSwitch17">
                                                <label class="custom-control-label" for="customSwitch17"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[compilations][update]" value="true" class="custom-control-input" id="customSwitch18">
                                                <label class="custom-control-label" for="customSwitch18"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[compilations][delete]" value="true" class="custom-control-input" id="customSwitch19">
                                                <label class="custom-control-label" for="customSwitch19"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.orders.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[orders][view]" value="true" class="custom-control-input" id="customSwitch20">
                                                <label class="custom-control-label" for="customSwitch20"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[orders][update]" value="true" class="custom-control-input" id="customSwitch20111">
                                                <label class="custom-control-label" for="customSwitch20111"></label>
                                            </div>
                                        </li>


                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.filter')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[orders][filter]" value="true" class="custom-control-input" id="customSwitch2001">
                                                <label class="custom-control-label" for="customSwitch2001"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'В обработке'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][processing]" value="true" class="custom-control-input" id="customSwitch1002">
                                                <label class="custom-control-label" for="customSwitch1002"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'Собран'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][collected]" value="true" class="custom-control-input" id="customSwitch1003">
                                                <label class="custom-control-label" for="customSwitch1003"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'Ожидает покупателя'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][waiting_buyer]" value="true" class="custom-control-input" id="customSwitch1004">
                                                <label class="custom-control-label" for="customSwitch1004"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'В пути'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][in_way]" value="true" class="custom-control-input" id="customSwitch1005">
                                                <label class="custom-control-label" for="customSwitch1005"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'Закрыт'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][closed]" value="true" class="custom-control-input" id="customSwitch1006">
                                                <label class="custom-control-label" for="customSwitch1006"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'Отменен'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][cancelled]" value="true" class="custom-control-input" id="customSwitch1007">
                                                <label class="custom-control-label" for="customSwitch1007"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.status', ['status' => 'Замена'])</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[order_status][replacement]" value="true" class="custom-control-input" id="customSwitch1008">
                                                <label class="custom-control-label" for="customSwitch1008"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.print')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[orders][print]"
                                                       value="true" class="custom-control-input" id="customSwitch1204">
                                                <label class="custom-control-label" for="customSwitch1204"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="branches" role="tabpanel" aria-labelledby="branches-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.branches.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[branches][view]" value="true" class="custom-control-input" id="customSwitch21">
                                                <label class="custom-control-label" for="customSwitch21"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[branches][create]" value="true" class="custom-control-input" id="customSwitch22">
                                                <label class="custom-control-label" for="customSwitch22"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[branches][update]" value="true" class="custom-control-input" id="customSwitch23">
                                                <label class="custom-control-label" for="customSwitch23"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[branches][delete]" value="true" class="custom-control-input" id="customSwitch24">
                                                <label class="custom-control-label" for="customSwitch24"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="partners" role="tabpanel" aria-labelledby="partners-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.brands.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[brands][view]" value="true" class="custom-control-input" id="customSwitch25">
                                                <label class="custom-control-label" for="customSwitch25"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[brands][create]" value="true" class="custom-control-input" id="customSwitch26">
                                                <label class="custom-control-label" for="customSwitch26"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[brands][update]" value="true" class="custom-control-input" id="customSwitch27">
                                                <label class="custom-control-label" for="customSwitch27"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[brands][delete]" value="true" class="custom-control-input" id="customSwitch28">
                                                <label class="custom-control-label" for="customSwitch28"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.posts.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[posts][view]" value="true" class="custom-control-input" id="customSwitch29">
                                                <label class="custom-control-label" for="customSwitch29"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[posts][create]" value="true" class="custom-control-input" id="customSwitch30">
                                                <label class="custom-control-label" for="customSwitch30"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[posts][update]" value="true" class="custom-control-input" id="customSwitch31">
                                                <label class="custom-control-label" for="customSwitch31"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[posts][delete]" value="true" class="custom-control-input" id="customSwitch32">
                                                <label class="custom-control-label" for="customSwitch32"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="sliders" role="tabpanel" aria-labelledby="sliders-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.slider.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[sliders][view]" value="true" class="custom-control-input" id="customSwitch33">
                                                <label class="custom-control-label" for="customSwitch33"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[sliders][create]" value="true" class="custom-control-input" id="customSwitch34">
                                                <label class="custom-control-label" for="customSwitch34"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[sliders][update]" value="true" class="custom-control-input" id="customSwitch35">
                                                <label class="custom-control-label" for="customSwitch35"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[sliders][delete]" value="true" class="custom-control-input" id="customSwitch36">
                                                <label class="custom-control-label" for="customSwitch36"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.categories.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[categories][view]" value="true" class="custom-control-input" id="customSwitch37">
                                                <label class="custom-control-label" for="customSwitch37"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[categories][create]" value="true" class="custom-control-input" id="customSwitch38">
                                                <label class="custom-control-label" for="customSwitch38"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[categories][update]" value="true" class="custom-control-input" id="customSwitch39">
                                                <label class="custom-control-label" for="customSwitch39"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[categories][delete]" value="true" class="custom-control-input" id="customSwitch40">
                                                <label class="custom-control-label" for="customSwitch40"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="specialoffers" role="tabpanel" aria-labelledby="specialoffers-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.specialOffers.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[special-offers][view]" value="true" class="custom-control-input" id="customSwitch41">
                                                <label class="custom-control-label" for="customSwitch41"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[special-offers][create]" value="true" class="custom-control-input" id="customSwitch42">
                                                <label class="custom-control-label" for="customSwitch42"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[special-offers][update]" value="true" class="custom-control-input" id="customSwitch43">
                                                <label class="custom-control-label" for="customSwitch43"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[special-offers][delete]" value="true" class="custom-control-input" id="customSwitch44">
                                                <label class="custom-control-label" for="customSwitch44"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pages" role="tabpanel" aria-labelledby="pages-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.pages.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[pages][create]" value="true" class="custom-control-input" id="customSwitch45">
                                                <label class="custom-control-label" for="customSwitch45"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[pages][update]" value="true" class="custom-control-input" id="customSwitch46">
                                                <label class="custom-control-label" for="customSwitch46"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[pages][delete]" value="true" class="custom-control-input" id="customSwitch1111">
                                                <label class="custom-control-label" for="customSwitch1111"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.feedback.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[feedback][view]" value="true" class="custom-control-input" id="customSwitch47">
                                                <label class="custom-control-label" for="customSwitch47"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[feedback][update]" value="true" class="custom-control-input" id="customSwitch49">
                                                <label class="custom-control-label" for="customSwitch49"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[feedback][delete]" value="true" class="custom-control-input" id="customSwitch50">
                                                <label class="custom-control-label" for="customSwitch50"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.comments.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[comments][view]" value="true" class="custom-control-input" id="customSwitch51">
                                                <label class="custom-control-label" for="customSwitch51"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[comments][update]" value="true" class="custom-control-input" id="customSwitch53">
                                                <label class="custom-control-label" for="customSwitch53"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[comments][delete]" value="true" class="custom-control-input" id="customSwitch54">
                                                <label class="custom-control-label" for="customSwitch54"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="billings" role="tabpanel" aria-labelledby="billings-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.billing.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[billings][view]" value="true" class="custom-control-input" id="customSwitch55">
                                                <label class="custom-control-label" for="customSwitch55"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="colors" role="tabpanel" aria-labelledby="colors-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.colors.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[colors][view]" value="true" class="custom-control-input" id="customSwitch56">
                                                <label class="custom-control-label" for="customSwitch56"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[colors][create]" value="true" class="custom-control-input" id="customSwitch57">
                                                <label class="custom-control-label" for="customSwitch57"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[colors][update]" value="true" class="custom-control-input" id="customSwitch58">
                                                <label class="custom-control-label" for="customSwitch58"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[colors][delete]" value="true" class="custom-control-input" id="customSwitch59">
                                                <label class="custom-control-label" for="customSwitch59"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="regions" role="tabpanel" aria-labelledby="regions-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.regions.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[regions][view]" value="true" class="custom-control-input" id="customSwitch60">
                                                <label class="custom-control-label" for="customSwitch60"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[regions][create]" value="true" class="custom-control-input" id="customSwitch61">
                                                <label class="custom-control-label" for="customSwitch61"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[regions][update]" value="true" class="custom-control-input" id="customSwitch62">
                                                <label class="custom-control-label" for="customSwitch62"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[regions][delete]" value="true" class="custom-control-input" id="customSwitch63">
                                                <label class="custom-control-label" for="customSwitch63"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="cities" role="tabpanel" aria-labelledby="cities-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.cities.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[cities][view]" value="true" class="custom-control-input" id="customSwitch64">
                                                <label class="custom-control-label" for="customSwitch64"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[cities][create]" value="true" class="custom-control-input" id="customSwitch65">
                                                <label class="custom-control-label" for="customSwitch65"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[cities][update]" value="true" class="custom-control-input" id="customSwitch66">
                                                <label class="custom-control-label" for="customSwitch66"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[cities][delete]" value="true" class="custom-control-input" id="customSwitch67">
                                                <label class="custom-control-label" for="customSwitch67"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.files.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[files][view]" value="true" class="custom-control-input" id="customSwitch68">
                                                <label class="custom-control-label" for="customSwitch68"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[files][create]" value="true" class="custom-control-input" id="customSwitch69">
                                                <label class="custom-control-label" for="customSwitch69"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[files][delete]" value="true" class="custom-control-input" id="customSwitch71">
                                                <label class="custom-control-label" for="customSwitch71"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="currencies" role="tabpanel" aria-labelledby="currencies-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.currency.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[currencies][view]" value="true" class="custom-control-input" id="customSwitch72">
                                                <label class="custom-control-label" for="customSwitch72"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[currencies][create]" value="true" class="custom-control-input" id="customSwitch73">
                                                <label class="custom-control-label" for="customSwitch73"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.logs.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[logs][view]" value="true" class="custom-control-input" id="customSwitch301">
                                                <label class="custom-control-label" for="customSwitch301"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.settings.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[settings][update]" value="true" class="custom-control-input" id="customSwitch74">
                                                <label class="custom-control-label" for="customSwitch74"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delivery')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[settings][delivery]" value="true" class="custom-control-input" id="customSwitch1001">
                                                <label class="custom-control-label" for="customSwitch1001"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="units" role="tabpanel" aria-labelledby="units-tab">
                        <div class="settings-emails mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title pb-2">@lang('admin.units.title')</h4>
                                </div>
                                <div class="card-content">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.view')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[units][view]" value="true" class="custom-control-input" id="customSwitchu21">
                                                <label class="custom-control-label" for="customSwitch21"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.create')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[units][create]" value="true" class="custom-control-input" id="customSwitchu22">
                                                <label class="custom-control-label" for="customSwitchu22"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.update')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[units][update]" value="true" class="custom-control-input" id="customSwitchu23">
                                                <label class="custom-control-label" for="customSwitchu23"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex pt-1 pb-1">
                                            <span>@lang('admin.permissions.delete')</span>
                                            <div class="custom-control custom-switch custom-switch-primary ml-auto">
                                                <input type="checkbox" name="permissions[units][delete]" value="true" class="custom-control-input" id="customSwitchu24">
                                                <label class="custom-control-label" for="customSwitchu24"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-0">
                <div class="row">
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                            <i class="feather icon-save"></i> @lang('admin.save')
                        </button>
                    </div>

                    <div class="col-9">
                        <a href="{{ route('dashboard.roles') }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                            <i class="feather icon-x-circle"></i> @lang('admin.cancel')
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <!-- Security-end -->
    </section>
@endsection
