<template>
  <div id="publicmain">
     <router-view></router-view>
     
     <Footer></Footer>
  </div>
</template>

<script>
import Footer from '../public/common/Footer.vue'
export default {
  components: {
    Footer,
  },
  mounted() {

  }
}
</script>

<style>

</style>