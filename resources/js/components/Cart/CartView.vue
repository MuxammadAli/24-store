<template>
    <section class="section-order">
        <div class="container">
            <div class="order-steps">
                <a href="#" class="order-steps__item is-active">
                    {{ $t('vue.cart.step_1') }}
                </a>
                <a href="/checkout" class="order-steps__item">
                    {{ $t('vue.cart.step_2') }}
                </a>
                <a href="/checkout" class="order-steps__item">
                    {{ $t('vue.cart.step_3') }}
                </a>
            </div>

            <div class="bg-white rounded p-lg-4 p-3 mt-5">
                <h4>
                    {{ $t('app.cart.title') }}
                </h4>

                <div class="border-bottom mt-4">
                    <div class="row">
                        <div class="col-lg-6 col-4">
                            <p class="text-secondary">Товар</p>
                        </div>
                        <div class="col-lg-3 col-4">
                            <p class="text-secondary">Кол-во</p>
                        </div>
                        <div class="col-lg-3 col-4">
                            <p class="text-secondary text-right">Итог-во</p>
                        </div>
                    </div>
                </div>

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

                <h4 class="my-4 text-right">{{ $t('vue.cart.total_amount') }}: {{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</h4>

                <div class="row">
                    <div class="col-12 ml-auto d-flex justify-content-end flex-md-row flex-column">
                        <button type="button" @click="removeAllProducts" class="btn px-md-5 btn-danger mr-2 mb-md-0 mb-3">
                            {{ $t('vue.cart.reset_cart') }}
                        </button>
                        <a href="/checkout" class="btn px-md-5 btn-dark">
                            {{ $t('vue.cart.checkout_product') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            cartData: {},
            loginInfo: {},
            pricesData: {},
        },

        data() {
            return {
                products: this.cartData,
                prices: this.pricesData
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

            async removeAllProducts() {
                const { data } = await axios.delete('/cart/remove/all');

                if (data.status) {
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                    this.prices = data.prices;
                    this.products = [];
                }
            },

            async CountMinus(product) {
                let unit = product.product.unit.count;

                if (product.product.count >= product.count) {
                    if (product.count <= unit) {
                        product.count = unit;
                    } else {
                        product.count -= unit;
                    }
                } else {
                    product.count = product.product.count;
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

                if (product.product.count > product.count){
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

            async Favorite(product) {
                var field = document.getElementById("favorite-count");
                var count = field.value;

                if (product.isFavorite === false) {
                    const { data } = await axios.get('/favorites/store/' + product.id);
                    product.isFavorite = true;
                    field.value = parseInt(count) + 1;
                } else {
                    const { data } = await axios.get('/favorites/delete/' + product.id);
                    product.isFavorite = false;
                    field.value = parseInt(count) - 1;
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
