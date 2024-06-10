<template>
    <div class="modal fade" id="confirm-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                    <h4 class="modal-title text-center">Вы уверены что хотите обменять товар?</h4>
                </div>
                <div class="modal-body">
                    <div class="px-md-5 pb-4 my-form">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    {{ $t('app.auth.cancel') }}
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-dark" @click="submit">
                                    Да
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ExchangeConfirmModal",
    props: {
        product: null,
        count: null
    },
    methods: {
        submit() {
            axios.post('/coin-product/order', {
                product: this.product,
                count: this.count
            }).then(response => {
                if (response.data.status === true) window.location.replace('')
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
