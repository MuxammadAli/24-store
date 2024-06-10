<template>
    <section class="section-all-product">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-lg-end">
                    <select class="custom-selecting" @change="orderByChange($event)">
                        <option value="all">{{ $t('vue.catalog.view_by_all') }} </option>
                        <option value="new">{{ $t('vue.catalog.new') }}</option>
                        <option value="cheap">{{ $t('vue.catalog.view_by_cheap') }}</option>
                        <option value="expensive">{{ $t('vue.catalog.view_by_expensive') }}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <button class="filter-btn btn btn-secondary"><i class="far fa-sliders-h"></i> <span>Фильтры</span></button>
                    <div class="categories-control">
                        <button class="filter-btn-close bg-transparent border-0"><i class="fal fa-times"></i></button>
                        <div class="categories sticky-top">
                            <form action="#" @submit.prevent="SendFilterParams"  class="h-100">
                                <div class="categories-list"  v-if="categories.length > 0">
                                    <div class="card">
                                        <div class="card-header px-md-4 pl-3 pb-3">
                                            <a class="card-link" data-toggle="collapse" href="#collapse-00" aria-expanded="true">
                                                {{ $t('vue.catalog.catalog_title') }}
                                            </a>
                                        </div>
                                        <div id="collapse-00" class="collapse show" data-parent="#collapse-00" style="">
                                            <div class="card-body">
                                                <div class="card-content category">
                                                    <ul>
                                                        <li v-for="(category, index) in categories" v-if="category.published" :key="index" class="border-top py-2 px-4">
                                                            <a :href="category.link">
                                                                {{ getName(category.name) }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-filter">
                                    <div class="card" v-if="characteristics.length > 0" v-for="(char, index) in characteristics" :key="index">
                                        <div class="card-header px-md-4 pl-3 pb-3">
                                            <a class="card-link" data-toggle="collapse" :href="'#collapse-'+ char.id">
                                                {{ getName(char.name) }}
                                            </a>
                                        </div>
                                        <div :id="'collapse-'+ char.id" class="collapse show" :data-parent="'#collapse-'+ char.id">
                                            <div class="card-body">
                                                <div class="card-content price-slider border-top py-2 px-4">
                                                    <div class="custom-control custom-checkbox" v-for="(attr, indexx) in char.attributes" :key="indexx">
                                                        <input type="checkbox" class="custom-control-input" v-model="filters"  :id="'check'+char.id+indexx" name="filter" :value="{id: char.id, name: char.name, type: char.type, attribute: attr}">
                                                        <label class="custom-control-label" :for="'check'+char.id+indexx" v-if="char.type === 'checkbox'">
                                                            <span v-if="attr === 'true'">
                                                                {{ $t('app.exist') }}
                                                            </span>
                                                            <span v-else>
                                                                 {{ $t('app.no') }}
                                                            </span>
                                                        </label>

                                                        <label class="custom-control-label" :for="'check'+char.id+indexx" v-else>
                                                            {{ attr }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header px-md-4 pl-3 pb-3">
                                            <a class="card-link" data-toggle="collapse" href="#collapse-3">
                                                {{ $t('vue.catalog.by_price') }}
                                            </a>
                                        </div>
                                        <div id="collapse-3" class="collapse show" data-parent="#collapse-3">
                                            <div class="card-body">
                                                <div class="card-content price-slider border-top py-2 px-4">
                                                    <div class="price-range">
                                                        <div class="price-range__input">

                                                            <div class="price-range__input--from mt-3">
                                                                <input type="number" v-model="prices.price_from" :placeholder="$t('vue.catalog.price_from')" id="price_from">
                                                            </div>

                                                            <div class="price-range__input--to mt-3">
                                                                <input type="number" v-model="prices.price_to" :placeholder="$t('vue.catalog.price_to')" id="price_to">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="category-buttons pb-2 mt-4 border-top pb-3">
                                        <div class="mt-3">

                                            <button @click="removeAllFilter" type="button" class="bg-transparent border-0 w-100 btn-reset">
                                                {{ $t('vue.catalog.catalog_reset') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row row-products">
                        <div v-if="products.length === 0">
                            {{ $t('app.no_category_product') }}
                        </div>

                        <div class="col-xl-3 col-md-4 mb-4" v-for="(product, index) in products">
                            <product-item  :key="index" :product="product" :login-info="loginInfo"/>
                        </div>
                    </div>

<!--                    v-if="product_count > 12"-->
                    <paginate
                              :pageCount="pageCount"
                              :clickHandler="PageCallBack"
                              :prevText="'<i class=\'far fa-long-arrow-left \'></i>'"
                              :nextText="'<i class=\'far fa-long-arrow-right \'></i>'"
                              :container-class="'pagination d-flex justify-content-center align-items-center flex-wrap mt-4'"
                              :page-class="'page-item'"
                              :page-link-class="'page-link'"
                              :next-class="'page-item'"
                              :prev-class="'page-item'"
                              :prev-link-class="'page-link'"
                              :next-link-class="'page-link'">
                    </paginate>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Product from '../Products/Product';
    import { isMobileOnly } from "mobile-device-detect";
    import Paginate from 'vuejs-paginate';

    export default {
        created() {
            this.MenuLiCount();
            if (localStorage.url_filter == window.location) {
                this.filters = localStorage.filter ? JSON.parse(localStorage.filter) : [];
            } else {
                localStorage.removeItem('url_filter');
                localStorage.removeItem('filter');
            }
        },

        props: {
            productsData: {},
            categoriesData: {},
            loginInfo: {},
            characteristicsData: {},
            categoryData: {},
            page: {}
        },

        components: {
            'product-item': Product,
            'paginate': Paginate
        },

        data() {
            return {
                products: this.productsData.data,
                categories: this.categoriesData,
                characteristics: this.characteristicsData,
                category: this.categoryData,

                filters: [],
                orderby: 'all',

                menu: 'three-li',
                mobile: isMobileOnly ? true : false,

                pageCount: this.productsData.last_page,
                page_current: 1,
                product_count: this.productsData.total,
                paginate: false,

                page_products: 12,

                prices: {
                    price_from: null,
                    price_to: null
                }
            }
        },

        watch: {
            filters: function (newVal) {
                this.SendFilterParams();
                localStorage.filter = JSON.stringify(this.filters);
            },
            'prices.price_from': function (newVal) {
                this.SendFilterParams();
            },

            'prices.price_to': function (newVal) {
                this.SendFilterParams();
            }
        },

        methods: {
            getName(name) {
                const lang = document.documentElement.lang.substr(0, 2);
                let value = '';

                if (lang) {
                    switch(lang){
                        case "ru":
                            value = name.ru;
                            break;
                        case "uz":
                            value = name.uz;
                            break;
                    }
                } else {
                    value = name.ru;
                }

                return value;
            },

            PageCallBack(pageNum) {
                this.page_current = pageNum;
                window.scrollTo(0,0);
                this.SendFilterParams();
            },

            async SendFilterParams() {
                const fields = {
                    order_by: this.orderby,
                    filter: this.filters,
                    page: this.page,
                    paginate: 12,
                    prices: this.prices
                };

                const { data } = await axios.post('/category/filter/' + this.category.id + '?page='+ this.page_current,  fields);

                localStorage.url_filter = window.location;

                this.pageCount = data.page;
                this.products = data.products;
                this.product_count = data.count;
            },

            removeFilter(index) {
                this.filters.splice(index, 1);
            },

            orderByChange(event) {
                this.orderby = event.target.value;

                this.SendFilterParams()
            },

            MenuLiCount() {
                if (this.categories.length > 0 && this.characteristics.length > 0) {
                    this.menu = 'three-li';
                } else if (this.categories.length === 0 ^ this.characteristics.length === 0) {
                    this.menu = 'two-li';
                } else {
                    this.menu = 'one-li';
                }
            },

            removeAllFilter() {
                this.filters = [];
                this.prices = {
                    price_from: null,
                    price_to: null
                }
            }
        }
    }
</script>

<style scoped>

</style>
