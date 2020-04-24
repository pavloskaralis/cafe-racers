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
  methods: {
    twoPlayer () {
      this.$router.push("/2-player/test");
    },
    versusAI () {
      this.$router.push("/versus-ai");
    }
  },
};
</script>

<style scoped src="../styles/Home.scss" lang="scss"></style>