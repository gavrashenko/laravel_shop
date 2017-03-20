import Vue from 'vue'

export default {
    saveOrder (data) {
        return Vue.http.post('/order', data).then(resp => {
            return resp.body;
        });
    }
};