<template>
    <h3>hello</h3>
</template>

<script>

    export default {
        name: 'loanRequests',

        data (){

            return {
                userdetails: {

                },
                departmentusers: {


                }

            }
        },


        methods: {

            getUserDetails: function() {
                axios.get('/getuserdetails')
                    .then( ({ data }) => {
                        this.userdetails = data;
                        console.log(this.userdetails)
                    }, () => {

                    });
            },
            getDepartmentUsers () {
                axios.get('/getdepartmentusers')
                    .then( ({ data }) => {
                        this.departmentusers= data;
                        console.log(this.departmentusers)
                    }, () => {

                    });

            }
        },

        mounted () {
            this.getUserDetails()

        }


    }

</script>
