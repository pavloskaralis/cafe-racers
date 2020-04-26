<template>
  <div class="cup-container" >
     <div class="winner-wrap"> 
         <div class="winner-text" :style="{'opacity': opacity}">Winner!</div>
     </div>
     <div class="empty-cup"> 
        <div class="full-cup" :style="{'clip-path': clipPath}"></div>
        <div class="speed-text"> {{this.state.speed}} WPM </div>
     </div>
     <div class="player-text"> 
        Them 
     </div>
  </div>
</template>

<script>

export default {
  name: "cup",
  props: ["state"],
  computed: {
    clipPath () {
        return `polygon(100% ${this.state.completion + 10}%, 100% 100%, 0 100%, 0 ${this.state.completion + 10}%)`;
    },
    opacity () {
      return this.state.winner !== this.state.player && this.state.winner !== "tie" ? 0 : 1; 
    }
  }
};
</script>
<style src="../styles/Cup.scss" scoped lang="scss"></style>