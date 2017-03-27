<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8"/>
</head>
<body style="margin: 0;padding:0; font-family: Helvetica, Arial, sans-serif">
<div style="max-width: 640px;margin: 0 auto">
    <h2 style="font-size: 36px; font-weight: bold; color: rgb(76, 175, 24);margin:0; mso-line-height-rule:exactly;padding-bottom: 10px;text-align: center">
        {{$order->user_name}}, ваш заказ успешно создан</h2>
    <div>Детали заказа вы можете посмотреть ниже, по любым вопросам заказа и доставки обращайтесь по номеру <b>(093)
            131-07-17</b> или по електронной почте <a href="mailto:support@normas.com.ua"><b>support@normas
                .com.ua</b></a>
    </div>
    
    <p style="padding:10px;">Ссылка на ваш заказ: <a href="http://normas.com.ua/order/{{$order->id}}-{{$order->hash}}">посмотреть детали заказа и статус на сайте</a></p>

    <table style="border-collapse: collapse;margin-top: 20px;">
        <tr>
            <td style="border-bottom: 2px solid grey;padding: 5px;">На этот номер мы Вам позвоним:</td>
            <td style="border-bottom: 2px solid grey;padding: 5px;font-style: italic;font-weight: bold">
                {{$order->user_phone}}
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 2px solid grey;padding: 5px;">Доставка:</td>
            <td style="border-bottom: 2px solid grey;padding: 5px;font-style: italic;font-weight: bold">
                {{$delivery}}
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 2px solid grey;padding: 5px;">Форма оплаты:</td>
            <td style="border-bottom: 2px solid grey;padding: 5px;font-style: italic;font-weight: bold">
                {{$payment}}
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 2px solid grey;padding: 5px;">Комментарий к заказу:</td>
            <td style="border-bottom: 2px solid grey;padding: 5px;font-style: italic;font-weight: bold">
                {{$order->delivery_comment}}
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 50px;">
        <tbody>

        @foreach ($items as $item)
        <tr>
            <td><img src="http://normas.com.ua/images/items/{{$item->main_image->url}}"
                     alt="{{$item->name}}"
                     style="width: 200px;"></td>
            <td><a target="_blank" href="http://normas.com.ua/{{$item->catalogue_alias}}/{{$item->alias}}">{{$item->name}}</a>
            </td>
            <td style="padding: 0 20px;">{{$item->order_count}}&nbsp;шт</td>
            <td style="color:green;font-weight: bold">{{$item->order_price}}&nbsp;грн</td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" style="text-align: right;">Итого:</td>
            <td><b>{{$totalPrice}}&nbsp;грн</b></td>
        </tr>
        </tfoot>
    </table>

    <hr>

    <p>Вы получили это письмо, потому что заказали товар в магазине <b>normas.com.ua</b></p>

</div>

</body>
</html>