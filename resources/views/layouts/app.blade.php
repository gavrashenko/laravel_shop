<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="referrer" content="origin">
    <meta name="description"
          content="Купить Черепашки Ниндзя в самом большом интернет магазине игрушек Toys - низкие цены, широкий ассортимент, доставка по Украине.">
    <meta name="keywords" content="Черепашки Ниндзя купить цена магазин детских игрушек">

    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <title>Normas</title>

</head>
<body>
<div id="cartModal" class="modal hide"></div>
<div id="buyModal" class="modal hide"></div>

<div class="top-line">
    <div class="container">
        <div class="row">
            <div class="span8">
                <div style="position:absolute;margin-left:0px">
                    <ul class="pseudomenu top-links">
                        <li><span style="color:white">Интернет-магазин</span>
                            <a href="/"><span style="color:white;font-size: 18pt;font-weight: bold">"НОРМАС"</span></a></li>
                        <li><span data-link="/oplata-i-dostavka">Оплата и доставка</span></li>
                        <li><span data-link="/kontakty">Контакты</span></li>
                    </ul>
                </div>
            </div>
            <div class="span4">
                <div class="phone">
                    <a id="phone" href="https://toys.com.ua/cherepashki-nindzya#collapseOne" data-toggle="collapse"
                       class="collapsed">(093) 131-07-17&nbsp;
                        <div></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="wait_for_sending_post" style="display:none;text-align:center;padding-top:50px"><img
            src="./index_files/loading32x32.gif" alt=""></div>
<div class="beige-bg">
    <div class="container">
        <div class="row">

            {!! Breadcrumbs::renderIfExists() !!}

            <div style="float: right" class="span3 breadcrumbs">

                &#x1f6d2; Я конзинка, жду игрушки :)

            </div>
        </div>
    </div>
</div>

<div>
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>

<div class="clear"></div>

<!-- End SiteHeart code -->
<footer class="overflow">
    <div style="background-color:#8dc462">
        <div class="container">
            <div class="row">
                <div class="span12" style="margin-left: 160px">
                    <a style="color: #cbeeaf;" href="http://normas.com.ua/">НОРМАС</a>
                    <ul id="yw0" class="pseudomenu bottom-links">
                        <li><span data-link="/o-magazine">О магазине</span></li>
                        <li><span data-link="/oplata-i-dostavka">Оплата и доставка</span></li>
                        <li><span data-link="/polzovatelskoe-soglashenie">Пользовательское соглашение</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container" style="position:relative">
            <div class="row">
                <div class="span12 footer-bottom-text">
                    Купить <a href="https://toys.com.ua/">детские игрушки</a> для мальчика и&nbsp;девочки в&nbsp;интернет
                    магазине Toys.com.ua с&nbsp;доставкой по&nbsp;всей Украине.<br>
                    Магазин игрушек Toys.com.ua принимает заказы в автоматическом режиме круглосуточно без выходных.<br>
                    © 2012–2017 Toys.com.ua
                </div>
            </div>
        </div>
    </div>

    <div class="children">
        <div style="position:absolute;bottom:0;left:50%;margin-left:-650px;width:130px;height:325px;background:url(/themes/flat/i/f-l-child.png) no-repeat"></div>
        <div style="position:absolute;bottom:0;right:50%;margin-right:-625px;width:145px;height:290px;background:url(/themes/flat/i/f-r-child.png) no-repeat"></div>
    </div>

</footer>


<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
<link  href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/vuex.js') }}"></script>

</body>
</html>