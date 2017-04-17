import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import Order from "./components/order/Order.vue"
import Catalogue from "./components/catalogue/Catalogue.vue"
import Item from "./components/item/Item.vue"

Vue.use(VueResource);
Vue.use(VueRouter);

Vue.http.interceptors.push(function(request, next) {
    if (request.method === 'POST') {
        request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
    }
    next();
});

Vue.http.options.root = '/admin4k';

const routes = [
    { path: '/', component: Order },
    { path: '/catalogues', component: Catalogue },
    { path: '/items', component: Item }
];

const router = new VueRouter({
    routes
});

new Vue({
    router,
    el: '#app',
    template: `
        <div>
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Магазин Нормас</a>
                </div>
                <ul class="nav navbar-nav">
                    <li :class="{active: active === 'orders'}" @click="activate('orders')">
                        <router-link to="/">Заказы</router-link>
                    </li>
                    <li :class="{active: active === 'catalogues'}" @click="activate('catalogues')">
                        <router-link to="/catalogues">Категории</router-link>
                    </li>
                    <li :class="{active: active === 'items'}" @click="activate('items')">
                        <router-link to="/items">Товары</router-link>
                    </li>
                </ul>
              </div>
            </nav>
        
            <router-view></router-view>
        </div>
    `,
    data () {
        return {
            active: 'orders'
        };
    },

    methods: {
        activate (name) {
            this.active = name;
        }
    }
});
