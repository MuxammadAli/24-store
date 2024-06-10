<template>
    <div class="row row-products">
        <div class="col-xl-3 col-lg-6 mb-4" v-for="(product, index) in favorites" :key="index" >
            <Product :product="product" :login-info="loginInfo"/>
        </div>
    </div>
</template>

<script>

    import Product from '../Products/Product.vue';

    export default {
        props: {
            products: {},
            loginInfo: {}
        },

        components: {
            Product
        },

        data () {
            return {
                favorites: this.products.data
            }
        },

        mounted() {

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

            async removeProduct(product, index) {
                var field = document.getElementById("favorite-count");
                var count = field.value;

                const { data } = await axios.get('/favorites/delete/' + product.id);

                if (data.status) {
                    this.favorites.splice(index, 1);
                    field.value = parseInt(count) - 1;
                }

            },

            async AddToCart(product) {
                if (product.isCart) {
                    this.$eventBus.$emit('cart-preview');
                    return;
                }

                const fields = {
                    product_id: product.children.id,
                    count: 1
                };

                const { data } = await axios.post('/cart/store', fields);

                if (data.status) {
                    product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                }
            }

        }
    }
</script>
