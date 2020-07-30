<template>
    <div class="d-flex flex-column  justify-content-between h-100">

            <pok-header/>          
            <div class="content bg-blur h-100 overflow-auto" >                 
                <div v-for="(pok, index) in poksStore" :key="index">
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
        mounted() {
            this.$store.dispatch("getPoks");
            
        },
        computed : {
            poksStore () {
                return this.$store.getters.getPoks;
            }
        }
    }
</script>
