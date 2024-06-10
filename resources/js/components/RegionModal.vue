<template>
    <div class="modal fade" id="region">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                    <h4 class="modal-title">Выберите район</h4>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit" class="px-md-5 pb-4 my-form">
                        <div class="form-group">
                            <select v-model="region" @change="selectRegion" id="region_id">
                                <option v-for="region in regionsData" :value="region.id">{{ region.name.ru }}</option>
                            </select>
                            <div id="error" style="display: none" class="text-danger">Заполните поле</div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-dark">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "RegionModal",
    props: {
        regionsData: {}
    },
    data() {
        return {
            region: null
        }
    },
    methods: {
        selectRegion() {
            document.querySelector('#error').style.display = 'none'
        },
        submit() {
            if (!this.region) {
                document.querySelector('#error').style.display = 'initial'
                return
            }
            const form = new FormData
            form.append('region_id', this.region)
            axios.post('/set-region', form).then(response => {
                if (response.data.status === true) {
                    window.location.replace('')
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
