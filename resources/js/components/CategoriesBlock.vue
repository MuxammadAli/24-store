<template>
    <nav class="big-menu-dropdown">
        <a href="#0" class="big-menu-close"><i class="fal fa-times"></i></a>
        <ul class="big-menu-dropdown-content">
            <li class="has-children" v-for="(category, index) in categories"  >
                <a :href="'/category/' + category.id + '/' + category.slug" class="link-item">
                    <i v-if="category.icon" :class="'far ' + category.icon"></i> {{ getName(category.name) }}
                </a>
                <ul class="big-menu-secondary-dropdown is-hidden">
                    <li class="go-back"><a href="#0">Категория</a></li>
                    <li class="has-children" v-for="(parent, index) in category.parents" v-if="parent.published">
                        <a class="d-lg-block d-none" :href="'/category/' + category.id + '/' + category.slug + '/' + parent.id + '/' + parent.slug">
                            {{ getName(parent.name) }}
                        </a>

                        <a class="d-lg-none" v-if="parent.parents.length === 0" :href="'/category/' + category.id + '/' + category.slug + '/' + parent.id + '/' + parent.slug">
                            {{ getName(parent.name) }}
                        </a>

                        <a v-else class="link-item d-lg-none" href="#00">
                            {{ getName(parent.name) }}
                        </a>

                        <ul class="is-hidden" v-if="parent.parents.length > 0">
                            <li class="go-back">
                                <a :href="`/category/${category.id}/${category.slug}/${parent.id}/${parent.slug}`">
                                    {{ getName(parent.name) }}
                                </a>
                            </li>
                            <li v-for="(child, index) in parent.parents"  v-if="child.published">
                                <a :href="'/category/' + category.id + '/' + category.slug + '/' + parent.id + '/' + parent.slug + '/' + child.id + '/' + child.slug">
                                    {{ getName(child.name) }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "CategoriesBlock",
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
