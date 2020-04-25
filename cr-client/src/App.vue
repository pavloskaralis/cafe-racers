
<template>
   <div class="app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: "app",
  mounted () {
    this.$store.dispatch('checkUser');
  }
}

</script>

<style lang="scss">
 body {
   margin: 0;
   overflow: hidden;
 }
 .app {
    height: 100vh;
    width: 100vw;  
  }
</style>
