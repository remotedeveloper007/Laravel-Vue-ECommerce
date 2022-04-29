import Form from 'vform';
<template>
  <div>
    <span v-if="token">
      <Header :username="myProfile.name" />
    </span>
    <span v-else>
      <Header1/>
    </span>
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>Shopping Cart</h3>
      </div>
    </div>
    <br />

    <form enctype="multipart/form-data">
      <section id="cart_items">
        <div class="container">
          <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li>
                <a href="/">Home</a>
              </li>
              <li class="active">Shopping Cart</li>
            </ol>
          </div>
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
                  <td>Remove</td>
                </tr>
              </thead>
              <tbody>
              
                <tr v-show="!getCart.length">
                  <td colspan="7">
                  <i><h3 id="mt">Your cart is empty!</h3></i>
                  <a id="pay-btn" href="/" class="btn btn-default"><i id="arrow" class="fa fa-angle-left"></i>&nbsp;Continue Shopping</a>&nbsp;
                  </td>
                </tr>           
                <tr v-for="cart in getCart" :key="cart.id">
                  <td class="cart_product">
                    <img :src="`/product_image/${cart.image}`" alt />
                  </td>
                  <td class="cart_description">
                    <h4>{{cart.product_name}}</h4>
                    <p>Web ID: {{cart.product_code}}</p>
                  </td>
                  <td><p>{{cart.size}}</p></td>
                  <td class="cart_price">
                    <p>${{ cart.price }}</p>
                  </td>
                  <td class="cart_quantity">
                    <div class="cart_quantity_button qty-btn">
                      <div class="cart_quantity_input" id="quantity">
                          <a
                            id="qty"
                            @click.prevent="quantityUp(cart.id)"
                          >+</a>
                          <!--	 <form class="form-horizontal" id="my-form" v-on:submit.prevent="quantityUp()">	-->
                          <input
                            class="cart_quantity_input"
                            type="text"
                            name="quantity"
                            v-model="cart.quantity"
                            autocomplete="off"
                            size="3"
                          />
                          <!--		</form>  -->
                      </div>
                      <span v-if="cart.quantity > 1">
                        <a
                          id="qty"
                          @click.prevent="quantityDown(cart.id)"
                        >-</a>
                      </span>
                      <a v-else class="cart_quantity_down" id="qty">-</a>
                    </div>
                  </td>
                  <td class="cart_total">
                    <p class="cart_total_price">${{cart.price * cart.quantity}}</p>
                  </td>
                  <td class="invert-closeb">
                    <p class="rem">
                      <!-- <button id="rem" type="submit" class="cart_quantity_button">update</button> -->
                      <a @click.prevent="deleteProduct(cart.id,cart.quantity)">
                        <button
                          class="btn btn-danger"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Delete Cart Product"
                        >
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </a>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
      <!--/#cart_items-->

      <section id="do_action">
        <div class="container">
          <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="chose_area">
                <div id="choose" class="user_option">

                  <div class="form-group row">
                      <form v-on:submit.prevent="applyCoupon()">
                        <!-- <input type="hidden" name="_token" :value="csrf" /> -->                     
                      <input id="checkbox" type="checkbox" />
                      <label id="label">Use Coupon Code</label>
                      <input
                        type="text"
                        id="coupon"
                        name="coupon_code"
                        v-model="form.coupon_code"
                        class="form-control"
                        placeholder="Enter Coupon Code"
                      />
                      <button type="submit" class="btn btn-default update" id="apply">Apply Coupon</button></form>
                  </div>
                  
                  <div class="form-group row">
                      <input id="check" type="checkbox" />
                      <label id="label">Use Gift Voucher</label>
                  </div>
                  <div class="form-group row">
                    <input id="check" type="checkbox" />
                    <label id="label">Estimate Shipping & Taxes</label>
                  </div>
                </div>
                <hr />
                <ul class="user_info">
                  <li class="single_field">
                    <label>Country:</label>
                    <select>
                      <option>Select</option>
                      <option>United States</option>
                      <option>Bangladesh</option>
                      <option>UK</option>
                      <option>India</option>
                      <option>Pakistan</option>
                      <option>Ucrane</option>
                      <option>Canada</option>
                      <option>Dubai</option>
                    </select>
                  </li>
                  <li class="single_field">
                    <label>Region / State:</label>
                    <select>
                      <option>Select</option>
                      <option>Dhaka</option>
                      <option>London</option>
                      <option>Dillih</option>
                      <option>Lahore</option>
                      <option>Alaska</option>
                      <option>Canada</option>
                      <option>Dubai</option>
                    </select>
                  </li>
                  <li class="single_field zip-field">
                    <label>Zip Code:</label>
                    <input type="text" name="zip" id="zip" class="form-control" />
                  </li>
                </ul>
                <a class="btn btn-default update" href>Get Quotes</a>
                <a class="btn btn-default check_out" href="/">Continue</a>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="total_area">
                <ul>
                  <li class="total">
                    Sub Total
                    <span>$ {{SubTotal}}</span>
                  </li>
                  <li class="total">
                    GST (18%)
                    <span>$ {{Tax}}</span>
                  </li>
                  <li class="total">
                    Shipping Cost
                    <span>Free</span>
                  </li>
                  <li class="total">
                    Discount Amount ( - )
                    <span>$ {{Discount}}</span>
                  </li>                  
                  <li class="total">
                    Total
                    <span id="gross">$ {{Total}}</span>
                  </li>
                </ul>
                <router-link class="btn btn-default update" type="submit" :to="{ name: 'Home' }">Continue Shopping</router-link>
                <router-link class="btn btn-default check_out" :to="{ name: 'checkout' }">Check Out</router-link>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
    <!--/#do_action-->
  </div>
