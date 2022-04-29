<template>
  <div>
    <!-- <span v-if="token"> -->
    <Header :username="myProfile.name" />
    <!-- </span> -->
    <!-- <span v-else>
    <Header />-->
    <!-- </span> -->
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Order Placed</h3>
      </div>
    </div>
    <br />

    <section id="cart_items">
      <div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li>
              <a href="/">Home</a>
            </li>
            <li class="active">Paypal Payment Status</li>
          </ol>
        </div>
      </div>
    </section>
    <!--/#cart_items-->

    <section id="do_action">
      <div class="container">
        <div class="heading" align="center">
          <h3>Your Payment Has Been Completed Successfully..!</h3>
          <p>
            Your order number is:
            <router-link :to="`/user/order-details/${this.orderId}`"
              ><strong>{{ orderId }}</strong></router-link
            >
            and total amount paid is:
            <strong>$ {{ grandTotal }}</strong>
          </p>
          <p id="info">Keep your order number for future reference</p>
          <p>
            <span>
              <a id="pay-btn" href="/" class="btn btn-default">
                <i id="arrow" class="fa fa-angle-left"></i>&nbsp;Continue
                Shopping </a
              >&nbsp;</span
            >
          </p>
        </div>
      </div>
    </section>
    <!--/#do_action-->
  </div>
</template>

<script>
// const PayPalButton = paypal.Buttons.driver("vue", window.Vue);
import Form from "vform";
import Header from "../public/header/header.vue";
// import Header1 from "../public/common/header1.vue";
export default {
  name: "Cart",
  components: {
    Header,
    // Header1
    // 'paypal-buttons': PayPalButton,
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      id: [],
      loaded: false,
      grandTotal: 0,
      orderId: "",
      form: {},
    };
  },

  computed: {
    myProfile() {
      return this.$store.getters.getProfile;
    },
  },

  mounted() {
    this.$store.dispatch("myProfile");
    if (this.token) {
      axios.get("/api/payment-status").then((response) => {
        this.orderId = response.data.orderNo;
        this.grandTotal = response.data.cartTotal;
      });
    }
    // this.getPurchaseItems();
    /**
     *  data-order-id="2VW94544JM6797511
     */
  },

  methods: {
    /**
     *
     */
    // getPurchaseItems() {
    //   if (this.token) {
    //     axios.get("/api/payment-status").then((response) => {
    //       // this.order = response.data.data;

    //     });
    //   }
    // },

    /**
     *
     */
  },

  created() {
    this.$root.$refs.cartTotal = this;
  },
};
</script>

<style scoped>
strong {
  color: #fe980f;
}
#info {
  color: red;
}
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