<style>
.fade-leave-active {
  transition: opacity 7.5s ease-out;
  /* transition: opacity 2.5s */
}

.fade-leave-to {
  opacity: 0;
  transform: translateX(100px);
}
/* body { background-image: url("/assets/admin/default/register.jpg") !important;} */
#link {
  text-decoration: none;
}
#text {
  text-decoration: none;
  color: red;
  font-size: 18px;
  font-weight: bolder;
}
#check {
  font-size: 18px;
  font-weight: bolder;
  border: #000;
}
</style>

<template>
  <div id="seller regiter"  class="hold-transition login-page">
    <div class="register-box">
      <div class="register-logo">
        <a id="link" href="/seller"><b>SELLER</b> Sign Up</a>
      </div>

      <!-- <div> -->
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="POST" @submit.prevent="sellerRegister()">
          <div class="input-group mb-3">
            <input
              type="text"
              name="name"
              v-model="form.name"
              class="form-control"
              placeholder="Full name"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <transition name="fade"
            ><span class="text-danger" v-if="errors['name']">{{
              errors["name"][0]
            }}</span></transition
          >
          <div class="input-group mb-3">
            <input
              type="email"
              name="email"
              v-model="form.email"
              class="form-control"
              placeholder="Email"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <transition name="fade"
            ><span class="text-danger" v-if="errors['email']">{{
              errors["email"][0]
            }}</span></transition
          >
          <div class="input-group mb-3">
            <input
              type="password"
              name="password"
              v-model="form.password"
              class="form-control"
              placeholder="Password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <transition name="fade"
            ><span class="text-danger" v-if="errors['password']">{{
              errors["password"][0]
            }}</span></transition
          >
          <div class="input-group mb-3">
            <input
              type="password"
              name="password_confirmation"
              v-model="form.password_confirmation"
              class="form-control"
              placeholder="Retype password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div id="check" class="icheck-primary">
                <input
                  type="checkbox"
                  id="agreeTerms"
                  name="terms"
                  value="agree"
                />
                <label for="agreeTerms">
                  I agree to the <a href>terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">
                Register
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i>
              Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Sign up using Google+
            </a>
          </div> -->

        <router-link
          id="text"
          :to="{ name: 'Seller Login' }"
          class="text-center"
          >I already have a membership</router-link
        >
      </div>
      <!-- /.form-box -->
      <!-- </div> -->
      <!-- /.card -->
    </div>
    <!-- /.register-box -->
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
    sellerRegister() {
      // console.log(this.form)
      this.$store
        .dispatch("register", this.form)
        .then((res) => {
          this.$router.push({ name: "Seller Dashboard" });
          // location.reload()
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>

