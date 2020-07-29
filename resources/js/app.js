require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex'
import storeData from "./store/index"
import Pokedex from './components/Pokedex.vue';
import Team from './components/Team.vue';
import Trade from './components/Trade.vue';

Vue.use(VueRouter);
Vue.use(Vuex);


const store = new Vuex.Store(
    storeData
) 

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
    router,
    store
});
