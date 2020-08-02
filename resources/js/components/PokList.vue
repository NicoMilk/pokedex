<template>
    <div class="content bg-blur" >                 
        <div v-for="(pok, index) in myProfileStore.team" :key="index">
            <router-link class="" :to="{ name: 'pokemon', params: { id: pok.id }}">
                <div class="container-fluid justify-content-between">
                    {{ pok.image }}
                    <img v-bind:src="pokListPix" alt="" width="50" height="50" class="profilePix">
                    {{ pok.name }}
                    {{ pok.id }}
                    {{ pok.types.type1 }}
                    {{ pok.types.type2 }}
                </div>
            </router-link>
        </div>
</template>

<script> 

export default {

    name: 'PokList',
    
    mounted() {
    },

    computed : {
        myProfileStore() {
            console.log(this.$store.getters.getMyUserProfile);
            return this.$store.getters.getMyUserProfile;
        },

        pokListPix() {
            return "/img/profile/"+this.myProfileStore.team[0].image//+".png"
        }
    }

}

</script>