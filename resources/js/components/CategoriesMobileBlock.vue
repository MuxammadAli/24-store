<template>
    <div>
        <div class="card" v-for="(category, index) in categories" :key="index">
            <div class="card-header">
                <a class="card-link collapsed" data-toggle="collapse" :href="'#link' + index">
                    {{ getName(category.name) }}
                </a>
            </div>
            <div :id="'link' + index" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <div class="card" v-for="(parent, index_parrent) in category.parents" :key="index_parrent">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" :href="'#link' + index + '_child' + index_parrent" v-if="parent.parents.length > 0">
                                {{ getName(parent.name) }}
                            </a>

                            <a class="card-link collapsed" :href="'/category/' + category.id + '-' + category.slug + '/' + parent.id + '-' + parent.slug" v-else>
                                {{ getName(parent.name) }}
                            </a>
                        </div>
                        <div :id="'link' + index + '_child' + index_parrent" v-if="parent.parents.length > 0" class="collapse">
                            <div class="card-body">
                                <ul class="">
                                    <li v-for="(parent_child, indexx) in parent.parents" :key="indexx">
                                        <a :href="'/category/' + category.id + '-' +category.slug + '/' + parent.id + '-' + parent.slug + '/' + parent_child.id + '-' + parent_child.slug">
                                            {{ getName(parent_child.name) }}
                                        </a>
                                    </li>
                                </ul>
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
        name: "CategoriesMobileBlock",

        props: {
            categoriesData: {}
        },

        data() {
            return {
                categories: this.categoriesData
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

                // console.log(value);
                return value;

            },
        }
    }
</script>

<style scoped>

</style>
