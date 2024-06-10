<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card alert-danger" v-if="errors.length !== 0">
                    <div class="card-body">
                        <ul style="list-style: none">
                            <li v-for="error in errors">
                                <i class="feather icon-alert-circle"></i> <span v-for="err in error">{{ err }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Причины возврата</h4>
                    </div>
                    <div class="card-body">
                        <form action="" @submit.prevent="submit">
                            <div class="row">
                                <div class="col-5" v-for="(reason, i) in reasons">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="hidden" :name="`reasons[${i}][id]`" v-model="reasons[i].id">
                                            <input type="text" :name="`reasons[${i}][title]`" placeholder="Причина" v-model="reasons[i].title"
                                                   class="form-control" aria-describedby="button-addon">
                                            <div class="input-group-append" id="button-addon">
                                                <button class="btn btn-danger btn-icon" type="button" @click="deleteReason(i)"
                                                        data-toggle="tooltip" title="Удалить">
                                                    <i class="feather icon-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-icon" type="button" data-toggle="tooltip" @click="addReason"
                                                title="Добавить">
                                            <i class="feather icon-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button v-if="!loading" class="btn btn-primary btn-icon">
                                            <i class="feather icon-file-text"></i>
                                            Сохранить
                                        </button>
                                        <button v-else class="btn btn-primary btn-icon">
                                            <i class="fa fa-spinner fa-spin"></i>
                                            Загрузка
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Reasons",
    props: {
        reasonsData: {}
    },
    data() {
        return {
            loading: false,
            reasons: this.reasonsData,
            deletes: [],
            errors: []
        }
    },
    methods: {
        deleteReason(i) {
            let id = this.reasons[i].id
            if (id) this.deletes.push(id)
            this.reasons.splice(i, 1)
        },
        addReason() {
            this.reasons.push({
                id: null,
                title: ''
            })
        },
        submit(event) {
            this.loading = true
            const form = new FormData

            form.append('_method', 'put')

            for (const [index, reason] of this.reasons.entries()) {
                if (reason.id) form.append(`reasons[${index}][id]`, reason.id)
                form.append(`reasons[${index}][title]`, reason.title)
            }
            for (const [index, del] of this.deletes.entries())
                form.append(`deletes[${index}]`, del)

            axios.post('', form).then(res => {
                this.loading = false
                if (res.status === 204) window.location.reload()
            }).catch(err => {
                this.loading = false

                if (err.response.data.errors) this.errors = err.response.data.errors
            })

        }
    }
}
</script>

<style scoped>

</style>
