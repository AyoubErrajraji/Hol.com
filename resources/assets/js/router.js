import Vue from 'vue';
import Router from 'vue-router';

import Home from './pages/Home'
import OrderHistory from './pages/OrderHistory'
import Order from './pages/Order'
import Product from './pages/Product'
import Category from './pages/Category'
import Cart from './pages/Cart'
import Checkout from './pages/Checkout'
import Payment from './pages/Payment'
import NotFound from './pages/NotFound'
import Succes from './pages/Succes'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home,
            meta: {description: 'Home'}
        },
        {
            path: '/history/:id',
            name: 'OrderHistory',
            component: OrderHistory,
            meta: {description: 'OrderHistory'}
        },
        {
            path: '/order/:id',
            name: 'Order',
            component: Order,
            meta: {description: 'Order'}
        },
        {
            path: '/product/:id',
            name: 'Product',
            component: Product,
            meta: {description: 'Product'}
        },
        {
            path: '/category/:id',
            name: 'Category',
            component: Category,
            meta: {description: 'Category'}
        },
        {
            path: '/cart',
            name: 'Cart',
            component: Cart,
            meta: {description: 'Cart'}

        },
        {
            path: '/checkout',
            name: 'Checkout',
            component: Checkout,
            meta: {description: 'Checkout'}
        },
        {
            path: '/payment',
            name: 'Payment',
            component: Payment,
            meta: {description: 'Payment'}
        },
        {
            path: '/succes',
            name: 'Succes',
            component: Succes,
            meta: {description: 'Succes'}
        },

        {
            path: '*',
            name: 'NotFound',
            component: NotFound,
            meta: {description: '404 | Page not found'}
        }
    ]
});