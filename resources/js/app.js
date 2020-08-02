require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex'
import storeData from "./store/index"
import Pokedex from './components/Pokedex.vue';
import Team from './components/Team.vue';
import Trade from './components/Trade.vue';
import TradeIn from './components/TradeIn.vue';
import Pokemon from './components/Pokemon.vue';
import Stats from './components/Stats.vue';
import Weak from './components/Weak.vue';
import Evol from './components/Evol.vue';


Vue.use(VueRouter);
Vue.use(Vuex);


const store = new Vuex.Store(
    storeData
) 

let apiToken = "";
window.onload = () => {

    apiToken = window.Laravel ? window.Laravel.apiToken : '';
    console.log("apiToken : ", apiToken);
    store.commit("setApiToken", apiToken)

}

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
    },{
        name: 'tradein',
        path: '/tradein/:idt',
        component: TradeIn
    },
    {
        path: '/pokemon/:id',
        component: Pokemon,
        children: [
            {
                name: "pokemon",
                path: '',
                component: Stats
            },
            {
                name:"stats",
                path: 'stats',
                component: Stats
            },
            {
                name:"weak",
                path: 'weak',
                component: Weak
            },
            {
                name:"evol",
                path: 'evol',
                component: Evol
            }
          ]
    }
]; 

const router = new VueRouter({routes});

const app = new Vue({

    el: '#app',
    router,
    store,
    apiToken
});