</template>

<script>
import Form from "vform";
import Header from "../header/header.vue";
import Header1 from "../common/header.vue";
export default {
  name: "Cart",
  components: {
    Header,
    Header1
  },
  data() {
    return {
      id: [],
      token: axios.defaults.headers.common["Authorization"],
      csrf: "",
      SubTotal: 0,
      Tax: 0,
      Discount: 0,
      Total: 0,
      coupon: [],
      cartItems: [], 
      couponCount: [],
      currentDate: "",
      status: "",
      expiry_date: "",
      today: "",
      errors: {},
      form: new Form({
        id: [],
        // csrf: document
        //   .querySelector('meta[name="csrf-token"]')
        //   .getAttribute("content"),
        quantity: [],
        // SubTotal: 0,
        // Tax: 0,
        // Total: "",
        coupon_code: "",
      }),
      availableStocks: [],
    };
  },
  computed: {
    getCart() {
      return this.$store.getters.getCart;
      this.cartTotal();
    },
    myProfile() {
      return this.$store.getters.getProfile;
    },
  },
  mounted() {
    this.$store.dispatch("myProfile");
    this.$store.dispatch("fetchCart");
    this.cartTotal();

    $("#checkbox").change(function () {
      if ($(this).is(":checked")) {
        // its chacked
        $("#coupon").show();
        $("#apply").show();
      } else {
        //its not checked
        $("#coupon").hide();
        $("#apply").hide();
      }
    });
  },

  methods: {
    cartTotal() {
      axios.get("/api/cart-amount").then((response) => {
        this.$store.dispatch("fetchCart");
        this.SubTotal = response.data.cartSubTotal;
        this.Tax = response.data.gst;
        this.Discount = response.data.discount
        this.Total = response.data.cartTotal;
        this.cartItems = response.data.cartItems;
      });
    },

    applyCoupon() {
      this.form
        .post("/api/cart-amount")
        .then((response) => {
          this.couponCount = response.data.couponCount;
          this.status = response.data.status;
          this.expiry_date = response.data.error;
          this.SubTotal = response.data.cartSubTotal;
          this.Tax = response.data.gst;
          this.Discount = response.data.discount
          this.Total = response.data.cartTotal;

          // To check if Coupon is Active or Not
          if (this.couponCount == 0) {
            this.cartTotal();
            Toast.fire({
              icon: "error",
              title: "Coupon does not exist!",
            });
          } else if (this.status == 0) {
            this.cartTotal();
            Toast.fire({
              icon: "warning",
              title: "Coupon is not Active!",
            });
          } else if (this.expiry_date == "Coupon is expired") {
            this.cartTotal();
            Toast.fire({
              icon: "error",
              title: "Coupon is not valid!",
            });
          } else {
            // this. cartTotal();
            this.$store.dispatch("fetchCart");
            this.SubTotal = response.data.cartSubTotal;
            this.Tax = response.data.gst;
            this.Total = response.data.cartTotal;
            Toast.fire({
              icon: "success",
              title: "Coupon Discount Applied Successfully!",
            });
          }
        })
        .catch(() => {});
    },

    quantityUp(id) {
      axios.get("/api/quantity-increment/" + id).then((response) => {
        this.availableStocks = response.data.availableStocks;
        /**
         * CartTotal() method call here to track the quantity
         * and change amount accordingly
         */

        this.cartTotal();
        this.$store.dispatch("fetchCart");
        Toast.fire({
          icon: "success",
          title: "Cart Quantity Updated Successfully",
        });

        if (this.availableStocks == 0) {
          this.$store.dispatch("fetchCart");
          Toast.fire({
            icon: "warning",
            title: "No More Quantity Available In Stock",
          });
        }
      });
    },

    quantityDown(id) {
      axios.get("/api/quantity-decrement/" + id).then((response) => {
        /**
         * CartTotal() method call here to track the quantity
         * and change amount accordingly
         */

        this.cartTotal();
        this.$store.dispatch("fetchCart");
        Toast.fire({
          icon: "success",
          title: "Cart Quantity Updated Successfully",
        });
      });
    },

    deleteProduct(id, quantity) {
      
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/delete-product/" + id + "/" + quantity)
            .then((response) => {
              /**
               * CartTotal() method call here to track the quantity
               * and change amount accordingly
               */

              this.cartTotal();

              this.$store.dispatch("fetchCart");
              Swal.fire(
                "Deleted!",
                "One Product from Cart has been deleted.",
                "success"
              );
            })
            .catch(() => {});
        } else {
          Swal.fire("Cancelled!", "Product is safe.", "error");
          this.$store.dispatch("fetchCart");
        }
      });

    },
  },
  // created() {
  //   this.$root.$refs.cartTotal = this;
  // },
};
</script>

