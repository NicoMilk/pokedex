require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex'
import storeData from "./store/index"
import Pokedex from './components/Pokedex.vue';
import Team from './components/Team.vue';
import Trade from './components/Trade.vue';
import Pokemon from './components/Pokemon.vue';

Vue.use(VueRouter);
Vue.use(Vuex);


const store = new Vuex.Store(
    storeData
) 

const routes = [
    {
        name:'pokedex',
        path : '/',
        component: Pokedex
    },
    {
        name: 'team',
        path: '/team',
        component: Team
    },
    {
        name: 'trade',
        path: '/trade',
        component: Trade
    },
    {
        name: 'pokemon',
        path: '/pokemon/:id',
        component: Pokemon
    }
]; 

const router = new VueRouter({routes});

const app = new Vue({

    el: '#app',
    router,
    store
});


