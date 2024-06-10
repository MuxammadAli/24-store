<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-12">
                <form class="form form-vertical" @submit.prevent="UpdateProduct">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Редактировать</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <p>Все поля обозначенные * обязательные</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nameru">Названия RU *</label>
                                                        <input type="text" v-model="products.name.ru" required id="nameru" class="form-control" placeholder="Названия RU *">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name">Названия UZ *</label>
                                                        <input type="text" v-model="products.name.uz" required id="name" class="form-control" placeholder="Названия UZ *">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="price">Цена *</label>
                                                <input type="number" min="0.01" v-model="products.price" step="0.01" required id="price" class="form-control" placeholder="Цена">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="count_product">Количество товаров на складе *</label>
                                                <input type="number" v-model="products.count" id="count_product" class="form-control" placeholder="Количество товаров на складе">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link active" id="ru-tab" data-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="true">RU</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link" id="uz-tab" data-toggle="tab" href="#uz" role="tab" aria-controls="uz" aria-selected="false">UZ</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="tab-content w-100" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-tab">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Короткая описания RU</label>
                                                                        <textarea cols="3" @keyup="remaincharRUCount" :class="this.products.short_body.ru && this.products.short_body.ru.length > 300 ? 'form-control is-invalid' : 'form-control'" v-model="products.short_body.ru"></textarea>
                                                                        {{ this.short_limit.ru }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Описания RU</label>
                                                                        <ckeditor :editor="editor" v-model="products.body.ru"></ckeditor>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz-tab">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Короткая описания UZ</label>
                                                                        <textarea cols="3" @keyup="remaincharUZCount"  :class="this.products.short_body.uz &&  this.products.short_body.uz.length > 300 ? 'form-control is-invalid' : 'form-control'" v-model="products.short_body.uz"></textarea>
                                                                        {{ this.short_limit.uz }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Описания UZ</label>
                                                                        <ckeditor :editor="editor" v-model="products.body.uz"></ckeditor>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Изображения</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <VueFileAgent
                                                ref="vueFileAgent"
                                                :theme="'default'"
                                                :multiple="true"
                                                :deletable="true"
                                                :meta="true"
                                                :accept="'image/*'"
                                                :maxSize="'10MB'"
                                                :maxFiles="14"
                                                :sortable="'handle'"
                                                :helpText="'Choose images or zip files'"
                                                :errorText="{
                                                                  type: 'Invalid file type. Only images or zip Allowed',
                                                                  size: 'Files should not exceed 10MB in size',
                                                                }"
                                                @select="filesSelected($event)"
                                                @beforedelete="fileDeleted($event)"
                                                v-model="products.screens"
                                            ></VueFileAgent>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-danger" v-if="error">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                <span v-for="msg in error" :key="msg">
                                    {{ msg }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" v-model="products.published">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                        <span class="">Публиковать</span>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" v-model="products.available">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                        <span class="">В наличии</span>
                                    </div>
                                </fieldset>
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
                                            <a href="/dashboard/products" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                                <i class="feather icon-x-circle"></i> {{ $t('admin.cancel') }}
                                            </a>
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
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    props: {
        categories: {},
        product: {},
    },

    data: function() {
        return {
            editor: ClassicEditor,

            short_limit: {
                ru: 'Осталось 300 символов.',
                uz: 'Осталось 300 символов.'
            },
            products: this.product,
            error: false,
            errors: [],
            files: [],
            deletes: {
                screens: []
            },
        }
    },

    mounted() {
        this.remaincharRUCount();
        this.remaincharUZCount();
        this.setCategory();
    },

    methods: {
        async UpdateProduct() {
            const header = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };

            const formData = new FormData();
            formData.append('name[ru]', this.products.name.ru);
            formData.append('name[uz]', this.products.name.uz);
            formData.append('body[ru]', this.products.body.ru);
            formData.append('body[uz]', this.products.body.uz);
            formData.append('short_body[ru]', this.products.short_body.ru);
            formData.append('short_body[uz]', this.products.short_body.uz);
            formData.append('published', this.products.published);
            formData.append('count', this.products.count);
            formData.append('available', this.products.available);
            formData.append('price', this.products.price);

            for (const [index, screen] of this.products.screens.entries()) {
                if (screen.id) {
                    formData.append('screens[' + index + '][id]', screen.id);
                } else {
                    formData.append('screens[' + index + '][id]', null);
                }

                formData.append('screens['+ index +'][image]', screen.file);
            }
            for (let i = 0; i < this.deletes.screens.length; i++) {
                formData.append('deletes[screens]['+ i +']', this.deletes.screens[i]);
            }

            formData.append('_method', 'put')

            axios.post('/dashboard/coin-product/update/' + this.products.id, formData, header).then((response) => {
                if (response.data.status) {
                    window.location.href = "/dashboard/coin-product";
                }
            }).catch((error) => {
                if (error.response) {
                    this.error = true;
                    this.errors = error.response.data.errors;
                }
            });

        },

        remaincharRUCount: function(){

            if (this.products.short_body.ru) {
                if(this.products.short_body.ru.length > 300){
                    this.short_limit.ru = "Превышен лимит в 300 символов.";
                } else {
                    let remainCharacters = 300 - this.products.short_body.ru.length;
                    this.short_limit.ru = "Осталось " + remainCharacters + " символов.";
                }

            }

        },

        remaincharUZCount: function(){

            if (this.products.short_body.uz) {
                if(this.products.short_body.uz.length > 300){
                    this.short_limit.uz = "Превышен лимит в 300 символов.";
                } else {
                    let remainCharacters = 300 - this.products.short_body.uz.length;
                    this.short_limit.uz = "Осталось " + remainCharacters + " символов.";
                }
            }

        },

        filesSelected: function(filesDataNewlySelected, index) {
            let validFilesData = filesDataNewlySelected.filter((fileData) => !fileData.error);
            this.products.filesDataForUpload = this.products.filesDataForUpload.concat(validFilesData);
        },

        fileDeleted: function(fileData, index) {
            // console.log(fileData);
            // console.log('index' + index);
            let i = this.products.screens.indexOf(fileData);

            if (i !== -1) {

                this.products.screens.splice(i, 1);
                let id = fileData.id ? fileData.id : null ;

                if (fileData.id) {
                    this.deletes.screens.push(id)
                }
            }
        },
    }
}
</script>

<style scoped>

</style>
