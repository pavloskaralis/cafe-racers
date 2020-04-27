<template>
  <div class="game-pieces">
    
    <div class="player-container"> 
      <cup :state="p1Cup"></cup>
      <cup :state="p2Cup"></cup>
    </div>

    <div class="text-container"> 
      <div v-if="prompt" class="prompt-container" >
        <div class="prompt-body">
            <div class="prompt-question">
              {{ prompt }}
            </div>
            <div class="prompt-options">
                <app-button type="game-button" :key="index" v-for="(option,index) in promptOptions" :text="option"></app-button>
            </div>
        </div>
      </div>

      <div class="text-body"> 
        <span :key="index" v-for="(word,index) in apiWords" class="text-word"> 
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
import Button from './Button'

export default {
  name: "versus-ai",
  components: {
    "cup": Cup,
    "letter": Letter,
    "app-button": Button
  },
  data() {
    return {
      prompt: "Select AI Difficulty",
      player1: "",
      player2: "",
      apiText: "",
      p1Text: "",
      p2Text: "",
      p1Time: 0,
      p2Time: 0,
      // player1: 
    }
  },
  computed: {
    apiWords () {
      const apiWords = []; 
      const apiTextSplit = this.apiText.split(" ");
      for(let i = 0; i < apiTextSplit.length; i++) {
        if(i !== apiTextSplit.length - 1) apiTextSplit[i] += " ";
        apiWords.push(apiTextSplit[i]);
      }
      return apiWords; 
    },
    p1Speed () {
      return this.p1Text ? this.p1Text.split(" ").length/this.p1Time * 60 : 0;
    },
    p2Speed () {
      return this.p2Text ? this.p2Text.split(" ").length/this.p2Time * 60 : 0;
    },
    p1Completion () {
      return this.p1Text ? this.p1Text.length/this.apiText.length : 0;
    },
    p2Completion () {
      return this.p2Text ? this.p2text.length/this.apiText.length : 0;
    },
    userIs () {
      if (this.$store.state.id === this.player1) {
        return "player1"
      } else if (this.$store.state.id === this.player2) {
        return "player2"
      } else {
        return "unknown"
      }
    },
    winner () {
      if(this.p1Completion === 100 && this.p2Completion === 100) {
        if(this.p1Speed === this.p2Speed) return "tie";
        return this.p1Speed > this.p2Speed ? "player1" : "player2";
      } else {
        return "game in progress"
      }
    },
    p1Cup () {
      return {
        cup: "left",
        player: this.userIs,
        speed: this.p1Speed,
        completion: this.p1Completion,
        winner: this.winner
      }
    },
    p2Cup () {
      return {
        cup: "right",
        player: this.userIs,  
        speed: this.p2Speed,
        completion: this.p2Completion,
        winner: this.winner
      }
    },
    promptOptions () {
      return {
        "Select AI Difficulty": ["Easy","Medium","Hard"],
        "play again": ["Yes","No"]
      }[this.prompt]
    }
  },
  methods: {
    async getIpsum () {
      const hipsterQuery = "https://hipsum.co/api/?type=hipster-centric&sentences=3";
      const hipsterResponse = await this.$axios.get(hipsterQuery);
      const hipsterText = hipsterResponse.data[0];
      this.apiText = hipsterText;
    }
  },
  mounted() {
    this.getIpsum(); 
    this.player1 = this.$store.state.id;  
    // console.log("id", this.$store.state.id)
  }
};
</script>
<style src="../styles/Pieces.scss" scoped lang="scss"> </style>