<script>
    export default {
        name: 'applyloan',
        data (){
            return {
                Userdetails: {
                },
                loandetails: {

                },
                amount: '',
                duration: ''

            }

        },
        watch: {
            amount: {
                handler: function () {
                    this.loandetails.amount = this.amount;
                    this.loandetails.duration =this.duration;
                   let amount = parseInt(this.amount);
                    let duration = parseInt(this.duration);

                   let ineterest = amount * 0.1 * duration;
                    this.loandetails.intrest = ineterest;
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
            sendLoanRequest:function () {
                axios.post('/api/loanrequest',
                    {
                        user_id: this.userdetails.id,
                        amount: this.loandetails.amount,
                        loan_intrest: this.loandetails.intrest,
                        type: this.loandetails.type,
                        duration: this.loandetails.duration,
                        user_department_id: this.userdetails.department_id,
                        username: this.userdetails.name,
                        status: '0'
                    }
                ).then( function (response) {
                    if (response.status=='success'){
                        toastr.success(response.message);
                    }
                    if (response.status=='error'){
                        toastr.error(response.message);
                    }
                    setTimeout(()=>{
                        location.reload();
                    },1000);
                    });




            }
        },
        mounted(){
            this.getUserDetails();


        }




    }
</script>
<template>
  <div class="applyLoanForm">

          <div class="row">
              <div class="small-3 columns">
                  <label for="loantype" class="right">Select Loan type</label>
              </div>
              <div class="small-9 columns">
                  <select v-model="loandetails.type" >
                      <option value="">--Select--</option>
                      <option value="Emergency">Emergency</option>
                      <option value="Medical" >Medical Loan</option>
                      <option value="Long">Long Term</option>
                  </select>
              </div>
          </div>
      <div class="row">
          <input type="hidden" name="_token" value="mDEzLxKhJwP1Cf4UCszElQpXV7lZ61aOSIz8B4oD">
          <div class="small-3 columns">
              <label for="Loanamount" class="right">Amount</label>
          </div>
          <div class="small-6 columns">
              <input type="number"    v-model="amount" >
          </div>
      </div>
          <div class="row">
              <div class="small-3 columns">
                  <label for="Loanduration" class="right" >Duration</label>
              </div>
              <div class="small-6 columns">
                  <input type="number" placeholder="Duration in months" v-model="duration" >
              </div>
          </div>
          <div class="row">
              <div class="small-3 columns">
                  <label for="intrestdue" class="right" value="Duration in months">Interest Due</label>
              </div>
              <div class="small-6 columns">
                  <input type="number"   name="name" v-model="loandetails.intrest" >
              </div>
          </div>
          <button  @click="sendLoanRequest" class="button">Submit</button>
          <a  href="about.html" class="button btn">Cancel</a>

  </div>
</template>

<style>
    .applyLoanForm{
        width: 350px;
    }
    .btn{
        margin-left: 12%;
    }
</style>