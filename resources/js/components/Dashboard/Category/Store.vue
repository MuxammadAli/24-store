<template>
    <div class="row">
        <form class="form form-vertical w-100" @submit.prevent="saveForm" action="#" enctype="multipart/form-data" method="post">

            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $t('admin.add') }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                                <div class="form-body">
                                    <p>{{ $t('admin.all_fields_with') }}</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">{{ $t('admin.categories.name') }} UZ *</label>
                                                        <input type="text" id="first-name-vertical" v-model="category.name.uz" required class="form-control "
                                                               name="name[uz]" :placeholder="$t('admin.categories.name') + ' UZ'">

                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nameru">{{ $t('admin.categories.name') }} RU *</label>
                                                        <input type="text" id="nameru" required v-model="category.name.ru" class="form-control"
                                                               name="name[ru]" :placeholder="$t('admin.categories.name') +  ' RU'">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-12">

                                            <div class="form-group">
                                                <label for="first-icon-vertical">Икон</label>
                                                <input type="text" id="first-icon-vertical" v-model="category.icon"  class="form-control "
                                                       name="name[uz]" placeholder="fa-mobile">

                                            </div>

                                            <div class="form-group">
                                                <label for="position">{{ $t('admin.categories.position') }} *</label>
                                                <input type="text" id="position" required class="form-control" v-model="category.position" name="position" :placeholder="$t('admin.categories.position')">
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input id="uploadImage" class="custom-file-input" type="file"
                                                           name="image" @change="ImageFile($event)" onchange="PreviewImage();" />
                                                    <label class="custom-file-label">{{ $t('admin.categories.image') }}</label>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <img id="uploadPreview" style="width: 300px; height: auto" />
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>{{ $t('admin.brands.title') }} *</label>

                                                <multiselect
                                                        :options="brandsData"
                                                        v-model="category.brands"
                                                        :multiple="true"
                                                        :taggable="true"
                                                        label="name"
                                                        track-by="name"></multiselect>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <h3>
                                                        Характеристики
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12" v-for="(char, index) in char" :key="index">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label :for="'first-name-vertical-uz' + index">{{ $t('admin.categories.char.name') }} UZ *</label>
                                                                <input type="text" :id="'first-name-vertical-uz' + index" v-model="char.name.uz" required class="form-control"
                                                                       name="name[uz]"  :placeholder="$t('admin.categories.name') + ' UZ'">

                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label :for="'first-name-vertical-ru' + index">{{ $t('admin.categories.char.name') }} RU *</label>
                                                                <input type="text" :id="'first-name-vertical-ru' + index" v-model="char.name.ru" required class="form-control "
                                                                       name="name[uz]"  :placeholder="$t('admin.categories.name')  + ' RU'">

                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <div class="form-group">
                                                                <label :for="'type' + index">{{ $t('admin.categories.char.type') }}  *</label>
                                                                <select class="form-control" :id="'type' + index" v-model="char.type">
                                                                    <option value="text">Text</option>
                                                                    <option value="number">Number</option>
                                                                    <option value="checkbox">checkbox</option>
                                                                    <option value="select">select</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-1">
                                                            <fieldset>
                                                                <label >Фильтр</label>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" v-model="char.filter" >
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="col-1">
                                                            <button @click="removeChar(index)" class="btn btn-danger mt-2" type="button" >
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <button type="button" class="btn btn-warning" @click="addChar">
                                                <i class="fa fa-plus"></i> Добавить характеристики
                                            </button>



                                            <div class="controls mt-1" v-if="">
                                                <button id="add_cat" type="button" class="btn btn-outline-primary w-100">{{ $t('admin.categories.add_cat') }}</button>
                                                <button id="remove_cat" type="button" class="btn btn-secondary w-100">{{ $t('admin.categories.remove_cat') }}</button>

                                                <br>
                                                <br>
                                                <div id="sub_cat" class="controls">
                                                    <label>{{ $t('admin.categories.sub_category') }}</label>
                                                    <select class="form-control" v-model="category.parent_id">
                                                        <option value="0">{{ $t('admin.categories.choose_cat') }}</option>

                                                        <option v-for="(category, index) in categoriesData" :key="index" :value="category.id">
                                                            {{ getName(category.name) }}
                                                            <span v-if="category.parent">
                                                               ( {{ getName(category.parent.name) }} )
                                                            </span>
                                                        </option>

                                                    </select>
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
                        <h4 class="card-title">SEO</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nameru">Title Seo RU *</label>
                                        <input type="text" v-model="category.title_seo.ru" id="nameru" class="form-control" placeholder="Title Seo RU *">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Title Seo UZ *</label>
                                        <input type="text" v-model="category.title_seo.uz" id="name" class="form-control" placeholder="Title Seo UZ *">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control"  v-model="category.keywords.ru" id="label-keywords-ru" rows="3" :placeholder="$t('admin.settings.keywords') + ' RU'"></textarea>
                                                <label for="label-keywords-ru">{{ $t('admin.settings.keywords') }} RU *</label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control"  v-model="category.keywords.uz" id="label-keywords" rows="3" :placeholder="$t('admin.settings.keywords') + ' UZ'"></textarea>
                                                <label for="label-keywords">{{ $t('admin.settings.keywords') }} UZ *</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control"  v-model="category.descriptions.ru" id="label-description-ru" rows="3" :placeholder="$t('admin.settings.description') + ' RU'"></textarea>
                                                <label for="label-description-ru">{{ $t('admin.settings.description') }} RU *</label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 float-left">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control"  v-model="category.descriptions.uz" id="label-description" rows="3" :placeholder="$t('admin.settings.description') + ' UZ'"></textarea>
                                                <label for="label-description">{{ $t('admin.settings.description') }} UZ *</label>
                                            </fieldset>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12" v-if="error">
                    <div class="alert alert-danger mt-2">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                            <span v-for="msg in error" :key="msg">
                                {{ msg }}
                            </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group mt-1">
                                <fieldset class="checkbox">
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" value="1" name="popular" v-model="category.popular">
                                        <span class="vs-checkbox">
                                        <span class="vs-checkbox--check">
                                            <i class="vs-icon feather icon-check"></i>
                                        </span>
                                    </span>

                                        <span class="">
                                        Добавить в "Популярные категории"
                                    </span>
                                    </div>
                                </fieldset>

                                <fieldset class="checkbox">
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" value="1" name="popular" v-model="category.published">
                                        <span class="vs-checkbox">
                                        <span class="vs-checkbox--check">
                                            <i class="vs-icon feather icon-check"></i>
                                        </span>
                                    </span>

                                        <span class="">
                                        Опубликовать
                                    </span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="card-footer pb-0 pl-0 pt-1">
                            <div class="col-12 mb-0">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                            <i class="feather icon-save"></i> {{ $t('admin.save') }}
                                        </button>
                                    </div>

                                    <div class="col-9">
                                        <a href="/dashboard/categories" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                            <i class="feather icon-x-circle"></i> {{ $t('admin.cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['brandsData', 'categoriesData'],

        data() {
            return {
                category: {
                    name: {
                        uz: '',
                        ru: ''
                    },

                    icon: null,

                    published: true,
                    position: 0,
                    brands: [],

                    popular: false,
                    parent_id: 0,

                    descriptions: {
                        uz: '',
                        ru: ''
                    },

                    keywords: {
                        uz: '',
                        ru: ''
                    },

                    title_seo: {
                        uz: '',
                        ru: ''
                    },

                    image: null
                },

                char: [],

                error: false,
                errors: [],
            }
        },

        methods: {

            getName(name) {
                const lang = document.documentElement.lang.substr(0, 2);
                let value = '';

                if (lang) {
                    switch(lang){
                        case "ru":
                            value = name.ru;
                            break;
                        case "uz":
                            value = name.uz;
                            break;
                    }
                } else {
                    value = name.ru;
                }

                return value;
            },

            async saveForm () {
                const header = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                const formData = new FormData();
                formData.append('name[ru]', this.category.name.ru);
                formData.append('name[uz]', this.category.name.uz);

                formData.append('position', this.category.position);

                //formData.append('brands', this.category.brands);
                formData.append('parent_id', this.category.parent_id);
                formData.append('popular', this.category.popular);
                formData.append('image', this.category.image);
                formData.append('published', this.category.published);
                formData.append('descriptions[ru]', this.category.descriptions.ru);
                formData.append('descriptions[uz]', this.category.descriptions.uz);
                formData.append('keywords[ru]', this.category.keywords.ru);
                formData.append('keywords[uz]', this.category.keywords.uz);

                formData.append('icon', this.category.icon);

                formData.append('title_seo[ru]', this.category.title_seo.ru);
                formData.append('title_seo[uz]', this.category.title_seo.uz);

                for (var i = 0; i < this.category.brands.length; i++) {
                    formData.append('brands['+ i +']', this.category.brands[i].id);
                }

                for (var i = 0; i < this.char.length; i++) {
                    formData.append('char['+ i +'][name][ru]', this.char[i].name.ru);
                    formData.append('char['+ i +'][name][uz]', this.char[i].name.uz);
                    formData.append('char['+ i +'][type]', this.char[i].type);
                    formData.append('char['+ i +'][filter]', this.char[i].filter);
                }


                axios.post('/dashboard/categories/store', formData, header).then((response) => {
                    if (response.data.status) {
                        window.location.href = "/dashboard/categories";
                    }
                }).catch((error) => {
                    if (error.response) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                });

            },

            ImageFile(event) {
                this.category.image = event.target.files[0]
            },

            addChar() {
                this.char.push({
                    name: {
                        ru: '',
                        uz: ''
                    },
                    type: 'text',
                    filter: false
                })
            },

            removeChar(index) {
                this.char.splice(index, 1)
            }
        }
    }
</script>

<style scoped>

</style>
