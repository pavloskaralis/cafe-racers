<template>
  <div class="home">
    <div class="home-background"></div>
    <div class="home-title-wrap">
      <div class="home-title">Café<span class="title-span">Racers </span></div>
    </div>
    <div class="home-button-container">
      <div class="home-button-wrap">
          <app-button type="home-button" text="2 Player" @clicked="twoPlayer"></app-button>
          <app-button type="home-button" text="Versus AI" @clicked="versusAI"></app-button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from "@/components/Button.vue";

export default {
  name: "home",
  components: {
    "app-button": Button
  },
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
      console.log("id",this.id)
      // console.log("jwt",this.jwt)
    },
    twoPlayer () {
      this.$router.push("/2-player/test");
    },
    versusAI () {
      this.$router.push("/versus-ai");
    }
  },
  mounted() {
    this.fetchJWT(); 
  }
};
</script>

<style scoped src="../styles/Home.scss" lang="scss"></style>