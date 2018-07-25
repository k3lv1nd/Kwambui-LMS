import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use( VueRouter )

import AdminDashboard from './pages/AdminDashboard';

export default new VueRouter ({
        routes:[
            {
                path: '/',
                name: 'admindashboard',
                component: AdminDashboard
            },


        ],
});
