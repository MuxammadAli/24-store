<template>
    <div>
        <div class="form-group">
            <b>Оповещения о наличии</b>
        </div>
        <div class="row">
            <div class="col-5" v-for="(email, i) in emails">
                <div class="form-group">
                    <div class="input-group">
                        <input type="email" :name="`notification_emails[${i}]`" placeholder="Email" v-model="emails[i]"
                               class="form-control" aria-describedby="button-addon">
                        <div class="input-group-append" id="button-addon">
                            <button class="btn btn-danger btn-icon" type="button" @click="deleteEmail(i)"
                                    data-toggle="tooltip" title="Удалить">
                                <i class="feather icon-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <button class="btn btn-success btn-icon" type="button" data-toggle="tooltip" @click="addEmail"
                            title="Добавить">
                        <i class="feather icon-plus-circle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Settings",
    props: {
        emailsData: {}
    },
    data() {
        return {
            emails: this.emailsData
        }
    },
    methods: {
        deleteEmail(i) {
            this.emails.splice(i, 1)
        },
        addEmail() {
            this.emails.push('')
        }
    }
}
</script>

<style scoped>

</style>
