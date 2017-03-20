<template>
    <div class="span6">
        <h1>Ваш заказ</h1>
        <div class="cart-items">
            <OrderCartItem v-for="cart in items"
                           :item="cart.item"
                           :count="cart.count"
                           :main-image="itemImages[cart.item.id]"
                           :key="cart.item.id">
            </OrderCartItem>
        </div>
        <div class="grand-total">
            <div class="title">Общая сумма:</div>
            <div class="cost"><span id="grandTotal">{{price}}</span>&nbsp;грн.</div>
        </div>
        <div id="lp_widget_button" style="float:right"></div>
        <div id="shipping_text_block" class="show"><br>Доставка курьером составляет 50грн по Киеву и оплачивается отдельно от основного заказа при получении. Для доставки по Киевской области и Украине нужно выбрать тип достаки "Новая почта" указав в адресе город и номер ближайшего к вам отделения.
        </div>
        <h2 style="color:#8e8e8e">Call-центр</h2>
        <p style="color:#8e8e8e">
            График работы: Пн-Пт с 9:00 до 19:00 <br>Суббота, Воскресенье: выходные<br>
        </p>
        <div style="color:#8e8e8e;padding:0 0 0 20px">
            (093) 131-07-17 (Lifecell)
        </div>

    </div>
</template>

<script>
    import itemApi from '../../api/item-api'
    import OrderCartItem from "./OrderCartItem.vue"

    export default {
        data () {
            return {
                itemImages: [],
            }
        },

        created () {
            if (this.count) {
                let self = this;
                itemApi.getMainImages(this.items).then(resp => {
                    self.itemImages = resp.mainImages;
                });
            }
        },

        computed: {
            price () {
                return this.$store.getters.cartTotalPrice;
            },

            count () {
                return this.$store.getters.cartItemsCount;
            },

            items () {
                return this.$store.getters.cartItems;
            }
        },

        components: {
            OrderCartItem
        }
    }
</script>

<style>
</style>
