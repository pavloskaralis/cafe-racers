<template>
  <div class="cup-container" >
     <div class="winner-wrap"> 

     </div>
     <div class="empty-cup"> 
        <div class="full-cup" :style="{'clip-path': clipPath}"></div>
        <!-- <div class="speed-text"> 84 WPM </div> -->
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
       min-height: 402px; 
    //    background: blue; 

    .winner-wrap {
        @extend .vertical-align;
        width: 100%;
        height: 100%;
        // background: blue;
    }

    .empty-cup {
        width: 100%;
        background-image: url("../assets/cup.png");
        background-size: contain; 
        background-repeat: no-repeat;
        background-position: bottom;

        height: 280px;
        position: relative;
        // background-color: pink;

        @media(max-width: $breakpointB) {
            height: 250px; 
        }
        @media(max-width: $breakpointC) {
            height: 185px; 
        }
        @media(max-width: $breakpointD) {
            height: 165px; 
        }
        @media(max-width: $breakpointE) {
            max-height: 135px;
        }
        @media(max-width: 410px) {
            height: 110px;
        }
        @media(max-width: 325px) {
            height: 90px; 
        }
        @media(max-height: $breakpointC) {
             height: 185px; 
        }


        .full-cup {
            @extend .empty-cup;
            background-image: url("../assets/coffee.png"); 
            transition: clip-path .5s;  
            // clip-path: polygon(100% 80%, 100% 100%, 0 100%, 0 80%);      
        }

        .speed-text {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            text-align: center;
            font-family: $fontA;
            font-weight: 600;
            color: $coffee;
            font-size: 3.4vh;
            padding-top: 5.2vh;  
            // background: red; 
            @media(max-width: $breakpointB) {
                font-size: 3.2vh;
                padding-top: 4.8vh;  
            }
            @media(max-width: $breakpointC) {
                font-size: 2.4vh;
                padding-top: 3.8vh;        
            }
            @media(max-width: $breakpointD) {
                font-size: 2vh;
                padding-top: 3.2vh; 
            }
            @media(max-width: $breakpointE) {
                font-size: 1.6vh;
                padding-top: 2.8vh; 
            }
            @media(max-width: 410px) {
                font-size: 1.4vh;
                padding-top: 2.4vh;               
            }
            @media(max-width: 325px) {
                font-size: 1.0vh;
                padding-top: 2vh;               
            }
        }
    }
    
    .player-text {
        // min-height: 13vh; 
        width: 100%;
        // background-color: red; 
        min-height: 81px; 
        height: 60%;
      
        @media(max-width: $breakpointC) {
            height: 50%;
        }
       
    }

   }
</style>