<template>
    <tr>
        <td width="140" class="img"><img
                :src="'/images/items/' + mainImage.url"
                alt="Оружие Черепашек-ниндзя «Нунчаки Микеланджело»"></td>
        <td class="title">
            <h3>{{item.name}}</h3>
            <div class="price"><span>{{item.price}}</span>&nbsp;грн.</div>
        </td>
        <td style="white-space:nowrap;color:#585858;font-size:18px;"><span
                class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input
                class="quantity ui-spinner-input" type="text" v-model="count"
                size="2" autocomplete="off" readonly
                role="spinbutton"><a
                @click.prevent="increase"
                class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only"
                tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span
                class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a
                @click.prevent="decrease"
                class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only"
                tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span
                class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span> шт.
        </td>
        <td class="orange-price"><a @click.prevent="remove" href="#" class="removeFromCart">×</a><span
                style="font-size:24px;">{{item.price * count}}</span> грн.
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['item', 'count', 'mainImage'],

        methods: {
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

            remove () {
                this.$store.commit('CART_REMOVE_ITEM', this.item);
            }
        }
    }
</script>

<style>
</style>
