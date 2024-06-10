<template>
    <div v-swiper:mySwiper="swiperOptions" class="swiper-container swiper-popular-product swiper-product">
        <div class="swiper-wrapper ml-4">
            <div class="swiper-slide" v-for="(brand, index) in brands" :key="index" >
                <img :src="'/' + brand.image" width="135" height="75" style="object-fit: contain" alt="">
            </div>
        </div>
        <div class="swiper-button-next swiper-button-next-product swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-prev-product swiper-button-white"></div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
//import "swiper/swiper-bundle.css";
import Product from './Products/Product.vue';
import 'swiper/css/swiper.css'

export default {
    props: {
        brandsData: {},
    },
    components: {
        Swiper,
        SwiperSlide,
        Product
    },

    directives: {
        swiper: directive
    },

    data() {
        return {
            swiperOptions: {
                spaceBetween: 20,
                navigation: {
                    nextEl: ".swiper-button-next-product",
                    prevEl: ".swiper-button-prev-product",
                },
                // pagination: {
                //     el: ".swiper-pagination-product",
                //     dynamicBullets: true,
                // },
                breakpoints: {
                    1200: {
                        slidesPerView: 5,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    576: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1.3,
                    },
                },
                autoplay: {
                    delay: 4000,
                },
            },
            brands: this.brandsData,
        };
    },
    computed: {
        swiper() {
            return this.$refs.mySwiper.$swiper;
        },
    },
};
</script>

<style scoped lang="scss">


</style>
