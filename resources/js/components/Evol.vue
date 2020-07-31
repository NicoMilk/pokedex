<template>
    <div>       
        {{ pokStore.stats.hp}}
        {{ pokStore.stats.attack}}
        {{ pokStore.stats.defense}}
        {{ pokStore.stats.special_attack}}
        {{ pokStore.stats.special_defense}}
        {{ pokStore.stats.speed}}
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
