import Form from "vform";
<template>
  <div>
    <span v-if="token">
      <Header :username="myProfile.name" />
    </span>
    <span v-else>
      <Header1 />
    </span>
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Review Order & Payment</h3>
      </div>
    </div>
    <br />
    <!--===============================================================================================-->
    <section id="cart_items">
      <div class="container">
        <!-- <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li>
              <a href="/">Home</a>
            </li>
            <li class="active">Review & Payment</li>
          </ol>
        </div>-->
        <div class="step-one">
          <div class="col-sm-6 invoice-col">
            <h2 class="heading">Billing Details</h2>

            <address id="details">
              <strong>{{ billing.name }}</strong>
              <br />
              <span id="b">
                {{ billing.address }}
                <br />
                {{ billcity }} &nbsp;&nbsp; {{ billing.pincode }}
                <br />
                {{ billstate }} &nbsp;&nbsp; {{ billcountry }}
                <br />
                Phone: {{ billing.phone }}
                <br />
                Email: {{ billing.email }}
              </span>
            </address>
          </div>
          <div class="col-sm-6 invoice-col">
            <h2 class="heading">Shipping Details</h2>

            <address id="details">
              <strong>{{ shipping.shipping_name }}</strong>
              <br />
              <span id="b">
                {{ shipping.shipping_address }}
                <br />
                {{ shipcity }} &nbsp;&nbsp; {{ shipping.shipping_pincode }}
                <br />
                {{ shipstate }} &nbsp;&nbsp; {{ shipcountry }}
                <br />
                Phone: {{ shipping.shipping_phone }}
                <br />
                Email: {{ shipping.shipping_email }}
              </span>
            </address>
          </div>
        </div>
      </div>
    </section>
    <br />
    <br />

    <section id="cart_items">
      <div class="container">
        <div class="table-responsive cart_info">
          <table class="table table-condensed">
            <thead>
              <tr class="cart_menu">
                <td class="image">Image</td>
                <td class="description">Product</td>
                <td>Size</td>
                <td class="price">Price</td>
                <td class="quantity">Quantity</td>
                <td class="total">Total</td>
                <!-- <td>Remove</td> -->
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in boughtProducts" :key="product.id">
                <td class="cart_product">
                  <a href>
                    <img :src="`/product_image/${product.image}`" alt />
                  </a>
                </td>
                <td class="cart_description">
                  <h4>{{ product.product_name }}</h4>
                  <p>Web ID: {{ product.product_code }}</p>
                </td>
                <td>
                  <p>{{ product.size }}</p>
                </td>
                <td class="cart_price">
                  <p>${{ product.price }}</p>
                </td>
                <td class="cart_quantity">
                  <p id="b">{{ product.quantity }}</p>
                  <!-- <b class="cart_quantity_button">                   
                    <a class="cart_quantity_up" id="qty" @click.prevent="quantityUp(cart.id)">+</a>
                    <strong>
                    <input
                      class="cart_quantity_input"
                      type="text"
                      name="quantity"
                       v-model="cart.quantity"
                      autocomplete="off"
                      size="2"
                    /></strong>
                    <span v-if="cart.quantity > 1"><a class="cart_quantity_down" id="qty" @click.prevent="quantityDown(cart.id)">-</a> </span>
                    <span v-else><a class="cart_quantity_down" id="qty">-</a></span>
                  </b>-->
                </td>
                <td class="cart_total">
                  <p class="cart_total_price">
                    ${{ product.price * product.quantity }}
                  </p>
                </td>
                <!-- <td class="invert-closeb">
                  <p>
                  <a @click.prevent="deleteProduct(cart.id,cart.quantity)" href>
                    <button class="btn btn-danger">
                      <span class="glyphicon glyphicon-trash"></span>
                      </button>
                  </a>
                  </p>
                </td>-->
              </tr>

              <tr>
                <td colspan="4">&nbsp;</td>
                <td colspan="2">
                  <table class="table table-condensed total-result">
                    <tr class="shipping-cost">
                      <td>Sub Total</td>
                      <td>$ {{ SubTotal }}</td>
                    </tr>
                    <tr class="shipping-cost">
                      <td>Discount -</td>
                      <td>$ {{ Discount }}</td>
                    </tr>
                    <tr class="shipping-cost">
                      <td>GST (18%) +</td>
                      <td>$ {{ Tax }}</td>
                    </tr>
                    <tr class="shipping-cost">
                      <td>Shipping Cost +</td>
                      <td>0.00</td>
                    </tr>
                    <tr class="shipping-cost">
                      <td>Grand Total</td>
                      <td>
                        <strong>$ {{ GrandTotal }}</strong>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="payment-options">
          <form v-on:submit.prevent="placeOrder">
            <input
              type="hidden"
              name="SubTotal"
              v-model="SubTotal"
              value="SubTotal"
            />
            <input type="hidden" name="Tax" v-model="Tax" value="Tax" />
            <input
              type="hidden"
              name="Discount"
              v-model="Discount"
              value="Discount"
            />
            <input
              type="hidden"
              name="Total"
              v-model="GrandTotal"
              value="GrandTotal"
            />
            <span>
              <label>
                <strong>Select Payment Method:</strong>
              </label>
            </span>
            <span>
              <label for="COD">
                <input
                  type="radio"
                  id="COD"
                  v-model="payment_mode"
                  value="CashOnDelivery"
                />
                <!-- <input type="radio" id="COD" name="payment" v-model="form.payment" :value="CashOnDelivery" /> -->
                <span id="labl">COD</span>
              </label>
            </span>
            <span>
              <label for="Paypal">
                <input
                  type="radio"
                  id="Paypal-mode"
                  v-model="payment_mode"
                  value="Paypal"
                  v-on:click="paymethod"
                />
                <!-- <input type="radio" id="Paypal" name="payment" v-model="form.payment" :value="Paypal" /> -->
                <span id="labl">Paypal</span>
              </label>
            </span>
            <span class="pull-right">
              <a id="pay-btn" href="/" class="btn btn-default">
                <i id="arrow" class="fa fa-angle-left"></i>&nbsp;Continue
                Shopping </a
              >&nbsp;
              <button type="submit" class="btn btn-default" id="place-order">
                Place Order for COD&nbsp;
                <i id="arrow" class="fa fa-angle-right"></i>
              </button>
            </span>
            <br />
          </form>
          <!-- <div>
            <form on:submit.prevent="">
              <span id="pay-now"><center><div ref="paypal"></div></center></span>
            </form>
          </div> -->
        </div>
        <center>
          <!-- <div id="pay-now" type="submit" ref="paypal"></div> -->
          <div id="paypal-button"></div>
        </center>
      </div>
    </section>
    <!--/#cart_items-->
  </div>
