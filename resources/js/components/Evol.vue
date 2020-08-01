<template>
    <div>       
        {{ pokStore.evolutions.required_lvl}}
        {{ pokStore.evolutions.evolution_id}}
        {{ pokEvolStore.evolutions.required_lvl}}
        {{ pokEvolStore.evolutions.evolution_id}}
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
            }
        }
    }
</script>
