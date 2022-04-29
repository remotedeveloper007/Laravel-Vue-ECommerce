<template>
  <div id="adminlog">
    <div class="login-box">
      <div class="login-logo">
        <a href="/admin"><b>Admin</b>Login</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form method="post" @submit.prevent="AdminLogin()">
            <div class="input-group mb-3">
              <input type="email" v-model="form.email" name="email" class="form-control" placeholder="Email" />               
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>            
            </div>
            <p><span class="text-danger" v-if="errors['email']">{{ errors['email'][0] }}</span></p>
            <div class="input-group mb-3">
              <input
                type="password"
                v-model="form.password"
                name="password"
                class="form-control"
                placeholder="Password"
              />             
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>              
            </div>
            <p><span class="text-danger" v-if="errors['password']">{{ errors['password'][0] }}</span></p>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember"> Remember Me </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="#">I forgot my password</a>
          </p>
          <!-- <p class="mb-0">
            <a href="register.html" class="text-center"
              >Register a new membership</a
            >
          </p> -->
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
          form: {}
      }
  },
 
  methods: {
    AdminLogin() {
       this.$store.dispatch("login", this.form).then((res) => {
        //  console.log(res.data)
        this.$router.push({ name: 'Admin Dashboard' })
        // location.reload()
      }).catch((err) => {
        this.errors = err.response.data.errors
      })
    }
  }
}
</script>

<style>
#adminlog{
  margin-left: 300px;
  background-color: #f8fafc;
}
</style>