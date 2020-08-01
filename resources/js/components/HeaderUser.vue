<template>
    <div >
        <div class="container-fluid justify-content-center p-0 bg-head">
            <div class="circle">
                <img v-bind:src="profilePix" alt="" width="100" height="100" class="profilePix">
            </div>
            <div class="row justify-content-end">
                <h3 class="col-4 py-3 m-0 align-middle userName">{{this.$store.state.myProfile.username}}</h3>
                <h4 class="col-4 py-3 m-0 align-middle userId">ID #{{this.$store.state.myProfile.user_id}}</h4>
            </div>
        </div>
        <div class="sep">&nbsp;</div> 
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

        
    }

}

</script>