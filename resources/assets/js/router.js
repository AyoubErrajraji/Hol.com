import Vue from 'vue';
import Router from 'vue-router';

import Home from './pages/Home'
import Product from './pages/Product'
import Category from './pages/Category'
import Cart from './pages/Cart'
import Checkout from './pages/Checkout'
import Payment from './pages/Payment'
import NotFound from './pages/NotFound'

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
            path: '/cart/',
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
            path: '*',
            name: 'NotFound',
            component: NotFound,
            meta: {description: '404 | Page not found'}
        }
    ]
});