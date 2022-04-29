<template>
  <div>
    <span>
      <Header1 />
    </span>

    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Verify Your Email Address</h3>
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
                  <center>
                    Email verification link has been sent to your email address.
                  </center>
                </div>
                <!-- @endif -->
                <center>
                  Before proceeding, please check your email for a verification
                  link. If you did not receive the email,
                  <form
                    class="inline"
                    method="POST"
                    action="#verification.resend"
                  >
                    <!-- @csrf -->
                    <button
                      type="submit"
                      class="btn btn-link p-0 m-0 align-baseline"
                    >
                      click here to request another
                    </button>
                  </form>
                  <br />
                  OR <br />
                </center>
                <hr />
                <!-- <p> -->
                <center>
                  <router-link :to="{ name: 'login' }"
                    ><button id="pay-btn" class="btn btn-default">
                      Login
                    </button></router-link
                  >
                </center>
                <!-- </p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <br /> -->
      <!-- <br /> -->
      <!-- </div> -->
    </section>
    <!-- <br />
    <br /> -->
  </div>
</template>

<script>
import Header1 from "../../public/common/header";
export default {
  components: {
    Header1,
  },

  data() {
    return {
      token: document.querySelector('meta[name="csrf-token"]'),
    };
  },
};
</script>

<style scoped>
/* #cart_items {
  padding-left: 50px;
} */
#pay-btn {
  background: #fe980f;
  border: medium none;
  border-radius: 0;
  color: #ffffff;
  cursor: pointer;
  font-family: "Roboto", sans-serif;
  padding: 6px 25px;
  font-size: 16px;
}
#pay-btn:hover {
  background: hsl(0, 3%, 94%);
  color: #000;
}
</style>


