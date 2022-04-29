<template>
  <div>
    <!-- header section start -->
    <!--  Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"
            ><i class="fas fa-bars"></i
          ></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/seller" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input
            class="form-control form-control-navbar"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img
              src="/assets/admin/default/admin.png"
              class="user-image img-circle elevation-2"
              alt="User Image"
            />
            <span class="d-none d-md-inline">DEMO </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img
                src="/assets/admin/default/admin.png"
                class="img-circle elevation-2"
                alt="User Image"
              />

              <p>
                DEMO - Web Developer
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->

            <!-- Menu Footer-->
            <li class="user-footer">
              <router-link
                to="/seller/profile"
                class="btn btn-outline-primary btn-flat"
                >Profile</router-link
              >
              <a @click="sellerLogout()" class="btn btn-outline-secondary btn-flat float-right" href>Sign out</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            data-widget="control-sidebar"
            data-slide="true"
            href="#"
          >
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /Navbar -->
    <!-- header section end -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      // user: {}
    };
  },
  mounted() {
    // this.$store.dispatch('getUser')
  },
  computed: {
    // user() {
    //   return this.$store.getters.getAuthUser
    // },
  },
  methods: {
    // getUser() {
    //   this.$store.dispatch('getUser');
    // },
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
    },
  },
  created() {
    // this.getUser();
  },
};
</script>

<style>
</style>