<template>
    <div class="cart-item order-cart-item">
        <div class="img">
            <img v-if="mainImageUrl" :src="'/images/items/' + mainImageUrl" :alt="item.name">
        </div>
        <a @click.prevent="removeFromCart" href="#" class="removeFromCart del">Удалить<br>из заказа</a>
        <div>
            <div class="title">
                <a :href="'/' + item.catalogue_alias + '/' + item.alias">
                    {{item.name}}
                </a>
            </div>

            <div class="number"><span>{{item.price}}</span>&nbsp;грн. <span class="x">x</span> &nbsp;<span
                    class="ui-spinner ui-widget ui-widget-content ui-corner-all">
                <input style="width: 20px;" readonly class="itemQuantity ui-spinner-input" type="text"
                       :value="count" size="2" autocomplete="off">
                <a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only"
                   tabindex="-1" role="button">
                    <span @click="increase" class="ui-button-text">
                        <span class="ui-icon ui-icon-triangle-1-n">▲</span>
                    </span>
                </a>
                <a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button">
                    <span @click="decrease" class="ui-button-text">
                        <span class="ui-icon ui-icon-triangle-1-s">▼</span>
                    </span>
                </a>
            </span> шт. = <span>{{item.price * count}}</span>&nbsp;грн.
            </div>
            &nbsp;
        </div>
        <div class="clear"></div>
    </div>
</template>

<script>
    export default {
        props: ['item', 'count', 'mainImage'],

        methods: {
            removeFromCart () {
                this.$store.commit('CART_REMOVE_ITEM', this.item);
            },

            increase () {
                if (this.count < 9) {
                    this.count++;
                    this.$store.commit('CART_SET_ITEMS_COUNT', {
                        item: this.item,
                        count: this.count
                    });
                }
            },

            decrease () {
                if (this.count > 1) {
                    this.count--;
                    this.$store.commit('CART_SET_ITEMS_COUNT', {
                        item: this.item,
                        count: this.count
                    });
                }
            },
        },

        computed: {
            mainImageUrl () {
                return this.mainImage ? this.mainImage.url : false;
            }
        }
    }
</script>

<style>
</style>
