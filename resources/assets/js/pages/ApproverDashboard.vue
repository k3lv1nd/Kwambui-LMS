<template>
    <div class="grid-x"  >
        <div class="medium-2">
            <div class="holy-grail-left ">
                <h5 class="header">Approver dashboard</h5>
                <ul >
                    <li class="links" ><a class="routes" @click="()=>{this.dynamiccomponent='LonRequests'}">Loan Requests</a></li>


                </ul>
            </div>
        </div>

        <div  class=" row large-8">
            <component :is="dynamiccomponent"></component>
        </div>


    </div>


</template>

<script>
    import LoanRequests from '../components/LoanRequests.vue'
    export default{
        name:'ApproverDashboard',
        data ()
        {
            return{
                dynamiccomponent:'LoanRequests'

            }
        },

        components: {
            LoanRequests

        },


    }

</script>

<style>
    .header {
        color: white;
    }
    .links{
        margin-top: 20px;
        list-style: none;

    }
    .routes{
        color: white;
    }





</style>