import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        shopProducts: [],
        shopProductsLoaded: false,
        inCart: [],
        categories: [],
        wishlist: [],
        wishlist_loaded: false,
        user: null,
        userLoaded: false,
        userDetails: [],
        userDetailsLoaded: false,
        orderBy: 'id',
        order: 'asc',
        errorMessages: null,
    },

    getters: {
        shopProducts: state => state.shopProducts,
        shopProductsLoaded: state => state.shopProductsLoaded,
        userDetails: state => state.userDetails,
        userDetailsLoaded: state => state.userDetailsLoaded,
        payments: state => state.payments,
        inCart: state => state.inCart,
        inWishList: state => {
            return state.wishlist;
        },
        orderBy: state => state.orderBy,
        order: state => state.order,
        categories: state => state.categories,
        user: state => state.user,
        userLoaded: state => state.userLoaded,
    },

    mutations: {
        ADD_TO_CART(state, invProduct) { state.inCart.push(invProduct); },
        REMOVE_FROM_CART(state, index) { state.inCart.splice(index, 1); },
        ADD_TO_WISHLIST(state, wishlist) {
            state.wishlist = wishlist;
        },
        ADD_WISHLIST_ITEM(state, item) {
            state.wishlist.push(item);
        },
        REMOVE_WISHLIST_ITEM(state, index) { state.wishlist.splice(index, 1); },
        REMOVE_FROM_WISHLIST(state, index) { state.wishlist.splice(index, 1); },
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
            var i;
            var bool = false;
            for (i = 0; i < this.state.inCart.length; i++) {
                if (this.state.inCart[i].product.id === invProduct.id) {
                    bool = true;
                    axios.put(`/api/cartitem`,{
                        id: this.state.inCart[i].id,
                        amount: 1,
                    });
                    this.state.inCart[i].amount++
                }
            }

            if (!bool) {
                axios.post(`/api/cartitem`,{
                    productId: invProduct.id,
                    cartId: 1,
                    amount: 1,
                    completed: false
                }).then(result => {
                    result.data.product = invProduct;
                    context.commit('ADD_TO_CART', result.data);
                }).catch((e) => {
                    //
                })
            }

        },
        addToCartFromDb(context, invProduct) {
                context.commit('ADD_TO_CART', invProduct);
        },
        removeFromCart(context, index) {
            axios.delete(`/api/cartitem/${this.state.inCart[index].id}`).catch((e) => {
                //
            });

            context.commit('REMOVE_FROM_CART', index);
        },

        addWishList(context, wishlist) {
            context.commit('ADD_TO_WISHLIST', wishlist)
        },
        addToWishList(context, id) {
            axios.post('/api/wishlistitem', {
                productId: id,
                wishlistId: 1,
                completed: false,
            }).then(result => {
                result.data.product = id;
                context.commit('ADD_WISHLIST_ITEM', result.data);
            }).catch((e) => {
                //
            })

        },
        deleteWishListItem(context, id) {
            context.commit('REMOVE_WISHLIST_ITEM', id);
        },

        addToWishListFromDb(context, invProduct) {
            context.commit('ADD_WISHLIST_ITEM', invProduct);
        },

        removeFromWishList(context, index) {
            axios.delete(`/api/wishlistitem/${this.state.wishlist[index].id}`).catch((e) => {
                //
            });

            context.commit('REMOVE_FROM_WISHLIST', index);
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