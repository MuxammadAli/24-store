<template>
<div>
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ users }}</h2>
                    <p class="mb-0">Пользователи</p>
                </div>
                <div class="card-content">
                  <br>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-credit-card text-success font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ revenue | getRevenue }}</h2>
                    <p class="mb-0">Доход</p>
                </div>
                <div class="card-content">
                    <br>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">
                        {{ orders }}
                    </h2>
                    <p class="mb-0">Заказы</p>
                </div>
                <div class="card-content">
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Количество заказов</h4>

                    <div class="btn-group dropdown mr-1 mb-1">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Primary
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Option 1</a>
                            <a class="dropdown-item active" href="#">Option 2</a>
                            <a class="dropdown-item" href="#">Option 3</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </div>


                </div>
                <div class="card-content">
                    <div class="card-body pl-0">
                        <div class="height-300">
                            <canvas id="count-chart" :data-data="{content}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Стоимость заказа</h4>
                </div>
                <div class="card-content">
                    <div class="card-body pl-0" >
                        <div class="height-300" >
                            <canvas id="price-chart"></canvas>
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
        props: {
            users: {},
            orders: {},
            revenue: {},
            orderData: {}
        },

        data: function () {
           return {
               content: []

           }
        },
        created() {
            Event.$on("document-was-processed", content => {
                this.content = JSON.parse(this.props.orderData);
            });
        },

        mounted() {

        },

        filters: {
            getRevenue(revenue) {
                let sum = revenue / 1000;

                if (sum < 1000) {
                    return sum + 'k'
                } else if (sum <= 10000) {
                    return sum / 1000 + 'M'
                } else {

                }
            }
        },

        methods: {

        }
    }
</script>

