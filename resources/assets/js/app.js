
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './router';
import store from './store';
import CartComponent from './components/CartComponent';
import UserComponent from './components/UserComponent';
import CategoryComponent from './components/CategoryComponent';
import BreadcrumbComponent from './components/BreadcrumbComponent';
import SettingsComponent from './components/SettingsComponent';
import WishListComponent from './components/WishListComponent';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import axios from 'axios';
import Paginate from 'vuejs-paginate';

Vue.component('paginate', Paginate);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        CartComponent,
        UserComponent,
        CategoryComponent,
        BreadcrumbComponent,
        SettingsComponent,
        WishListComponent
    },
    data(){
        return  {
            categories: [],
            errorMessages: []
        }
    },

    created() {
        axios.get(`/api/categories`, {
        }).then(result => {
            this.categories = result.data;
            this.$store.dispatch('addCategories', this.categories)
                .then(() => console.log('Categories added to store state'));
        }).catch((e) => {
            this.errorMessages.push(e);
        })
    },
});


