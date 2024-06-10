<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-12">
                <form class="form form-vertical" @submit.prevent="UpdateProduct">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Добавить</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <p>Все поля обозначенные * обязательные</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nameru">Названия RU *</label>
                                                        <input type="text" v-model="products.name.ru" required id="nameru" class="form-control" placeholder="Названия RU *">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name">Названия UZ *</label>
                                                        <input type="text" v-model="products.name.uz" required id="name" class="form-control" placeholder="Названия UZ *">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label >Категория *</label>

                                                <multiselect
                                                        :options="categories"
                                                        v-model="category.first"
                                                        label="category"
                                                        @change="DetectCategory($event)"
                                                        track-by="category"></multiselect>
                                                <!--                                                    //@change="getCharacteristics($event)"-->

                                            </div>
                                        </div>

                                        <div class="col-4" v-if="category.two_view">
                                            <div class="form-group">
                                                <label >Суб категория *</label>

                                                <multiselect
                                                        :options="category.first.parents"
                                                        v-model="category.two"
                                                        label="category"
                                                        @change="DetectCategoryTwo"
                                                        track-by="category"></multiselect>

                                            </div>
                                        </div>

                                        <div class="col-4" v-if="category.three_view">
                                            <div class="form-group">
                                                <label >Под категория *</label>

                                                <multiselect
                                                        :options="category.two.parents"
                                                        v-model="category.three"
                                                        label="category"
                                                        @change="DetectCategory"
                                                        track-by="category"></multiselect>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="brand">Бренд</label>
                                                <select class="form-control" id="brand" v-model="products.brand_id">
                                                    <option value="0">нет бренд</option>
                                                    <option v-for="brand in brands" :value="brand.id">
                                                        {{ brand.name.ru}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="units">Единицы</label>
                                                <select class="form-control" id="units" v-model="products.unit_id">
                                                    <option  value="0">нет единицы</option>
                                                    <option v-for="unit in units" :value="unit.id">
                                                        {{ unit.name.ru}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

<!--                                        <div class="col-12">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="euro">Курс *</label>-->
<!--                                                <select class="form-control" id="euro" v-model="products.currency">-->
<!--                                                    <option  value="sum">-->
<!--                                                        So`m UZS-->
<!--                                                    </option>-->

<!--                                                    <option  value="dollar">-->
<!--                                                        Dollar $-->
<!--                                                    </option>-->

<!--                                                    <option  value="euro">-->
<!--                                                        EURO €-->
<!--                                                    </option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="price">Цена *</label>
                                                <input type="number" min="0.01" v-model="products.price" step="0.01" required id="price" class="form-control" placeholder="Цена">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="price_discount">Цена со скидкой</label>
                                                <input type="number" v-model="products.price_discount" step="0.01" id="price_discount" class="form-control" placeholder="Цена со скидкой">
                                            </div>
                                        </div>

                                        <div class="col-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="entry_price">Цена приемки</label>
                                                <input type="number" v-model="products.entry_price" step="0.01" id="entry_price" class="form-control" placeholder="Цена приемки">
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="price_percents">Проценты</label>
                                                <input type="number" v-model="products.price_percents" step="0.01" id="price_percents" class="form-control" placeholder="Проценты">
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="discount_percents">Проценты со скидкой</label>
                                                <input type="number" v-model="products.discount_percents" step="0.01" id="discount_percents" class="form-control" placeholder="Проценты со скидкой">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="article_number">Артикул *</label>
                                                <input type="text" v-model="products.article_number" id="article_number" class="form-control" placeholder="Артикул">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="count_product">Количество товаров на складе *</label>
                                                <input type="number" v-model="products.count" id="count_product" class="form-control" placeholder="Количество товаров на складе">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="slug">Ссылка на продукт (не обязательно)</label>
                                                <input type="text"  v-model="products.slug"  id="slug" class="form-control" placeholder="iphone-pro-max">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <textarea v-model="products.search_keywords" id="search_keywords" placeholder="Ключевые слова для поиска" class="form-control"></textarea>
                                                <label for="search_keywords">Ключевые слова для поиска</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
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

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="tab-content w-100" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Короткий описания RU</label>
                                                                        <textarea cols="3" @keyup="remaincharRUCount" :class="this.products.short_body.ru && this.products.short_body.ru.length > 300 ? 'form-control is-invalid' : 'form-control'" v-model="products.short_body.ru"></textarea>
                                                                        {{ this.short_limit.ru }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Описания RU</label>
                                                                        <ckeditor :editor="editor" v-model="products.body.ru"></ckeditor>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz-tab">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Короткий описания UZ</label>
                                                                        <textarea cols="3" @keyup="remaincharUZCount"  :class="this.products.short_body.uz &&  this.products.short_body.uz.length > 300 ? 'form-control is-invalid' : 'form-control'" v-model="products.short_body.uz"></textarea>
                                                                        {{ this.short_limit.uz }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Описания UZ</label>
                                                                        <ckeditor :editor="editor" v-model="products.body.uz"></ckeditor>
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
                        </div>
                    </div>

                    <div class="card" v-if="characteristics.length > 0">
                        <div class="card-header">
                            <h4 class="card-title">Характеристики</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-md-12" v-for="(char, index) in characteristics" :key="index">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <fieldset class="form-group">
                                                <input type="text" disabled v-model="char.name.ru" class="form-control">
                                            </fieldset>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <fieldset class="form-group" v-if="char.type != 'checkbox'">
<!--                                                <input :type="char.type" min="0" v-model="$data[char.pivot.value == 'true' ? true : false]" class="form-control">-->
<!--                                                <input :type="char.type" min="0" v-model="$data[char.pivot.value == 'true' ? true : false]" class="form-control">-->

                                                <input :type="char.type" min="0" v-model="char.value"  class="form-control">

                                            </fieldset>

                                            <fieldset v-else>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" v-model="char.value" true-value="true" false-value="false" >
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
<!--                            <h4 class="card-title">Добавить Цвет *</h4>-->
                            <h4 class="card-title">Изображения</h4>
<!--                            <button type="button" @click="DeleteColor(index, color.id)" class="btn btn-danger"><i class="fa fa-trash"></i> Удалить</button>-->
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
<!--                                        <div class="col-12">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="color">Цвет</label>-->
<!--                                                <select class="form-control" id="color" v-model="color.color_id">-->
<!--                                                    <option selected value="null">-->
<!--                                                        Не выбран-->
<!--                                                    </option>-->

<!--                                                    <option v-for="color in colors" :value="color.id">-->
<!--                                                        {{ color.name.ru}}-->
<!--                                                    </option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->

<!--                                        <div class="col-12">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="colorarticle_number">Артикул</label>-->
<!--                                                <input type="text" v-model="color.article_number" id="colorarticle_number" class="form-control" placeholder="Артикул">-->
<!--                                            </div>-->
<!--                                        </div>-->

<!--                                        <div class="col-md-12" v-for="(size, indexx) in color.sizes">-->
<!--                                            <div class="row">-->
<!--                                                <div class="col-xl-4 col-md-6 col-12 mb-1">-->
<!--                                                    <fieldset class="form-group">-->
<!--                                                        <label for="size">Размер *</label>-->
<!--                                                        <input type="text" v-model="size.name" required class="form-control" id="size" placeholder="XS или 39">-->
<!--                                                    </fieldset>-->
<!--                                                </div>-->

<!--                                                <div class="col-xl-4 col-md-6 col-12 mb-1">-->
<!--                                                    <fieldset class="form-group">-->
<!--                                                        <label for="count">Количество *</label>-->
<!--                                                        <input type="number" v-model="size.count" required min="0" class="form-control" id="count" placeholder="Количество">-->
<!--                                                    </fieldset>-->
<!--                                                </div>-->

<!--                                                <div class="col-xl-2 col-md-2 col-2 mb-1">-->
<!--                                                    <button type="button" @click="DeleteSize(index, indexx)" class="btn btn-icon mt-1 btn-danger">-->
<!--                                                        <i class="fa fa-trash"></i>-->
<!--                                                    </button>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->

<!--                                        <div class="col-12">-->
<!--                                            <button type="button" @click="AddSize(index)" class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light">-->
<!--                                                <i class="fa fa-plus"></i> Добавить размер  *-->
<!--                                            </button>-->
<!--                                        </div>-->

                                        <div class="col-md-12">
                                            <VueFileAgent
                                                    ref="vueFileAgent"
                                                    :theme="'default'"
                                                    :multiple="true"
                                                    :deletable="true"
                                                    :meta="true"
                                                    :accept="'image/*'"
                                                    :maxSize="'10MB'"
                                                    :maxFiles="14"
                                                    :sortable="'handle'"
                                                    :helpText="'Choose images or zip files'"
                                                    :errorText="{
                                                                  type: 'Invalid file type. Only images or zip Allowed',
                                                                  size: 'Files should not exceed 10MB in size',
                                                                }"
                                                    @select="filesSelected($event)"
                                                    @beforedelete="fileDeleted($event)"
                                                    v-model="products.screens"
                                            ></VueFileAgent>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SEO</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nameru">Title Seo RU *</label>
                                            <input type="text" v-model="products.title_seo.ru"  id="nameru" class="form-control" placeholder="Title Seo RU *">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Title Seo UZ *</label>
                                            <input type="text" v-model="products.title_seo.uz"  id="name" class="form-control" placeholder="Title Seo UZ *">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control"  v-model="products.keywords.ru" id="label-keywords-ru" rows="3" :placeholder="$t('admin.settings.keywords') + ' RU'"></textarea>
                                                    <label for="label-keywords-ru">{{ $t('admin.settings.keywords') }} RU *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                            <textarea class="form-control"  v-model="products.keywords.uz" id="label-keywords" rows="3" :placeholder="$t('admin.settings.keywords') + ' UZ'"></textarea>
                                                    <label for="label-keywords">{{ $t('admin.settings.keywords') }} UZ *</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control"  v-model="products.descriptions.ru" id="label-description-ru" rows="3" :placeholder="$t('admin.settings.description') + ' RU'"></textarea>
                                                    <label for="label-description-ru">{{ $t('admin.settings.description') }} RU *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control"  v-model="products.descriptions.uz" id="label-description" rows="3" :placeholder="$t('admin.settings.description') + ' UZ'"></textarea>
                                                    <label for="label-description">{{ $t('admin.settings.description') }} UZ *</label>
                                                </fieldset>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!--                    <div class="col-12">-->
<!--                        <div class="row">-->
<!--                            <button type="button" @click="AddColor" class="btn  btn-primary mr-1 mb-1 waves-effect waves-light">-->
<!--                                <i class="fa fa-plus"></i>  Добавить Цвет-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="alert alert-danger" v-if="error">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                <span v-for="msg in error" :key="msg">
                                    {{ msg }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" v-model="products.published">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                        <span class="">Публиковать</span>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" v-model="products.available">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                        <span class="">В наличии</span>
                                    </div>
                                </fieldset>

<!--                                <fieldset>-->
<!--                                    <div class="vs-checkbox-con vs-checkbox-primary">-->
<!--                                        <input type="checkbox" v-model="products.popular">-->
<!--                                        <span class="vs-checkbox">-->
<!--                                            <span class="vs-checkbox&#45;&#45;check">-->
<!--                                                <i class="vs-icon feather icon-check"></i>-->
<!--                                            </span>-->
<!--                                        </span>-->

<!--                                        <span class="">Добавить в "Популярные товары"</span>-->
<!--                                    </div>-->
<!--                                </fieldset>-->

<!--                                <fieldset>-->
<!--                                    <div class="vs-checkbox-con vs-checkbox-primary">-->
<!--                                        <input type="checkbox" v-model="products.leader_of_sales">-->
<!--                                        <span class="vs-checkbox">-->
<!--                                            <span class="vs-checkbox&#45;&#45;check">-->
<!--                                                <i class="vs-icon feather icon-check"></i>-->
<!--                                            </span>-->
<!--                                        </span>-->

<!--                                        <span class="">Добавить в "Лидеры продаж"</span>-->
<!--                                    </div>-->
<!--                                </fieldset>-->
                            </div>
                            <div class="card-footer">
                                <div class="col-12 mb-0">
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                                <i class="feather icon-save"></i> {{ $t('admin.save') }}
                                            </button>
                                        </div>

                                        <div class="col-9">
                                            <a href="/dashboard/products" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                                <i class="feather icon-x-circle"></i> {{ $t('admin.cancel') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props: {
            brands: {},
            categories: {},
            colors: {},
            product: {},
            units: {}
        },

        watch: {
            'products.category_id': function (newVal) {
                this.getCharacteristics(newVal)
            },

            'category.first': function (newVal) {
                if (this.watch_count.first > 1) {
                    this.DetectCategory();
                }

                this.watch_count.first = 2;
            },

            'category.two': function (newVal) {
                if (this.watch_count.two > 1) {
                    if (newVal.parents.length > 0) {
                        this.DetectCategoryTwo();
                    } else {
                        if (newVal.id) {
                            this.product.category_id = newVal.id;
                            this.getCharacteristics(newVal)
                        }
                    }
                }

                this.watch_count.two = 2;

            },

            'category.three': function (newVal) {
                if (this.watch_count.three > 1) {
                    this.DetectCategoryThree();
                }

                this.watch_count.three = 2;
            },
        },

        data: function() {
            return {
                editor: ClassicEditor,

                short_limit: {
                    ru: 'Осталось 300 символов.',
                    uz: 'Осталось 300 символов.'
                },

                products: this.product,

                characteristic: false,
                characteristics: [],

                error: false,
                errors: [],

                files: [],

                deletes: {
                    childrens: [],
                    screens: []
                },

                category: {
                    first: {},
                    two: {},
                    three: {},
                    two_view: false,
                    three_view: false,
                },

                watch_count: {
                    first: 0,
                    two: 0,
                    three: 0,
                }

            }
        },

        mounted() {
            this.remaincharRUCount();
            this.remaincharUZCount();
            this.setCategory();


            if (!this.products.title_seo.ru || this.products.title_seo.ru == 'null') {
                this.products.title_seo.ru = '';
            }

            if (!this.products.title_seo.uz || this.products.title_seo.uz == 'null') {
                this.products.title_seo.uz = '';
            }

            if (!this.products.keywords.uz || this.products.keywords.uz == 'null') {
                this.products.keywords.uz = '';
            }

            if (!this.products.keywords.ru || this.products.keywords.ru == 'null') {
                this.products.keywords.ru = '';
            }

            if (!this.products.slug || this.products.slug == 'null') {
                this.products.slug = '';
            }

            if (!this.products.keywords.ru || this.products.keywords.ru == 'null') {
                this.products.keywords.ru = '';
            }

            if (!this.products.descriptions.uz || this.products.descriptions.uz == 'null') {
                this.products.descriptions.uz = '';
            }

            if (!this.products.descriptions.ru || this.products.descriptions.ru == 'null') {
                this.products.descriptions.ru = '';
            }

            if (this.products.categories.length == 0) {
                this.watch_count = {
                    first: 2,
                    two: 2,
                    three: 2,
                }
            }
        },

        methods: {

            setCategory () {
                if (this.products.categories[0]) {
                    if (this.products.categories[0].parent) {
                        if (this.products.categories[0].parent.parent) {
                            this.category.two_view = true;
                            this.category.three_view = true;
                            this.products.category_id = this.products.categories[0].id;

                            this.category.first = this.products.categories[0].parent.parent;
                            this.category.two = this.products.categories[0].parent;
                            this.category.three = this.products.categories[0];
                        } else {
                            this.products.category_id = this.products.categories[0].id;

                            this.category.first = this.products.categories[0].parent;
                            this.category.two = this.products.categories[0];
                            this.category.two_view = true;
                        }
                    } else {
                        this.products.category_id = this.products.categories[0].id;
                        this.category.first = this.products.categories[0];
                    }

                    this.getCharacteristics(this.product.categories[0].id);
                }
            },


            DetectCategory() {
                this.category.two = {
                    parents: []
                };
                this.category.two_view = false;
                this.category.three = {};
                this.category.three_view = false;

                if (this.category.first.parents.length > 0) {
                    this.category.two_view = true
                } else {
                    this.getCharacteristics(this.category.first.id)
                    this.product.category_id = this.category.first.id;
                }
            },

            DetectCategoryTwo () {
                this.category.three = {};
                this.category.three_view = false;

                if (this.category.two.parents.length > 0) {
                    this.category.three_view = true
                }
            },

            DetectCategoryThree () {
                this.getCharacteristics(this.category.three.id)
                this.product.category_id = this.category.three.id;
            },

            async getCharacteristics(id) {
                const { data } = await axios.get('/dashboard/products/characteristics/' + id);

                if (data.status) {
                    this.characteristics = data.characteristics;
                    this.setCharacters();
                }
            },

            setCharacters() {
                if(this.products.characteristics.length > 0) {
                    for (var i = 0; i < this.characteristics.length; i++ ) {
                        for (var c = 0; c < this.products.characteristics.length; c++) {
                            if (this.characteristics[i].id == this.products.characteristics[c].id) {
                                this.characteristics[i].value = this.products.characteristics[c].pivot.value;
                            }
                        }
                    }
                }
            },


            async UpdateProduct() {
                const header = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                const formData = new FormData();
                // formData.append('poster', this.products.poster);
                // formData.append('poster_thumb', this.products.poster_thumb);
                formData.append('name[ru]', this.products.name.ru);
                formData.append('name[uz]', this.products.name.uz);

                formData.append('body[ru]', this.products.body.ru);
                formData.append('body[uz]', this.products.body.uz);

                formData.append('short_body[ru]', this.products.short_body.ru);
                formData.append('short_body[uz]', this.products.short_body.uz);

                formData.append('brand_id', this.products.brand_id);
                formData.append('unit_id', this.products.unit_id);
                formData.append('published', this.products.published);
                formData.append('popular', this.products.popular);
                formData.append('leader_of_sales', this.products.leader_of_sales);
                // formData.append('currency', this.products.currency);
                formData.append('slug', this.products.slug);
                formData.append('count', this.products.count);
                formData.append('available', this.products.available);
                formData.append('descriptions[ru]', this.products.descriptions.ru);
                formData.append('descriptions[uz]', this.products.descriptions.uz);
                formData.append('keywords[uz]', this.products.keywords.uz);
                formData.append('keywords[ru]', this.products.keywords.ru);

                formData.append('title_seo[ru]', this.products.title_seo.ru);
                formData.append('title_seo[uz]', this.products.title_seo.uz);

                formData.append('article_number', this.products.article_number);
                formData.append('search_keywords', this.products.search_keywords);

                // for (let i = 0; i < this.products.categories.length; i++) {
                if (this.products.category_id) {
                    formData.append('category_id', this.products.category_id);
                }
                // }

                let price_discount = 0;

                if (this.products.price_discount) {
                    price_discount = this.products.price_discount
                }

                formData.append('price', this.products.price);
                formData.append('price_discount', price_discount);

                if (this.products.entry_price) formData.append('entry_price', this.products.entry_price);
                if (this.products.price_percents) formData.append('price_percents', this.products.price_percents);
                if (this.products.discount_percents) formData.append('discount_percents', this.products.discount_percents);

                for (var i = 0; i < this.characteristics.length; i++) {
                    formData.append('characteristics['+ i +'][id]', this.characteristics[i].id);
                    formData.append('characteristics['+ i +'][value]', this.characteristics[i].value);
                }

                // for (let i = 0; i < this.products.childrens.length; i++) {

                    // formData.append('colors['+ i +'][id]', this.products.childrens[i].id);
                    //
                    // if (this.products.childrens[i].color_id) {
                    //     formData.append('colors['+ i +'][color_id]', this.products.childrens[i].color_id);
                    // } else {
                    //     formData.append('colors['+ i +'][color_id]', null);
                    // }
                    //
                    // formData.append('colors['+ i +'][article_number]', this.products.childrens[i].article_number);
                    //
                    // if (this.products.childrens[i].sizes) {
                    //     for (var sizes = 0; sizes < this.products.childrens[i].sizes.length; sizes++) {
                    //         formData.append('colors['+ i +'][sizes]['+sizes+'][name]', this.products.childrens[i].sizes[sizes].name);
                    //         formData.append('colors['+ i +'][sizes]['+sizes+'][count]', this.products.childrens[i].sizes[sizes].count);
                    //     }
                    // }


                    for (var screens = 0; screens < this.products.screens.length; screens++) {
                        if (this.products.screens[screens].id) {
                            formData.append('screens[' + screens + '][id]', this.products.screens[screens].id);
                        } else {
                            formData.append('screens[' + screens + '][id]', null);
                        }

                        formData.append('screens['+ screens +'][image]', this.products.screens[screens].file);
                    }
                //
                // }

                // for (let i = 0; i < this.deletes.childrens.length; i++) {
                //     formData.append('deletes[childrens]['+ i +']', this.deletes.childrens[i]);
                // }

                for (let i = 0; i < this.deletes.screens.length; i++) {
                    formData.append('deletes[screens]['+ i +']', this.deletes.screens[i]);
                }

                axios.post('/dashboard/products/update/' + this.products.id, formData, header).then((response) => {
                    if (response.data.status) {
                        window.location.href = "/dashboard/products";
                    }
                }).catch((error) => {
                    if (error.response) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                });

            },

            remaincharRUCount: function(){

                if (this.products.short_body.ru) {
                    if(this.products.short_body.ru.length > 300){
                        this.short_limit.ru = "Превышен лимит в 300 символов.";
                    } else {
                        let remainCharacters = 300 - this.products.short_body.ru.length;
                        this.short_limit.ru = "Осталось " + remainCharacters + " символов.";
                    }

                }

            },

            remaincharUZCount: function(){

                if (this.products.short_body.uz) {
                    if(this.products.short_body.uz.length > 300){
                        this.short_limit.uz = "Превышен лимит в 300 символов.";
                    } else {
                        let remainCharacters = 300 - this.products.short_body.uz.length;
                        this.short_limit.uz = "Осталось " + remainCharacters + " символов.";
                    }
                }

            },

            filesSelected: function(filesDataNewlySelected, index) {
                let validFilesData = filesDataNewlySelected.filter((fileData) => !fileData.error);
                this.products.filesDataForUpload = this.products.filesDataForUpload.concat(validFilesData);
            },

            fileDeleted: function(fileData, index) {
                // console.log(fileData);
                // console.log('index' + index);
                let i = this.products.screens.indexOf(fileData);

                if (i !== -1) {

                    this.products.screens.splice(i, 1);
                    let id = fileData.id ? fileData.id : null ;

                    if (fileData.id) {
                        this.deletes.screens.push(id)
                    }
                }
            },
        }
    }
</script>

<style scoped>

</style>
