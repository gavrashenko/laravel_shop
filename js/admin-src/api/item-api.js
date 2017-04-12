import Vue from 'vue'
import _ from 'lodash'

export default {
    getMainImages (items) {
        let idItems = _.map(items, cart => cart.item.id);

        return Vue.http.post('/image/get-main-images', {
            idItems
        }).then(resp => {
            return resp.body;
        });
    }
};