<template>
    <li class="span3" style="padding-bottom:25px;border-bottom: 3px solid #edecdb">
        <div class="product-item">
            <div class="pic">
                <a :href="'/' + item.catalogue_alias + '/' + item.alias">
                    <img :title="item.name"
                         :src="'/images/items/' + item.main_image.url"
                         :alt="item.name">
                </a>
            </div>
            <a :href="'/' + item.catalogue_alias + '/' + item.alias" class="title">{{item.name}}</a>
            <div class="price">{{item.price}}&nbsp;<span>грн.</span></div>
            <button @click="buy" class="btn btn-warning addToCart">Купить</button>

        </div>
    </li>
</template>

<script>
    export default {
        props: ['item'],

        methods: {
            buy () {
                this.$store.commit('CART_ADD_ITEM', this.item)
            }
        }
    }
</script>

<style>
</style>
