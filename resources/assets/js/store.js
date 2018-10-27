import Vue from 'vue';
import Vuex from 'vuex';
import _ from 'lodash';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        products: [],
        products_loaded: false,
        cart: [],
        cart_loaded: false,
        wishlist: [],
        wishlist_loaded: false,
        user: null,
        user_loaded: false,
        settings: null,
        settings_loaded: false,
        search: '',
    },
    getters: {
        products: state => {
            return state.products.filter(product => {
                return product.title.toLowerCase().includes(state.search.toLowerCase())
            })
        },
        productsLoaded: state => {
            return state.products_loaded;
        },

        cart: state => {
            return state.cart;
        },

        getProductById: (state) => (id) => {
            return state.products.find(product => product.id === id);
        },

        wishlist: state => {
            return state.wishlist;
        },
        wishlistLoaded: state => {
            return state.wishlist_loaded;
        },

        user: state => {
            return state.user;
        },
        userLoaded: state => {
            return state.user_loaded;
        },

        settings: state => {
            return state.settings;
        },
        settingsLoaded: state => {
            return state.settings_loaded;
        },

        search: state => {
            return state.search;
        },
    },
    mutations: {
        ADD_PRODUCTS(state, products) {
            state.products = products;
            state.products_loaded = true;
        },
        ADD_TO_CART(state, product) {
            state.cart.push(product);
        },
        REMOVE_FROM_CART(state, index) {
            state.cart.splice(index, 1);
        },
        ADD_WISHLIST(state, wishlist) {
            state.wishlist = wishlist;
            state.wishlist_loaded = true;
        },
        ADD_WISHLIST_ITEM(state, item) {
            state.wishlist.push(item);
        },
        REMOVE_WISHLIST_ITEM(state, item_id) {
            const index = state.wishlist.indexOf(state.wishlist.find(item => item.id === item_id));
            if(index > -1) {
                state.wishlist.splice(index, 1);
            }
        },
        ADD_USER(state, user) {
            state.user = user;
            state.user_loaded = true;
        },
        ADD_SETTINGS(state, settings) {
            state.settings = settings;
            state.settings_loaded = true;
        },
        SET_SEARCH(state, search) {
            state.search = search;
        },
    },
    actions: {
        addProducts(context, products) {
            context.commit('ADD_PRODUCTS', products);
        },
        addToCart(context, product) {
            context.commit('ADD_TO_CART', product);
        },
        removeFromCart(context, index) {
            context.commit('REMOVE_FROM_CART', index);
        },
        addWishlist(context, wishlist) {
            context.commit('ADD_WISHLIST', wishlist)
        },
        addWishlistItem(context, item) {
            context.commit('ADD_WISHLIST_ITEM', item);
        },
        deleteWishlistItem(context, id) {
            context.commit('REMOVE_WISHLIST_ITEM', id);
        },
        addUser(context, user) {
            context.commit('ADD_USER', user);
        },
        addSettings(context, settings) {
            context.commit('ADD_SETTINGS', settings);
        },
        setSearch(context, search) {
            context.commit('SET_SEARCH', search)
        },
    },
});