<template>
    <div>
        <section class="section-product-item mt-4">
            <div class="container">
                <div class="bg-white rounded px-lg-4 py-lg-5 py-3 px-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="slider slider-big" id="aniimated-big">
                                <div class="slider__content" v-for="(screen, index) in product.screens">
                                    <div class="slider__img">
                                        <div class="item" :data-src="'/' + screen.path">
                                            <img :src="'/' + screen.path_thumb" :alt="getName(product.name)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slider slider-small py-3 px-2" id="aniimated-small">
                                <div class="slider__img" v-for="(screen, index) in product.screens">
                                    <div class="item1" :data-src="'/' + screen.path">
                                        <img class="" :src="'/' + screen.path_thumb" :alt="getName(product.name)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mt-lg-0 mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="product-item">
                                        <h2 class="product-item__title">{{ getName(product.name) }}</h2>
                                        <h4 class="product-item__price" v-if="product.unit">
                                            {{ product.price | number('0,0', {thousandsSeparator: ' '}) }}
                                            монет за 1 {{ getName(product.unit.name) }}</h4>
                                        <h4 class="product-item__price" v-else>
                                            {{ product.price | number('0,0', {thousandsSeparator: ' '}) }}
                                            монет</h4>

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

                                        <div class="share share-product">
                                            <p>Поделиться:</p>
                                            <ShareNetwork :url="url" network="facebook" :title="getName(product.name)">
                                                <i class="fab fa-facebook-f"></i>
                                            </ShareNetwork>

                                            <ShareNetwork :url="url" network="telegram" :title="getName(product.name)">
                                                <i class="fab fa-telegram"></i>
                                            </ShareNetwork>

                                            <ShareNetwork :url="url" network="vk" :title="getName(product.name)">
                                                <i class="fab fa-vk"></i>
                                            </ShareNetwork>

                                            <ShareNetwork :url="url" network="odnoklassniki"
                                                          :title="getName(product.name)">
                                                <i class="fab fa-odnoklassniki"></i>
                                            </ShareNetwork>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-lg-0 mt-md-3">
                                    <button type="button" v-if="!product.isCart && product.count !== 0 && loginInfo && coins >= product.price"
                                            data-target="#confirm-modal" data-toggle="modal" class="mb-4 mt-md-0 mt-4 btn btn-dark w-100">
                                        <img src="/vendor/site/img/exchange.svg" width="24px">
                                        Обменять на монет
                                    </button>
                                    <button type="button" disabled v-if="coins < product.price"
                                            data-target="#confirm-modal" data-toggle="modal" class="mb-4 mt-md-0 mt-4 btn btn-dark w-100">
                                        Не хватает монет
                                    </button>
                                    <button type="button" v-if="!loginInfo && coins >= product.price"
                                            data-target="#sing-in-1" data-toggle="modal"
                                            class="mb-4 mt-md-0 mt-4 btn btn-dark w-100">
                                        <img src="/vendor/site/img/exchange.svg" width="24px">
                                        Обменять на монет
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <coin-product-confirm :product="product.id" :count="count"></coin-product-confirm>
    </div>
</template>

<script>
import VueSocialSharing from 'vue-social-sharing'

export default {
    props: {
        productData: {},
        productsRelated: {},
        loginInfo: {},
        firstName: {},
        settingData: {},
        phoneProfile: {},
        coins: 0
    },

    components: {
        'ShareSocial': VueSocialSharing,
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
                    switch (lang) {
                        case "ru":
                            value = name.ru;
                            break;
                        case "uz":
                            value = name.uz;
                            break;
                        default:
                            value = name.ru;
                            break;
                    }
                } else {
                    value = name.ru;
                }

                return value;
            }
        },

        CountMinus() {
            let add = this.product.unit.count;

            if (this.count <= add) {
                return add;
            } else {
                this.count -= add;
            }
        },

        CountAdd() {
            let add = this.product.unit.count;

            if (this.product.count > this.count) {
                this.count += add;
            }
        },

        exchange() {

        }

    }

}
</script>

