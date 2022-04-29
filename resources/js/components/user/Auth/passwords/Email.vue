<template>
  <div>
    <span>
      <Header1 />
    </span>

    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Forgot Password</h3>
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
              <li>
                <router-link :to="{ name: 'login' }" data-toggle="tab"
                  >Login</router-link
                >
              </li>
              <li class="active">
                <router-link :to="{ name: 'Reset Password' }" data-toggle="tab">
                  Forgot Password
                </router-link>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="forgotpassword">
              <div class="col-sm-12">
                <div class="signup-form">
                  <!--Reset Password form-->
                  <p id="login-box-msg">Reset Password</p>
                  <form action="#">
                    <input type="email" placeholder="Enter Email Address" />
                    <br />
                    <center>
                      <button type="submit" class="btn btn-default">
                        Send Password Reset Link
                      </button>
                    </center>
                  </form>
                </div>
                <!--/Reset Password form-->
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
import Header1 from "../../../public/common/header";
export default {
  name: "Email",
  components: {
    Header1,
  },
  data() {
    return {};
  },
};
</script>

<style>
</style>