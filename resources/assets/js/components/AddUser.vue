<script>
    export default{
        name: 'AddUser',

        data (){
            return{
                user:{},
                users: []

            }
        },

        methods: {
            postAddNewUser(e) {
                e.preventDefault();


                let self = this;
                let data = self.user;

                axios.post('api/adduser', data).then(function (response) {
                    data=response.data;
                    if (data.status=='success'){
                        toastr.success(data.message);
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }
                    self.user={};
                    if (data.status=='error'){
                        toastr.error(data.message);
                    }
                    console.log(response);

                });

            },


        }

    }
</script>

<template>
    <div class="row large-4">
        <div class="small-8">
            <div class="row">
                <input type="hidden" name="_token" value="mDEzLxKhJwP1Cf4UCszElQpXV7lZ61aOSIz8B4oD">
                <div class="small-3 columns">
                    <label for="username" class="right">Username</label>
                </div>
                <div class="small-6 columns">
                    <input type="text"  v-model="user.name" name="name" >
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <label for="email" class="right">Email</label>
                </div>
                <div class="small-9 columns">
                    <input type="email" v-model="user.email" name="email" >
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <label for="role" class="right">Assign Role</label>
                </div>
                <div class="small-9 columns">
                    <select v-model="user.role">
                        <option value="">--Select--</option>
                        <option value="1">Employee</option>
                        <option value="2" >Approver</option>
                        <option value="3">Admin</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <label for="role" class="right">User Department</label>
                </div>
                <div class="small-9 columns">
                    <select v-model="user.department">
                        <option value="">--Select--</option>
                        <option value="1">CT</option>
                        <option value="2" >HR</option>
                        <option value="3">FINANCE</option>
                        <option value="4">AUDIT</option>
                        <option value="5">PROCUREMENT</option>

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <label for="password" class="right">Password</label>
                </div>
                <div class="small-9 columns">
                    <input type="password" id="right-label" v-model="user.password">
                </div>
            </div>
            <button @click="postAddNewUser" class="button">Add</button>
        </div>
    </div>
</template>

<styles>

</styles>