import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use( VueRouter )

import AdminDashboard from './pages/AdminDashboard';
import Master from './pages/Master';
import Loans from './components/Loans.vue'

export default new VueRouter ({
        routes:[
            {
                path: '/admin',
                name: 'admindashboard',
                component: AdminDashboard
            },
            {
                path: '/',
                name: 'master',
                component: Master

            },
            {
              path: '/employeeLoans',
              name: 'loans' ,
                component: Loans
            }



        ],
});
