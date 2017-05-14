<template>
    <div class="item container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Товары:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li v-for="catalogue in catalogues"
                        role="presentation"
                        :class="{active: catalogue.id === selected.id}">
                        <a @click.prevent="setCatalogue(catalogue)" href="#">{{catalogue.name}}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <table class="table table-striped">
                    <tbody>
                        <tr v-for="item in items" is="Item" :item="item" @edit="editItem">
                        </tr>
                    </tbody>
                </table>
                <pre>{{items[0]}}</pre>
                <Modal :item="modalItem" :is-visible="isModalVisible" @close="closeModal"></Modal>
            </div>
        </div>
    </div>
</template>

<script>
    import catalogueApi from "../../api/catalogue-api"
    import itemApi from "../../api/item-api"
    import Item from "./ItemItem.vue"
    import Modal from "./Modal.vue"

    export default {
        data () {
            return {
                catalogues: null,
                selected: null,
                items: [],
                modalItem: null,
                isModalVisible: false
            }
        },

        methods: {
            setCatalogue (catalogue) {
                this.selected = catalogue;
            },

            editItem (item) {
                this.modalItem = item;
                this.isModalVisible = true;
            },

            closeModal () {
                this.modalItem = null;
                this.isModalVisible = false;
            }
        },

        watch: {
            selected (catalogue) {
                itemApi.getByCatalogue(catalogue).then(resp => {
                    this.items = resp.items;
                })
            }
        },

        beforeRouteEnter (to, from, next) {
            catalogueApi.getAll().then(resp => {
                next(vm => {
                    vm.catalogues = resp.catalogues;
                    vm.selected = resp.catalogues[0];
                })
            })
        },

        components: {
            Item,
            Modal
        }
    }
</script>
