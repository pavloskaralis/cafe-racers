<template>
  <div class="game-pieces">
    <div class="player-container"> 
      <cup></cup>
      <cup></cup>
    </div>

    <div class="text-container"> 
      <div class="text-body"> 

      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Cup from "./Cup"

export default {
  name: "versus-ai",
  components: {
    "cup": Cup
  }
};
</script>
<style scoped lang="scss">
  .game-pieces {
    position: absolute;
    width: 100%;
    height: 100%;
    // background-color: orange; 

    .player-container {
      height: 67%;
      width: 100%;
      max-width: $breakpointB;
      margin:0 auto;
      display: flex;
      justify-content: space-between;
      // background-color: red; 
    }

    .text-container {
      height: 33%;
      width: 100%;
      box-sizing: border-box;
      padding: 28px;
      padding-top: 16px;
      // background-color: blue; 

      .text-body {
        background-color: $white;
        width: 100%;
        max-width: $breakpointB;
        height: 100%;
        border-radius: 24px; 
        margin: 0 auto;
      }
    }
  }
</style>