
<template>
<div class="container">

</div>
</template>

<script>
    export default {

        data() {
            return {
              users: {},
            }
        },
        methods: {
            getUser(){
                axios.get('/api/products')
                     .then((response)=>{
                       this.users = response.data.users
                     })
            }
        },
        created() {
            this.getUser()
        }
    }
</script> 