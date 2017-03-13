<template>
    <div class="span12">
        <h1>{{ data.item.name }}</h1>
        <div class="product-code">Код товара: {{ data.item.id }}.</div>
        <div class="product">
            <div class="left-part">
                <div class="position" style="position: relative; z-index: 1; width: 467px; left: 0px; top: 0px;">
                    <div class="large-img">
                        <a data-fancybox="gallery"
                           :href="'/images/items/' + data.mainImage.url"
                           :title="data.item.name">
                            <img :title="data.item.name"
                                 :src="'/images/items/' + data.mainImage.url"
                                 :alt="data.item.name">
                        </a>
                        <div><img src="/images/zoom.png" width="36" height="36" alt="" id="zoom"></div>
                    </div>
                    <div style="text-align: left">
                        <a v-for="image in data.images" data-fancybox="gallery"
                           :href="'/images/items/' + image.url">
                            <img :title="data.item.name"
                                 :src="'/images/items/' + image.url"
                                 :alt="data.item.name"
                                 width="150"
                                 style="margin-top: 4px;"
                            ></a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="right-part noselect">
                <div class="price-and-button">
                    <div class="price">
                        <div itemprop="itemCondition" content="new"></div>
                        <div itemprop="gtin13" content=""></div>
                        <span itemprop="price">{{ data.item.price }}</span>
                        <small itemprop="priceCurrency" content="UAH">грн.</small>
                    </div>
                    <div class="buttons-block">
                        <button @click="buy"
                                class="addToCart btn btn-large btn-warning"
                                style="padding:15px 30px;font-size: 24px;margin:5px 0; width:100%">Купить
                        </button>
                        <br>
                        <button class="buy1Click btn">Купить в 1 клик</button>
                    </div>
                    <div class="clear"></div>
                </div>

                <div v-html="data.item.description"></div>

                <div class="payment-shipping-warranty">
                    <div class="payment-shipping-warranty-gray" style="margin-top:17px;color:#666">
                        <div id="payment-ul" style="display:none">
                            <ul>
                                <li>Оплата при получении</li>
                                <li>Оплата на сайте картами Visa/MasterCard</li>
                                <li>Оплата на сайте через Приват24</li>
                            </ul>
                            <a id="paymentLink" href="#" rel="nofollow">подробнее...</a>
                        </div>
                        <div id="shipping-ul">
                            <ul>
                                <li>Самовывоз (Киев, Днепр) - Бесплатно!</li>
                                <li>На склад "Новой Почты" от 35 грн</li>
                                <li>Адресная доставка по Украине от 45 грн</li>
                                <li>Курьер по Киеву, Днепру - 50 грн</li>
                            </ul>
                        </div>
                        <div id="warranty-ul" style="display:none">
                            <ul>
                                <li>Обмен/Возврат в течение 14 дней</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="clear"></div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['data'],

        methods: {
            buy () {
                this.$store.commit('CART_ADD_ITEM', this.data.item)
            }
        }
    }
</script>

<style>
</style>
