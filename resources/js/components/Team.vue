<template>
    <div class="h-100 p-0">
        <HeaderUser/>
        <PokList/>
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

        computed : {
            myProfileStore() {
                return this.$store.getters.getMyProfile;
            },
            // myTeamStore() {
            //     return this.$store.getters.getMyTeam;
            // },

        }


    }
</script>
