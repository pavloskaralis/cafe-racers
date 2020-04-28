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

      <div class="text-body" id="text-body"> 
        <span :key="wordIndex" v-for="(word,wordIndex) in apiWords" class="text-word"> 
          <letter 
            :key="wordIndex + '_' + letterIndex" 
            :id="wordIndex + '_' + letterIndex" 
            v-for="(letter, letterIndex) in word.split('')" 
            :letter="letter"
            :status="getLetterState(wordIndex,letterIndex)"
            :isWrong="mistake"
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
      currentLetterID: "",
      mistake: false,
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
      return this.p1Text && this.p1Time ? Math.round(this.p1Text.split(" ").length/this.p1Time * 60) : 0;
    },
    p2Speed () {
      return this.p2Text && this.p2Time ? Math.round(this.p2Text.split(" ").length/this.p2Time * 60) : 0;
    },
    p1Completion () {
      return this.p1Text ? this.p1Text.length/this.apiText.length * 100 : 0;
    },
    p2Completion () {
      return this.p2Text ? this.p2Text.length/this.apiText.length * 100 : 0;
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
        if(this.p1Time === this.p2Time) return "tie";
        return this.p1Time < this.p2Time ? "player1" : "player2";
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
        //AI Version
        player: "player2",  
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
      const hipsterQuery = "https://hipsum.co/api/?type=hipster-centric&sentences=2";
      const hipsterResponse = await this.$axios.get(hipsterQuery);
      const hipsterText = hipsterResponse.data[0];
      this.apiText = hipsterText;
      this.apiText= "short easy sentence"
    },
    startGame() {
      for (let i = 4; i > 0; i--) {
        setTimeout(()=> this.prompt = `Start Typing In ${i}`, 1000 * [3,2,1,0][i-1])
      }
      setTimeout(()=> {
        this.prompt = "";
        this.tracking = true;
        this.startAI(); 
        setInterval( ()=> {
          if(this.p1Completion < 100) this.p1Time += 1;
          if(this.p2Completion < 100) this.p2Time += 1;
        }, 1000);
      }, 4000);
    },
    startAI () {
      let totalTime = 0; 
      let totalWords = this.apiWords.length;
      let totalLetters = this.apiText.length; 
      let lettersPerWord = totalLetters/totalWords;

      for(let i = 0; i < totalLetters; i ++) {
        let random = Math.round(Math.random() * 10); 
        let randomWPM = this.difficulty + random; 
        let newTime = (60/randomWPM * 1000)/lettersPerWord; 
        totalTime += newTime; 
        setTimeout(()=> {
          this.p2Text += this.apiText[i];
        },totalTime);
      }
    },
    trackInput() {
      let key = event.key;
      let currentTextLength = this.userIs === "player1" ? this.p1Text.length : this.p2Text.length;
      let currentLetter = this.apiText[currentTextLength];
      if(key !== currentLetter && key !== "Shift") {this.mistake = true;}
      if(key === currentLetter) { 
        this.userIs === "player1" ? this.p1Text += key : this.p2Text += key;
        this.mistake = false; 
        this.autoScroll(); 
      }      
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
        easy: 30,
        medium: 35,
        hard: 50
      }[level];
      this.startGame();
    },
     setNext(choice){
      if(choice === "yes") {
        this.prompt = "Select AI Difficulty";
        this.difficulty = "";
        this.currentLetterID = "";
        this.p1Text = "";
        this.p2Text = "";
        this.p1Time = 0;
        this.p2Time = 0;
        this.getIpsum(); 
      } else if (choice === "no") {
        this.$router.push("/");
      }
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
        if(wordIndex === lastWordIndex + 1 && letterIndex === 0) {
          state = "current";
          this.currentLetterID = wordIndex + "_" + letterIndex; 
        }
        //and all letters in words before the next word are innactive
        if(wordIndex <= lastWordIndex) state = "inactive";
      //otherwise if the last word is not fully spelled
      } else if(words[lastWordIndex] !== this.apiWords[lastWordIndex]) {
        //the first unexisting letter of the current word is current
        if(wordIndex === lastWordIndex && letterIndex === lastLetterIndex + 1) {
          state = "current";
          this.currentLetterID = wordIndex + "_" + letterIndex; 
        }
        //and all letters in the current word before the current letter are inactive;
        if(wordIndex === lastWordIndex && letterIndex < lastLetterIndex + 1) state = "inactive";
        //as well as all letters in words before the current word
        if(wordIndex < lastWordIndex) state = "inactive";
      }
      return state;
    },
    autoScroll () {
      let letter = document.getElementById(this.currentLetterID);
      let textBody = document.getElementById('text-body');
      let tbHeight = textBody.getBoundingClientRect().top; 
      let lHeight = letter.getBoundingClientRect().top;
      let scrollHeight = lHeight - tbHeight;
      if(scrollHeight > 100) textBody.scrollTop += 20;
     
     console.log(this.p1Completion);
    }
  },
  mounted() {
    this.getIpsum(); 
    //AI Version
    this.player1 = this.$store.state.id;  
  }
};
</script>
<style src="../styles/Pieces.scss" scoped lang="scss"> </style>