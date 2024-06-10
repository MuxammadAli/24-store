<template>
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content ">
                    <div class="table-responsive table-responsive-xl" >
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ $t('admin.products.name') }} RU</th>
                                <th scope="col">{{ $t('admin.products.name') }} Uz</th>
                                <th scope="col" width="150">Артикул</th>
                                <th scope="col" width="170">{{ $t('admin.products.price') }}</th>
                                <th scope="col">{{ $t('admin.products.brand') }}</th>
                                <th scope="col">Лидеры продаж</th>
                                <th scope="col">Популярные товары</th>
                                <th scope="col">Х-рка</th>
                                <th scope="col">{{ $t('admin.actions') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="products.length == 0">
                                <td class="text-center" colspan="9">
                                    {{ $t('admin.no_data') }}
                                </td>
                            </tr>


                            <tr v-for="(product, index) in products" :key="index">
                                <td>
                                    {{ product.name.ru }}
                                </td>

                                <td>
                                    {{ product.name.uz }}
                                </td>

                                <td>
                                    {{ product.article_number }}
                                </td>

                                <td>
                                    <span v-if="product.price_discount">
                                        <strike>{{ product.price }}</strike>
                                        {{ $t('admin.ye') }}
                                        <br>
                                        {{ product.price_discount }}
                                        {{ $t('admin.ye') }}
                                    </span>

                                    <span v-else>
                                        {{ product.price }} {{ $t('admin.ye') }}
                                    </span>
                                </td>

                                <td>
                                    {{ product.brand }}
                                </td>

                                <td>
                                    {{ product.leader_of_sales }}
                                </td>

                                <td>
                                    {{ product.popular }}
                                </td>

                                <td>
                                    <button type="button" @click="charView(product)" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#large">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>

                                <td class="text-right">
                                    <a href="#" @click="removeProduct(product, index)" class="btn btn-danger btn-icon">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                    </div>


                </div>

            </div>

            <button type="button" class="btn btn-success" @click="sendProducts">
                <i class="fa fa-save"></i> Сохранить
            </button>


        </div>

        <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Характеристики</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12" v-for="(char, index) in characteristics" :key="index">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <input type="text" disabled v-model="char.name.ru" class="form-control">
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group" v-if="char.type != 'checkbox'">
                                        <input :type="char.type" min="0" v-model="char_data[index]" class="form-control">
                                    </fieldset>

                                    <fieldset v-else>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" v-model="char_data[index]" >
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="saveChar" data-dismiss="modal">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            productsData: {},
            characteristicsData: {},
            categoryData: {}
        },

        data() {
            return {
                products: this.productsData,
                characteristics: this.characteristicsData.characteristics,

                category_id: this.categoryData,
                char_data: []
            }
        },

        methods: {
            removeProduct(product, index) {
                this.products.splice(index, 1)
            },

            charView(product) {
                this.char_data = product.characteristics;
            },

            saveChar() {
                this.char_data = [];
            },

            async sendProducts() {
                const fields = {
                    data: this.products,
                    category_id: this.category_id
                };

                const { data } = await axios.post('/dashboard/products/preview/store', fields);

                if (data.status) {
                    window.location = '/dashboard/products'
                }
            }
        }
    }
</script>