<style scoped>
#mt{
  margin-left: 500px;
}
#pay-btn{
    background: #FE980F;
    border: medium none;
    border-radius: 0;
    color: #FFFFFF;
    cursor: pointer;
    font-family: 'Roboto', sans-serif;
    padding: 6px 25px;
    font-size: 16px;
    margin-left: 500px;
}
#pay-btn:hover{
  background: hsl(0, 3%, 94%);
  color: #000;
}
/* .cart_quantity_button {
    padding-left: 50px;
  } */
.qty-btn{
  margin-top: -20px;
}
#size {
  width: 40px;
}

#rem {
  cursor: pointer;
}
/* #name {
	  width: auto;
  } */
img {
  width: 70px !important;
}
#qty {
  font-size: 22px;
  font-weight: bolder;
  cursor: pointer;
  background-color: #f0f0e9;
}
#quantity {
  font-size: 20px;
}

.total {
  font-size: 18px;
}
#gross {
  color: #fe980f;
  font-size: 20px;
  font-weight: bold;
}
#checkbox {
  margin-left: 55px;
  float: left !important;
}
#check {
  margin-left: 55px;
  float: left !important;
}
#label {
  float: left !important;
  margin-top: 2px;
}
#coupon {
  width: 150px;
  float: left;
  margin-left: 20px;
  margin-top: -10px;
  display: none;
  box-shadow: 3px #000;
}
#choose {
  margin-top: 16px;
}
#zip {
  height: 28px;
}
#apply {
  margin-top: -7px;
  display: none;
}
</style>