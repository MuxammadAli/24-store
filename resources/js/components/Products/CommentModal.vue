<template>
    <div class="modal fade" id="comments">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                    <h4 class="modal-title">{{ $t('vue.cart.review.create') }}</h4>
                </div>
                <div class="modal-body">
                    <h6 class="text-center mb-2">{{ $t('vue.cart.review.subtitle') }}</h6>

                    <div class="px-md-5  my-form" v-if="store">
                        <div class="alert alert-info ">
                            <i class="fa fa-info-circle"></i> {{ $('vue.cart.review.success') }}
                        </div>
                    </div>

                    <form @submit.prevent="StoreComment" action="" class="px-md-5 pb-4 my-form">
                        <div class="form-group mb-0">
                            <textarea v-model="comment.body" :placeholder="$t('vue.cart.review.your_review')" id="" cols="30" rows="5"></textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-dark px-5">{{ $t('vue.cart.review.create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentModal",

        props: {
            product: {}
        },

        data() {
            return {
                comment: {
                    // star: 0,
                    body: '',
                    // first_name: this.firstName
                },

                store: false
            }
        },

        methods: {
            async StoreComment() {
                const { data } = await axios.post('/product/' + this.product.id +'/comment/', this.comment);

                if (data.status) {
                    this.comment = {
                        // star: 0,
                        body: '',
                        // first_name: this.firstName
                    };

                    this.store = true;
                }
            }
        }
    }
</script>

<style scoped>

</style>
