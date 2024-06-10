<template>
    <div>
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Редактировать</h4>
                </div>
                <div class="card-content">
                    <form class="form form-vertical" @submit.prevent="Update">
                        <div class="card-body">
                            <div class="form-body">
                                <p>Все поля обозначенные * обязательные</p>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="ru">Названия RU *</label>
                                                    <input type="text" id="ru" class="form-control" v-model="title.ru"placeholder="Названия RU *">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="uz">Названия UZ *</label>
                                                    <input type="text" id="uz" class="form-control" v-model="title.uz" placeholder="Названия UZ *">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12" v-if="compilation.type == 'default'">
                                        <div class="form-group">
                                            <label for="category">Категория</label>
                                            <select id="category" class="form-control" v-model="category_id">
                                                <option value="0">Все</option>
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name.ru }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12" v-if="compilation.type == 'default'">
                                        <div class="form-group">
                                            <label>Продукты *</label>

                                            <multiselect v-model="compilations"
                                                         placeholder="Искать"
                                                         label="name"
                                                         track-by="name"
                                                         :options="products"
                                                         :option-height="104"
                                                         :custom-label="customLabel"
                                                         :show-labels="false"
                                                         @search-change="SearchProduct"
                                                         :multiple="true"
                                            >

                                                <template slot="singleLabel" slot-scope="props">
                                                    <img class="option__image" :src="props.option.poster" width="50" alt="No Man’s Sky">
                                                    <span class="option__desc">
                                                            <span class="option__title">{{ props.option.name }}</span>
                                                        </span>
                                                </template>

                                                <template slot="option" slot-scope="props">
                                                    <img class="option__image" :src="props.option.poster" width="50" alt="No Man’s Sky">
                                                    <div class="option__desc">
                                                        <span class="option__title">{{ props.option.name }}</span>
                                                    </div>
                                                </template>
                                            </multiselect>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Выбранные продукты</label>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <SlickList lockAxis="y" v-model="compilations" pressDelay="700" tag="tbody">
                                                        <SlickItem v-for="(product, index) in compilations" :index="index" :key="index" tag="tr">
                                                            <td>
                                                                <img :src="product.poster" width="100" >
                                                            </td>
                                                            <td>
                                                                {{ product.name }}
                                                            </td>
                                                            <td v-if="compilation.type == 'default'">
                                                                <a href="#" @click="Delete(index)" class="btn btn-danger btn-sm btn-icon">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </SlickItem>
                                                    </SlickList>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="position">Позиция</label>
                                            <input type="number" id="position" placeholder="Позиция" v-model="position" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" v-model="published">
                                                <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                                <span class="">Публиковать</span>
                                            </div>
                                        </fieldset>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-12 mb-0">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                            <i class="feather icon-save"></i> {{ $t('admin.save') }}
                                        </button>
                                    </div>

                                    <div class="col-9">
                                        <a href="/dashboard/compilations" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                            <i class="feather icon-x-circle"></i> {{ $t('admin.cancel') }}
                                        </a>
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
    import { SlickList, SlickItem } from 'vue-slicksort';

    export default {
        props: {
            compilation: {},
            categories: {}
        },
        components: {
            SlickItem,
            SlickList
        },

        data: function() {
            return {
                title: {
                    ru: this.compilation.title.ru,
                    uz: this.compilation.title.uz,
                },
                published: this.compilation.published,

                compilations: this.compilation.products,
                category_id: this.compilation.category_id,

                position: this.compilation.position,

                products: []
            }
        },

        mounted() {

        },

        methods: {
            customLabel ({ name }) {
                return `${name}`
            },

            async Update() {
                const array = {
                    title: this.title,
                    products: this.compilations,
                    published: this.published,
                    category_id: this.category_id,
                    position: this.position
                };
                const { data } = await axios.post('/dashboard/compilations/update/' + this.compilation.id, array);

                if (data.status) {
                    window.location.href = "/dashboard/compilations";
                }
            },

            async SearchProduct(query) {
                let name = query;

                if (name.length > 0) {
                    axios.post('/dashboard/compilations/product/search', { name: name})
                        .then((response) => {
                            if (response.data.status) {
                                this.products = response.data.products;
                            }
                        }).catch((error) => {
                        if (error.response) {
                            this.error = true;
                            this.errors = error.response.data.errors;
                        }
                    });
                }

                console.log(query);
            },

            Delete(index) {
                this.compilations.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>
