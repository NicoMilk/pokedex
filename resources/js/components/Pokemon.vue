<template>
    <div class="d-flex flex-column  justify-content-between h-100">
        <div class="content bg-blur h-100 overflow-auto" >  
    
            {{pokStore.name}}
            {{pokStore.image}}
            {{pokStore.types.type1}}
            {{pokStore.types.type2}}
            {{pokStore.description}}

            <router-link :to="{ name: 'stats' }">Stats</router-link>
            <router-link :to="{ name: 'weak' }">Weaknesses</router-link>
            <router-link :to="{ name: 'evol' }">Evolutions</router-link>
            
            <router-view/>
            
        </div>
        <pok-footer/>
    </div>
</template>

<script>

import Footer from './Footer.vue';

    export default {
        
        components: {
            "pok-footer" : Footer
        },
        name:"pokemon",
        mounted() {
            this.$store.dispatch("getPok", this.$route.params.id );            
        },
        computed : {
            pokStore () {
                return this.$store.getters.getPok;
            }
        }
    }
</script>
