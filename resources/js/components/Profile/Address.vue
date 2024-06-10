<template>
    <div>
        <div class="row mb-5">
            <div class="col-xl-5 mb-4" v-for="(address, index) in addresses">
                <div class="address-item shadow rounded p-3" >
                    <button class="bg-transparent border-0 float-right text-warning p-0" @click="editAddress(address)" data-toggle="modal" data-target="#address-edit">Изменить</button>
                    <h6>{{ address.name }}</h6>
                    <p class="w-75 mb-0" v-if="address.phone != 0">{{ $t('app.auth.phone') }}: +{{ address.phone }}</p>
                    <p class="w-75 mb-0">{{ address.city }}, {{ address.region }}, {{ address.address }}</p>
                </div>
            </div>
            <p v-if="addresses.length === 0">
                {{ $t('app.profile.address.no_data') }}
            </p>
        </div>

        <div class="d-flex justify-content-lg-start justify-content-center ">
            <button class="btn px-md-5 px-4 btn-dark" data-target="#address-add" data-toggle="modal">Добавить адрес</button>
        </div>

        <AddressStore></AddressStore>
        <AddressEdit :address-data="preview"></AddressEdit>

    </div>
</template>

<script>
    import AddressStore from './AddressStore'
    import AddressEdit from './AddressEdit'

    export default {
        name: "Address",

        components: {
            AddressStore,
            AddressEdit
        },

        props: ['addresses'],

        data() {
            return {
                preview: {}
            }
        },

        mounted() {
            // this.initMap();
        },

        methods: {
            editAddress(address) {
                this.preview = address
            }
        }
    }
</script>

<style scoped>
    .google-map {
        width: 100%;
        height: 450px;
    }
</style>
