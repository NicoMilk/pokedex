<template>
   <div class="d-flex flex-column  justify-content-between h-100">
        <h3 class="text-center py-3 m-0 bg-blur">
            <a>Pokemons</a>
        </h3>
        <div class="bg-blur text-center">
                <input class="searchbar px-2 mb-2" type="text" v-model= "query" placeholder="Search"/>
        </div>
        <div class="sep">&nbsp;</div> 


        <div class="content bg-blur h-100 overflow-auto bg-white" >    
                         
            <div v-for= "(user, index) in filteredusers" :key= "index" >
                
                <router-link :to="{ name: 'tradein', params: { idt: user.user_id }}">
                <div class= "d-flex justify-content-between align-items-center pt-2 mx-2">
                    <div class="circle-sm">
                        <img v-bind:src ="getUserAvatar(user)" class= "pok-trade"/>
                    </div>
                    <h2 class ="d-flex"> {{ user.username }}</h2>
                    <div class ="pok-id align-items-end">ID {{ getUserId(user) }}</div>
                </div>  
                </router-link>
                <hr/>           
                <div v-for="(pok, index) in getPoksTeam(user.team)" :key="index">
                    <router-link class="" :to="{ name: 'pokemon', params: { id: pok.id }}">
                        <div class="d-flex flex-row flex-nowrap justify-content-between my-2 mx-4">
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
                        <hr class="mx-3"/>

                    </router-link>
                </div>
            </div>
        </div>
        <Footer></Footer>   
    </div> 
</template>

<script>
import Footer from './Footer.vue';
import PokList from './PokList.vue'; 

export default {

    components: {
        PokList,
        Footer
    },
    name:"trade",

    data: () => ({ 
        query:'',
    }),
    mounted() {
        this.$store.dispatch("getUsers");
    },
    computed : {
        usersStore () {
            return this.$store.getters.getUsers; 
        },
        teamsStore(){
            return this.$store.getters.getTeams;
        },
        filteredusers() {
            return this.$store.getters.getUsers.filter((users)=> {
                return users.username.match(this.query);
            });
        },
    },
    methods: {
        getPoksTeam (pokTeam) {
            let teamPoks = [];
            pokTeam.forEach( element => {
                let pok = this.$store.getters.getPoks.find( item => item.id == element.pokemon_id);
                teamPoks.push(pok);
            });
            return teamPoks;
        },
        pokImage (pok) {
            return "/img/pokemon/" + pok.image ;
        },
        typeImage (type) {
            return "/img/types/small/types-" + type + ".png" ;
        },
        getPokId (id) {
            return "#" + ("00"+id).substr(-3);
        },
        getUserId (user) {
            return "#"+("00"+user.user_id).substr(-3);
        },
        getUserAvatar(user) {
            return "/img/profile/"+user.profile_icon_id+".png";
        }
    }
}


</script>