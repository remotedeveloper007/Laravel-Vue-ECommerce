<template>
  <div>
	    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/seller" class="brand-link">
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
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/seller" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <router-link to="/seller/manage-brand" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Brands</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/seller/manage-category" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Category</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/seller/manage-subcategory" class="nav-link">
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
                  <router-link to="/seller/add-product" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Product</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/seller/manage-product" class="nav-link">
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
              <router-link to="/seller/manage-coupon" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Coupons</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/seller/manage-banners" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Manage Banners</p>
              </router-link>
            </li>
            <li class="nav-item">
              <a @click="sellerLogout()" class="nav-link" href>
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

  methods: {
    sellerLogout() {
      // console.log('logged out')
      this.$store.dispatch('logout');
      axios.post('/seller/logout').then((res) => {
        this.$router.push({ name: 'Seller Login' })
        Toast.fire({
          icon: "success",
          title: "Seller Logout Successfully!",
        });        
      })
      // location.reload()     
    }
  }
};
</script>

<style>
</style>