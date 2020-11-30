<template>
    <div>
        <div class="d-flex flex-row flex-wrap justify-content-center mx-4 my-3">
            <div class="col-4 weak-item d-inline" v-for="(weak, idx) in weaks" :key="idx">
               <div class="text-left text-nowrap pl-2 py-1">
                   <img :src="getTypeImage(weak)" :alt="weak" /><span>&nbsp;{{ getWeak(pokStore.weaknesses[weak]) }}</span>
               </div>
            </div>
        </div>   
    </div>
</template>



<script>

    export default {

        data: () => ({
            weaks:  ['bug','dark','dragon','electric','fairy','fight','fire','flying',
                'ghost','grass','ground','ice','normal','poison','psychic','rock','steel','water']
        }),

        methods : {
            getTypeImage(type) {
                return "/img/types/small/types-" + type + ".png"
            },
            getWeak(weak) {
                return weak == "0.25" ? "1/4x" : weak == "0.5" ? "1/2x" : weak+"x";
            }
        },
        
        computed : {
            pokStore () {
                return this.$store.getters.getPok;
            }
        }
    }
</script>