</template>

<script>
import Form from "vform";
import Header from "../public/header/header.vue";
import Header1 from "../public/common/header.vue";
export default {
  name: "ReviewOrder",
  components: {
    Header,
    Header1,
  },
  data() {
    return {
      id: [],
      token: axios.defaults.headers.common["Authorization"],
      SubTotal: 0,
      Tax: 0,
      Discount: 0,
      GrandTotal: "",
      coupon: [],
      cartItems: [],
      couponCount: [],
      currentDate: "",
      status: "",
      expiry_date: "",
      today: "",
      billing: "",
      billcountry: "",
      billstate: "",
      billcity: "",
      shipping: [],
      shipcountry: "",
      shipstate: "",
      shipcity: "",
      availableStocks: [],
      boughtProducts: [],
      CashOnDelivery: "",
      Paypal: "",
      payment_mode: "",
      payalDescription: "",
      paypalValue: 0,
      paypalCurrency: "USD",
      form: {},
    };
  },

  computed: {
    myProfile() {
      return this.$store.getters.getProfile;
    },
    // orderReview() {
    //   return this.$store.getters.reviewCart;
    //   this.cartTotal();
    // },

    // cartTotal: function () {

    // }
  },

  mounted() {
    this.$store.dispatch("myProfile");
    // this.$store.dispatch("orderReview");
    //  this.cartTotal();
    if (this.token) {
      axios.get("/api/order-review").then((response) => {
        //  this.cartTotal();
        this.boughtProducts = response.data.reviewCart;
        this.billing = response.data.billing;
        this.billcountry = response.data.billcountry;
        this.billstate = response.data.billstate;
        this.billcity = response.data.billcity;
        this.shipping = response.data.shipping;
        this.shipcountry = response.data.shipcountry;
        this.shipstate = response.data.shipstate;
        this.shipcity = response.data.shipcity;
        this.SubTotal = response.data.cartSubTotal;
        this.Tax = response.data.gst;
        this.Discount = response.data.discount;
        this.GrandTotal = response.data.cartTotal;
        this.cartItems = response.data.cartItems;
      });
    }
    /**
     *
     */
    $("#Paypal-mode").on("change",function() {
      $("#place-order").hide()
      // $("#paypal-button").show()

    });
    $("#COD").on("change",function() {
      $("#place-order").show()
      // $("#paypal-button").hide()
    });
    /** */
  },
  created() {
    // EventsList.$on("ProductPurchased", PPEventReceived);
  },
  methods: {
    // PPEventReceived: function(product) {
    //   this.boughtProducts.push(product);
    //   this.payalDescription = this.payalDescription + "<li>"+product.product_name+"&nbps;"+product.quantity+"&nbsp;"+product.ptice+"</li>";
    // },
    /**
     *
     */
    placeOrder () {
      if (this.token) {
        if (this.payment_mode) {
          // this.form.post('/api/place-order', {Total: this.Total}).then(() => {})
          axios
            .post("/api/cod-order", {
              SubTotal: this.SubTotal,
              Tax: this.Tax,
              Discount: this.Discount,
              GrandTotal: this.GrandTotal,
              payment_mode: this.payment_mode,
            })
            .then(() => {
              if (this.payment_mode == "CashOnDelivery") {
                this.$router.push({ name: "Thanks" });
                Swal.fire({
                  title: "Congratulation!",
                  text: "Your COD Order Has Been Placed Successfully..!",
                  icon: "success",

                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  // cancelButtonColor: "#d33",
                  confirmButtonText: "Ok",
                }).then((result) => {
                  if (result.value) {
                    axios
                      .post("/api/thanks/")
                      .then(() => {})
                      .catch(() => {});
                  }
                });
              } else {
                this.$router.push({ name: "Paypal" });
                Swal.fire({
                  title: "Congratulation!",
                  text: "Your Order Has Been Placed Successfully..!",
                  icon: "success",

                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  // cancelButtonColor: "#d33",
                  confirmButtonText: "Ok",
                }).then((result) => {
                  if (result.value) {
                    // axios
                    //   .post("/api/paypal/")
                    //   .then(() => {})
                    //   .catch(() => {});
                    // this.paypalScriptLoad()
                  }
                });
              }
            });
        } else {
          Toast.fire({
            icon: "error",
            title: "Please Select any payment method!",
          });
        }
        //token end
      }
      //place-order end
    },
    /**
     * Execute paypal script to load button
    */
    paymethod: function () {
      if (this.token) {
        // const ClientID = "AdPjlYVHhNaucvd-GuZlXFhpIyCwExD5DvmMoh_JAtLZmOnBQYu9FE8zcbEgW4GDBAw89McTC8bvcbNq";
        var script = document.createElement("script");
        // script.src = `https://www.paypal.com/sdk/js?client-id=${ClientID}`;
        script.src = "https://www.paypalobjects.com/api/checkout.js";
        script.addEventListener("load", this.setLoaded);
        document.body.appendChild(script);
      }
    },

    setLoaded: function () {
      this.loaded = true;
      // window.paypal.Buttons({
      paypal.Button.render ({
          env: "sandbox",
          // locale: "en_US",
          style: {
            size: "large",
            layout: "vertical",
            size: "responsive",
            color: "gold",
            shape: "pill",
            label: "pay",
          },
          commit: true,
            // Set up the payment:
            // 1. Add a payment callback

            payment: function(data, actions) {
             // 2. Make a request to your server
              return new Promise((resolve, reject) => {
               axios.post('/api/paypal/create-payment').then(res => {
                        // 3. Return res.id from the response
                        console.log(res);
                          resolve(res.data.id)
                      })
                      .catch(error => {
                          reject(error)
                      })
              })
              /** ====== */
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // const order = actions.order.capture(details);
                // 2. Make a request to your server
                return new Promise((resolve, reject) => {
                    axios.post('/api/paypal/execute-payment',  { payment_id: data.paymentID, orderID: data.orderID, payer_id:   data.payerID }, {
                            // headers: { 'Authorization': 'Bearer ' + this.token }                          
                        }).then(res => {                           
                            //3. Show the buyer a confirmation message.
                            axios.post('/api/paypal-order', { data,payment_id: data.paymentID, orderID: data.orderID, payer_id:   data.payerID }).then(res=>{
                              // location.href = 'http://localhost:8000/user/payment-status';
                                // this.$router.push({ name: 'Paypal Status' });
                                Swal.fire({
                                    title: "Congratulation!",
                                    text: "Your Order Has Been Placed Successfully..!",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    // cancelButtonColor: "#d33",
                                    confirmButtonText: "Ok",
                                  }).then((result) => {
                                    if (result.value) {
                                      location.href = 'http://localhost:8000/user/payment-status';
                                      axios
                                        .post("/api/payment-status")
                                        .then(res => {
                                          
                                        })
                                        .catch(() => {});
                                      // this.paypalScriptLoad()
                                    }
                                });                                 
                            });
                            
                            // console.log(res)
                            resolve(res)
                        }).catch(error => {
                            reject(error)
                        })
                })
                /** ====== */
            }
        }, "#paypal-button")
        // .render(this.$refs.paypal);
    },
  },

};
</script>

<style scoped>
#arrow {
  font-size: 24px;
}
#details {
  margin-left: 25px;
}
#b {
  font-size: 18px;
  /* color: #bbbbb5; */
}
strong {
  font-size: 20px;
  color: #fe980f;
}
/** Cart table */
img {
  width: 70px !important;
}
#labl {
  margin-top: -25px;
}
.total-result {
  font-size: 18px;
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
#place-order {
  background: #fe980f;
  border: medium none;
  border-radius: 0;
  color: #ffffff;
  cursor: pointer;
  font-family: "Roboto", sans-serif;
  padding: 6px 25px;
  font-size: 16px;
}
#place-order:hover {
  background: hsl(0, 3%, 94%);
  color: #000;
}
#COD {
  min-width: 22px;
  min-height: 22px;
  line-height: 22px;
  cursor: pointer;
  /* margin-top: 23px; */
}
#Paypal-mode {
  min-width: 22px;
  min-height: 22px;
  line-height: 22px;
  cursor: pointer;
  /* margin-top: 23px; */
}
#labl {
  font-size: 20px;
  margin-top: -20px;
}
</style>