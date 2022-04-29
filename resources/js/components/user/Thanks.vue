import Form from 'vform';
<template>
  <div>
    <!-- <span v-if="token"> -->
    <Header :username="myProfile.name" />
    <!-- </span> -->
    <!-- <span v-else>
      <Header1/>
    </span> -->
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
            <li class="active">Thanks</li>
          </ol>
        </div>
      </div>
    </section>
    <!--/#cart_items-->

    <section id="do_action">
      <div class="container">
        <div class="heading" align="center">
          <h3>Your COD Order Has Been Placed Successfully..!</h3>
          <p>
            Your order number is: <strong> {{ orderId }} </strong> and total
            payable amount is: <strong> $ {{ GrandTotal }} </strong>
          </p>
          <!-- <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p> -->
        </div>
      </div>
    </section>
    <!--/#do_action-->
  </div>
</template>

<script>
import Form from "vform";
import Header from "../public/header/header.vue";
// import Header1 from "../common/header.vue";
export default {
  name: "Cart",
  components: {
    Header,
    // Header1
  },
  data() {
    return {
      id: [],
      token: axios.defaults.headers.common["Authorization"],
      orderId: [],
      GrandTotal: 0,

      form: new Form({
        id: [],
      }),
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
      axios.get("/api/thanks").then((response) => {
        this.orderId = response.data.order_id;
        this.GrandTotal = response.data.cartTotal;
      });
    }
    //===============================

    //================================
  },

  methods: {
    //============
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
</style>