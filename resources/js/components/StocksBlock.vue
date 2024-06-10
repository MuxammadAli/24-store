<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <select class="custom-selecting" @change="orderByChange($event)" v-model="orderBy">
                    <option value="all">Все </option>
                    <option value="new">По новизне</option>
                    <option value="cheap">Сначала дешевые</option>
                    <option value="expensive">Сначала дорогие</option>
                </select>
            </div>
        </div>
        <h4 class="mb-4">Скидки</h4>

<!--        <div  v-if="products.length === 0">-->
<!--            {{ $t('app.search_result', {text: searchText}) }}-->
<!--        </div>-->

        <div class="row">
            <div class="col-lg-12">
                <div class="rows">
                    <Product v-for="(product, index) in products" :product="product" :login-info="loginInfo" :key="index"></Product>
                </div>


                <Paginate v-if="product_count > 12"
                          :pageCount="pageCount"
                          :clickHandler="PageCallBack"
                          :prevText="'<i class=\'far fa-chevron-left \'></i>'"
                          :nextText="'<i class=\'far fa-chevron-right \'></i>'"
                          :container-class="'pagination d-flex justify-content-center align-items-center flex-wrap mt-4'"
                          :page-class="'page-item'"
                          :page-link-class="'page-link'"
                          :next-class="'page-item'"
                          :prev-class="'page-item'"
                          :prev-link-class="'page-link'"
                          :next-link-class="'page-link'">
                </Paginate>
            </div>
        </div>
    </div>
</template>

<script>
    import Product from './Products/Product';
    import Paginate from 'vuejs-paginate'

    export default {
        props: {
            searchData: {},
            loginInfo: {},
            searchText: {}
        },

        components: {
            Product,
            Paginate
        },

        data () {
            return {
                products: this.searchData.data,

                orderBy: 'all',

                pageCount: this.searchData.last_page,
                page_current: 1,
                product_count: this.searchData.total,
                paginate: false,

                // page_products: 12,
            }
        },

        methods: {
            PageCallBack(pageNum) {
                this.page_current = pageNum;
                window.scrollTo(0,0);

                this.SendFilterParams();
            },

            async SendFilterParams() {
                const fields = {
                    order_by: this.orderby,
                    // filter: this.filters,
                    // page: this.page,
                    // paginate: this.page_products
                };

                const { data } = await axios.post('/stocks?page='+ this.page_current, fields);

                localStorage.url_filter = window.location;

                this.pageCount = data.last_page;
                this.products = data.data;
                this.product_count = data.total;
            },

            orderByChange(event) {
                this.orderby = event.target.value;

                this.SendFilterParams()
            },
        }
    }
</script>

<style scoped>

</style>
