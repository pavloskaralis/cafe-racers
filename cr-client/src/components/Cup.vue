<template>
  <div class="cup-container" >
     <div class="winner-wrap"> 
         <div class="winner-text">Winner!</div>
     </div>
     <div class="empty-cup"> 
        <div class="full-cup" :style="{'clip-path': clipPath}"></div>
        <div class="speed-text"> 84 WPM </div>
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
          return "polygon(100% 40%, 100% 100%, 0 100%, 0 40%)";
      }
  }
};
</script>
<style src="../styles/Cup.scss" scoped lang="scss"></style>