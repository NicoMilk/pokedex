<template>
    <div class="d-flex flex-column justify-content-start my-3">      
        <div class="d-flex flex-row flex-nowrap justify-content-center">
            <div><img v-bind:src="pokImage" :alt="pokStore.name" class="pok-evol"/>
                <div>{{ pokStore.name }}</div>
            </div>
            <div class="w-25 pt-3 " v-if="pokStore.evolutions.evolution_id">
                <div>{{ pokStore.evolutions.required_lvl}}</div>                
                <div><i class="fa fa-long-arrow-right"></i></div>
            </div>
            <div v-if="pokStore.evolutions.evolution_id">
                <img v-bind:src="evolPokImage" :alt="pokEvolStore.name" class="pok-evol"/>
                <div>{{ pokEvolStore.name }}</div>
            </div>
        </div> 
        <div v-if="pokEvolStore.evolutions.evolution_id" class="px-5"><hr/></div>
        <div v-if="pokEvolStore.evolutions.evolution_id" class="d-flex flex-row flex-nowrap justify-content-center">
            <div><img v-bind:src="evolPokImage" :alt="pokEvolStore.name" class="pok-evol"/>
                  <div>{{ pokEvolStore.name }}</div>
            </div>
            <div class="w-25">
                <div>{{ pokEvolStore.evolutions.required_lvl}}</div>                
                <div><i class="fa fa-long-arrow-right"></i></div>
            </div>            
            <div>
                <img  v-bind:src="evolPokImage2" :alt="pokEvolStore2.name" class="pok-evol"/>  
                <div>{{ pokEvolStore2.name }}</div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        
        computed : {
            pokStore () {
                return this.$store.getters.getPok;
            },
            pokEvolStore () {
                return this.$store.getters.getEvolPok;
            },
            pokEvolStore2 () {
                return this.$store.getters.getEvolPok2;
            },
            pokImage () {
                return "/img/pokemon/" + this.pokStore.image ;
            },
            evolPokImage () {
                return "/img/pokemon/" + this.pokEvolStore.image ;
            },
            evolPokImage2 () {
                return "/img/pokemon/" + this.pokEvolStore2.image ;
            }
        }
    }
</script>
