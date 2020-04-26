<template>
  <div class="game-pieces">
    <div class="player-container"> 
      <cup></cup>
      <cup></cup>
    </div>

    <div class="text-container"> 
      <div class="text-body"> 
        <span :key="index" v-for="(word,index) in text" class="text-word"> 
            <letter :key="index" v-for="(letter, index) in word.split('')" :letter="letter"></letter>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Cup from "./Cup"
import Letter from "./Letter"

export default {
  name: "versus-ai",
  components: {
    "cup": Cup,
    "letter": Letter
  },
  computed: {
      text () {
       let original = "Bushwick migas authentic bespoke, jianbing letterpress church-key cardigan godard paleo photo booth XOXO. Post-ironic prism ramps cornhole flannel iPhone 90's kogi you probably haven't heard of them drinking vinegar venmo cardigan intelligentsia. Retro tattooed listicle beard, chillwave bicycle rights mustache roof party chambray YOLO put a bird on it 90's schlitz.".split(" ")
        let text = [];

        for(let i = 0; i < original.length; i++) {
          
          if(i === original.legngth - 1) {
            text.push(original[i]);
            break;
          }
          text.push(original[i] + " ");
         
        }
        return text;
      }
  },
  mounted() {
    // console.log("test", this.text)
  }
};
</script>
<style scoped lang="scss">
  .game-pieces {
    position: absolute;
    width: 100%;
    height: 100%;
    min-height: 600px;

    // background-color: orange; 

    .player-container {
      height: 67%;
      width: 100%;
      max-width: $breakpointB;
      margin:0 auto;
      display: flex;
      justify-content: space-between;
      min-height: 402px;
      // background-color: red; 
    }

    .text-container {
      height: 33%;
      width: 100%;
      box-sizing: border-box;
      padding: 24px;
      padding-top: 16px;
      min-height: 198px;
      // background-color: blue; 

      .text-body {
        background-color: $white;
        width: 100%;
        max-width: $breakpointB;
        height: 100%;
        border-radius: 24px; 
        margin: 0 auto;
        min-height: 154px; 
        box-sizing: border-box;
        padding: 16px 12px 22px 30px;
        overflow: auto;
        -ms-overflow-style: none;
        display: flex;
        flex-wrap: wrap;

        &::-webkit-scrollbar {
          display: none;
        }

      }
    }
  }
</style>