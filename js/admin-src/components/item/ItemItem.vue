<template>
    <tr :style="item.is_enabled ? {} : {'background-color': '#FCC'}">
        <td>{{item.id}}</td>
        <td>
            <img :src="'/images/items/' + item.main_image.url_200" width="100">
            <br>
            всего {{item.images.length}} картинок
        </td>
        <td>{{item.name}}</td>
        <td>{{item.alias}}</td>
        <td>{{item.price}} UAH</td>
        <td>{{item.discount}} UAH</td>
        <td>{{item.count}} Items</td>
        <td>
            <a @click.prevent="edit" href="#">Редактировать</a>
            <a @click.prevent="remove" href="#" class="delete-item">Удалить</a>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['item'],

        methods: {
            edit () {
                this.$emit('edit', this.item);
            },

            remove () {
                if (!confirm('Точно удалить ' + this.item.name + ' ?')) {
                    return;
                }


            }
        }
    }
</script>

<style>
    .delete-item {
        color: #942a25;
    }
</style>
