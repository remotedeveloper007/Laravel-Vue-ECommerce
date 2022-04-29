<template>
  <div id="adminview">
    <div class="wrapper">
      <template v-if="$route.name !== 'Admin Login'">
        <!-- <div> -->
          <Header></Header>
          <Sidebar/>
        <!-- </div> -->

      </template> 
        <div class="content-wrapper admin">

            <router-view :myStyle="myStyle"></router-view>
        </div>           
        <Footer v-if="$route.name !== 'Admin Login'"></Footer> 
        <!-- <div><Footer/></div> -->
    </div>
  </div>
</template>

<script>
import Header from '../admin/common/Header.vue'
import Sidebar from '../admin/common/AdminSidebar.vue'
import Footer from '../admin/common/Footer.vue'
export default {
  data() {
    return {
      myStyle:{
        backgroundColor: "#f8fafc" 
      }
    }
  },
  components: {
    Header,
    Sidebar,
    Footer,
  },
  // mounted() {
  //   axios.get('/admin/view-order').then((response) => {
  //     this.count = response.data.totalOrder;
  //   })
  // },

}
</script>

<style scoped>
.admin{
  background-color: #f8f9fa;
}
</style>