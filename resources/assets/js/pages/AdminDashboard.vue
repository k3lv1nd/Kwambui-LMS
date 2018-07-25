<style>
    .large-6 {

        justify-content: center;

    }

    .users {
        width: 600px;
    }

    h5 {
        margin-left: 340px
    }

</style>

<template>
    <div class=" grid-x large-6 hover">
        <div class="row medium-12">
        <h4>Admin dashboard</h4>
        <button @click="displayForm" class="button">Add a new user</button>
        </div>
        <div v-if="Formdisplay" class="addUserForm small-4">

        <AddUser />
        </div>

        <table align="center" class="users medium-6">

            <thead>
            <tr>
                <th width="">Username</th>
                <th>Email</th>
                <th width="">Role</th>
                <th width="s">Date of registration</th>
            </tr>
            </thead>
            <tbody v-for="user in users">

                <tr >
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.role}}</td>
                    <td>{{user.date}}</td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    import users from '../api/users.js';
    import {LMS_CONFIG} from '../config.js'
    import AddUser from '../components/AddUser.vue'

    export default {
        data() {
            return {
                Formdisplay: true,
                users: []

            }
        },
        methods: {

            displayForm: function () {

                this.Formdisplay = true

            },
            getAllUsers: function() {
                axios.get('/api/getusers')
                    .then( ({ data }) => {
                        this.users = data;
                    }, () => {

                    });
            }


        },
        mounted() {
            this.getAllUsers();

        },

        components: {
            AddUser
        }

    }

</script>