<template>
   <div class="d-flex flex-column  justify-content-between h-100">
       <div>
        <h3 class="text-center py-3 m-0 bg-blur">
            <a>Users</a>
            <input class= "searchbar" type ="text" v-model = "query" placeholder="Search"> 
        </h3>
        </div>
        <div class="sep">&nbsp;</div> 
        <div class="content bg-blur h-100 overflow-auto" >                 
            <div v-for= "(user, index) in filteredusers" :key= "index">
                <div class= "d-flex justify-content-between">
                    <img src="/img/profile/bulbasaur.png" alt="" >
                    <div>{{ user.username }}</div>
                    <div>ID {{ user.user_id }}</div>
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
        
        this.$store.dispatch("getTeams");
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
        
    } 
}
</script>