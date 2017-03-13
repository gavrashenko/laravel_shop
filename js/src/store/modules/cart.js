import _ from "lodash"

export default {
    state: {
        items: []
    },

    getters: {
        cartItems (state) {
            return state.items;
        },

        cartItemsCount (state) {
            return _.sumBy(state.items, (i) => i.count);
        },

        cartTotalPrice (state) {
            return _.sumBy(state.items, (i) => i.item.price * i.count);
        }
    },

    // actions: {
    //     cartAdd (store, item) {
    //         store.commit('CART_ADD_ITEM', item)
    //     }
    // },

    mutations: {
        CART_ADD_ITEM (state, item) {
            let found = _.find(state.items, {id: item.id});

            if (found === undefined) {
                state.items.push({
                    item,
                    id: item.id,
                    count: 1
                });
            } else {
                found.count++;
            }

        },

        CART_REMOVE_ITEM  (state, item) {
            let index = _.findIndex(state.items, {id: item.id});

            if (index !== -1) {
                state.items.splice(index, 1);
            }
        },

        CART_SET_ITEMS_COUNT  (state, {item, count}) {
            let found = _.find(state.items, {id: item.id});

            if (found !== undefined) {
                found.count = count;
            }
        }
    }
}