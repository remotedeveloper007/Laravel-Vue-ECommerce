<template>
  <div>
    <span>
      <Header1 />
    </span>

    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Email verification Failed</h3>
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
                <div class="alert alert-danger" role="alert">
                  Your email verification has failed.
                </div>
                <!-- @endif -->

                Resend your email verification link,
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
                    click here to request another</button
                  >.
                </form>
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
name: "VerifyFailed";
export default {};
</script>

<style lang="scss" scoped>
</style>