<template>
    <div>

        <div class="d-flex flex-row mx-2 my-3 mx-5">
            <span class="mx-2 stat-label">HP</span>
            <span class="mx-2 stat-label-val">{{ pokStore.stats.hp}}</span>
            <div class="progress w-100 ml-2 mt-2">
                <div class="progress-bar" v-bind:class="pokStore.types.type1" :style="{ width: pokStore.stats.hp + '%'}" ></div>
            </div>
        </div>
        <div class="d-flex flex-row mx-2 my-3 mx-5">
            <span class="mx-2 stat-label">ATK</span>
            <span class="mx-2 stat-label-val">{{ pokStore.stats.attack}}</span>
            <div class="progress w-100 mx-2 mt-2">
                <div class="progress-bar" v-bind:class="pokStore.types.type1" :style="{ width: pokStore.stats.attack + '%'}" ></div>
            </div>
        </div>
        <div class="d-flex flex-row mx-2 my-3 mx-5">
            <span class="mx-2 stat-label">DEF</span>
            <span class="mx-2 stat-label-val">{{ pokStore.stats.defense}}</span>
            <div class="progress w-100 mx-2 mt-2">
                <div class="progress-bar" v-bind:class="pokStore.types.type1" :style="{ width: pokStore.stats.defense + '%'}" ></div>
            </div>
        </div>
        <div class="d-flex flex-row mx-2 my-3 mx-5">
            <span class="mx-2 stat-label">SATK</span>
            <span class="mx-2 stat-label-val">{{ pokStore.stats.special_attack}}</span>
            <div class="progress w-100 mx-2 mt-2">
                <div class="progress-bar" v-bind:class="pokStore.types.type1" :style="{ width: pokStore.stats.special_attack + '%'}" ></div>
            </div>
        </div>
        <div class="d-flex flex-row mx-2 my-3 mx-5">
            <span class="mx-2 stat-label">SDEF</span>
            <span class="mx-2 stat-label-val">{{ pokStore.stats.special_defense}}</span>
            <div class="progress w-100 mx-2 mt-2">
                <div class="progress-bar" v-bind:class="pokStore.types.type1" :style="{ width: pokStore.stats.special_defense + '%'}" ></div>
            </div>
        </div>
        <div class="d-flex flex-row mx-2 my-3 mx-5">
            <span class="mx-2 stat-label">SPD</span>
            <span class="mx-2 stat-label-val">{{ pokStore.stats.speed}}</span>
            <div class="progress w-100 mx-2 mt-2">
                <div class="progress-bar" v-bind:class="pokStore.types.type1" :style="{ width: pokStore.stats.speed + '%'}" ></div>
            </div>
        </div>
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


