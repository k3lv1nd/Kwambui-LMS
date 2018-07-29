import Vue from 'vue'
import Vuex from 'vuex'

Vue.use( Vuex )


const state = {
    role:''

};

const getters = {

    user: state => state.user,


};

const mutations = {



}
const actions = {



};

const store = new Vuex.Store({
    state, getters, mutations, actions
});

export default store;
