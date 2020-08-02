<template>
    <div class="container-fluid justify-content-center p-0 bg-head">
        <a href="/home">
        <div class="circle">
            <img v-bind:src="profilePix" alt=""  class="profilePix">
        </div>
        </a>
        <div class="d-flex flex-row flex-nowrap justify-content-center">
            <h3 class="py-3 m-0 align-middle userName mr-3">{{profileStore.username}}</h3>
            <h4 class="py-3 m-0 align-middle userId mt-3">ID #{{profileStore.user_id}}</h4>
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