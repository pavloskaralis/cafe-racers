<template>
  <div class="button" :class="[type]"  @click="$emit('clicked');">
        <div class="button-text">{{ text }}</div>
        <div class="button-pointer">&#9664;</div>
  </div>
</template>

<script>

export default {
  name: "app-button",
  props: ["type","text"]
};
</script>
<style scoped lang="scss">
    .button {
        font-family: $fontB;
        text-transform: capitalize;
        display: flex;
        justify-content: space-between;
        cursor: pointer;

        .button-pointer {
            opacity: 0;
        }

        &:hover .button-pointer {
            opacity: 1;
        }
        
    }

    .home-button {
        color: $white;
        font-weight: 600;
        font-size: 48px;
       
        @media(max-width: $breakpointA) {
            font-size: 40px;  
        }
        @media(max-width: $breakpointB) {
            font-size: 36px;  
        }
        @media(max-width: $breakpointC) {
            font-size: 32px;  
        }
        @media(max-width: $breakpointD) {
            font-size: 28px;  
        }
        @media(max-width: $breakpointE) {
            font-size: 24px;  
        }

        .button-text {
            @extend .vertical-align; 
            width: 100%;
            text-align: right;
            margin-right: 32px;
            @media(max-width: $breakpointA) {
                margin-right: 28px;
            }
            @media(max-width: $breakpointB) {
                margin-right: 24px;
            }
            @media(max-width: $breakpointC) {
                margin-right: 20px;
            }
            @media(max-width: $breakpointD) {
                margin-right: 16px;  
            }
            @media(max-width: $breakpointE) {
                margin-right: 12px; 
            }
        }
    }

</style>