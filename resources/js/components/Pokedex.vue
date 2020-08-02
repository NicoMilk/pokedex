<template>
        <div class="d-flex flex-column justify-content-between h-100">
            
            <h3 class="text-center py-3 m-0 bg-blur">
                <a>Pokemons</a>
            </h3>
            <div class="bg-blur text-center">
                   <input class="searchbar px-2 mb-2" type="text" v-model= "query" placeholder="Search"/>
            </div>
            <div class="sep">&nbsp;</div> 
                     
            <div class="content h-100 overflow-auto bg-light px-4" >                 
                <div v-for="(pok, index) in filteredpoks" :key="index">
                    <router-link class="" :to="{ name: 'pokemon', params: { id: pok.id }}">
                          
                        <div class="d-flex flex-row flex-nowrap justify-content-between my-3">
                            <img v-bind:src="pokImage(pok)" :alt="pok.name" class="pok-sm"/>
                            <div class="flex-grow-1 text-left ml-3" >
                                <h5>{{ pok.name }}</h5>                
                                <div class="pok-id">{{ getPokId(pok.id) }}</div>
                            </div>
                            <div>
                                <img v-bind:src="typeImage(pok.types.type1)" :alt="pok.types.type1" class="pok-type"/>
                                <img v-if="pok.types.type2" v-bind:src="typeImage(pok.types.type2)" :alt="pok.types.type2" class="pok-type"/>
                            </div>
                        </div> 
                        <hr/>
        
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
        methods : {

            pokImage (pok) {
                return "/img/pokemon/" + pok.image ;
            },
            typeImage (type) {
                return "/img/types/small/types-" + type + ".png" ;
            },
            getPokId (id) {
                return "#" + ("00"+id).substr(-3);
            }
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
