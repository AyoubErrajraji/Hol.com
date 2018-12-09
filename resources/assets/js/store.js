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
        userLoaded: false,
        userDetails: [],
        userDetailsLoaded: false,
        orderBy: 'id',
        order: 'asc',

    },
    getters: {
        shopProducts: state => state.shopProducts,
        shopProductsLoaded: state => state.shopProductsLoaded,
        userDetails: state => state.userDetails,
        userDetailsLoaded: state => state.userDetailsLoaded,
        payments: state => state.payments,
        inCart: state => state.inCart,
        orderBy: state => state.orderBy,
        order: state => state.order,
        categories: state => state.categories,
        user: state => state.user,
        userLoaded: state => state.userLoaded,
    },
    mutations: {
        ADD_TO_CART(state, invProduct) { state.inCart.push(invProduct); },
        REMOVE_FROM_CART(state, index) { state.inCart.splice(index, 1); },
        ADD_CATEGORIES(state, categories) { state.categories = categories; },
        ADD_PRODUCTS(state, products) { state.shopProducts = products; state.shopProductsLoaded= true;},
        ADD_USER_DETAILS(state, details) { state.userDetails = details; state.userDetailsLoaded= true;},
        ADD_USER(state, user) { state.user = user; state.userLoaded= true;},
        ADD_ORDERBY(state, orderby) { state.orderBy = orderby; },
        ADD_ORDER(state, order) { state.order = order; },
        ADD_PAYMENT(state, payments) {state.payments = payments; }
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
        addUserDetails(context, details) {
            context.commit('ADD_USER_DETAILS', details);
        },
        addOrderBy(context, orderby) {
            context.commit('ADD_ORDERBY', orderby);
        },
        addOrder(context, order) {
            context.commit('ADD_ORDER', order);
        },
        addPayment(context, payments) {
            context.commit('ADD_PAYMENT', payments);
        },
    }
});