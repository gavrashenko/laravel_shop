import Vue from 'vue'

export default {
    getByCatalogue (catalogue) {
        return Vue.http.get('catalogue/items/' + catalogue.alias).then(resp => {
            return resp.body;
        });
    }
};