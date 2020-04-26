<template>
  <span class="letter-container" >
    {{letter}}
  </span>
</template>

<script>

export default {
  name: "letter",
  props: ["state","letter"]
  
};
</script>
<style scoped lang="scss">
    .letter-container {
        display: inline-block;
        $font-famiily: $fontB; 
        color: $dark-blue; 
        // background: red;
        font-size: 28px; 
        padding: 0 3px; 
        min-width: 11px;
        min-height: 32px;
        margin-bottom: 10px;

        @media(max-width: $breakpointB) {
              font-size: 26px; 
              padding: 0 2.9px; 
              min-width: 10px;
              min-height: 31px;
              margin-bottom: 9px;   
        }
        @media(max-width: $breakpointC) {
            font-size: 24px;
            padding: 0 2.8px; 
            min-width: 9px;
            min-height: 30px;
            margin-bottom: 7px;    
        }
        @media(max-width: $breakpointD) {
            font-size: 22px;
            padding: 0 2.7px; 
            min-width: 8px;
            min-height: 28px;
            margin-bottom: 7px;  
        }
        @media(max-width: $breakpointE) {
            font-size: 20px;
            padding: 0 2.6px; 
            min-width: 7px;
            min-height: 26px;
            margin-bottom: 4px; 
        }
        @media(max-width: $breakpointF) {
            font-size: 18px;
            padding: 0 2.5px; 
            min-width: 6px;
            min-height: 24px;
            margin-bottom: 2px; 
        }
        @media(max-width: $breakpointG) {
            font-size: 16px;
            padding: 0 2.4px; 
            min-width: 5px;
            min-height: 20px;
            margin-bottom: 0px;        
        }
        @media(max-height: $breakpointC) and (min-width: $breakpointC) {
            font-size: 24px;
            padding: 0 2.8px; 
            min-width: 9px;
            min-height: 30px;
            margin-bottom: 7px; 
        }        
    }
</style>