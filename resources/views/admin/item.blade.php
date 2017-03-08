@extends('layouts.admin')
@section('content')

    <div class="span12">
        <h1>Добавление нового товара</h1>

        <fieldset>
            <legend>Форма товара</legend>

            <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <label for="name">Название товара:</label>
                <input required style="width: 100%" id="name" name="name" type="text">
                <br>

                <label for="alias">Алиас товара:</label>
                <input required style="width: 100%" id="alias" name="alias" type="text">
                <br>

                <label for="description">Описание товара:</label>
                <textarea required style="width: 100%;height: 200px;" id="description" name="description"></textarea>
                <br>

                <label for="price">Цена товара (грн):</label>
                <input required style="width: 100%" id="price" name="price" type="number">
                <br>

                <label for="count">Остаток на складе (единиц):</label>
                <input required style="width: 100%" id="count" value="1" name="count" type="number">
                <br>

                <label for="id_catalogue">Категория товара:</label>
                <select required style="width: 100%" id="id_catalogue" name="id_catalogue">
                    <option value="1">Фильмы и комиксы</option>
                    <option value="2">Конструкторы</option>
                    <option value="3">Животные</option>
                </select>
                <br>

                <table width="100%">
                    <tr>
                        <td>
                            <label for="main_photo">Основное фото товара:</label>
                            <input required id="main_photo" name="main_photo" type="file">
                        </td>
                        <td>
                            <label for="extra_photo">Дополнительные фото товара:</label>
                            <input id="extra_photo" name="photos[]" type="file" multiple>
                        </td>
                        <td>
                            <button style="padding: 20px;">Добавить товар</button>
                        </td>
                    </tr>
                </table>



            </form>


        </fieldset>

        <div class="clear"></div>
    </div>

    </div>
@endsection