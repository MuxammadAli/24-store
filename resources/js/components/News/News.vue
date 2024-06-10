<template>
    <div class="news">
        <div class="news-header">
            <a :href="'/blog/news/' + postData.id + '-' + postData.slug">
                <img :src="'/' + postData.image" :alt="postData.name" >
            </a>
        </div>
        <div class="news-body">
            <p class="news-date">
                {{ postData.date }}
            </p>
            <h3 class="news-title">
                <a :href="'/blog/news/' + postData.id + '-' + postData.slug">
                    {{ postData.name }}
                </a>
            </h3>
        </div>
    </div>
</template>

<script>
    export default {
        name: "News",
        props: ['postData'],
    }
</script>

<style scoped>

</style>
