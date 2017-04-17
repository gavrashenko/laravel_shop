<template>
   <div class="order container-fluid">
       <h1>Заказы: </h1>
       <table class="table">
           <thead>
           <tr>
               <th>Дата заказа:</th>
               <th>Номер заказа:</th>
               <th>Статус:</th>
               <th>Имя:</th>
               <th>Email:</th>
               <th>Телефон:</th>
               <th>Тип дост.:</th>
               <th>Комментарий:</th>
               <th>Дата доставки:</th>
               <th>Тип оплаты:</th>
           </tr>
           </thead>
           <tbody>
           <tr is="order-item"
               v-for="order in orders"
               :order="order">
           </tr>
           </tbody>
       </table>
   </div>
</template>

<script>
    import orderApi from "../../api/order-api"
    import OrderItem from "./OrderItem.vue"

    export default {
        data () {
            return {
                orders: null
            }
        },

        beforeRouteEnter (to, from, next) {
            orderApi.getAll().then((resp) => {
                next(vm => {
                    vm.orders = resp.orders
                })
            })
        },

        components: {
            OrderItem
        }
    }
</script>

<style>

</style>
