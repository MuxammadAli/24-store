<template>
    <div class="product">
        <div class="product-discount" v-if="product.discountPrice > 0 && product.price_discount && product.isAvailable">
            -{{ product.discountPrice }}%
        </div>

        <div class="product-header">
            <a v-if="product.type && product.type == 'coin'" :href="'/coin-product/' + product.id + '-' + product.slug">
                <img v-if="product.screen" :src="'/' + product.screen.path_thumb" :class="!product.isAvailable ? 'no-product-img' : ''" :alt="getName(product.name)">
                <img v-else-if="product.images" :src="product.images[0].path_thumb" :class="!product.isAvailable ? 'no-product-img' : ''" :alt="getName(product.name)">
            </a>
            <a v-else-if="!product.type || (product.type && product.type == 'default')" :href="'/product/' + product.id + '-' + product.slug">
                <img v-if="product.screen" :src="'/' + product.screen.path_thumb" :class="!product.isAvailable ? 'no-product-img' : ''" :alt="getName(product.name)">
                <img v-else-if="product.images" :src="product.images[0].path_thumb" :class="!product.isAvailable ? 'no-product-img' : ''" :alt="getName(product.name)">
            </a>

            <button class="product-to-favourite" data-target="#sing-in-1" data-toggle="modal" v-if="!loginInfo">
                <i class="far fa-heart"></i>
            </button>

            <button :class="product.isFavorite ? 'product-to-favourite is-active' : 'product-to-favourite'" @click="Favorite(product)" v-if="loginInfo">
                <i :class="product.isFavorite ? 'fas fa-heart text-dark' : 'far fa-heart'"></i>
            </button>

        </div>
        <div class="product-body">
            <div class="product-comment">
                <img src="/vendor/site/img/comments.svg" alt="comment icon">
                <span>{{ $t('vue.cart.reviews') }} ({{ product.comments_count }})</span>
            </div>
            <h4 class="product-title">
                <a :href="'/product/' + product.id + '-' + product.slug">
                    {{ getName(product.name) }}
                </a>
            </h4>
        </div>
        <div class="product-footer" v-if="product.type !== 'coin'">
            <h6 class="product-price-old" v-if="product.price_discount">
                {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
            </h6>
            <h5 class="product-price-now">
                {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
                <span v-if="product.unit">{{ $t('vue.product.unit', {count: product.unit.count, unit: getName(product.unit.name)}) }}</span>
            </h5>
        </div>
        <div class="product-footer" v-else>
            <h6 class="product-price-old" v-if="product.price_discount">
                {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }}
            </h6>
            <h5 class="product-price-now">
                {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }}
                <span v-if="product.unit">{{ $t('vue.product.unit', {count: product.unit.count, unit: getName(product.unit.name)}) }}</span>
            </h5>
        </div>
        <button class="add-to-cart add_to_card" v-if="product.isAvailable && !product.isCart" @click="AddToCart(product)">
            <img src="/vendor/site/img/add-shopping-cart.svg" alt="add-shopping-cart"
                 class="add-card-img d-block">

            <span class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">
           </span>
        </button>


        <button class="add-to-cart" v-if="product.isAvailable && product.isCart" data-target="#basket" data-toggle="modal"   @click="AddToCart(product)">
            <img src="/vendor/site/img/check.svg" alt="added-shopping-cart" class="added-card-imgs">

            <span class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">
           </span>
        </button>

    </div>
</template>

<script>
    export default {
        name: "Product",

        props: ['product', 'loginInfo'],

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

            async Favorite(product) {
                var field = document.getElementById("favorite-count");
                var count = field.value;

                if (product.isFavorite === false) {
                    const { data } = await axios.post('/favorites/' + product.id);
                    this.product.isFavorite = true;
                    field.value = parseInt(count) + 1;
                } else {
                    const { data } = await axios.delete('/favorites/' + product.id);
                    this.product.isFavorite = false;
                    field.value = parseInt(count) - 1;
                }
            },

            async AddToCart(product) {
                if (this.product.isCart){
                    this.$eventBus.$emit('cart-preview');
                    return;
                }
                const fields = {
                    product_id: product.id,
                    count: 1
                };

                const { data } = await axios.post('/cart', fields);

                if (data.status) {
                    product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                }
            }
        }
    }
</script>

<style scoped>
    .product-discount {
        z-index: 2 !important;
    }
</style>
