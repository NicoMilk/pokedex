<template>
    <div>
        {{ pokStore.weaknesses.bug }}
        {{ pokStore.weaknesses.dark }}
        {{ pokStore.weaknesses.dragon }}
        {{ pokStore.weaknesses.electric }}
        {{ pokStore.weaknesses.fairy }}
        {{ pokStore.weaknesses.fight }}
        {{ pokStore.weaknesses.fire }}
        {{ pokStore.weaknesses.flying }}
        {{ pokStore.weaknesses.ghost }}
        {{ pokStore.weaknesses.grass }}
        {{ pokStore.weaknesses.ground }}
        {{ pokStore.weaknesses.ice }}
        {{ pokStore.weaknesses.normal }}
        {{ pokStore.weaknesses.poison }}
        {{ pokStore.weaknesses.psychic }}
        {{ pokStore.weaknesses.rock }}
        {{ pokStore.weaknesses.steel }}
        {{ pokStore.weaknesses.water }}
    
    </div>
</template>



<script>

    export default {
        
        computed : {
            pokStore () {
                return this.$store.getters.getPok;
            }
        }
    }
</script>
