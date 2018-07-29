<template>
    <div>
        <br>
        <h3 class="text-center">Loan Requests</h3>
        <div v-if="message" class="loanrequestmessage">
            {{message}}
        </div>
        <div v-if="loans.length>0">
            <div class="large-12">
                <small style="color: green; text-align: center; font-size:15px;" v-if="btnapprovestatus">{{btnapprovestatus}}</small>
                <table align="center" class="users medium-6">

                    <thead>
                    <tr>
                        <th>Applicants Name</th>
                        <th width="">Loan Type</th>
                        <th>Date of Application</th>
                        <th width="">Loan Amount</th>
                        <th width="">Interest Due</th>
                        <th width="">Action</th>
                    </tr>
                    </thead>
                    <tbody  >

                    <tr v-for="key in loans " >

                        <td>{{ loanowner }}</td>
                        <td v-bind:id="key.user_id" style="display: none !important;">{{getOwner(key.user_id)}}</td>
                        <td>{{key.type}}</td>
                        <td>{{key.created_at}}</td>
                        <td>{{key.amount}}</td>
                        <td>{{key.loan_intrest}}</td>
                        <td>
                            <button type="button" class="success button" @click="ApproveLoan(key)">Approve</button>
                            <button type="button" class="alert button" @click="RejectLoan(key)">Reject</button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <br>
    </div>
</template>

<script>

    export default {
        name: 'loanRequests',

        data (){

            return {
                userdetails: {},
                departmentusers: {},
                message:'',
                loanees:[],
                loans:[],
                loanowner:'',
                btnapprovestatus:''
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

            },
            loanRequest(){
                axios.get('/loanRequests').then(({data})=>{
                    this.message=data.message;

                    this.loanees=data;



                    var arr1=[];
                    for(var i=0;i<data.length;i++){
                        arr1.push(data[i]);
                    }
                    var loans=[];
                    for (var i=0;i<arr1.length;i++){
                        var loans_related_to_one_person=arr1[i].loans;
                        if (loans_related_to_one_person.length>0){
                            for(var x=0 ;x<loans_related_to_one_person.length;x++){
                                loans.push(loans_related_to_one_person[x]);
                            }
                        }
                    }


                    this.loans=loans;
                });
            },
            getOwner(id){
                var users=this.loanees;

                var owner='';
                for(var i=0;i<users.length;i++){
                    if(users[i].id==id){
                        owner=users[i].name;
                    }
                }
                this.loanowner=owner;
                owner='';

            },
            ApproveLoan(obj){
                this.btnapprovestatus='Please Wait!.Approving Loan Request...';
                axios.post('/approveLoan',obj).then(({data})=>{
                    if(data.status=='success'){
                        toastr.success(data.message);
                    }
                    if(data.status=='error'){
                        toastr.error(data.message);
                    }

                    setTimeout(function(){
                        location.reload();
                    },1000);
                });
            },
            RejectLoan(obj){
                this.btnapprovestatus='Please Wait!.Declining Loan Request...';
                axios.post('/rejectLoan',obj).then(({data})=>{
                    if(data.status=='success'){
                        toastr.success(data.message);
                    }
                    if(data.status=='error'){
                        toastr.error(data.message);
                    }

                    setTimeout(function(){
                        location.reload();
                    },1000);
                });
            }
        },

        mounted () {
            this.getUserDetails();
            this.loanRequest();

        }


    }

</script>
