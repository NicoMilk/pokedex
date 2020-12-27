<template>
    <div class="d-flex flex-column  justify-content-between h-100">
        <HeaderUser />
        <div class="sep">&nbsp;</div>
        <div class="content bg-blur h-100 overflow-auto">
            <PokList />
        </div>
        <Footer />
    </div>
</template>

<script>
import HeaderUser from "./HeaderUser.vue";
import Footer from "./Footer.vue";
import PokList from "./PokList.vue";

export default {
    name: "Team",

    components: {
        HeaderUser,
        PokList,
        Footer
    },

    mounted() {
        if (this.$store.getters.getApiToken != null) {
            this.$store.dispatch("myTeam");
        } else {
            document.location = "/login";
        }
    },

    computed: {
        myProfileStore() {
            return this.$store.getters.getMyProfile;
        }
        // myTeamStore() {
        //     return this.$store.getters.getMyTeam;
        // },
    }
};
</script>
