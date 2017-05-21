import Vue from 'vue'

export default {
    getByCatalogue (catalogue) {
        return Vue.http.get('catalogue/items/' + catalogue.alias).then(resp => {
            return resp.body;
        });
    },

    saveItem (data) {

        return Vue.http.post('/admin4k/item/save', data).then(resp => {
            return resp.body;
        });

        // return $.ajax({
        //     url: '/admin4k/item/save',
        //     data: data,
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     type: 'POST'
        // });
    }
};