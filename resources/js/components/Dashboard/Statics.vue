<template>
    <div class="row">
        <div class="col-md-12">
             <div class="card w-100">
                 <div class="card-content">
                     <div class="card-header">
                         <h1 class="card-title">
                             Количество заказов
                         </h1>
                     </div>

                     <div class="card-body">
                         <vue-frappe
                                 id="orders_count"
                                 title=""
                                 type="line"
                                 :height="300"
                                 :labels="labels"
                                 :lineOptions="{regionFill: 1}"
                                 :colors="['#896978', '#839791', '#FFD4CA', '#70566D', '#9EE493']"
                                 :discreteDomains="false"
                                 :dataSets="orders_count"
                         ></vue-frappe>
                     </div>
                 </div>
             </div>

            <div class="card w-100">
                <div class="card-content">
                    <div class="card-header">
                        <h1 class="card-title">
                            Новый пользователи
                        </h1>
                    </div>

                    <div class="card-body">
                        <vue-frappe
                                id="new_users"
                                title=""
                                type="line"
                                :height="300"
                                :labels="labels"
                                :lineOptions="{regionFill: 1}"
                                :colors="['#9EE493']"
                                :discreteDomains="false"
                                :dataSets="new_users"
                        ></vue-frappe>
                    </div>
                </div>
            </div>

<!--            <div class="card w-100">-->
<!--                <div class="card-content">-->
<!--                    <div class="card-header">-->
<!--                        <h1 class="card-title">-->
<!--                            Успеваемости заказы-->
<!--                        </h1>-->
<!--                    </div>-->

<!--                    <div class="card-body">-->
<!--                        <vue-frappe-->
<!--                                id="status_orders"-->
<!--                                title=""-->
<!--                                type="pie"-->
<!--                                :height="300"-->
<!--                                :labels="labels"-->
<!--                                :lineOptions="{regionFill: 1}"-->
<!--                                :colors="['red']"-->
<!--                                :discreteDomains="false"-->
<!--                                :dataSets="orders_count"-->
<!--                        ></vue-frappe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>

<!--        <div class="col-md-12">-->
<!--            <div class="card w-100">-->
<!--                <div class="card-content">-->
<!--                    <div class="card-header">-->
<!--                        <h1 class="card-title">-->
<!--                            Количество транзакции-->
<!--                        </h1>-->
<!--                    </div>-->

<!--                    <div class="card-body">-->
<!--                        <vue-frappe-->
<!--                                id="transactions"-->
<!--                                title=""-->
<!--                                type="line"-->
<!--                                :height="300"-->
<!--                                :labels="labels"-->
<!--                                :lineOptions="{regionFill: 1}"-->
<!--                                :colors="['#9EE493', '#B4D4EE', '#FF7477']"-->
<!--                                :discreteDomains="false"-->
<!--                                :dataSets="transactions"-->
<!--                        ></vue-frappe>-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->

<!--            <div class="card w-100">-->
<!--                <div class="card-content">-->
<!--                    <div class="card-header">-->
<!--                        <h1 class="card-title">-->
<!--                            Стоимость заказа-->
<!--                        </h1>-->
<!--                    </div>-->

<!--                    <div class="card-body">-->
<!--                        <vue-frappe-->
<!--                                id="amount_orders"-->
<!--                                title=""-->
<!--                                type="line"-->
<!--                                :height="300"-->
<!--                                :labels="labels"-->
<!--                                :lineOptions="{regionFill: 1}"-->
<!--                                :colors="['#9EE493', '#B4D4EE', '#FF7477']"-->
<!--                                :discreteDomains="false"-->
<!--                                :dataSets="sum"-->
<!--                        ></vue-frappe>-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
    import { VueFrappe } from 'vue2-frappe'

    export default {
        props: {
            statics: {}
        },

        components: {
            VueFrappe,
        },

        data() {
            return {
                labels: this.statics.labels,
                orders_count: this.statics.orders_count.data,
                new_users: this.statics.new_users.data,
                transactions: this.statics.transactions.data,
                credits: this.statics.credits.data,
                sum: this.statics.sum.data,

                data: [{
                        name: "test",
                        values: [25, 40, 30, 35, 8, 52, 17, -4]
                    },
                    {
                        name: "test2",
                        values: [25, 50, -10, 15, 18, 32, 27, 14]
                    },
                    {
                        name: "test3",
                        values: [15, 20, -3, -15, 58, 12, -17, 37]
                    }]
            };
        },
    }
</script>

<style scoped>

</style>
