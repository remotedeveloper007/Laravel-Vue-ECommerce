<template>
  <div>
    <!--===============================================================================================-->
    <span v-if="userLoggedIn"><Header v-bind:username="myProfile.name" /></span>
    <span v-else><Header1 /></span>
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Contact Us</h3>
      </div>
    </div>
    <br />
    <!--===============================================================================================-->
    <!-- contact -->
    <div class="contact">
      <div id="contact-page" class="container">
        <div class="bg">
          <div class="row">
            <div class="contact-grids">
              <div
                class="
                  col-md-4
                  contact-grid
                  text-center
                  animated
                  wow
                  slideInLeft
                "
                data-wow-delay=".5s"
              >
                <div class="contact-grid1">
                  <i
                    class="glyphicon glyphicon-map-marker"
                    aria-hidden="true"
                  ></i>
                  <h4>Address</h4>
                  <p>
                    12K Street, 45 Building Road
                    <span>New York City.</span>
                  </p>
                </div>
              </div>
              <div
                class="col-md-4 contact-grid text-center animated wow slideInUp"
                data-wow-delay=".5s"
              >
                <div class="contact-grid2">
                  <i
                    class="glyphicon glyphicon-earphone"
                    aria-hidden="true"
                  ></i>
                  <h4>Call Us</h4>
                  <p>
                    +1234 758 839
                    <span>+1273 748 730</span>
                  </p>
                </div>
              </div>
              <div
                class="
                  col-md-4
                  contact-grid
                  text-center
                  animated
                  wow
                  slideInRight
                "
                data-wow-delay=".5s"
              >
                <div class="contact-grid3">
                  <i
                    class="glyphicon glyphicon-envelope"
                    aria-hidden="true"
                  ></i>
                  <h4>Email</h4>
                  <p>
                    <a href="mailto:info@example.com">info@example1.com</a>
                    <span>
                      <a href="mailto:info@example.com">info@example2.com</a>
                    </span>
                  </p>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="map wow fadeInDown animated" data-wow-delay=".5s">
              <h3 class="tittle">View On Map</h3>
              <!--<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2482.432383990807!2d0.028213999961443994!3d51.52362882484525!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1423469959819" frameborder="0" style="border:0"></iframe>-->
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14738.88878482092!2d88.38006472159341!3d22.537084382309295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0276badf701f6f%3A0xe3398cf5c19f9102!2sTopsia%2C+Kolkata%2C+West+Bengal!5e0!3m2!1sen!2sin!4v1541834504613"
                frameborder="0"
                style="border: 0"
                allowfullscreen
              ></iframe>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <div class="contact-form2">
                <h2 class="title text-center">Get In Touch</h2>
                <div
                  class="status alert alert-success"
                  style="display: none"
                ></div>
                <form class="contact-form" name="contact-form" method="post">
                  <div class="form-group col-md-6">
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="Name"
                      required
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <input
                      type="email"
                      name="email"
                      class="form-control"
                      placeholder="Email"
                      required
                    />
                  </div>
                  <div class="form-group col-md-12">
                    <input
                      type="text"
                      name="subject"
                      class="form-control"
                      placeholder="Subject"
                      required
                    />
                  </div>

                  <div class="form-group col-md-12">
                    <textarea
                      name="message"
                      id="message"
                      required="required"
                      class="form-control"
                      rows="8"
                      placeholder="Your Message Here"
                    ></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <input
                      type="submit"
                      name="submit"
                      class="btn btn-primary"
                      value="Submit"
                    />
                  </div>
                </form>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="contact-info">
                <h2 class="title text-center">Contact Info</h2>
                <address>
                  <p>E-Shopper Inc.</p>
                  <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                  <p>Newyork USA</p>
                  <p>Mobile: +2346 17 38 93</p>
                  <p>Fax: 1-714-252-0026</p>
                  <p>Email: info@e-shopper.com</p>
                </address>
                <div class="social-auth-links text-center mb-3">
                  <h2 class="title text-center">Social Networking</h2>
                  <ul
                    class="
                      social-nav
                      model-3d-0
                      footer-social
                      w3_agile_social
                      top_agile_third
                    "
                  >
                    <li>
                      <a href="#" class="facebook">
                        <div class="front">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </div>
                        <div class="back">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="twitter">
                        <div class="front">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </div>
                        <div class="back">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="instagram">
                        <div class="front">
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </div>
                        <div class="back">
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="pinterest">
                        <div class="front">
                          <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </div>
                        <div class="back">
                          <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </div>
                      </a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/#contact-page-->
    </div>

    <!-- //contact -->
    <!--===============================================================================================-->
  </div>
</template>

<script>
import { userComputed } from "../../../vuex/helper.js";
import Header from "../header/header.vue";
import Header1 from "../common/header.vue";

export default {
  name: "Contact",
  components: {
    Header,
    Header1,
  },

  data() {
    return {};
  },

  computed: {
    ...userComputed,
    myProfile() {
      return this.$store.getters.getProfile;
    },
  },

  mounted() {
    this.$store.dispatch("myProfile");
  },
};
</script>

<style scoped>
</style>