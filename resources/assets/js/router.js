import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home'
import Ad from './pages/Ad'

Vue.use(Router);

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
];

const router =  new Router({mode: 'history', routes});

export default router;