<template>

    <div>
        <button @click="open" type="button" class="buy1Click btn">Купить в 1 клик</button>

        <div v-if="isModalVisible" class="quick-order">
            <div @click="close" class="modal-backdrop  in"></div>
            <div id="quickOrderModal" class="modal hide in" aria-hidden="false" style="display: block;">
                <div class="modal-header"><a @click.prevent="close" class="close">×</a>
                    <h1>Быстрый заказ, без лишних вопросов :)</h1>
                </div>
                <div class="modal-body">
                    <table>
                        <tbody>
                        <tr>
                            <td width="140" class="img">
                                <img :src="'/images/items/' + data.mainImage.url"
                                     :alt="data.item.name"></td>
                            <td class="title">
                                <h3>{{data.item.name}}</h3>
                            </td>
                            <td style="white-space:nowrap;color:#585858;font-size:18px;">
                                1&nbsp;шт.
                            </td>
                            <td class="orange-price">{{data.item.price}}&nbsp;грн.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <template v-if="!isOrdered">
                        <label>Ваш номер телефона: <span class="error" v-show="$v.form.user_phone.$error">(Заполните правильно ваш номер телефона)</span></label>

                        <input v-model="form.user_phone"
                               class="phone" type="text" v-mask="'+38(0##)###-##-##'">
                        <a @click.prevent="makeOrder" href="#" class="btn btn-large btn-warning confirm-order">Подтверждаю
                            заказ</a>
                    </template>
                    <div v-else class="ordered">
                        Спасибо за заказ, мы свяжемся с вами в ближайшее время.
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, minLength, maxLength} from 'vuelidate/lib/validators'
    import orderApi from "../../api/order-api"

    export default {
        props: ['data'],

        data () {
            return {
                isModalVisible: false,
                isOrdered: false,
                form: {
                    user_phone: '+38(0',
                }
            };
        },

        methods: {
            open () {
                this.isOrdered = false;
                this.isModalVisible = true;
            },

            close () {
                this.isModalVisible = false;
            },

            makeOrder () {
                this.$v.form.user_phone.$touch();
                if (!this.$v.form.user_phone.$error) {
                    orderApi.saveQuickOrder({
                        form: this.form,
                        id_item: this.data.item.id
                    }).then(() => {
                        this.isOrdered = true;
                        setTimeout(() => {
                            this.close();
                        }, 2000);
                    }).catch(function (resp) {
                        alert(resp.body.error);
                    });

                }
            }
        },

        validations: {
            form: {
                user_phone: {
                    required,
                    minLength: minLength(17),
                    maxLength: maxLength(17)
                }
            }
        }
    }
</script>

<style>
    .quick-order .phone {
        padding: 5px;
        height: 34px;
        margin-top: 10px;
        font-size: 16pt;
    }

    .quick-order .confirm-order {
        padding: 15px;
    }

    .quick-order .error {
        color: red;
        font-style: italic;
    }

    .quick-order .ordered {
        color: green;
        font-size: 18pt;
    }

    .quick-order #quickOrderModal {
        position: absolute;
        width: 880px;
        margin: -150px 0 0 -700px;
        border: 10px solid #edecdb;
    }
</style>
