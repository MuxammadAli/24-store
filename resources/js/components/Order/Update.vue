<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-12">
                <form class="form form-vertical" @submit.prevent="UpdateProduct">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Редактировать Заказ №{{ order.id }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <p>Все поля обозначенные * обязательные</p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h3>
                                        Товары
                                    </h3>
                                    <hr>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">

                                            <thead>
                                            <th>
                                                Фото
                                            </th>
                                            <th width="300">
                                                Названия
                                            </th>
                                            <th>
                                                Цена
                                            </th>

                                            <th>
                                                Скидка
                                            </th>

                                            <th>
                                                Размер
                                            </th>

                                            <th>
                                                Кол-во
                                            </th>


                                            <th>
                                                Действия
                                            </th>
                                            </thead>

                                            <tbody>
                                            <tr v-for="(product, index) in orders.products">
                                                <td>
                                                    <img :src="product.product.poster_thumb" width="100">
                                                </td>
                                                <td width="300">
                                                    {{ product.product.name.ru }}
                                                </td>
                                                <td>
                                                    <span v-if="product.product.price_discount">
                                                        <strike>
                                                            {{ product.product.price }} сум
                                                        </strike>
                                                        <br>

                                                        <span v-if="product.discount">
                                                            {{ product.product.price_discount }}
                                                        </span>

                                                        сум

                                                    </span>

                                                    <span v-else>
                                                        {{ product.product.price }} сум
                                                    </span>

                                                </td>

                                                <td>
                                                    <span v-if="product.discount">
                                                        {{ product.discount }}
                                                    </span>

                                                    <span v-else>
                                                        {{ product.product.discount }}
                                                    </span>
                                                    %
                                                </td>

                                                <td>
                                                    {{ product.size }}
                                                </td>

                                                <td>
                                                    {{ product.count }}
                                                </td>

                                                <td>
                                                    <button type="button" @click="Edit(index)"
                                                            class="btn btn-primary btn-sm btn-icon">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button" @click="Delete(index)"
                                                            class="btn btn-danger btn-sm btn-icon">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <button type="button" @click="addProduct" class="btn btn-info btn-icon">
                                    <i class="fa fa-plus"></i> Добавить товар
                                </button>

                                <div class="col-12 mt-1" v-if="actions.store">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>
                                                Добавить продукт
                                            </h3>
                                            <hr>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <multiselect v-model="actions.product"
                                                             placeholder="Искать"
                                                             label="name"
                                                             track-by="name"
                                                             :options="actions.products"
                                                             :option-height="104"
                                                             :custom-label="customLabel"
                                                             :show-labels="false"
                                                             @search-change="SearchProduct"
                                                >
                                                    <template slot="singleLabel" slot-scope="props">
                                                        <img class="option__image" :src="props.option.poster" width="50"
                                                             alt="No Man’s Sky">
                                                        <span class="option__desc">
                                                            <span class="option__title">{{ props.option.name }}</span>
                                                        </span>
                                                    </template>

                                                    <template slot="option" slot-scope="props">
                                                        <img class="option__image" :src="props.option.poster" width="50"
                                                             alt="No Man’s Sky">
                                                        <div class="option__desc">
                                                            <span class="option__title">{{ props.option.name }}</span>
                                                        </div>
                                                    </template>
                                                </multiselect>
                                            </div>
                                        </div>

                                        <div class="col-12" v-if="store.product">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="count">Кол-во</label>
                                                        <input type="number" id="count" class="form-control"
                                                               v-model.number="store.count" placeholder="Кол-во">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button type="button" @click="SaveProductStore"
                                                    class="btn btn-success btn-icon">
                                                <i class="fa fa-save"></i> Добавить
                                            </button>

                                            <button type="button" @click="CancelProduct('store')"
                                                    class="btn btn-default btn-icon">
                                                Отменить
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 mt-1" v-if="actions.edit">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>
                                                Редактировать продукт
                                            </h3>
                                            <hr>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="count">Кол-во</label>
                                                <input type="number" id="count" class="form-control"
                                                       v-model="product.data.count" placeholder="Адрес">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button type="button" @click="SaveProduct" class="btn btn-success btn-icon">
                                                <i class="fa fa-save"></i> Сохранить
                                            </button>

                                            <button type="button" @click="CancelProduct('edit')"
                                                    class="btn btn-default btn-icon">
                                                Отменить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--                    <div class="card">-->
                    <!--                        <div class="card-content">-->
                    <!--                            <div class="card-header">-->
                    <!--                                <h4 class="card-title">Цены</h4>-->
                    <!--                                <button type="button" class="btn btn-info" @click="TotalDiscount()"><i class="fa fa-refresh"></i> Пересчитать</button>-->
                    <!--                            </div>-->

                    <!--                            <div class="card-body">-->
                    <!--                                <div class="col-12">-->
                    <!--                                    <div class="form-group">-->
                    <!--                                        <label for="price">Продукты</label>-->
                    <!--                                        <input type="number" disabled id="price" class="form-control" v-model="product_total" placeholder="Цена Продуты">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->

                    <!--                                <div class="col-12" v-if="orders.type_delivery == 1">-->
                    <!--                                    <div class="form-group">-->
                    <!--                                        <label for="delivery_price">Цена за доставку</label>-->
                    <!--                                        <input type="number" id="delivery_price" class="form-control" v-model="orders.price_delivery" placeholder="Цена за доставку">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->

                    <!--                                <div class="col-12">-->
                    <!--                                    <div class="form-group">-->
                    <!--                                        <label for="discount">Скидка %</label>-->
                    <!--                                        <input type="number" id="discount" class="form-control" v-model="orders.discount" placeholder="Скидка">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->

                    <!--                                <div class="col-12">-->
                    <!--                                    <div class="form-group">-->
                    <!--                                        <label for="total">Итого</label>-->
                    <!--                                        <input type="number" disabled v-model="total" id="total" class="form-control" >-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->

                    <!--                        </div>-->
                    <!--                    </div>-->

                    <div class="alert alert-danger" v-if="actions.error">
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

                            <div class="card-footer">
                                <div class="col-12 mb-0">
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit"
                                                    class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                                <i class="feather icon-save"></i> {{ $t('admin.save') }}
                                            </button>
                                        </div>

                                        <div class="col-9">
                                            <a href="/dashboard/orders"
                                               class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
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
export default {
    props: {
        order: {},
        branches: {},
    },
    data: function () {
        return {
            orders: this.order,

            product: {
                index: null,
                data: {}
            },

            store: {
                count: 1,
                color: null,
                color_id: null,
                product: null,
                discount: null,
                order_id: this.order.id,
                product_id: null,
                size: "",
            },

            actions: {
                error: false,
                edit: false,
                store: false,
                product: null,
                products: []
            },

            product_total: 0,
            total: 0,

            colors: [],
            sizes: [],
            errors: [],

            deletes: {
                products: []
            }
        }
    },

    mounted() {
        this.TotalDiscount();
    },

    watch: {
        'orders.price_total': function (newVal, oldVal) {
            this.total = parseInt(this.orders.price_total) + parseInt(this.orders.price_delivery);
        },

        'orders.discount': function (newVal, oldVal) {
            if (newVal === "" || newVal === 0) {
                this.orders.discount = null;
            } else {
                if (this.orders.discount > 0) {
                    this.orders.discount = newVal;
                }
            }
            this.TotalDiscount();
        },

        'orders.price_delivery': function (newVal, oldVal) {
            if (newVal === "" || newVal === 0) {
                this.orders.price_delivery = null;
            } else {
                if (this.orders.price_delivery > 0) {
                    this.orders.price_delivery = newVal;
                }
            }
            this.TotalDiscount();
        },

        'product.data.discount': function (newVal, oldVal) {
            if (newVal === "" || newVal === 0) {
                this.product.data.discount = null;
                this.product.data.product.price_discount = null;
            } else {
                if (oldVal) {
                    if (this.product.data.discount > 0) {
                        this.product.data.product.price_discount = Math.round(this.product.data.product.price - parseInt(this.product.data.product.price) * parseFloat(this.product.data.discount) / 100);
                    }
                }

            }
        },

        'store.discount': function (newVal, oldVal) {
            if (newVal === "" || newVal === 0) {
                this.store.discount = null;
                this.store.product.price_discount = null;
            } else {
                if (this.store.discount > 0) {
                    this.store.product.price_discount = this.store.product.price - parseInt(this.store.product.price) * parseFloat(this.store.discount) / 100;
                }
            }
        },

        'actions.product': function () {
            this.getProductInfo();
        },

    },

    methods: {

        MathRound(number, precision) {
            "use strict";

            var nativeRound = Math.round,
                castNumber = +number,
                castPrecision = +precision,
                scaledNumber, eSplit, eString;

            // If the exp is undefined or zero, just use native rounding
            if (typeof precision === "undefined" || 0 === castPrecision) {
                return nativeRound(number);
            }

            // If the value is not a number or the exp is not an integer...
            if (isNaN(castNumber) || !(typeof castPrecision === "number" && 0 === castPrecision % 1)) {
                return NaN;
            }

            // In case the number is already in scientific when casted to string, split off the exponent
            eSplit = ("" + castNumber).split("e");

            // Increase the exponent by the given precision and create a scientific notion string
            eString = (eSplit[0] + "e" + (eSplit[1] ? (+eSplit[1] + castPrecision) : castPrecision));

            // Cast to number and round
            scaledNumber = nativeRound(+eString);

            // Do the same as before, backwards
            eSplit = ("" + scaledNumber).split("e");
            eString = (eSplit[0] + "e" + (eSplit[1] ? (+eSplit[1] - castPrecision) : -castPrecision));

            return +eString;
        },

        UpdateProduct() {
            let prices = []
            for (const product of this.orders.products) {
                prices.push(product.price_discount ?? product.price)
            }
            const data = {
                products: this.orders.products,
                product_total: prices.reduce((previousValue, currentValue) => previousValue + currentValue, 0),
                total: this.total,
                region_id: this.orders.region_id,
                deletes: this.deletes.products
            };

            axios.post('/dashboard/orders/update/' + this.order.id, data).then((response) => {
                if (response.data.status) {
                    window.location.href = "/dashboard/orders/view/" + this.order.id;
                }
            }).catch((error) => {
                if (error.response) {
                    this.actions.error = true;
                    this.errors = error.response.data.errors;
                }
            });
        },

        Edit(index) {
            this.actions.edit = true;
            this.product.index = index;

            this.product.data = {...this.order.products[index]};

            axios.get('/dashboard/orders/products/' + this.product.data.product_id).then((response) => {
                if (response.data.status) {
                    this.colors = response.data.product.childrens;

                    for (let i = 0; i < this.colors.length; i++) {
                        if (this.colors[i].id === this.product.data.color_id) {
                            if (this.colors[i].sizes) {
                                this.sizes = this.colors[i].sizes;
                            }
                        }
                    }
                }
            });
        },

        SaveProduct() {
            this.actions.edit = false;

            this.orders.products[this.product.index] = this.product.data;

            this.product.index = null;

            this.sizes = [];
            this.colors = [];
            this.product.data = {};

            setTimeout(this.TotalDiscount(), 1000);
        },

        CancelProduct(type) {
            if (type === 'edit') {
                this.actions.edit = false;

                this.product.index = null;

                this.product.data = {};
            } else {
                this.actions.store = false;

                this.store = {
                    count: null,
                    color: null,
                    color_id: null,
                    product: null,
                    discount: null,
                    order_id: this.order.id,
                    product_id: null,
                    size: "",
                };

                this.actions.products = [];
                this.actions.product = null;
            }


            this.sizes = [];
            this.colors = [];

            this.TotalDiscount();
        },

        SaveProductStore() {
            this.actions.store = false;

            this.orders.products.push({...this.store});

            this.store = {
                count: 1,
                color: null,
                color_id: null,
                product: null,
                discount: null,
                order_id: this.order.id,
                product_id: null,
                size: "",
            };

            this.sizes = [];
            this.colors = [];

            this.actions.products = [];
            this.actions.product = null;

            this.TotalDiscount();
        },

        TotalDiscount() {
            let price = [];
            let price_discount = [];

            if (this.orders.address_id == null) {
                this.orders.address = {
                    first_name: '',
                    phone: ''
                }
            }

            this.orders.products.forEach(function (product, index) {
                if (product.discount === null && product.product.discountPrice === 0) { //|| product.product.price_discount === null
                    console.log(1);
                    price.push(parseInt(product.product.price) * product.count);
                } else {
                    console.log(2);
                    //console.log(product.product.price_discount)
                    price_discount.push(parseInt(product.product.price_discount) * product.count);
                }
            });

            //console.log(3);
            //console.log(price_discount);
            let total_price = price.reduce(function (total, num) {
                return total + num
            }, 0);
            // console.log('price ' + total_price);
            let total_discount = price_discount.reduce(function (total, num) {
                return total + num
            }, 0);
            // console.log('dis ' + total_discount);


            this.product_total = parseInt(total_price) + parseInt(total_discount);
            let discount = this.orders.discount == null ? 0 : this.orders.discount;

            total_price = parseInt(total_price) - parseInt(total_price) * parseInt(discount) / 100;

            let delivery;

            if (this.orders.type_delivery == 1) {
                delivery = this.orders.price_delivery == null ? 0 : this.orders.price_delivery;
            } else {
                this.orders.price_delivery = 0;
                delivery = 0;
            }

            this.total = parseInt(total_price) + parseInt(total_discount) + parseInt(delivery);

        },

        addProduct() {
            this.actions.store = true;
        },

        Delete(index) {
            //console.log(index);

            this.deletes.products.push(this.orders.products[index].product_id);
            this.orders.products.splice(index, 1);

            this.TotalDiscount();
        },

        async getProductInfo() {
            if (this.actions.product) {
                const {data} = await axios.post('/dashboard/orders/product/info/' + this.actions.product.id);

                if (data.product.price_discount) {
                    this.store.discount = 100 - parseInt(data.product.price_discount) * 100 / parseInt(data.product.price);
                } else {
                    this.store.discount = null;
                }

                this.store.product = data.product;
                this.store.product_id = data.product.id;

                axios.get('/dashboard/orders/products/' + data.product.id).then((response) => {
                    if (response.data.status) {
                        this.colors = response.data.product.childrens;
                        this.store.color_id = response.data.product.childrens[0].id
                    }
                });
            } else {
                this.store.product = null;
            }
        },


        async SearchProduct(query) {
            let name = query;

            if (name.length > 0) {
                axios.post('/dashboard/orders/product/search', {name: name, region_id: this.order.region_id})
                    .then((response) => {
                        if (response.data.status) {
                            this.actions.products = response.data.products;
                        }
                    }).catch((error) => {
                    if (error.response) {
                        this.actions.error = true;
                        this.errors = error.response.data.errors;
                    }
                });
            }

            //console.log(query);
        },

        customLabel({name}) {
            return `${name}`
        },

    },

}
</script>

<style scoped>

</style>
