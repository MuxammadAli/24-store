<template>
    <div>
        <button data-target="#basket" data-toggle="modal" type="button" @click="getPreviews" :class="mobile ? 'cart mx-4 bg-transparent border-0 p-0' : 'cart d-lg-inline-block d-none bg-transparent border-0 p-0'">
            <img src="/vendor/site/img/cart.svg" alt="heart icon">
            <span>
                <input type="text" id="basket-count" disabled v-model="basket">
            </span>
        </button>
    </div>
</template>

<script>
    // import { bus } from '../../vendor';
    export default {

        props: {
            loginInfo: {},
            mobile: {}
        },

        created() {
            this.$eventBus.$on('cart-basket', this.getPreviews)
        },

        data() {
            return {

                basket: 0,
            }
        },

        mounted() {
            this.getCount()
        },

        methods: {

            getPreviews() {
                this.$eventBus.$emit('cart-preview');
            },

            async getCount() {
                const { data } = await axios.get('/cart/basket/');

                if (data.status) {
                    this.basket = data.basket;
                }
            },


        }
    }
</script>

<style scoped>

</style>
