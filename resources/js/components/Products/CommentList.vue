<template>
    <div class="comment-item my-3 border-bottom">
        <p class="float-right text-secondary">{{ comment.created_at }}</p>
        <h6>
            {{ comment.first_name }}
        </h6>
        <p  v-html="comment.body"></p>
    </div>
</template>

<script>
    export default {
        props: ['commentData'],

        data() {
            return {
                comment: this.commentData
            }
        }
    }
</script>

<style scoped>

</style>
