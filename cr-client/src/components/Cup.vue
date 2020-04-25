<template>
  <div class="cup-container" >
     <div class="winner-wrap"> 

     </div>
     <div class="empty-cup"> 
         <div class="full-cup" :style="{'clip-path': clipPath}"></div>
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
          return "polygon(100% 40%, 100% 100%, 0 100%, 0 40%)";
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
        // flex-shrink: 1.5;
        // background: blue;
        @media(max-width: 700px){
            // flex-shrink: 1;
        }
    }

    .empty-cup {
        width: 100%;
        background-image: url("../assets/cup.png");
        background-size: contain; 
        background-repeat: no-repeat;
        background-position: bottom;
        height: 30vh;
        max-height: 280px;
        // background-color: pink;

        @media(max-width: $breakpointA) {
            // max-height: 48px; 
        }
        @media(max-width: $breakpointB) {
            max-height: 255px; 
        }
        @media(max-width: $breakpointC) {
            max-height: 190px; 
        }
        @media(max-width: $breakpointD) {
            max-height: 170px; 
        }
        @media(max-width: $breakpointE) {
            max-height: 135px;
        }
        @media(max-width: 410px) {
            max-height: 110px;
        }
        @media(max-width: 325px) {
            max-height: 90px;
        }


        .full-cup {
            @extend .empty-cup;
            background-image: url("../assets/coffee.png"); 
            transition: clip-path .5s;  
            // clip-path: polygon(100% 80%, 100% 100%, 0 100%, 0 80%);      
        }
    }
    
    .player-text {
        min-height: 13vh; 
        width: 100%;
        // background-color: red; 
    }

   }
</style>