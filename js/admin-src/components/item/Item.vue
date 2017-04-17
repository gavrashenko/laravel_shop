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
                {{items}}
            </div>
        </div>
    </div>
</template>

<script>
    import catalogueApi from "../../api/catalogue-api"
    import itemApi from "../../api/item-api"

    export default {
        data () {
            return {
                catalogues: null,
                selected: null,
                items: []
            }
        },

        methods: {
            setCatalogue (catalogue) {
                this.selected = catalogue;
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
    }
</script>
