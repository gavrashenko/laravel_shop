import Vue from 'vue'

export default {
    getAll () {
        return Vue.http.get('order/all').then(resp => {
            return resp.body;
        });
    }
};