<template lang="html">
  <div class="game">
      <div class="game-background"></div>
      <div class="background-overlay"></div>
      <div class="table-container"> 
          <div class="table"></div>
          <div class="table-extension"></div>
      </div>
      <div></div>

  </div>
</template>
 
 
<script lang="js">
    // import VersusAI from "@/components/VersusAI.vue";
    // import TwoPlayer from "@/components/TwoPlayer.vue";

    export default  {
        name: "game",
        props: [],
        mounted() {
    
        },
        data() {
        return {
    
        }
        },
        methods: {
    
        },
        computed: {
    
        }
    }
</script>
 
<style scoped lang="scss">
  .game {
    width: 100%;
    height: 100%;
  
    .game-background {
      position:absolute;
      // z-index: 0;
      background-image: url("../assets/game-background.jpg");
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      height: 50%;
      width: 100%;
      top: 0; 

    }

    .background-overlay {
      position: absolute;
      top: 0; 
      width: 100%;
      height: 100%;
      background-image: linear-gradient(
        180deg, 
        rgba($white, 0) 20%,
        rgba($white, .95) 50%
      );
    }

    .table-container {
      @extend .vertical-align;
      position: absolute;
      bottom: 0;
    
      width: 100%;


      .table {
        height: 25vh;
        width: 100%;
        background-color: $brown;
        background-image: url("../assets/table.jpg");
        background-position: bottom;
        background-size: cover;
        background-repeat: no-repeat;
      }

      .table-extension {
        height: 33vh;
        width: 100%;
        background-color: $brown;
      }

    }
    // background: red; 
  }
</style>