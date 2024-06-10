<template>
    <div>
        <ul class="activity-timeline timeline-left list-unstyled"  :key="index">
<!--            v-if="log.log_name != 'products' && log.decription != 'created' && log.properties.attributes.name != null"-->
            <li v-for="(log, index) in logs" :key="index">
                <div class="timeline-icon bg-primary" v-if="log.description == 'updated'">
                    <i class="feather icon-edit font-medium-2 align-middle"></i>
                </div>

                <div class="timeline-icon bg-danger" v-if="log.description == 'deleted'">
                    <i class="feather icon-trash-2 font-medium-2 align-middle"></i>
                </div>

                <div class="timeline-icon bg-success" v-if="log.description == 'created'">
                    <i class="feather icon-plus-circle font-medium-2 align-middle"></i>
                </div>

                <div class="timeline-info">
                    <p class="font-weight-bold mb-0">

                        <i :class="getIcon(log)"></i> {{ getType(log) }}

                    </p>
                    <span class="font-small-3" v-html="getMessage(log)">
                    </span>
                    <a href="#" @click="getData(log)" data-toggle="modal" data-target="#exampleModalLong">
                        подробнее
                    </a>
                </div>
                <small class="text-muted">
                  {{ log.created_at | moment("HH:mm, DD.MM.YYYY") }} | ID: {{ log.causer.id }} | Пользователь:  <b>{{ log.causer.username }}</b>
                </small>
            </li>
        </ul>

        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Подробнее</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="log_modal">
                        <fieldset class="form-group">
                            <label for="basicInput">Пользователь</label>
                            <input type="text" class="form-control" disabled  :value="log.causer.username" id="basicInput">
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="basicInput">ID</label>
                            <input type="text" class="form-control" disabled :value="log.subject_id" id="basicInput" >
                        </fieldset>

                        <div v-if="log.log_name === 'products'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.name">
                                    <label for="basicInput">Названия Ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.name.ru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.name.ru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.name">
                                    <label for="basicInput">Названия Uz</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.name.uz" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.name.uz : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.price">
                                    <label for="basicInput">Цена</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.price" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.price : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.price_discount">
                                    <label for="basicInput">Цена со скидкой</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.price_discount" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.price_discount : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.count <= 0">
                                    <label for="basicInput">Количество товаров на складе</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.count" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.count : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.article_number">
                                    <label for="basicInput">Артикул</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.article_number" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.article_number : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.published === false || log.properties.attributes.published">
                                    <label for="basicInput">Публиковать</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.published" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.published : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.available === false || log.properties.attributes.available">
                                    <label for="basicInput">В наличии</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.available" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.available : '' }}
                                </fieldset>
                            </div>
                        </div>

                        <div v-if="log.log_name === 'orders'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.status">
                                    <label for="basicInput">Статус</label>
                                    <input type="text" class="form-control" disabled :value="getStatus(log.properties.attributes.status)" id="basicInput" >
                                    Было: {{ getStatus(log.properties.old.status) }}
                                </fieldset>
                            </div>
                        </div>

                        <div v-if="log.log_name === 'staffs'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.username">
                                    <label for="basicInput">Логин</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.username" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.username : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.password">
                                    <label for="basicInput">Пароль</label>
                                    <input type="password" class="form-control" disabled :value="log.properties.attributes.password" id="basicInput" >

                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.role.name">
                                    <label for="basicInput">Роль</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.role.name" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.role.name : '' }}
                                </fieldset>
                            </div>
                        </div>

                        <div v-if="log.log_name === 'roles'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.name">
                                    <label for="basicInput">Названия</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.name" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.name : '' }}
                                </fieldset>

                            </div>
                        </div>

                        <div v-if="log.log_name != 'products'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.name">
                                    <label for="basicInput">Названия Ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.name.ru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.name.ru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.name">
                                    <label for="basicInput">Названия Uz</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.name.uz" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.name.uz : '' }}
                                </fieldset>

                            </div>
                        </div>

                        <div v-if="log.log_name === 'special_offer'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.description">
                                    <label for="basicInput">Описания Ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.description.ru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.name.ru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.description">
                                    <label for="basicInput">Описания Uz</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.description.uz" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.description.uz : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.link">
                                    <label for="basicInput">Ccылка</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.link" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.link : '' }}
                                </fieldset>

                            </div>
                        </div>

                        <div v-if="log.log_name === 'settings'">
                            <div v-if="log.description">
                                <fieldset class="form-group" v-if="log.properties.attributes.title">
                                    <label for="basicInput">Названия Ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.title.ru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.title.ru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.title">
                                    <label for="basicInput">Названия Uz</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.title.uz" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.title.uz : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.phone">
                                    <label for="basicInput">Телефон</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.phone.default" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.phone.default : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.phone">
                                    <label for="basicInput">Телефон другой</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.phone.other" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.phone.other : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.address">
                                    <label for="basicInput">Адрес Ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.address.ru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.address.ru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.address">
                                    <label for="basicInput">Адрес Uz</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.address.uz" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.address.uz : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.socials">
                                    <label for="basicInput">Телеграм</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.socials.telegram" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.socials.telegram : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.socials">
                                    <label for="basicInput">Facebook</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.socials.facebook" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.socials.facebook : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.socials">
                                    <label for="basicInput">Instagram</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.socials.instagram" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.socials.instagram : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.socials">
                                    <label for="basicInput">Youtube</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.socials.youtube" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.socials.youtube : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.socials">
                                    <label for="basicInput">Ok.ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.socials.okru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.socials.okru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.email">
                                    <label for="basicInput">Email</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.email" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.email : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.landmark">
                                    <label for="basicInput">Ориентер Ru</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.landmark.ru" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.landmark.ru : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.address">
                                    <label for="basicInput">Ориентер Uz</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.landmark.uz" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.landmark.uz : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.day_delivery">
                                    <label for="basicInput">Время доставки</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.day_delivery" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.day_delivery : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.price_delivery">
                                    <label for="basicInput">Стоимость доставки</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.price_delivery" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.day_delivery : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.pickup === false || log.properties.attributes.pickup">
                                    <label for="basicInput">Самовывоз</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.pickup" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.pickup : '' }}
                                </fieldset>

                                <fieldset class="form-group" v-if="log.properties.attributes.delivery === false || log.properties.attributes.delivery">
                                    <label for="basicInput">Доставка курьером</label>
                                    <input type="text" class="form-control" disabled :value="log.properties.attributes.delivery" id="basicInput" >
                                    Было: {{ log.properties.old ? log.properties.old.delivery : '' }}
                                </fieldset>


                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        props: {
            logsData: {}
        },

        data() {
            return {
                logs: this.logsData.data,

                log_modal: false,
                log: {}
            }
        },

        methods: {
            getType(log) {
                let message;
                switch (log.log_name) {
                    case 'roles':
                        message = 'Роли';
                        break;
                    case 'products':
                        message = 'Продукты';
                        break;
                    case 'orders':
                        message = 'Заказы';
                        break;
                    case 'staffs':
                        message = 'Стаф';
                        break;
                    case 'users':
                        message = 'Пользователи';
                        break;
                    case 'posts':
                        message = 'Посты';
                        break;
                    case 'sliders':
                        message = 'Баннеры';
                        break;
                    case 'categories':
                        message = 'Категории';
                        break;
                    case 'billings':
                        message = 'История оплаты';
                        break;
                    case 'regions':
                        message = 'Регионы';
                        break;
                    case 'cities':
                        message = 'Города';
                        break;
                    case 'settings':
                        message = 'Настройки';
                        break;
                    case 'addresses':
                        message = 'Адрес';
                        break;
                    case 'brand':
                        message = 'Бренды';
                        break;
                    case 'pages':
                        message = 'Страницы';
                        break;
                    case 'special_offer':
                        message = 'Спецпредложения';
                        break;
                }

                // addresses, brand, pages, special_offer

                return message;
            },

            getIcon(log) {
                let icon;
                switch (log.log_name) {
                    case 'roles':
                        icon = 'feather icon-check-circle';
                        break;
                    case 'products':
                        icon = 'feather icon-box';
                        break;
                    case 'orders':
                        icon = 'feather icon-shopping-cart';
                        break;
                    case 'staffs':
                        icon = 'feather icon-users';
                        break;
                    case 'users':
                        icon = 'feather icon-users';
                        break;
                    case 'posts':
                        icon = 'feather icon-align-center';
                        break;
                    case 'sliders':
                        icon = 'feather icon-align-center';
                        break;
                    case 'categories':
                        icon = 'feather icon-tag';
                        break;
                    case 'billings':
                        icon = 'feather icon-credit-card';
                        break;
                    case 'regions':
                        icon = 'feather icon-database';
                        break;
                    case 'cities':
                        icon = 'feather icon-layers';
                        break;
                    case 'settings':
                        icon = 'feather icon-settings';
                        break;
                    case 'addresses':
                        icon = 'feather icon-home';
                        break;
                    case 'brand':
                        icon = 'feather icon-cast';
                        break;
                    case 'pages':
                        icon = 'feather icon-align-center';
                        break;
                    case 'special_offer':
                        icon = 'feather icon-command';
                        break;
                }

                return icon;
            },

            getMessage(log) {
                let message;
                switch (log.description) {
                    case 'created':
                        message = '<b>ID: ' + log.subject_id + '</b> успешно создано';
                        break;
                    case 'deleted':
                        message = '<b>ID: ' + log.subject_id + '</b> успешно удалено';
                        break;
                    case 'updated':
                        message = '<b>ID: ' + log.subject_id + '</b> успешно редактировано';
                        break;
                }

                return message;
                // switch (log.log_name) {
                //     case 'products':
                //         switch (log.description) {
                //             case 'created':
                //                 message = 'Продукт <b>ID: ' + log.subject_id + '</b> успешно создано';
                //                 break;
                //             case 'deleted':
                //                 message = 'Продукт <b>ID: ' + log.subject_id + '</b> успешно удалено';
                //                 break;
                //             case 'updated':
                //                 message = 'Продукт <b>ID: ' + log.subject_id + '</b> успешно редактировано';
                //                 break;
                //         }
                //         break;
                //     case 'orders':
                //         switch (log.description) {
                //             case 'deleted':
                //                 message = 'Заказ <b>ID: ' + log.subject_id + '</b> успешно удалено';
                //                 break;
                //             case 'updated':
                //                 message = 'Заказ <b>ID: ' + log.subject_id + '</b> успешно редактировано';
                //                 break;
                //         }
                //         break;
                // }
                //
                // return message;
            },

            getStatus(status) {
                let message;
                switch (status) {
                    case 'processing':
                        message = 'В обработке';
                        break;
                    case 'collected':
                        message = 'Собран';
                        break;
                    case 'waiting_buyer':
                        message = 'Ожидает покупателя';
                        break;
                    case 'in_way':
                        message = 'В пути';
                        break;
                    case 'closed':
                        message = 'Закрыт';
                        break;
                    case 'cancelled':
                        message = 'Отменен';
                        break;
                    case 'replacement':
                        message = 'Замена';
                        break;
                }

                return message;
            },

            getData(log) {
                this.log_modal = true;
                this.log = log;
            }
        }
    }
</script>

<style scoped>

</style>
