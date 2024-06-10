<template>
    <section class="section-news">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">{{ $t('vue.news.news_title') }}
                    <img src="/vendor/site/img/news.svg" alt="news img">
                </h2>

                <a href="/blog/news" class="all_link">
                    {{ $t('vue.catalog.view_by_all') }}
                </a>
            </div>

            <NewsSlider :posts-data="postsSlider"></NewsSlider>
        </div>
    </section>
</template>

<script>
    import NewsSlider from './NewsSlider';

    export default {
        props: ['postsData'],

        data() {
            return {
                postsSlider: this.postsData
            };
        },
        components: {
            NewsSlider
        },

        mounted() {

        },

        methods: {
        }

    }
</script>

<style scoped>

</style>
