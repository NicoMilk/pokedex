require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Pokedex from './components/Pokedex.vue';
import Team from './components/Team.vue';

 const routes = [
    {
        path : '/',
        component: Pokedex
    },
    {
        path: '/team',
        component: Team
    }
]; 
Vue.component('Pokedex', require ('./components/Pokedex.vue').default)
const Router = new VueRouter(routes);

const app = new Vue({
    Router,
    el: '#app',
});
