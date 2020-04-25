<template>
  <div class="cup-container" >
     <div class="winner-wrap"> 

     </div>
     <div class="empty-cup"> 
         <div class="full-cup" style="clip-path: clipPath;"></div>
     </div>
     <div class="player-text"> 

     </div>
  </div>
</template>

<script>

export default {
  name: "cup",
  props: ["state"],
  computed: {
      clipPath () {
          return "polygon(100% 10%, 100% 100%, 0 100%, 0 10%)";
      }
  }
};
</script>
<style scoped lang="scss">
   .cup-container {
       width: 50%;
       min-height: 100%;
       display: flex;
       flex-direction: column;
    //    background: blue; 

    .winner-wrap {
        @extend .vertical-align;
        width: 100%;
        height: 100%;
        flex-shrink: 2;

        background: blue;
        @media(max-width: $breakpointC){
            flex-shrink: 1;
        }
    }

    .empty-cup {
        width: 100%;
        background-image: url("../assets/cup.png");
        background-size: contain; 
        background-repeat: no-repeat;
        background-position: bottom;
        height: 100%;
        // max-height: 347px; 
        // background-color: pink;
        .full-cup {
            @extend .empty-cup;
            height: 100%;
            background-image: url("../assets/coffee.png");          
        }
    }
    
    .player-text {
        min-height: 13vh; 
        width: 100%;
        // background-color: red; 
    }

   }
</style>