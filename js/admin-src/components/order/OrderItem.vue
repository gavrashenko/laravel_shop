<template>
   <tr :class="{'bg-success': isOrdered24h}">
       <td>{{order.date_created}}</td>
       <td>
           <a :href="'/order/' + order.id + '-' + order.hash"
              target="_blank">
               {{orderNumber}}
           </a>
       </td>
       <td>
           <p v-if="order.status === 0" class="bg-warning">Проверяется</p>
           <p v-if="order.status === 1" class="bg-info">Доставляется</p>
           <p v-if="order.status === 2" class="bg-primary">Завершено</p>
           <p v-if="order.status === 3" class="bg-danger">Отменено</p>
       </td>
       <td>{{order.user_name}}</td>
       <td>{{order.user_email}}</td>
       <td>{{order.user_phone}}</td>
       <td>{{delivery}}</td>
       <td>{{order.delivery_comment}}</td>
       <td>{{order.delivery_date}}</td>
       <td>{{payment}}</td>
   </tr>
</template>

<script>
    export default {
        props: ['order'],

        computed: {
            orderNumber () {
                return this.order.id + '-' + this.order.hash.substring(0,2);
            },

            isOrdered24h () {
                let date = (new Date).getTime() - 3600 * 24 * 1000;

                return Date.parse(this.order.date_created) > date;
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
        }
    }
</script>

<style>
</style>
