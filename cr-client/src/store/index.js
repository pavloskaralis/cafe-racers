import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: ''
  },
  mutations: {
    setUser (state, payload) {
        state.user = payload;
    }
  },
  actions: {
    async checkUser (context) {

      const token = localStorage.getItem("cafe-racers"); 
      const url = "http://localhost:8000/api/jwt"; 
      const config = {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
   
      const response = await axios.get(url,config);
      const jwt = await response.data.jwt;
      if(jwt) localStorage.setItem("cafe-racers",jwt);
      const user = response.data.user; 
      context.commit('setUser', user);
    }

  },
  modules: {}
});
