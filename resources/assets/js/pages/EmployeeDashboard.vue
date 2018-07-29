<template>
    <div class="grid-x"  >
        <div class="medium-2">
            <div class="holy-grail-left ">
                <h5 class="header">Employee dashboard</h5>
                <ul >
                    <li class="links" ><i class="fa fa-money" aria-hidden="true"></i><a class="routes" @click="()=>{this.dynamiccomponent='Loans'}">Loans</a></li>
                    <li class="links"><a class="routes" @click="()=>{this.dynamiccomponent='LoanCalculator'}">LoansCalculator</a></li>

                </ul>
            </div>
        </div>

        <div  class=" row large-8">
            <component :is="dynamiccomponent"></component>
        </div>


    </div>


</template>

<script>
    import Loans from '../components/Loans.vue'
    import LoanCalculator from '../components/LoanCalculator.vue'
    import ApplyLoan from '../components/ApplyLoan.vue'
    export default{
        name:'EmployeeDashboard',
        data ()
        {
            return{
                dynamiccomponent:'Loans'

            }
        },

        components: {
            Loans,
            LoanCalculator,
            ApplyLoan

        }
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