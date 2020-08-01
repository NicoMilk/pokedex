<template>
    <div>
        <div class="d-flex flex-column  justify-content-between h-100">
            <div>
        <h3 class="text-center py-3 m-0 bg-blur">
                <a>Pokemons</a>
            
            <input class = "searchbar" type = "text" v-model= "query" placeholder= "Search " > 
            </h3>
            </div>
            <div class="sep">&nbsp;</div> 
    </div>         
            <div class="content bg-blur h-100 overflow-auto" >                 
                <div v-for="(pok, index) in filteredpoks" :key="index">
                    <router-link class="" :to="{ name: 'pokemon', params: { id: pok.id }}">
                    {{ pok.name }}
                    </router-link>
                </div>
            </div>
            <pok-footer/>
        </div>
    
</template>

<script>

import Footer from './Footer.vue';
import Header from './Header.vue';

    export default {
        components: {
            "pok-header" : Header,
            "pok-footer" : Footer
        },
        name:"pokedex",

        data: () => ({ 
            query:'',
        }),
        mounted() {
            this.$store.dispatch("getPoks");
            
        },
        computed : {
            poksStore () {
                return this.$store.getters.getPoks;
            },
            filteredpoks() {
                return this.$store.getters.getPoks.filter((poks)=> {
                    return poks.name.match(this.query);
                });
             }
        }
    }
</script>
