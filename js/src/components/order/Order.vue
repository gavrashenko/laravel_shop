<template>
    <div class="row order">
        <div class="span6"><h1>Оформить заказ</h1>
            <div class="order-form">
                <!--<div class="title">Покупатель <span href="#" class="clear-data">Очистить данные покупателя</span></div>-->
                <br>

                <label for="Order_first_name" class="required">Имя</label>
                <span class="error" v-show="$v.form.user_name.$error">Имя должно быть не менее 2 букв</span>
                <input @input="$v.form.user_name.$touch()" v-model.trim="form.user_name" size="32" maxlength="255" autofocus required style="width:415px" id="Order_first_name" type="text">

                <label for="Order_phone">Телефон</label>
                <span class="error" v-show="$v.form.user_phone.$error">Заполните ваш номер телефона</span>
                <input v-model.trim="form.user_phone"
                       v-mask="'+38(0##)###-##-##'"
                       @input="$v.form.user_phone.$touch()"
                       size="12"
                       maxlength="18"
                       required
                       style="width:415px"
                       id="Order_phone"
                       type="text">

                <label for="Order_email">Email <span><sup>*</sup>Сюда прийдет письмо с информацией о Вашем заказе</span></label>
                <span class="error" v-show="$v.form.user_email.$error">Заполните правильный email</span>
                <input v-model.trim="form.user_email"
                       @input="$v.form.user_email.$touch()"
                       style="width:415px"
                       id="Order_email"
                       type="text">
            </div>

            <div class="order-form">
                <!--<div class="title">Доставка <span href="#" class="clear-data">Очистить данные доставки</span></div>-->
                <br>
                <div id="Order_shipping_type_block">

                    <label for="Order_shipping_type">Тип доставки</label>
                    <select v-model="form.delivery_type" class="span5" style="width:435px" id="Order_shipping_type">
                        <option value="1" selected>Новая почта — на отделение</option>
                        <option value="2">Самовывоз (ул. Кирилловская 40р)</option>
                        <option value="3">Курьер по Киеву</option>
                    </select>
                </div>

                <div class="shipping_block">
                    <div id="Order_city_block">
                        <label for="Order_city_id">Город</label>
                        <input v-model="form.delivery_city"
                               id="Order_city_id" type="text" style="width: 415px;">
                    </div>

                    <div class="hide" style="display: block;">
                        <label for="Order_address_id_block">Номер отделения/Адрес</label>
                        <input v-model="form.delivery_address" id="Order_address_id_block" type="text" style="width: 415px;">
                    </div>

                    <div id="Order_payment_type_block">
                        <label for="Order_payment_type">Форма оплаты</label>
                        <select v-model="form.payment_type" class="span5" style="width:435px" id="Order_payment_type">
                            <option value="1" selected="">Оплата наличными при получении</option>
                            <option value="2">Оплата на карту PrivatBank</option>
                        </select>
                    </div>
                </div>

                <label for="Order_customer_comment">Комментарий</label>
                <textarea rows="5" maxlength="255"
                          v-model="form.delivery_comment"
                          style="width:410px"
                          name="Order[customer_comment]"
                          id="Order_customer_comment">
                </textarea>
            </div>

            <div style="text-align:center;padding-bottom: 18px;">
                <button @click="confirmOrder" id="btnSubmitOrder" class="btn btn-warning btn-large"
                        style="margin-left:15px;padding:15px 30px">Подтверждаю заказ
                </button>
            </div>
        </div>
        <OrderCart></OrderCart>
    </div>
</template>

<script>
    import OrderCart from "./OrderCart.vue"
    import store from "../../store/index"
    import { validationMixin } from 'vuelidate'
    import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
    import orderApi from "../../api/order-api"

    export default {
        mixins: [validationMixin],
        props: ['data'],
        store,

        data () {
            return {
                form: {
                    user_name: '',
                    user_phone: '+38(0',
                    user_email: '',
                    delivery_type: 1,
                    delivery_city: '',
                    delivery_address: '',
                    delivery_comment: '',
                    payment_type: 1
                }
            }
        },

        methods: {
            confirmOrder () {
                this.$v.form.user_name.$touch();
                this.$v.form.user_phone.$touch();
                this.$v.form.user_email.$touch();

                let isFormValid = !this.$v.form.user_name.$invalid;
                isFormValid &= !this.$v.form.user_phone.$invalid;
                isFormValid &= !this.$v.form.user_email.$invalid;

                if (!!isFormValid) {
                    orderApi.saveOrder({
                        form: this.form,
                        items: this.$store.getters.cartItems
                    }).then(function (resp) {
                        location.href = '/order/' + resp.idOrder + '-' + resp.hash;
                    }).catch(function (resp) {
                        alert(resp.body.error);
                    });
                } else {
                    alert('Пожалуйста, исправьте поля с ошибками.')
                }
            }
        },

        components: {
            OrderCart
        },

        validations: {
            form: {
                user_name: {
                    required,
                    minLength: minLength(2)
                },
                user_phone: {
                    required,
                    minLength: minLength(17),
                    maxLength: maxLength(17)
                },
                user_email: {
                    required,
                    email
                }
            }
        }
    }
</script>

<style>
    .order .error {
        color: red;
    }
    
    .order .clear-data {
        float: right;
        cursor: pointer;
    }

    .order .clear-data:hover {
        text-decoration: underline;
    }
</style>
