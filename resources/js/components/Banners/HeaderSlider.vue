<template>
    <section class="section-banner">
        <div class="container">
            <swiper ref="mySwiperHeader" class="swiper-container swiper-banner" :options="swiperOptions">
                <swiper-slide v-for="(slider, index) in sliderData" :key="index">
                    <div class="banner">
                        <a :href="slider.link"><img :src="'/' + slider.image" alt="banner image"></a>
                    </div>
                </swiper-slide>

                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-next-banner swiper-button-white" slot="button-next"></div>
                <div class="swiper-button-prev swiper-button-prev-banner swiper-button-white" slot="button-prev"></div>

                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-white" slot="pagination"></div>
            </swiper>
        </div>
    </section>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
// import "swiper/swiper-bundle.css";
import 'swiper/css/swiper.css'

export default {
  props: ['sliderData'],

  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      swiperOptions: {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
          nextEl: ".swiper-button-next-banner",
          prevEl: ".swiper-button-prev-banner",
        },
        pagination: {
          el: ".swiper-pagination-white",
          clickable: true,
        },
        loop: true,
        effect: "fade",
        speed: 1000,
        autoplay: {
          delay: 6000,
        },
      },
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiperHeader.$swiper;
    },
  },
};
</script>

<style scoped lang="scss">
$breakpoints: (
  "phone-smallest": 251px,
  "phone-small": 321px,
  "phone": 400px,
  "phone-wide": 480px,
  "phablet": 560px,
  "tablet-small": 640px,
  "tablet": 768px,
  "tablet-wide": 1024px,
  "desktop": 1248px,
  "desktop-wide": 1440px,
  "desktop-large": 2500px,
);

.swiper-banner {
    padding-top: 30px;
}

@mixin mq($width, $type: min) {
  @if map_has_key($breakpoints, $width) {
    $width: map_get($breakpoints, $width);

    @if $type==max {
      $width: $width - 1px;
    }

    @media only screen and (#{$type}-width: $width) {
      @content;
    }
  }
}
</style>
