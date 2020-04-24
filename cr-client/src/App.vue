<template>
   <div class="app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: "app",
  data() {
    return {
      id: ''
    }
  },
  methods: {
    async fetchJWT() {
      //request variables
      const token = localStorage.getItem("cafe-racers"); 
      const url = "http://localhost:8000/api/jwt"; 
      const config = {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
      //request/data assignment 
      const response = await this.$axios.get(url,config);
      const jwt = response.data.jwt;
      if(jwt) localStorage.setItem("cafe-racers",jwt);
      this.id = response.data.id; 
      // console.log("id",this.id)
      // console.log("jwt",this.jwt)
    }
  },
  mounted() {
    this.fetchJWT(); 
  }
}
</script>
<style lang="scss">
 body {
   margin: 0;
   overflow: hidden;
 }
 .app {
   height: 100vh;
   width: 100vw;  
  }
</style>
