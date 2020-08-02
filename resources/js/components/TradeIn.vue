<template>
     <div class="d-flex flex-column  justify-content-between h-100">
        <HeaderUser/>
        
        <div class="content bg-blur h-100 overflow-auto border-top" >
            
            <div class="d-flex flex-row flex-nowrap py-2 px-1  bg-white border-bottom">
                <div v-for="(pok,idx) in myProfileStore.team" :key="idx" >
                     <img v-bind:src="pokImage(pok)" :alt="pok.name" class="pok-sm m-1" @click="selectPok(pok)"/>
                </div>
            </div>
            <div>

                <div class="d-flex justify-content-around bg-white py-3 border-bottom">
                    <div class="pt-1"><button class="btn btn-danger rounded-pill"><strong>CANCEL</strong></button></div>
                    <div><img src="/img/sending-icon.png" alt="send" class="sending-icon" ><i class="ml-2 fa fa-long-arrow-down"></i></div>
                    <div class="pt-1"><button class="btn btn-primary rounded-pill" @click="sendToTrader"><strong>SEND</strong></button></div>
                </div>
                <div class="circle">
                    <img v-bind:src="traderImage()" alt="trader" class="profilePix"/>
                </div>

                <div class="d-flex justify-content-center">
                    <h2 class="mt-3 ml-4" >{{ traderName() }}</h2>
                    <h4 class="py-3 m-0 align-middle userId mt-1 ml-3">ID #{{ $route.params.idt}}</h4>
                </div>

            </div>


        </div>
        <Footer/>
    </div>
</template>

<script>

import HeaderUser from "./HeaderUser.vue"
import Footer from './Footer.vue';
import PokList from './PokList.vue';

    export default {

        name: 'Team',

        components: {
            HeaderUser,
            PokList, 
            Footer
        },

        mounted() {
            this.$store.dispatch("myTeam");
        },
        data : () =>({
            selectedPok : null
        }),
        methods : {
            selectPok(pok) {
                this.selectedPok = pok;
            },
            sendToTrader () {
                console.log(this.selectedPok)

                if (this.selectedPok) this.$store.dispatch("sendToTrader", { pok_id : this.selectedPok.id, trader_id: this.$route.params.idt}  )
            },

            pokImage (pok) {
                return "/img/pokemon/" + pok.image ;
            },

            traderImage() {

                let userTrade = this.$store.getters.getUsers.find( item => item.user_id ==  this.$route.params.idt );                
                return "/img/profile/"+userTrade.profile_icon_id+".png"
            },
            traderName() {
                let userTrade = this.$store.getters.getUsers.find( item => item.user_id ==  this.$route.params.idt );  
                return userTrade.username;
            }
        },        
        computed : {
            myProfileStore() {
                return this.$store.getters.getMyUserProfile;
            }
         }
    }
</script>
