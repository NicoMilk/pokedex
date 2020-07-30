<template>
    <div class="d-flex flex-column  justify-content-between h-100">
        <div class="content bg-blur h-100 overflow-auto" >  
    
            {{pokStore.name}}
            {{pokStore.image}}
            {{pokStore.types.type1}}
            {{pokStore.types.type2}}
            
        </div>
        <pok-footer/>
    </div>
</template>

<script>

import Footer from './Footer.vue';
import Stats from './Stats.vue';
import Weak from './Weak.vue';
import Evol from './Evol.vue';

    export default {
        
        components: {
            "stats" : Stats,
            "weak" : Weak,
            "evol" : Evol,
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
