import Form from "vform";
<template>
  <div>
    <span>
      <Header />
    </span>

    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>User Login</h3>
      </div>
    </div>
    <br />
    <!--===============================================================================================-->
    <section id="cart_items">
      <div id="card">
        <div id="catab" class="category-tab shop-details-tab">
          <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li>
                <router-link :to="{ name: 'register' }" data-toggle="tab">
                  Sign Up
                </router-link>
              </li>
              <li class="active">
                <router-link :to="{ name: 'login' }" data-toggle="tab"
                  >Login</router-link
                >
              </li>
              <li>
                <router-link :to="{ name: 'Reset Password' }" data-toggle="tab">
                  Forgot Password
                </router-link>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="login">
              <div class="col-sm-12">
                <div class="login-form">
                  <!--login form-->
                  <!--      <h2>Login to your account</h2> -->
                  <p id="login-box-msg">Sign in to start your session</p>
                  <p id="verify" class="alert-danger">
                    <center>
                      <strong>
                        Your email is not verified. Activate your account to
                        login.</strong
                      >
                    </center>
                  </p>
                  <form
                    class="form-group form-horizontal"
                    @submit.prevent="login"
                  >
                    <!--    <center class="alert-danger"><strong><p v-if="error">Invalid Email/Password!</p></strong></center> -->
                    <div>
                      <input
                        id="email"
                        type="email"
                        name="email"
                        v-model="form.email"
                        autocomplete="email"
                        autofocus
                        placeholder="Email Address"
                      />

                      <div>
                        <span class="text-danger" v-if="errors['email']">{{
                          errors["email"][0]
                        }}</span>
                      </div>
                    </div>
                    <div>
                      <input
                        type="password"
                        class="input"
                        id="passwod"
                        v-model="form.password"
                        name="password"
                        placeholder="Password"
                      />
                      <div>
                        <span class="text-danger" v-if="errors['password']">{{
                          errors["password"][0]
                        }}</span>
                      </div>
                    </div>
                    <div id="check" class="col-sm-12">
                      <span class="col-sm-8">
                        <input
                          type="checkbox"
                          id="remember"
                          v-model="form.remember"
                          name="remember"
                        />
                        <label for="remember" id="me">Remember Me</label>
                      </span>
                      <span class="col-sm-4">
                        <button type="submit" class="btn btn-default">
                          Login
                        </button>
                      </span>
                    </div>
                  </form>
                  <center>
                    <router-link :to="{ name: 'register' }" data-toggle="tab">
                      Don't have an account? Register
                    </router-link>
                  </center>
                </div>
                <!--/login form-->
              </div>
            </div>
          </div>
        </div>
        <br />
        <br />
      </div>
    </section>
    <br />
    <br />
  </div>
</template>

<script>
import Form from "vform";
import Header from "../../public/common/header.vue";
import axios from "axios";
export default {
  name: "Login",
  components: {
    Header,
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],

      errors: {},
      form: new Form({
        email: "",
        password: "",
        remember: "",
      }),
      is_verified: true,
    };
  },

  mounted() {
    // Instantaneously hide all paragraphs
    $("#verify").hide();
  },
  methods: {
    /**
     * method for handling login:
     */
    login() {
      this.$Progress.start();
      axios
        .post("/api/login", this.form)
        .then((res) => {
          this.is_verified = res.data.status;
          if (this.is_verified == false) {
            $("#verify").show();
            $("#verify").fadeOut(10000);
          } else {
            this.$store.commit("SET_USER_DATA", res.data);
            // this.$router.push({ name: "cart" });
            Toast.fire({
              icon: "success",
              title: "User Login Successfully!",
            });
            this.$Progress.finish();
            location.reload();
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>

<style scoped>
#verify {
  height: 45px;
  line-height: 40px;
}

#card {
  display: flex;
  justify-content: center;
}

#catab {
  width: 400px;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  padding: 1.25rem;
}

#catab {
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
  margin-bottom: 1rem;
}

#login-box-msg {
  margin: 0;
  padding: 0 20px 20px;
  text-align: center;
}
#remember {
  min-width: 22px;
  min-height: 22px;
  line-height: 22px;
  cursor: pointer;
  margin-top: 23px;
}
#me {
  margin-top: 23px;
}
#check {
  margin-bottom: 23px;
}
</style>