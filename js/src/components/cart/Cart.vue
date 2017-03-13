<template>
    <div id="cart" class="span3 breadcrumbs">

        <div v-if="!count">
            &#x1f6d2; Я корзинка, жду игрушки :)
        </div>

        <div v-else>
            &#x1f6d2; <a @click.prevent="openCart" href="#">В корзинке {{count}} товаров на {{price}}грн.</a>
        </div>

        <div v-if="isModalVisible">
            <div @click="closeCart" class="modal-backdrop  in"></div>
            <div @click.prevent id="cartModal" class="modal hide in" aria-hidden="false" style="display: block;">
                <div class="modal-header"><a @click.prevent="closeCart" class="close">×</a>
                    <h1>Я ваша корзинка с игрушками ;)</h1></div>
                <div class="modal-body">
                    <table>
                        <tbody>
                            <tr is="cart-item"
                                v-for="cart in items"
                                :item="cart.item"
                                :count="cart.count"
                                :main-image="itemImages[cart.item.id]"></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div style="padding: 0 20px 25px 0;text-align:right;font-size:20px;color:#888">Общая сумма: <span
                            id="total" class="orange-price" style="font-size:24px;">{{price}}</span><span class="orange-price"
                                                                                                    style="font-size:14px;">&nbsp;грн.</span>
                    </div>
                    <a href="/order" class="btn btn-large btn-warning" id="btnMakeOrder">Оформить заказ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a @click.prevent="closeCart" href="#" data-dismiss="modal" style="text-decoration:underline;">Продолжить покупки</a><br><br></div>

            </div>
        </div>

    </div>
</template>

<script>
    import itemApi from '../../api/item-api'
    import CartItem from './CartItem.vue'

    export default {

        data () {
            return {
                isModalVisible: false,
                itemImages: []
            };
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
            },
        },

        methods: {
            openCart () {
                if (this.count) {
                    let self = this;
                    itemApi.getMainImages(this.items).then(resp => {
                        self.itemImages = resp.mainImages;
                        self.isModalVisible = true;
                    });
                }
            },

            closeCart () {
                this.isModalVisible = false;
            },
        },

        components: {
            CartItem
        }
    }
</script>

<style>
    #cart {
        float: right;
    }
</style>
