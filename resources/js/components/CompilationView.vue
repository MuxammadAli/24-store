<template>
    <section class="section-all-product">
        <div class="container">
            <div class="row mb-3">
                <div class="col-9 d-flex justify-content-lg-end">
                    <select class="custom-selecting" @change="orderByChange($event)">
                        <option value="all">{{ $t('vue.catalog.view_by_all') }} </option>
                        <option value="new">{{ $t('vue.catalog.new') }}</option>
                        <option value="cheap">{{ $t('vue.catalog.view_by_cheap') }}</option>
                        <option value="expensive">{{ $t('vue.catalog.view_by_expensive') }}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row row-products">
                        <div v-if="products.length === 0">
                            {{ $t('app.no_category_product') }}
                        </div>

                        <div class="col-xl-2 col-md-4 mb-4" v-for="(product, index) in products">
                            <product-item  :key="index" :product="product" :login-info="loginInfo"/>
                        </div>
                    </div>


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
import Product from './Products/Product';
import { isMobileOnly } from "mobile-device-detect";
import Paginate from 'vuejs-paginate';

export default {
    created() {
        // this.MenuLiCount();
        if (localStorage.url_filter == window.location) {
            this.filters = localStorage.filter ? JSON.parse(localStorage.filter) : [];
        } else {
            localStorage.removeItem('url_filter');
            localStorage.removeItem('filter');
        }
    },

    props: {
        productsData: {},
        loginInfo: {},
        page: {}
    },

    components: {
        'product-item': Product,
        'paginate': Paginate
    },

    data() {
        return {
            products: this.productsData.data,

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
            this.Paginate()
        },

        Paginate() {
            axios.post('?page=' + this.page_current).then(res => {
                if (res.data.status === true) this.products = res.data.products.data
            })
        },

        orderByChange(event) {
            this.orderby = event.target.value;
        },

    }
}
</script>

<style scoped>

</style>
