<template>
    <div class="row personal-order">
        <div class="span6 offset3" style="text-align: center;margin-top:30px;">
            <div style="font-size: 36px;font-weight: bold;color:#4caf18">Спасибо за заказ :)</div>
            <br>
            <p style="font-size: 18px">Номер заказа <b>{{order.id}}-{{order.hash | short}}</b>. Наш менеджер позвонит
                Вам для уточнения деталей заказа. <br><br>Информация по вашему заказу всегда доступна на текущей
                странице, а также отправлена на указанный Вами e-mail (<i>{{order.user_email}}</i>).<br></p>

            <div class="order-title">Информация по Вашему заказу:</div>

            <table>
                <tr>
                    <td>Стату заказа:</td>
                    <td class="order-value order-status">{{status}}</td>
                </tr>
                <tr>
                    <td>E-mail на который мы выслали детали заказа:</td>
                    <td class="order-value">{{order.user_email}}</td>
                </tr>
                <tr>
                    <td>На этот номер мы Вам позвоним:</td>
                    <td class="order-value">{{order.user_phone}}</td>
                </tr>
                <tr>
                    <td>Доставка:</td>
                    <td class="order-value">{{delivery}}</td>
                </tr>
                <tr>
                    <td>Форма оплаты:</td>
                    <td class="order-value">{{payment}}</td>
                </tr>
                <tr>
                    <td>Комментарий к заказу:</td>
                    <td class="order-value">{{order.delivery_comment}}</td>
                </tr>
            </table>

            <div class="order-title">Товары которые вы купили:</div>

            <table>
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <td><img style="width: 200px;"
                             :src="'/images/items/' + item.main_image.url"
                             :alt="item.name"></td>
                    <td><a target="_blank" :href="'/' + item.catalogue_alias + '/' + item.alias">{{item.name}}</a></td>
                    <td>{{item.order_count}}шт</td>
                    <td>{{item.order_price}}грн</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align: right" colspan="3">Итого:</td>
                    <td><b>{{orderPrice}}грн</b></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    import OrderCart from "./OrderCart.vue"
    import store from "../../store/index"

    export default {
        store,
        props: ['data'],

        data () {
            return {}
        },

        computed: {
            order () {
                return this.data.order;
            },

            items () {
                return this.data.items;
            },

            delivery () {
                switch (this.order.delivery_type) {
                    case 1:
                        return "Новая Почта, город " + this.order.delivery_city + ", отделение №" + this.order.delivery_address;
                    case 2:
                        return "Самовывоз по адресу г. Киев, ул. Кирилловская 40р с 9:00 до 19:00";
                    case 3:
                        return "Доставка курьером по Киеву на адрес: " + this.order.delivery_address;
                    default:
                        return "Тип доставки не определен.";
                }
            },

            payment () {
                switch (this.order.payment_type) {
                    case 1:
                        return 'Наличными курьеру при получении!';
                    case 2:
                        return 'На карту приватбанка.';
                    default:
                        return 'Форма оплаты не определена.';
                }
            },

            status () {
                switch (this.order.status) {
                    case 0:
                        return 'Проверяется.';
                    default:
                        return 'Ошибка.';
                }
            },

            orderPrice () {
                return _.sumBy(this.items, item => item.order_price * item.order_count);
            }
        },

        filters: {
            short (text) {
                return text.substring(0, 2);
            }
        }
    }
</script>

<style>
    .personal-order .order-value {
        font-style: italic;
        font-weight: bold;
    }

    .personal-order .order-status {
        color: blue;
    }

    .personal-order .order-title {
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 26px;
        font-weight: bold;
        color: #1b6d85
    }
</style>
