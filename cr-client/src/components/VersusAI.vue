<template>
  <div v-on="tracking ? {keydown:trackInput} : {}" tabindex="0" class="game-pieces">
    
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
            <div  v-if="promptOptions" class="prompt-options">
              <app-button 
                type="game-button" 
                :key="index" 
                v-for="(option,index) in promptOptions" 
                :text="option"
                @clicked="processClick"
              >
              </app-button>
            </div>
        </div>
      </div>

      <div class="text-body"> 
        <span :key="wordIndex" v-for="(word,wordIndex) in apiWords" class="text-word"> 
          <letter 
            :key="wordIndex + '_' + letterIndex" 
            v-for="(letter, letterIndex) in word.split('')" 
            :letter="letter"
            :state="getLetterState(wordIndex,letterIndex)"
          >
          </letter>
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
      difficulty: "",
      tracking: false, 
      player1: "",
      player2: "",
      apiText: "",
      p1Text: "",
      p2Text: "",
      p1Time: 0,
      p2Time: 0,
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
      return this.p1Text ? Math.round(this.p1Text.split(" ").length/this.p1Time * 60) : 0;
    },
    p2Speed () {
      return this.p2Text ? Math.round(this.p2Text.split(" ").length/this.p2Time * 60) : 0;
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
        "Select AI Difficulty": ["easy","medium","hard"],
        "play again": ["yes","no"]
      }[this.prompt]
    }
  },
  methods: {
    async getIpsum() {
      const hipsterQuery = "https://hipsum.co/api/?type=hipster-centric&sentences=3";
      const hipsterResponse = await this.$axios.get(hipsterQuery);
      const hipsterText = hipsterResponse.data[0];
      this.apiText = hipsterText;
    },
    startGame() {
      // for (let i = 4; i > 0; i--) {
      //   setTimeout(()=> this.prompt = `Start Typing In ${i}`, 1000 * [3,2,1,0][i-1])
      // }
      // setTimeout(()=> {
      //   this.prompt = "";
      //   this.tracking = true;
      //   setInterval( ()=> {
      //     if(this.p1Completion < 100) this.p1Time += 1;
      //     if(this.p2Completion < 100) this.p2Time += 1;
      //   }, 1000);
      // }, 4000);
      this.prompt = "";
        this.tracking = true;
        setInterval( ()=> {
          if(this.p1Completion < 100) this.p1Time += 1;
          if(this.p2Completion < 100) this.p2Time += 1;
        }, 1000);
    },
    trackInput() {
      if(this.userIs === "player1") {
        return null; 
      } else if (this.userIs === "player2") {
        return null;
      }
      // console.log("tracking")
    },
    processClick(event) {
      if(["easy","medium","hard"].indexOf(event)!== -1) {
        this.setDifficulty(event)
      } else if (["yes","no"].indexOf(event)!== -1) {
        return null
      }
    },
    setDifficulty(level) {
      this.difficulty = {
        easy: 70,
        medium: 75,
        hard: 80
      }[level];
      this.startGame();
    },
    getLetterState (wordIndex, letterIndex) {
      //default
      let state = "active"
      //get all words of client
      const splitText = this.userIs === "player1" ? this.p1Text.split(" ") : this.p2Text.split(" ");
      //add spaces to match api words
      const words = []; 
      for(let i = 0; i < splitText.length; i++) {
        if(i !== splitText.length - 1) splitText[i] += " ";
        words.push(splitText[i]);
      }
      //find client's last word and letter indexes
      const lastWordIndex = words.length - 1; 
      const lastLetterIndex = words[lastWordIndex].length -1;
      //if last word of client text is fully spelled
      if(words[lastWordIndex] === this.apiWords[lastWordIndex]) {
        //the first letter of the next word is current
        if(wordIndex === lastWordIndex + 1 && letterIndex === 0) state = "current";
        //and all letters in words before the next word are innactive
        if(wordIndex <= lastWordIndex) state = "inactive";
      //otherwise if the last word is not fully spelled
      } else if(words[lastWordIndex] !== this.apiWords[lastWordIndex]) {
        //the first unexisting letter of the current word is current
        if(wordIndex === lastWordIndex && letterIndex === lastLetterIndex + 1) state = "current";
        //and all letters in the current word before the current letter are inactive;
        if(wordIndex === lastWordIndex && letterIndex < lastLetterIndex + 1) state = "inactive";
        //as well as all letters in words before the current word
        if(wordIndex < lastWordIndex) state = "inactive";
      }
      return state;
    },
  },
  mounted() {
    this.getIpsum(); 
    //AI Version
    this.player1 = this.$store.state.id;  
  }
};
</script>
<style src="../styles/Pieces.scss" scoped lang="scss"> </style>