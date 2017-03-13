<template>
    <div class="row">
        <div class="span6"><h1>Оформить заказ</h1>
            <div class="order-form">
                <div class="title">Покупатель</div>
                <br>

                <label for="Order_first_name" class="required">Имя <span class="required">*</span></label>
                <input size="32" maxlength="255" autofocus required style="width:415px" id="Order_first_name"
                       type="text" value=""
                       class="ng-pristine ng-invalid ng-invalid-required ng-valid-maxlength ng-touched">

                <label for="Order_phone">Телефон, <span><sup>*</sup>например +380971234567</span></label>
                <input size="12" maxlength="12" required style="width:415px" id="Order_phone" type="text" value="+380"
                       class="ng-pristine ng-untouched ng-valid-required ng-invalid ng-invalid-pattern ng-valid-maxlength">

                <label for="Order_email">Email,
                    <span><sup>*</sup>Сюда прийдет письмо с информацией о Вашем заказе</span></label>
                <input style="width:415px" id="Order_email" type="email"
                       class="ng-pristine ng-untouched ng-valid ng-valid-email">
            </div>

            <div class="order-form">
                <div class="title">Доставка</div>
                <br>
                <div id="Order_shipping_type_block">

                    <label for="Order_shipping_type">Тип доставки</label>
                    <select class="span5" style="width:435px" id="Order_shipping_type">
                        <option value="new_post" selected>Новая почта — на отделение</option>
                        <option value="pickup">Самовывоз (ул. Кирилловская 40р)</option>
                        <option value="courier">Курьер по Киеву</option>
                    </select>
                </div>

                <div class="shipping_block">
                    <div id="Order_city_block">
                        <label for="Order_city_id">Город</label>
                        <input id="Order_city_id" type="text"
                               class="ng-pristine ng-untouched ng-valid ng-valid-email"
                               style="width: 415px;">
                    </div>

                    <div class="hide" style="display: block;">
                        <label for="Order_address_id_block">Номер отделения/Адрес</label>
                        <input id="Order_address_id_block" type="text"
                               class="ng-pristine ng-untouched ng-valid ng-valid-email"
                               style="width: 415px;">
                    </div>

                    <div id="Order_address_block" class="hide" style="display: none;">
                        <label for="Order_address">Адрес</label>
                        <input size="12" maxlength="255" style="width:415px"
                               name="Order[address]" id="Order_address" type="text">
                    </div>

                    <div id="Order_payment_type_block">
                        <label for="Order_payment_type">Форма оплаты</label>
                        <select class="span5" style="width:435px" id="Order_payment_type">
                            <option value="delivery-payment" selected="">Оплата наличными при получении</option>
                            <option value="wayforpay">Оплата на карту PrivatBank</option>
                        </select>
                    </div>
                </div>

                <label for="Order_customer_comment">Комментарий</label>
                <textarea rows="5" maxlength="255"
                          style="width:410px"
                          name="Order[customer_comment]"
                          id="Order_customer_comment">
                </textarea>
            </div>

            <div style="text-align:center;padding-bottom: 18px;">
                <button id="btnSubmitOrder" class="btn btn-warning btn-large"
                        style="margin-left:15px;padding:15px 30px">Подтверждаю заказ
                </button>
            </div>
        </div>
        <div class="span6">
            <h1>В вашей корзинке</h1>
            <div class="cart-items">
                <div class="cart-item">
                    <div class="img"><img
                            src="https://s.toys.com.ua/img/igrovoy-nabor-cherepashki-nindzya-boevoy-arsenal-56662t.jpg"
                            alt="Игровой набор «Черепашки-ниндзя - боевой арсенал»"></div>
                    <a href="javascript: void(0)" id="cp18194" class="removeFromCart del">Убрать<br>из корзины</a>
                    <div>
                        <div class="title"><a href="/igrovoy-nabor-cherepashki-nindzya-boevoy-arsenal-23307">Игровой
                            набор «Черепашки-ниндзя - боевой арсенал»</a></div>

                        <div class="number"><span>55</span>&nbsp;грн. <span class="x">x</span> &nbsp;<span
                                class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input
                                class="itemQuantity ui-spinner-input" type="text" id="qp18194" name="products[18194]"
                                value="1" size="2" aria-valuemin="1" aria-valuemax="100" aria-valuenow="1"
                                autocomplete="off" role="spinbutton"><a
                                class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only"
                                tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span
                                class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a
                                class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only"
                                tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span
                                class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span> шт. = <span
                                id="psp18194">55</span>&nbsp;грн.
                        </div>
                        &nbsp;
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div id="shipping_cost_block" class="shipping-cost hide">
                <div class="title">Стоимость доставки:</div>
                <div class="cost"><span id="shippingCost">0,00</span> грн.</div>
            </div>
            <div class="grand-total">
                <div class="title">Общая сумма:</div>
                <div class="cost"><span id="grandTotal">519,00</span>&nbsp;грн.</div>
            </div>
            <div id="lp_widget_button" style="float:right"></div>
            <div id="shipping_text_block" class="show"><br>Доставка курьером составляет 50грн по Киеву и оплачивается отдельно от основного заказа при получении. Для доставки по Киевской области и Украине нужно выбрать типо достаки "Новая почта" указав в адресе город и номер ближайшего к вам отделения.
            </div>
            <h2 style="color:#8e8e8e">Call-центр</h2>
            <p style="color:#8e8e8e">
                График работы: Пн-Пт с 9:00 до 19:00 <br>Суббота, Воскресенье: выходные<br>
            </p>
            <div style="color:#8e8e8e;padding:0 0 0 20px">
                (093) 131-07-17 (Lifecell)
            </div>
            <!--<br>-->
            <!--<div style="color:#8e8e8e;text-align:justify">-->
                <!--Важно! Обязательно проверяйте товар при получении, так как он отправляется надлежащего качества, и в-->
                <!--случае повреждения при транспортировке ущерб может возместить только перевозчик, но не магазин.-->
            <!--</div>-->
            <!--<p></p>-->

        </div>

    </div>
</template>

<script>
    export default {
        props: ['data'],

        components: {}
    }
</script>

<style>
</style>
