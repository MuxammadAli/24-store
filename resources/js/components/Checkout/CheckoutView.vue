<template>
    <div>
        <section class="section-order">
            <div class="container">
                <div class="order-steps" :class="!login && step === 2 ? 'steps-two' : 'steps-three'">
                    <a href="/cart" class="order-steps__item ">
                        {{ $t('vue.cart.step_1') }}
                    </a>
                    <a href="#" :class="!login && step === 2 ? 'order-steps__item is-active' : 'order-steps__item'">
                        {{ $t('vue.cart.step_2') }}
                    </a>
                    <a href="#" :class="step === 3 ? 'order-steps__item is-active' : 'order-steps__item'">
                        {{ $t('vue.cart.step_3') }}
                    </a>
                </div>
            </div>
        </section>

        <section class="section-order" v-if="step === 2">
            <div class="container">
                <div class="bg-white rounded p-lg-4 p-3 mt-5">
                    <h4 class="text-center">{{ $t('vue.checkout.checkout_title2') }}</h4>
                    <h5 class="text-center my-3">
                        {{ $t('vue.checkout.checkout_title') }}
                    </h5>

                    <div class="row mt-4" style="min-height: 50vh;">
                        <div class="col-lg-4 col-md-8 mx-auto">
                            <form @submit.prevent="LoginSend" class="px-md-5 pb-4 my-form">
                                <div class="form-group mb-0">
                                    <label for="phone-for-order">Номер телефона</label>
                                    <input type="tel" class="phone" v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="phone-for-order" :placeholder="$t('vue.checkout.input_phone')" required>
                                    <div class="text-right" v-if="verify">
                                        <a href="#" @click="Resend"  class="resend-phone">{{ $t('app.auth.resend_sms') }}</a>
                                    </div>
                                </div>

                                <div class="form-group" v-if="verify">
                                    <label for="pwd">Введите код из СМС</label>
                                    <input type="tel" v-mask="'######'" v-model="user.code" :placeholder="$t('vue.checkout.input_sms_code')" id="pwd" required>
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" v-if="!verify" class="btn btn-dark px-lg-5">{{ $t('vue.checkout.get_code') }}</button>
                                    <button type="submit" v-if="verify"  class="btn btn-dark px-lg-5">{{ $t('vue.checkout.sign_in') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-order" v-if="step === 3">
            <div class="container">
                <div class="bg-white rounded p-lg-4 p-3 my-5">
                    <h4>
                        {{ $t('vue.cart.checkout_product') }}
                    </h4>

                    <form @submit.prevent="SendOrder" class="my-form mt-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="fist-name">Имя</label>
                                    <input type="text" v-model="order.first_name" placeholder="" id="fist-name" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="last-name">Фамилия</label>
                                    <input type="text" v-model="order.last_name" placeholder="" id="last-name" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="phone">Дополнительный контакт</label>
                                    <input type="tel" class="phone" v-mask="'+998 (##) ###-##-##'"  v-model="order.other_phone" placeholder="+998" required>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="phone">Адрес доставки</label>
                                    <select @change="changeAddress($event)">
                                        <option value="new">
                                            Добавить новый адрес
                                        </option>
                                        <option  v-for="(add, index) in addresses" :key="index" :value="index" :selected="index === 0">
                                            {{ add.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 my-3" >
                                <h6 v-if="addresses.length === 0 ">Если у вас нет сохраненных адресов, введите ниже</h6>
                            </div>

<!--                            <div class="col-lg-4 col-md-6 mb-3">-->
<!--                                <div class="form-group mb-0">-->
<!--                                    <label for="region">Регион доставки</label>-->
<!--                                    <input type="text" placeholder="" v-model="address.city" id="region" required>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="region">Регион</label>
                                    <select id="region" v-model="address.region_id" @change="handleRegion">
                                        <option v-for="region in regionsData" :value="region.id">{{ region.name.ru }}</option>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="col-lg-4 col-md-6 mb-3">-->
<!--                                <div class="form-group mb-0">-->
<!--                                    <label for="city-or-district">Город или район</label>-->
<!--                                    <input type="text" placeholder=""  v-model="address.region" id="city-or-district" required>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="city-or-district">Город или район</label>
                                    <select v-model="address.city_id" id="city-or-district">
                                        <option v-for="city in cities" :value="city.id">{{ city.name.ru }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="form-group mb-0">
                                    <label for="comment-on">Адрес</label>
                                    <input type="text" placeholder="" v-model="address.address" id="comment-on" required>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-7 mb-4">
                                <div class="form-group">
                                    <label for="pwd">Комментарий к заказу</label>
                                    <textarea v-model="order.comment" id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-5 mb-3">
                                <div class="form-group mb-0">
                                    <label for="comment-map">Найти на карте</label>

                                    <yandex-map
                                            :coords="coords"
                                            :zoom="14"
                                            @click="onClick"
                                            :settings="settings"
                                    >
                                        <ymap-marker
                                                :coords="coords"
                                                marker-id="123"
                                                hint-content="some hint"
                                        />
                                    </yandex-map>
                                </div>
                            </div>

                            <div class="col-12">
                                <h4 class="mb-4">{{ $t('vue.checkout.delivery_about_price') }}</h4>

                                <div class="payments">
                                    <div class="custom-control custom-radio custom-control-inline mr-4 mt-md-0 mt-3">
                                        <input type="radio" class="custom-control-input" id="payment1" name="payment" v-model="order.payment_type" value="cash">
                                        <label class="custom-control-label" for="payment1">
                                            <img style="transform: translateX(-35px);" src="/vendor/site/img/cash-icon.svg" alt="cash icon">
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mr-4 mt-md-0 mt-3">
                                        <input type="radio" class="custom-control-input" id="payment2" name="payment" v-model="order.payment_type" value="transfer">
                                        <label class="custom-control-label" for="payment2">
                                            <img style="transform: translateX(20px); object-fit: cover;" width="160px" src="/vendor/site/img/enumeration-checkout.png" alt="cash icon">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="text-right">{{ $t('vue.checkout.delivery_total_cost') }}: {{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</h4>


                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-dark px-lg-5">
                                {{ $t('vue.cart.checkout_product') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { yandexMap, ymapMarker } from 'vue-yandex-maps'

    export default {
        props: {
            cartData: {},
            loginInfo: {},
            pricesData: {},

            // regionsData: {},
            // deliveryPrice: {},
            // pickupInfo: {},
            // deliveryInfo: {},
            // pickupText: {},


            firstName: {},
            addressData: {},
            regionsData: {},

            coords: [41.311151, 69.279737],
        },

        components: {
            yandexMap,
            ymapMarker
        },

        data() {
            return {
                user: {
                    phone: null,
                    code: null,
                    type: 'checkout-login'
                    // action: action
                },

                addresses: this.addressData,

                prices: this.pricesData,

                address: {
                    id: null,
                    region: null,
                    city: null,
                    address: null,
                    location: {
                        lat: null,
                        lng: null
                    },
                    region_id: null,
                    city_id: null
                },

                cities: [],

                order: {
                    payment_type: 'cash',
                    first_name: this.firstName,
                    last_name: null,
                    other_phone: null,
                    comment: null,
                },

                verify: false,

                step: this.loginInfo ? 3 : 2,

                error: false,
                errors: [],
                error_type: null,
                cash: true,

                login: this.loginInfo
            }
        },

        mounted() {
            if (this.step === 3) {
                if (this.addresses.length > 0) {
                    this.address = {
                        id: this.addressData[0].id,
                        region: this.addressData[0].region,
                        city: this.addressData[0].city,
                        address: this.addressData[0].address,
                        location: this.addressData[0].location,
                        region_id: this.addressData[0].region_id,
                        city_id: this.addressData[0].city_id,
                    };

                    this.coords = [this.addressData[0].location.lat, this.addressData[0].location.lng];
                }
            }

            if (this.address.region_id) {
                for (const region of this.regionsData) {
                    if (region.id === this.address.region_id) this.cities = region.cities
                }
            }

            // this.cities = this.regions[0].cities;
            // this.address.city_id = this.cities[0] ? this.cities[0].id : null;
        },

        methods: {

            onClick(e) {
                this.coords = e.get('coords');
                this.address.location = {
                    lat: this.coords[0],
                    lng: this.coords[1],
                };
            },

            async LoginSend() {
                if (!this.verify) {
                    const { data } = await axios.post('/auth/login', {
                        phone: this.user.phone
                    });

                    this.verify = true;
                } else {

                    try {
                        const { data } = await axios.post('/auth/verify', this.user);
                        if (data.status) {
                            this.login = true;
                            this.step = 3;
                            this.error = false;
                            this.address.first_name = data.first_name;
                            this.address.address = data.address;

                            this.addresses = data.data.addresses;
                        }
                    } catch (error) {
                        this.error = true;
                    }
                }
            },

            async Resend () {
                if (this.verify) {
                    await axios.post('/api/auth/login', {
                        phone: this.user.phone
                    });
                }
            },

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

            async SendOrder() {
                var product_id = [];

                for (var i = 0; i < this.cartData.length; i++) {
                    product_id.push(this.cartData[i].id);
                }

                const fields = {
                    // delivery_type: this.order.delivery_type,
                    // delivery_price: this.order.delivery_price,
                    order: this.order,
                    products: product_id,

                    address: this.address,
                };

                try {
                    const { data } = await axios.post('/checkout', fields);
                    if (data.status) {
                        window.location.href = data.url
                    } else {
                        this.error = true;
                        this.errors = data.errors;
                        this.error_type = 'available';
                    }
                } catch (err) {
                    if (err.response.status === 422) {
                        this.error = true;
                        this.errors = err.response.data.errors;
                        this.error_type = 'validation';

                    }
                }
            },

            changeAddress(event) {
                let index = parseInt(event.target.value);

                if (event.target.value === 'new') {
                    this.address = {
                        id: null,
                        region: null,
                        city: null,
                        address: null,
                        location: {
                            lat: 41.311151,
                            lng: 69.279737
                        }
                    };

                    this.coords = [41.311151, 69.279737];
                } else {
                    let address = this.addressData[index];
                    this.address = {
                        id: address.id,
                        region: address.region,
                        city: address.city,
                        address: address.address,
                        location: address.location
                    };

                    this.coords = [address.location.lat, address.location.lng];
                }
            },

            handleRegion() {
                for (const region of this.regionsData) {
                    if (region.id === this.address.region_id) this.cities = region.cities
                }
            }
        }
    }
</script>

<style scoped>
    .ymap-container {
        width: 100%;
        height: 300px
    }
</style>
