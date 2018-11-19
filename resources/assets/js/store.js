import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        shopProducts: [],
        shopProductsLoaded: false,
        inCart: [],
        categories: [],
        user: null,
        orderBy: 'id',
    },
    getters: {
        shopProducts: state => state.shopProducts,
        shopProductsLoaded: state => state.shopProductsLoaded,
        inCart: state => state.inCart,
        orderBy: state => state.orderBy,
        categories: state => state.categories,
        user: state => {
            return state.user;
        },
    },
    mutations: {
        ADD_TO_CART(state, invProduct) { state.inCart.push(invProduct); },
        REMOVE_FROM_CART(state, index) { state.inCart.splice(index, 1); },
        ADD_CATEGORIES(state, categories) { state.categories = categories; },
        ADD_PRODUCTS(state, products) { state.shopProducts = products; state.shopProductsLoaded= true;},
        ADD_USER(state, user) { state.user = user; },
        ADD_ORDERBY(state, orderby) { state.orderBy = orderby; },
    },
    actions: {
        addToCart(context, invProduct) {
            context.commit('ADD_TO_CART', invProduct);
        },
        removeFromCart(context, index) {
            context.commit('REMOVE_FROM_CART', index);
        },
        addUser(context, user) {
            context.commit('ADD_USER', user);
        },
        addCategories(context, categories) {
            context.commit('ADD_CATEGORIES', categories);
        },
        addProducts(context, products) {
            context.commit('ADD_PRODUCTS', products);
        },
        addOrderBy(context, orderby) {
            context.commit('ADD_ORDERBY', orderby);
        },
    }
});