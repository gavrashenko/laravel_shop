@extends('layouts.app')
@section('content')

    <div class="span3">
        <div class="sidebar-div"></div>

        <div class="category-sidebar">
            <ul class="category-list">
                @foreach ($categories as $cat)
                    <li><a href="/{{$cat->alias}}">{{$cat->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="span9">
        <h1 style="font-size: 30px">{{$categoryName}}</h1>
        @if ($showSorting)
        <div style="color:#7a7a7a;font-size:14px">Всего товаров: {{$itemsCount}}
            <div style="float:right">Сортировка:
                <a class="link-nofollow" href="#">сначала новые</a>
                |
                <a class="link-nofollow" href="#">сначала старые</a>
                |
                <a class="link-nofollow" href="#">сначала дешевые</a>
                |
                <a class="link-nofollow" href="#">сначала дорогие</a>
            </div>
        </div>
        @endif
        <ul class="thumbnails row">
            @foreach ($items as $item)
                <li class="span3" style="padding-bottom:25px;border-bottom: 3px solid #edecdb">
                    <div class="product-item">
                        <div class="pic"><a href="/{{$item->catalogue_alias}}/{{$item->alias}}"><img
                                        title="{{$item->name}}"
                                        src="{{ url('images/items/' . $item->main_image->url) }}"
                                        alt="{{$item->name}}"></a></div>
                        <a href="/{{$item->catalogue_alias}}/{{$item->alias}}" class="title">{{$item->name}}</a>
                        <div class="price">{{$item->price}}&nbsp;<span>грн.</span></div>
                        <button class="btn btn-warning addToCart" data-id="6825">Купить</button>

                    </div>
                </li>
            @endforeach
        </ul>

        <div class="noselect"><h2>Черепашки-ниндзя - фигурки для игры и коллекции!</h2>
            <p>Очень давно детские сердца начала постепенно покорять серия комиксов про необычных гуманоидных
                мутантов-черепашек Teenage Mutant Ninja Turtles , которые обучались боевым искусствам у своего
                Мастера Сплинтера и жили на подземной базе под городом. Эта незамысловатая вымышленная история
                быстро набрала популярности и переросла в серию потрясающих и очень интересных мультфильмов,
                которые собирались смотреть у телевизора дети со всего мира. Конечно же, сегодня этот мультфильм
                и его главные герои, которые всегда стоят на страже добра и справедливости, знаком не только
                деткам, но и их родителям.</p>
            <p>Черепашки Ниндзя теперь могут посетить комнату каждого карапуза в виде забавной миниатюрной
                копии, которую малыш может использовать в своих сюжетно-ролевых играх, а может просто поставит
                на полочку и собирать всю коллекцию из очень большого количества разных персонажей, антагонистов
                и второстепенных героев. А еще у нас можно найти игры «Черепашки Ниндзя», настольные детские
                игры, лото и домино.</p>
            <p>В нашем интернет-магазине Toys Вы сможете купить черепашки-ниндзя на любой вкус, ведь игровые
                фигурки выполнены в разном стиле и с разным комплектом аксессуаров, так что подобрать именно то,
                что нужно Вашему непоседе - не составит никакого труда.</p>
            <p>Здесь малыш сможет выбрать себе не только пресловутых Леонардо, Донателло, Рафаэлло и
                Микеланджело, но и Мастера Сплинтера, Шреддера и даже красавицу Эйприл. Кроме того, Вы можете
                купить целый игровой центр для Teenage Mutant Hero Turtles, включающий в себя место обитание
                знаменитых героев, а так же разнообразные аксессуары вроде игрушечной рогатки с
                черепашками-нинзя или детский мобильный телефон с фигуркой Leonardo.</p>
            <p>Мы оформим Вам доставку в Киев, Днепропетровск, Харьков, Запорожье, Львов и другие города
                Украины!</p></div>
    </div> <!-- span9 -->
@endsection