import Vue from 'vue'
import store from './store'
import router from './router'
import axios from 'axios'
import CartComponent from './components/CartComponent';
import SearchComponent from './components/SearchComponent';
import BreadcrumbComponent from './components/BreadcrumbComponent';
import SettingsComponent from './components/SettingsComponent';

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        CartComponent,
        SearchComponent,
        BreadcrumbComponent,
        SettingsComponent
    },
    store,
    router,
    mounted() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios.get('/api/products')
                .then(response => {
                    this.$store.dispatch('addProducts', response.data)
                        .then(() => { console.log('Products added to store state') });
                })
                .catch(err => {
                    console.log(err);
                });
        },
    }
});
