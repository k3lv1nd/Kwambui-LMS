import { LMS_CONFIG } from '../config.js'
import axios from 'axios'
export default {
    postAddNewUser: function( name, email, password, role){

         axios.post( LMS_CONFIG.API_URL + '/adduser',
            {
                name: 'kelvin',
                email: 'kalvind95@gmail.com',
                password: 'voxx',
                role: '1',

            }
        );
    }

}