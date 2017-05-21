<template>
    <div id="item-modal" v-if="isVisible" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Редактирование {{item.name}}</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="item-name">Название</label>
                            <input v-model="form.name" type="text" class="form-control" id="item-name">
                        </div>
                        <div class="form-group">
                            <label for="item-alias">Алиас</label>
                            <input v-model="form.alias" type="text" class="form-control" id="item-alias">
                        </div>
                        <div class="form-group">
                            <label for="item-description">Описание</label>
                            <textarea v-model="form.description" rows="10" class="form-control" id="item-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="item-alias">Цена (в гривнях)</label>
                            <input v-model="form.price" type="text" class="form-control" id="item-price">
                        </div>
                        <div class="form-group">
                            <label for="item-alias">Скидка (в гривнях)</label>
                            <input v-model="form.discount" type="text" class="form-control" id="item-discount">
                        </div>
                        <div class="form-group">
                            <label for="item-alias">Остаток (в штуках)</label>
                            <input v-model="form.count" type="number" class="form-control" id="item-count">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input v-model="form.is_enabled" type="checkbox"> Доступна на сайте?
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="item-main-image">Главная картинка {{form.images[1]}}</label>
                            <img v-if="!isNew" :src="'/images/items/' + form.main_image.url_200" width="100">
                            <input type="file" id="item-main-image">
                            <p class="help-block">Эта картинка будет первой отображаться на сайте.</p>
                        </div>

                        <p>Дополнительные картинки: (<a @click.prevent="addMorePhotos" href="#">еще</a>)</p>

                        <div v-for="n in newImagesCount">
                            <input type="file" class="item-new-image">
                        </div>

                        <div v-if="!isNew" class="form-group" v-for="image in form.images">
                            <img v-if="!isNew" :src="'/images/items/' + image.url" width="100">
                            <a href="#">удалить</a>
                            <br>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                    <button @click="save" type="button" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import _ from 'lodash'
    import itemApi from '../../api/item-api'

    export default {
        props: ['item', 'isVisible'],

        data () {
            return {
                form: null,
                newImagesCount: 1
            }
        },

        methods: {
            getEmptyItem () {
                return {
                    name: ''
                };
            },

            addMorePhotos () {
                this.newImagesCount++;
            },

            save () {
                let data = new FormData();
                $('.item-new-image').each((i, image) => {
                    for (let j in image.files) {
                        data.append('files[]', image.files[j]);
                    }
                });
                $('#item-main-image').each((i, image) => {
                    for (let j in image.files) {
                        data.append('main', image.files[j]);
                    }
                });

                for (let i in this.form) {
                    data.append(i, this.form[i]);
                }

                itemApi.saveItem(data).then(() => {
                    debugger
                });
            }
        },

        computed: {
            isNew () {
                return typeof this.form.id === 'undefined';
            }
        },

        watch: {
            isVisible (value) {
                if (value) {
                    if (this.item !== null) {
                        this.form = _.clone(this.item);
                    } else {
                        this.form = this.getEmptyItem();
                    }

                    Vue.nextTick(() => {
                        $('#item-modal').modal('show').on('hide.bs.modal', () => {
                            this.$emit('close');
                        });
                    })
                }
            }
        }
    }
</script>
