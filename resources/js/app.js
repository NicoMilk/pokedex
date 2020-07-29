require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Pokedex from './components/Pokedex.vue';
import Team from './components/Team.vue';
import Trade from './components/Trade.vue';

/* 
Vue.component('Pokedex',Pokedex);
Vue.component('Pokedex',Team); */

const routes = [
    {
        path : '/',
        component: Pokedex
    },
    {
        path: '/team',
        component: Team
    },
    {
        path: '/trade',
        component: Trade
    }
]; 

const router = new VueRouter({routes});

const app = new Vue({

    el: '#app',
    router
});
