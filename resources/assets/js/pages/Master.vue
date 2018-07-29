<template>
    <div  >
        <div v-if="admin">
    <AdminDashboard/>
        </div>
        <div v-if="employee" >
        <EmployeeDashboard/>
        </div>
        <div v-if="approver">
            <ApproverDashboard/>
        </div>
        <div v-if="message" class="role_unavailable">
            {{message}}
        </div>

    </div>

</template>

<script>
    import {mapGetters} from 'vuex';
    import AdminDashboard from './AdminDashboard.vue';
    import EmployeeDashboard from './EmployeeDashboard.vue';
    import ApproverDashboard from './ApproverDashboard.vue';
    export default {

        data (){
            return {
                user: {
                    role: ''
                },

                admin: false,
                employee: false,
                approver: false,
                message:''


            }
        },
        methods:{
            getLoggedInUser: function() {
                axios.get('/getloggedinuser')
                    .then( ({ data }) => {
                        this.user.role = data;
                        console.log(data)
                        this.message=data.message;

                        if (!this.message){
                            this.renderComponent();
                        }


                    });

                //this.dispatch('addLoggedInUserRole');
            },

            renderComponent: function () {
                if(this.user.role=='employee')
                {
                    this.employee = true;
                }
                else if(this.user.role=='admin')
                {
                    this.admin = true;
                }
                else if(this.user.role=='approver')
                {
                    this.approver = true;

                }

            }



        },

        components: {
            AdminDashboard,
            EmployeeDashboard,
            ApproverDashboard
        },
        computed:{

        },

        mounted() {
            this.getLoggedInUser();
        },
    }
</script>