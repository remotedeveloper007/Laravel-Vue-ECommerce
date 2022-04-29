<template>
  <div>
	    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/admin" class="brand-link">
        <img
          src="/assets/admin/default/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light" v-if="$route.name === 'Admin Dashboard'">AdminLTE 3</span>
        <span class="brand-text font-weight-light" v-else>SellerLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="/assets/admin/default/admin.png"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">DEMO </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav id="nav" class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <router-link to="/admin" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class="nav-item has-treeview">
              <router-link to="/admin/manage-brand" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Brands</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'Category' }" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Category</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'Subcategory' }" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage SubCategory</p>
              </router-link>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                  Product
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{ name: 'AddPro' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Product</p>                   
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'ManagePro' }" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Manage Products</p>
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Charts
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ChartJS</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/flot.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Flot</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/inline.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inline</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: 'Coupon' }" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Coupons</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/admin/manage-banners" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Banners</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'Order' }" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Orders</p>
                <i class="right fas fa-badge">
                  <!-- {{ orderCount }} -->
                </i>
              </router-link>
            </li>            
            <li class="nav-item">
              <a @click="adminLogout()" class="nav-link" href>
                <i class="nav-icon fas fa-power-off"></i>
                <p>LogOut</p>
              </a>
            </li>            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
	  <!-- /Main Sidebar Container -->
  </div>
</template>

<script>
export default {
  name: "PublicBreadCrum",
  // data() {
  //   return{}
  // },
  // props: {
  //   orderCount: { 
  //     type: Number ,
  //   }
  // },

  methods: {
    adminLogout() {
      this.$store.dispatch('logout');
      axios.post('/admin/logout').then(() => {
        this.$router.push({ name: 'Admin Login' })
        Toast.fire({
          icon: "success",
          title: "Admin Logout Successfully!",
        });         
      })
      // location.reload()     
    }
  }
};
</script>

<style scoped>
#nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #007bff;
    color: #fff;
}
#nav-treeview>.nav-item>.nav-link.active:hover {
    background-color: rgba(255,255,255,.9);
    color: #343a40;
 }

 /* nav a.router-link-active, */
 #nav a.sidebar-active-class {
    background-color: #007bff;
    color: #fff;
   cursor: pointer;
 }


</style>