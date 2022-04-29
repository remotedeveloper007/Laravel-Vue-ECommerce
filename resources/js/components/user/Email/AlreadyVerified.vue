<template>
  <div>
    <span>
      <Header1 />
    </span>

    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Your Email has Already verified</h3>
      </div>
    </div>
    <br />
    <!--===============================================================================================-->
    <section id="cart_items">
      <!-- <div id="card"> -->

      <div class="container">
        <div class="col-md-2"></div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <!-- <div class="card-header">Verify Your Email Address</div> -->

              <div class="card-body">
                <!-- @if (session('resent')) -->
                <div class="alert alert-success" role="alert">
                  <center id="alert">
                    Your email has already been verified...!
                  </center>
                </div>
                <!-- @endif -->
                <div>
                  <center>
                    <span id="redirect">
                      To access your dashboard/profile
                    </span>
                    <!-- @csrf -->
                    <router-link
                      id="button"
                      :to="{ name: 'login' }"
                      class="btn btn-default"
                      ><strong><i>Click here to login</i></strong></router-link
                    >
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <br />  Your email has already been verified...!-->
      <!-- <br /> -->
      <!-- </div> -->
    </section>
    <!-- <br />
    <br /> -->
  </div>
</template>

<script>
import Header1 from "../../public/header/header.vue";

export default {
  name: "AlreadyVerified",
  components: {
    Header1,
  },
};
</script>

<style lang="scss" scoped>
#alert {
  font-size: 18px;
}
#button {
  // -webkit-appearance: button;
  // -moz-appearance: button;
  // appearance: button;
  // text-decoration: outline;
  color: #fff;
  font-size: 16px;
  // border: 1 px solid #fe980f;
  background-color: #fe980f;
  border-radius: 3px;
}
#button:hover {
  background-color: #ebebeb;
  border-color: #adadad;
  color: #333;
}
#redirect {
  font-size: 20px;
}
</style>