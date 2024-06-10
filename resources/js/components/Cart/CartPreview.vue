<template>
    <div class="modal fade" id="basket">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                    <h4 class="modal-title">{{ $t('vue.cart_preview.basket_title') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="container pb-3">
                        <div class="cart-product py-3 border-bottom" v-for="(product, index) in products">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 d-flex align-items-md-end flex-md-row flex-column">
                                    <div class="cart-product__img">
                                        <img v-if="product.product.screen" :src="'/' + product.product.screen.path_thumb" :alt="getName(product.product.name)">
                                        <img v-else-if="product.product.images[0].path_thumb" :src="product.product.images[0].path_thumb" :alt="getName(product.product.name)">
                                    </div>
                                    <h5 class="cart-product__title mt-3">
                                        <a :href="'/product/' + product.product.id + '-' + product.product.slug">
                                            {{ getName(product.product.name) }}
                                        </a>
                                    </h5>
                                </div>
                                <div class="col-lg-3 col-md-4 d-flex align-items-end justify-content-md-start justify-content-center">
                                    <div class="product-count mb-0">
                                        <span class="decrement" @click="CountMinus(product)">
                                            <i class="fal fa-minus"></i>
                                        </span>
                                        <input type="text" v-model="product.count" min="0" readonly="readonly">
                                        <span class="increment" @click="CountAdd(product)">
                                            <i class="fal fa-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 d-flex align-items-md-end flex-md-column justify-content-md-between cart-product__footer">
                                    <div class="d-flex flex-column cart-product__icons">
                                        <button class="delete-product" type="button" @click="removeProduct(product, index)"><i class="far fa-times"></i></button>
                                    </div>
                                    <h5 class="cart-product__price">
                                        {{ $t('app.price') }} {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }}
                                        {{ $t('app.sum') }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <p class="alert alert-info mb-3 " v-if="products.length === 0">
                            <i class="fa fa-info-circle"></i> {{ $t('app.no_product') }}
                        </p>

                        <h4 v-if="products.length > 0" class="my-4 text-right">{{ $t('vue.cart.total_amount') }}: {{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</h4>

                        <div v-if="products.length > 0"  class="row">
                            <div class="col-12 ml-auto d-flex justify-content-end flex-md-row flex-column">
                                <a href="/cart" class="btn px-md-5 btn-dark d-flex justify-content-center align-items-center">
                                    {{ $t('vue.cart_preview.basket_checkout') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import {bus} from "../../vendor";

    export default {

        props: {
            loginInfo: {}
        },

        data () {
          return {
              products: [],
              prices: 0,
          }
        },

        created() {
            this.$eventBus.$on("cart-preview", this.getCart);
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



            async CountMinus(product) {
                let unit = product.product.unit.count;

                if (product.count <= unit) {
                    product.count = unit;
                } else {
                    product.count -= unit;
                }

                const fields = {
                    product_id: product.product_id,
                    count: product.count
                };

                const { data } = await axios.put('/cart/', fields);

                if (data.status) {
                    product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                    this.prices = data.prices;
                    product.product.count = data.max_count;
                }
            },

            async CountAdd(product) {
                let unit = product.product.unit.count;

                if (product.product.count >= product.count + unit){
                    product.count += unit;

                    const fields = {
                        product_id: product.product_id,
                        count: product.count
                    };

                    const { data } = await axios.put('/cart/', fields);

                    if (data.status) {
                        product.isCart = true;
                        var basket = document.getElementById("basket-count");
                        basket.value = data.count;
                        this.prices = data.prices;
                        product.product.count = data.max_count;
                    }
                }
            },

            async getCart() {
                const { data } = await axios.get('/cart/preview/');

                if (data.status) {
                    this.basket = data.products.length;
                    this.products = data.products;
                    this.prices = data.prices;
                    this.on_credit = data.on_credit
                }
            },

            async removeProduct(product, index) {
                const { data } = await axios.delete('/cart/' + product.product_id);

                if (data.status) {
                    this.basket = data.count;
                    this.prices = data.prices;
                    this.products.splice(index, 1)
                }

            },
        }
    }
</script>

<style scoped>

</style>
