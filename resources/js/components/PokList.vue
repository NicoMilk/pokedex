<template>
    <div >
        <div class="content bg-blur h-100 overflow-auto" >                 
            <div v-for="(pok, index) in myTeamStore" :key="index">
                <router-link class="" :to="{ name: 'pokemon', params: { id: pok.id }}">
                {{ pok.image }}
                {{ pok.name }}
                {{ pok.id }}
                {{ pok.types.type1 }}
                {{ pok.types.type2 }}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    name: 'PokList',
    
    mounted() {
    },

    computed : {
    }

}

</script>