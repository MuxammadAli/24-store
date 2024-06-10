<template>
    <div class="modal fade" id="export-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Export</h4>
                    <button class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label>Категория</label>
                            <multiselect
                                :options="categoriesData"
                                v-model="categories"
                                name="categories"
                                multiple="true"
                                label="category"
                                track-by="category"
                            ></multiselect>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="all" id="checkbox">
                                <label class="form-check-label" for="checkbox">
                                    Все
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i> Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductsExport",
    props: {
        categoriesData: {}
    },
    data() {
        return {
            categories: null,
            all: false
        }
    },
    methods: {
        submit() {
            if (!this.all) {
                let categories = []
                for (const category of this.categories) {
                    categories.push(category.id)
                }
                window.location.replace('/dashboard/products/export?categories='+JSON.stringify(categories))
            } else window.location.replace('/dashboard/products/export?all=1')
        }
    }
}
</script>

<style scoped>

</style>
