<template>
   <div class="d-flex flex-column  justify-content-between h-100">
       <div>
        <h3 class="text-center py-3 m-0 bg-blur">
            <a>Users</a>
            <input class= "searchbar" type ="text" v-model = "query" placeholder="Search"/> 
        </h3>
        </div>
        <div class="sep">&nbsp;</div> 
        <div class="content bg-blur h-100 overflow-auto" >                 
            <div v-for= "(user, index) in filteredusers" :key= "index">
                <div class= "d-flex justify-content-between align-items-center p-3">
                    <img v-bind:src ="getUserAvatar(user)" class= "pok-trade"/>
                    <h2 class ="d-flex"> {{ user.username }}</h2>
                    <div class ="pok-id align-items-end">ID {{ getUserId(user) }}</div>
                </div> 
             </div>
        </div>
    </div> 
</template>

<script>
import Footer from './Footer.vue';
import Headertrade from './Headertrade.vue'; 

 export default {

    components: {
        /* "pok-header" : Header,
        "pok-footer" : Footer */
        Headertrade
    },
    name:"trade",

    data: () => ({ 
        query:'',
    }),
    mounted() {
        this.$store.dispatch("getUsers");
        
        //this.$store.dispatch("getTeams");
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
        getUserId (user) {
            return "#"+("00"+user.user_id).substr(-3);
        },
        getUserAvatar(user) {

            return "/img/profile/"+user.profile_icon_id+".png";
            //console.log(user.profile_icon_id);
            /* switch(user.profile_icon_id){
                case '1':
                    return "/img/profile/bulbausaur.png";
                    break;
                 case '2':
                    return "/img/profile/charmander.png";
                    break;
                 case '3':
                    return "/img/profile/jigglypuff.png";
                    break;
                 case '4':
                    return "/img/profile/pikachu.png";
                    break;
                 case '5':
                    return "/img/profile/pokeball.png";
                    break;
                 case '6':
                    return "/img/profile/squirtle.png";
                    break;
                default:
                    return "/img/profile/pikachu.png"; */
            }
        }
    } 


</script>