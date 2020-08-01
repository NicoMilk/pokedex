<template>
    <div class="d-flex flex-column text-center justify-content-start  w-100  h-100" v-bind:class="pokStore.types.type1">
        <div class="h-100 overflow-auto" >  
            <div class="text-left m-4 text-white">V</div> 
            <div class="d-inline-block">          
            <div class="pok-content pb-2">
                <img v-bind:src="pokImage" :alt="pokStore.name" class="pok-top"/>  
                <h2 class="pt-3 text-center">{{pokStore.name}}</h2>
                <div class="pok-types my-2">
                    <div v-for="type in pokStore.types" :key="type" class="d-inline">  
                        <img :src="getTypeImage(type)" :alt="type" />
                    </div>
                </div>
                <div class="mx-2 p-2">{{pokStore.description}}</div>            
                <div class="d-inline pok-chars">           
                    <router-link :to="{ name: 'pokemon' }" v-bind:class="pokStore.types.type1" @click="setActive(0)">Stats</router-link>
                    <router-link :to="{ name: 'weak' }" v-bind:class="pokStore.types.type1" @click="setActive(1)">Weaknesses</router-link>
                    <router-link :to="{ name: 'evol' }" v-bind:class="pokStore.types.type1" @click="setActive(2)">Evolutions</router-link>
                </div>

                <router-view/>

            </div>
            </div>
        </div>
        <pok-footer/>
    </div>
</template>

<script>

import Footer from './Footer.vue';

    export default {

        data: () => ({
            charActive : 0
        }),
        
        components: {
            "pok-footer" : Footer
        },
        name:"pokemon",
        mounted() {
            this.$store.dispatch("getPok", this.$route.params.id );            
        },
        methods: {
            getTypeImage(type) {
                return type ? "/img/types/large/tag-" + type + ".png" : "";
            },
            setActive(char) {
                this.charActive = char;
            }
        },
        computed : {
            pokStore () {
                return this.$store.getters.getPok;
            },
            pokImage () {
                return "/img/pokemon/" + this.pokStore.image ;
            }
        }
    }
</script>
