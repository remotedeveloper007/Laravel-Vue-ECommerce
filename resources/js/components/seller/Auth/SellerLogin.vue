<template>
  <div id="seller login" class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a id="link" href="/seller"><b>SELLER</b> Login</a>
      </div>
      <!-- /.login-logo -->
      <div>
        <div class="card-body modal-body-sub_agil">
          <p class="login-box-msg">Sign in to start your session</p>

          <form method="POST" @submit.prevent="sellerLogin()">
            <div class="input-group mb-3 styled-input agile-styled-input-top">
              <input
                id="email"
                type="email"
                name="email"
                v-model="form.email"
                class="form-control"
                placeholder="Email"
                autocomplete="email"
                autofocus
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <p><span class="text-danger" v-if="errors['email']">{{ errors["email"][0] }}</span></p>
            <div class="input-group mb-3">
              <input
                id="password"
                type="password"
                v-model="form.password"
                class="form-control"
                name="password"
                placeholder="Password"
                autocomplete="current-password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-key"></span>
                </div>
              </div>
            </div>
            <p><span class="text-danger" v-if="errors['password']">{{ errors["password"][0] }}</span></p>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" name="remember" id="remember" />
                  <label for="remember"> Remember Me </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Login
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3">
            <!-- <p>- OR -</p> -->
            <!--               
              <ul class="social-nav model-3d-0 w3_agile_social top_agile_third">
                                  <li><a href="#" class="facebook">
                                      <div class="front"><i class="fab fa-facebook-f" aria-hidden="true"></i></div>
                                      <div class="back"><i class="fab fa-facebook-f" aria-hidden="true"></i></div></a></li>
                                  <li><a href="#" class="twitter"> 
                                      <div class="front"><i class="fab fa-twitter" aria-hidden="true"></i></div>
                                      <div class="back"><i class="fab fa-twitter" aria-hidden="true"></i></div></a></li>
                                  <li><a href="#" class="instagram">
                                      <div class="front"><i class="fab fa-instagram" aria-hidden="true"></i></div>
                                      <div class="back"><i class="fab fa-instagram" aria-hidden="true"></i></div></a></li>
                                  <li><a href="#" class="pinterest">
                                      <div class="front"><i class="fab fa-linkedin-in" aria-hidden="true"></i></div>
                                      <div class="back"><i class="fab fa-linkedin-in" aria-hidden="true"></i></div></a></li>
              </ul> 
              -->
            <div class="clearfix"></div>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <!-- @if (Route::has('password.request')) -->
            <a id="text" href="#">Forgot Your Password?</a>
            <!-- @endif -->
          </p>
          <p class="mb-0" v-if="$route.name !== 'Seller Register'">
            <!-- @if (Route::has('register')) -->
            <router-link
              id="reg"
              :to="{ name: 'Seller Register' }"
              class="text-center"
              >Register a new membership</router-link
            >
            <!-- @endif -->
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: {},
      form: {},
    };
  },

  methods: {
    sellerLogin() {
      this.$store.dispatch("login", this.form).then((res) => {
        this.$router.push({ name: "Seller Dashboard" });
        //  location.reload()
      }).catch((err) => {
        this.errors = err.response.data.errors
      });
    },
  },
};
</script>

<style>
/* body { background-image: url('/assets/admin/default/login.jpg') !important;} */
#link {
  text-decoration: none;
}
#text {
  text-decoration: none;
  color: red;
  font-size: 18px;
  font-weight: bolder;
}
#reg {
  text-decoration: none;
  color: blue;
  font-size: 18px;
  font-weight: bolder;
}
</style>