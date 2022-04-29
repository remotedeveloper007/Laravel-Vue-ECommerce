import Form from "vform";
<template>
  <div>
    <Header />
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>User Register</h3>
      </div>
    </div>
    <br />
    <!--===============================================================================================-->
    <section id="cart_items">
      <div id="card">
        <div id="catab" class="category-tab shop-details-tab">
          <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#register" data-toggle="tab">Sign Up</a>
              </li>
              <li>
                <router-link :to="{ name: 'login' }" data-toggle="tab">
                  Login
                </router-link>
              </li>
              <li>
                <router-link :to="{ name: 'Reset Password' }" data-toggle="tab">
                  Forgot Password
                </router-link>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="register">
              <div class="col-sm-12">
                <div class="signup-form">
                  <!--sign up form-->
                  <p id="login-box-msg">Create New User Account!</p>
                  <form
                    class="form-group form-horizontal"
                    @submit.prevent="register"
                  >
                    <div>
                      <input
                        id="name"
                        type="text"
                        name="name"
                        v-model="form.name"
                        autofocus
                        placeholder="Name"
                      />
                      <!-- <input type="hidden" name="_token" value="csrf-token" />  -->
                      <div>
                        <span class="text-danger" v-if="errors['name']">{{
                          errors["name"][0]
                        }}</span>
                      </div>
                    </div>
                    <div>
                      <input
                        id="emil"
                        type="email"
                        name="email"
                        v-model="form.email"
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
                        id="password"
                        type="password"
                        name="password"
                        v-model="form.password"
                        placeholder="Password"
                      />
                      <div>
                        <span class="text-danger" v-if="errors['password']">{{
                          errors["password"][0]
                        }}</span>
                      </div>
                    </div>
                    <div>
                      <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        v-model="form.password_confirmation"
                        placeholder="Confirm Password"
                      />
                      <div>
                        <!-- <has-error :form="form" field="password_confirmation" class="alert alert-danger"></has-error> -->
                      </div>
                    </div>
                    <br />
                    <div id="check" class="col-sm-12">
                      <span class="col-sm-8">
                        <router-link :to="{ name: 'login' }" data-toggle="tab"
                          >Already have an account? Login</router-link
                        >
                      </span>
                      <span class="col-sm-4">
                        <button type="submit" class="btn btn-default">
                          Register
                        </button>
                      </span>
                    </div>
                  </form>
                </div>
                <!--/sign up form-->
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
export default {
  name: "Register",
  components: {
    Header,
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      errors: {},
      form: {},
      // new Form({
      //   name: "",
      //   email: "",
      //   password: "",
      //   password_confirmation: "",
      // }),
    };
  },
  methods: {
    /**
     * method for handling register:
     */
    register() {
      this.$Progress.start();
      this.$store
        .dispatch("register", this.form)
        .then(() => {
          // location.reload(),
          // this.$router.push({ name: "Verify Email" });
          window.location.href = "http://127.0.0.1:8000/email/verify";
          Toast.fire({
            icon: "warning",
            title: "Chheck Your Email For Email Address Verification Link!",
          });
          this.$Progress.finish();
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },

  mounted() {},
};
</script>

<style>
/*
#row{
  margin-top: -20px;
} */

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