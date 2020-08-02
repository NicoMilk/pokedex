<template>
    <div class="content h-100 overflow-auto bg-light px-4" >                 
        <div v-for="(pok, index) in myProfileStore.team" :key="index">
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
</template>

<script> 

export default {

    name: 'PokList',
    
    mounted() {
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
        myProfileStore() {
            return this.$store.getters.getMyUserProfile;
        },

        pokListPix() {
            return "/img/profile/"+this.myProfileStore.team[0].image//+".png"
        }
    }
}

</script>