<template>
<div>
 <div class="row large-8">
 <h3>Loans</h3>
 </div>
 <br>
 <div class=" row large-8">
  <div class="large-2">
   <button @click="displayForm" class="button">Apply Loan</button>
  </div>
  <div class="medium-4" v-if="loanForm">
    <apply-loan/>
  </div>
  <div class=" small-4.columns">
 <p>
  Current Loans
 </p>
  </div>

 </div>
 <div class="large-12">
  <table align="center" class="users medium-6">

   <thead>
   <tr>
    <th width="">Loan Type</th>
    <th>Date of Application</th>
    <th width="">Loan Amount</th>
    <th width="">Interest Due</th>
    <th width="">Status</th>
    <th width="">Action</th>
   </tr>
   </thead>
   <tbody  >

   <tr v-for="key in userloans " >
<td>{{key.type}}</td><td>{{key.created_at}}</td><td>{{key.amount}}</td><td>{{key.loan_intrest}}</td><td><a :class="val" href="#">{{status}}</a></td><td><button type="button" class="success button">Make payment</button></td>
   </tr>

   </tbody>
  </table>
 </div>

</div>
</template>

<script>
 import ApplyLoan from './ApplyLoan.vue'
    export default {

        name: 'Loans',
        data ()
        {
            return {
                userdetails:{},
                loanForm:false,
                userloans:[],
                val: '',
                status: ''
            }
        },
        methods:{
            getUserDetails: function() {
                axios.get('/getuserdetails')
                    .then( ({ data }) => {
                        this.userdetails = data;
                        //console.log(this.userdetails)
                    }, () => {

                    });
            },
            displayForm:function ()
            {
                this.loanForm = true;
            },



            hideForm: function ()
            {
                this.loanForm = false;
            },
//
            getUserLoans: function() {

                axios.get('/getuserloans')
                    .then( ({ data }) => {
                       // console.log(data)
                        this.userloans = data;
                        //console.log(this.userloans);
                        for(var i=0;  i<=1;i++){
                       if(this.userloans[i].status==1){
                           this.val = 'button success'
                           this.status = 'Approved'
                       }
                        else{this.val = 'button alert'
                           this.status = 'Pending'

                       }
                        }
                        //console.log(this.userdetails)
                    }, () => {

                    });
            },



        },
        mounted(){
            this.getUserDetails();
            this.getUserLoans();

            //console.log(this.userloans.amount);
        },
        components:{
            ApplyLoan
        }
    }

</script>

<style>

</style>