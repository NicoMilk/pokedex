<template>
    <div class="container-fluid justify-content-center p-0 bg-head">
        <div class="circle">
            <img v-bind:src="profilePix" alt=""  class="profilePix">
        </div>
        <div class="d-flex flex-row flex-nowrap justify-content-center">
            <h3 class="py-3 m-0 align-middle userName mr-3">{{this.$store.state.myProfile.username}}</h3>
            <h4 class="py-3 m-0 align-middle userId">ID #{{this.$store.state.myProfile.user_id}}</h4>
        </div>
    </div>
</template>

<script>

export default {
    
    name: 'HeaderUser',
    
    mounted() {
        this.$store.dispatch("myProfile");            
    },

    computed : {
        profileStore() {
         return this.$store.getters.getMyProfile   
        },

        profilePix() {
            return "/img/profile/"+this.profileStore.profile_icon_id+".png"
        }
    }

}

</script>