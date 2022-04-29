<template>
  <div id="sellerview">
    <!-- <div class="wrapper"> -->
    <template v-if="$route.name !== 'Seller Login'">
      <template v-if="$route.name !== 'Seller Register'">
        <Header></Header>
        <Sidebar />
      </template>
    </template>
    <router-view></router-view>
    <span v-if="$route.name !== 'Seller Register'">
    <Footer v-if="$route.name !== 'Seller Login'"></Footer>
    </span>
    <!-- </div> -->
  </div>
</template>

<script>
import Header from "../seller/common/Header.vue";
import Sidebar from "../seller/common/AdminSidebar.vue";
import Footer from "../seller/common/Footer.vue";
export default {
  components: {
    Header,
    Sidebar,
    Footer,
  },
};
</script>

<style>
</style>