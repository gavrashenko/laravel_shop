import Vue from 'vue'

export default {
    saveOrder (data) {
        return Vue.http.post('/order', data).then(resp => {
            return resp.body;
        });
    },
    saveQuickOrder (data) {
        return Vue.http.post('/quick-order', data).then(resp => {
            return resp.body;
        });
    }
};