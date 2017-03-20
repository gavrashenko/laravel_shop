import Vue from 'vue'
import VueResource from 'vue-resource'
import Vuelidate from 'vuelidate'
import VueMask from 'v-mask'
import store from './store/index'
import Cart from './components/cart/Cart.vue'
import Catalogue from './components/catalogue/List.vue'
import Item from './components/item/Item.vue'
import Order from './components/order/Order.vue'

Vue.use(VueResource);
Vue.use(Vuelidate);
Vue.use(VueMask);

Vue.http.interceptors.push(function(request, next) {
    if (request.method === 'POST') {
        request.headers.set('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    }
    next();
});

new Vue({
    el: '#app',
    store,
    http: {
        root: '/'
    },
    data () {
        return {
            templateData
        };
    },
    components: {
        Cart,
        Catalogue,
        Item,
        Order
    }
});
