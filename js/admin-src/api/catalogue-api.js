import Vue from 'vue'

export default {
    getAll () {
        return Vue.http.get('catalogue/all').then(resp => {
            return resp.body;
        });
    }
};