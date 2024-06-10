<template>
    <div class="modal fade" id="sing-in-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                    <h4 class="modal-title">Авторизация</h4>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="SendForm" class="px-md-5 pb-4 my-form">
                        <div class="form-group mb-0">
                            <label for="phone_auth">
                                {{ $t('app.auth.phone') }}
                            </label>
                            <input type="tel" id="phone_auth" :placeholder="$t('app.auth.enter_phone')" v-mask="'+998 (##) ###-##-##'" v-model="user.phone" required>
                            <div class="text-right" v-if="verify">
                                <a href="#" @click="Resend" class="resend-phone">
                                    {{ $t('app.auth.resend_sms') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group"  v-if="verify">
                            <label for="sms_verify">{{ $t('app.auth.enter_sms') }}</label>
                            <input type="tel" class="" v-mask="'####'" id="sms_verify" :placeholder="$t('app.auth.sms')" v-model="user.verify" required>
                        </div>

                        <div class="text-danger mt-1" v-if="error">
                            {{ $t('vue.login.sms_empty') }}
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                {{ $t('app.auth.cancel') }}
                            </button>
                            <button type="submit" class="btn btn-dark" v-if="verify">
                                {{ $t('app.layout.login') }}
                            </button>
                            <button type="submit" class="btn btn-dark" v-if="!verify" >
                                {{ $t('app.auth.send_to_sms') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        props: ['url'],

        data: () => ({
            user: {
                phone: null,
                verify: null
            },

            verify: false,

            error: false
        }),


        methods: {
            async SendForm () {
                if (!this.verify) {
                    const { data } = await axios.post('/auth/login', {
                        phone: this.user.phone
                    });

                    this.verify = true;
                } else {
                    try {
                        let type;
                        let action;

                        if (this.$cookie.get('product-credit')) {
                            type = 'product-credit';
                            action = this.$cookie.get('product-credit');
                        } else if (this.$cookie.get('cart-preview')) {
                            type = 'cart-preview';
                            action = 'cart-preview';
                        } else {
                            type = 'auth';
                            action = null;
                        }

                        const { data } = await axios.post('/auth/verify', {
                            phone: this.user.phone,
                            code: this.user.verify,
                            type: type,
                            action: action
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });
                        if (data.status) {
                            switch (data.action) {
                                case 'cart-preview':
                                    window.location.href = data.url;
                                    this.$cookie.delete('cart-preview');
                                    break;
                                case 'product-credit':
                                    window.location.href = data.url;
                                    this.$cookie.delete('product-credit');
                                    break;
                                default:
                                    location.reload();
                                    this.$cookie.delete('product-credit');
                                    this.$cookie.delete('cart-preview');
                                    break;
                            }

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
            }
        }
    }
</script>

<style scoped>

</style>
