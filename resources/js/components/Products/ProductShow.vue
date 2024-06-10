<template>
    <div>
        <section class="section-product-item mt-4">
            <div class="container">
                <div class="bg-white rounded px-lg-4 py-lg-5 py-3 px-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="slider slider-big" id="aniimated-big">
                                <div class="slider__content" v-if="!product.images" v-for="(screen, index) in product.screens">
                                    <div class="slider__img" >
                                        <div class="item" :data-src="'/' + screen.path">
                                            <img :src="'/' + screen.path_thumb" :alt="getName(product.name)">
                                        </div>
                                    </div>
                                </div>
                                <div class="slider__content" v-if="product.images" v-for="(screen, index) in product.images">
                                    <div class="slider__img" >
                                        <div class="item" :data-src="screen.path">
                                            <img :src="screen.path_thumb" :alt="getName(product.name)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slider slider-small py-3 px-2" id="aniimated-small">
                                <div class="slider__img" v-if="!product.images" v-for="(screen, index) in product.screens">
                                    <div class="item1" :data-src="'/' + screen.path">
                                        <img class="" :src="'/' + screen.path_thumb" :alt="getName(product.name)">
                                    </div>
                                </div>
                                <div class="slider__img" v-if="product.images" v-for="(screen, index) in product.images">
                                    <div class="item1" :data-src="screen.path">
                                        <img class="" :src="screen.path_thumb" :alt="getName(product.name)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mt-lg-0 mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="product-item">
                                        <h2 class="product-item__title">{{ getName(product.name) }}</h2>
                                        <h6 class="product-price-old" v-if="product.price_discount">{{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}  <span v-if="product.unit">{{ $t('vue.product.unit', {unit: getName(product.unit.name), count: product.unit.count}) }}</span></h6>
                                        <h4 class="product-item__price" v-if="!product.price_discount">{{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }} <span v-if="product.unit">{{ $t('vue.product.unit', {unit: getName(product.unit.name), count: product.unit.count}) }}</span></h4>
                                        <h4 class="product-item__price" v-if="product.price_discount">{{ product.price_discount | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }} <span v-if="product.unit">{{ $t('vue.product.unit', {unit: getName(product.unit.name), count: product.unit.count}) }}</span></h4>

                                        <div class="product-count" v-if="product.count !== 0">
                                          <span class="decrement" @click="CountMinus">
                                            <i class="fal fa-minus"></i>
                                          </span>
                                            <input type="text" v-model="count" min="0" readonly="readonly">
                                            <span class="increment" @click="CountAdd">
                                                <i class="fal fa-plus"></i>
                                            </span>
                                        </div>

                                        <p class="product-item__subtitle" v-html="getName(product.body)">

                                        </p>

                                        <div class="share share-payment mb-3 flex-md-row flex-column align-items-md-center align-items-start">
                                            <p>{{ $t('vue.cart.payment_title') }}:</p>
                                            <div class="d-lg-inline-block">
<!--                                                <img class="mr-3 mt-md-0 mt-3" src="/vendor/site/img/payme.svg" alt="payme">-->
<!--                                                <img class="mr-3 mt-md-0 mt-3" src="/vendor/site/img/click.svg" alt="click">-->
                                                <img class="mr-3 mt-md-0 mt-3" src="/vendor/site/img/enumeration.png" width="160" height="40" alt="enumeration">
                                                <img class="mr-3 mt-md-0 mt-3" src="/vendor/site/img/cash.svg" alt="cash">
                                            </div>
                                        </div>
<!--                                        <div class="share share-product">-->
<!--                                            <p>Поделиться:</p>-->
<!--                                            <ShareNetwork :url="url" network="facebook" :title="getName(product.name)">-->
<!--                                                <i class="fab fa-facebook-f"></i>-->
<!--                                            </ShareNetwork>-->

<!--                                            <ShareNetwork :url="url" network="telegram" :title="getName(product.name)">-->
<!--                                                <i class="fab fa-telegram"></i>-->
<!--                                            </ShareNetwork>-->

<!--                                            <ShareNetwork :url="url" network="vk" :title="getName(product.name)">-->
<!--                                                <i class="fab fa-vk"></i>-->
<!--                                            </ShareNetwork>-->

<!--                                            <ShareNetwork :url="url" network="odnoklassniki" :title="getName(product.name)">-->
<!--                                                <i class="fab fa-odnoklassniki"></i>-->
<!--                                            </ShareNetwork>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                                <div class="col-md-4 mt-lg-0 mt-md-3">
                                    <button type="button" v-if="!product.isCart && product.isAvailable" :class="product.isCart ? 'product-to_basket is-actived is-active' : 'product-to_basket is-actived'" @click="AddToCart" class="mb-4 mt-md-0 mt-4 btn btn-dark w-100">
                                        <img src="/vendor/site/img/add-shopping-cart.svg">
                                        В корзину

                                        <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">

                                        </div>
                                    </button>
                                    <button type="button" disabled v-if="!product.isCart && !product.isAvailable" :class="product.isCart ? 'product-to_basket is-actived is-active' : 'product-to_basket is-actived'"class="mb-4 mt-md-0 mt-4 btn btn-dark w-100">
<!--                                        <img src="/vendor/site/img/add-shopping-cart.svg">-->
                                        {{ $t('vue.not_available') }}

                                        <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">

                                        </div>
                                    </button>

                                    <button v-if="product.isCart"  @click="AddToCart" data-target="#basket" data-toggle="modal" type="button" class="mb-4 mt-md-0 mt-4 btn btn-dark w-100">
                                        <img src="/vendor/site/img/check.svg" alt="added-shopping-cart" class="added-card-imgs">
                                        {{ $t('vue.cart.product_to_basket_title') }}
                                    </button>


<!--                                    <button v-if="!product.isCart" :class="product.isCart ? 'product-to_basket is-actived is-active' : 'product-to_basket is-actived'" @click="AddToCart">-->
<!--                                        <i class="far fa-shopping-basket"></i>-->
<!--                                        <span class="d-inline-block">{{ $t('vue.cart.product_to_basket_title') }}</span>-->

<!--                                        <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">-->

<!--                                        </div>-->
<!--                                    </button>-->

<!--                                    <button v-if="product.isCart" :class="product.isCart ? 'product-to_basket is-actived is-active' : 'product-to_basket is-actived'" @click="AddToCart" data-target="#basket" data-toggle="modal" type="button">-->
<!--                                        <i class="far fa-shopping-basket"></i>-->
<!--                                        <span class="d-inline-block">{{ $t('vue.cart.product_to_basket_title') }}</span>-->
<!--                                    </button>-->

                                    <button class="btn btn-warning w-100" data-target="#sing-in-1" data-toggle="modal" v-if="!loginInfo">
                                        <i class="fal fa-heart mr-1"></i> {{ $t('app.favorites.favorite') }}
                                    </button>

                                    <button :class="product.isFavorite ? 'btn btn-warning w-100' : 'btn btn-warning w-100'" @click="Favorite(product)" v-if="loginInfo">
                                        <i :class="product.isFavorite ? 'fas fa-heart' : 'far fa-heart'"></i>
                                        {{ $t('app.favorites.favorite') }}
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-similar products">
            <div class="container">
                <h2 class="section-title">{{ $t('app.index.popular_prods') }}</h2>
                <products-slider :products-data="productsRelated" :login-info="loginInfo"></products-slider>
            </div>
        </section>

        <section class="section-comments py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>{{ $t('vue.cart.reviews') }} ({{ product.comments_count }})</h4>
                            <button v-if="loginInfo" type="button" class="bg-transparent p-0 border-0 text-warning h5 btn-link"
                                    style="text-decoration: underline;" data-toggle="modal" data-target="#comments">{{ $t('vue.cart.review.create') }}</button>

                            <button v-if="!loginInfo" type="button" class="bg-transparent p-0 border-0 text-warning h5 btn-link"
                                    style="text-decoration: underline;" data-toggle="modal" data-target="#sing-in-1">{{ $t('vue.cart.review.create') }}</button>
                        </div>

                        <div class="comment p-lg-4 p-3 bg-white rounded mt-4">
                            <p v-if="product.comments.length === 0">{{ $t('vue.cart.no_reviews') }}</p>
                            <comment-list v-for="(comment, index) in product.comments" :comment-data="comment" :key="index"></comment-list>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <comment-modal v-if="loginInfo" :product="product"></comment-modal>

    </div>
</template>

<script>
    import CommentList from './CommentList';
    import CommentModal from './CommentModal';

    import VueSocialSharing from 'vue-social-sharing'

    // import { bus } from "../../vendor";

    export default {
        props: {
            productData: {},
            productsRelated: {},
            loginInfo: {},
            firstName: {},
            settingData: {},
            phoneProfile: {}
        },

        components: {
            'comment-list': CommentList,
            'ShareSocial': VueSocialSharing,
            'comment-modal': CommentModal,
        },

        created() {
            this.url = window.location.href;
            this.count = this.productData.unit.count;
        },

        data() {
            return {
                product: this.productData,
                count: this.productData.count !== 0 ? 1 : 0,
                color_id: null,
                comment: {
                    star: 0,
                    body: '',
                    first_name: this.firstName
                },

                alertComment: false,

                alertBasket: false,

                colors: false,
                url: ''
            }
        },

        methods: {
            getName(name) {
                const lang = document.documentElement.lang.substr(0, 2);
                let value = '';

                if (name) {
                    if (lang) {
                        switch(lang){
                            case "ru":
                                value = name.ru;
                                break;
                            case "uz":
                                value = name.uz;
                                break;
                            default:
                                value =  name.ru;
                                break;
                        }
                    } else {
                        value = name.ru;
                    }

                    return value;
                }
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

            async AddToCart() {

                if (this.product.isCart) {
                    this.$eventBus.$emit('cart-basket');
                    return;
                }

                const fields = {
                    product_id: this.product.id,
                    count: this.count
                };

                const { data } = await axios.post('/cart', fields);

                if (data.status) {
                    this.product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                }
            },

            CountMinus() {
                let add = this.product.unit.count;

                if (this.product.isAvailable) {
                    if (this.count <= add) {
                        return add;
                    } else {
                        this.count -= add;
                    }
                }

            },

            CountAdd() {
                let add = this.product.unit.count;

                if (this.product.isAvailable && this.product.count > this.count) {
                    this.count += add;
                }
            },

            CreditCookie() {
                this.$cookie.delete('cart-preview');
                this.$cookie.set('product-credit', this.product.id);
            },

            async StoreComment() {
                const { data } = await axios.post('/product/comment/' + this.product.id, this.comment);

                if (data.status) {
                    this.comment = {
                        star: 0,
                        body: '',
                        first_name: this.firstName
                    };

                    this.alertComment = true;
                }
            }
        }

    }
</script>

