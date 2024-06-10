<template>
    <div class="modal fade" id="address-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                    <h4 class="modal-title">Редактировать адрес</h4>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="SendForm" class="px-md-3 pb-4 my-form">
                        <div class="container px-md-3 px-0">
                            <div class="row">
                                <div class="col-lg-12 mb-2" v-if="error">
                                    <div class="alert alert-danger">
                                        <i class="fa fa-info-circle"></i> Выберите адрес на карте
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="address-name">Название*</label>
                                        <input type="text" id="address-name" v-model="addressData.name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="address-city">Город*</label>
                                        <input type="text" id="address-city" v-model="addressData.city" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="address-district">Район*</label>
                                        <input type="text" id="address-district" v-model="addressData.region"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="address-square">Адрес*</label>
                                        <input type="text" id="address-square" v-model="addressData.address"  required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <label for="address-map">Показать на карте</label>
                                        <!--                                        <div id="map" style="width:100%;height:400px"></div>-->

                                        <yandex-map
                                                :coords="coords"
                                                :zoom="14"
                                                @click="onClick"
                                                :settings="settings"
                                        >
                                            <ymap-marker
                                                    :coords="coords"
                                                    marker-id="123"
                                                    hint-content="some hint"
                                            />
                                        </yandex-map>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-md-0 mt-4">
                                    <div class="row w-100 h-100 m-0">
                                        <div class="col-lg-8 h-100 w-100 ml-auto p-0 mt-3">
                                            <div class="d-flex  justify-content-end w-100 h-100 mb-2">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    {{ $t('app.auth.cancel') }}
                                                </button>
                                                <button type="submit" class="btn btn-dark ml-1">Сохранить изменения</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { yandexMap, ymapMarker } from 'vue-yandex-maps'

    export default {

        props: {
            addressData: {}
        },

        components: {
            yandexMap,
            ymapMarker
        },


        data() {
            return {

                coords: [41.311151, 69.279737],

                settings:  {
                    apiKey: '9e30b848-855b-45c9-9d65-e98e88a4c468',
                    lang: 'ru_RU',
                    coordorder: 'latlong',
                    version: '2.1'
                },

                error: false
            }
        },

        mounted() {
          this.coords = [
              this.addressData.lat,
              this.addressData.lng
          ]
        },

        watch: {
            addressData: function (newVal, oldVal) {
                this.coords = [
                    newVal.location.lat,
                    newVal.location.lng
                ]
            }
        },

        methods: {

            onClick(e) {
                this.coords = e.get('coords');
                this.addressData.location = {
                    lat: this.coords[0],
                    lng: this.coords[1],
                };
            },

            async SendForm() {
                if (!this.addressData.location.lat) {
                    this.error = true;
                    return;
                }

                try {
                    const { data } = await axios.put('/profile/address/' + this.addressData.id, {
                        address: this.addressData,
                        //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                    });

                    if (data.status) {
                        location.reload();
                    }

                } catch (error) {
                    this.error = true;
                }
            }
        }
    }
</script>

<style scoped>
    .ymap-container {
        width: 100%;
        height: 300px
    }
</style>
