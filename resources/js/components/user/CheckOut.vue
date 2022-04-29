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
        <h3>Check Out</h3>
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
            <li class="active">Check out</li>
          </ol>
        </div>-->
        <!--/breadcrums-->

        <!--/register-req-->
        <div class="shopper-informations">
          <!-- <div class="login-form"> -->
          <div class="row">
            <form @submit.prevent="checkout">
              <div id="billaddress" class="col-sm-6">
                <div class="shopper-info">
                  <p>Bill To</p>
                  <form @submit.prevent="checkout">
                    <input type="text" name="name" v-model="form.name" placeholder="Billing Name" :class="{ 'is-invalid': form.errors.has('address') }" />
                    <has-error id="bname" :form="form" field="name" class="invalid-feedback" role="alert"></has-error>
                    <input
                      type="text"
                      name="address"
                      v-model="form.address"
                      placeholder="Billing Address"
                      :class="{ 'is-invalid': form.errors.has('address') }"
                    />
                    <has-error id="baddress" :form="form" field="address" class="invalid-feedback" role="alert"></has-error>

                    <select name="country_id" v-model="form.country_id" @change="getState()" :class="{ 'is-invalid': form.errors.has('country_id') }">
                      <option value disabled>-- Country --</option>
                      <option
                        v-for="country in countries"
                        :key="country.id"
                        :value="country.id"
                      >{{ country.name }} &nbsp; [{{country.sortname}}]</option>
                    </select>
                    <has-error id="bcid" :form="form" field="country_id" class="invalid-feedback" role="alert"></has-error>
                    <!-- //Coutry -->
                    <select name="state_id" v-model="form.state_id" @change="getCity()" :class="{ 'is-invalid': form.errors.has('state_id') }">
                      <option value disabled>-- State / Province / Region --</option>
                      <option
                        v-for="state in states"
                        :key="state.id"
                        :value="state.id"
                      >{{ state.name }}</option>
                    </select>
                    <has-error id="bsid" :form="form" field="state" class="invalid-feedback" role="alert"></has-error>
                    <!-- //State -->
                    <select name="city_id" v-model="form.city_id" :class="{ 'is-invalid': form.errors.has('city_id') }">
                      <option value disabled>-- City --</option>
                      <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                    </select>
                    <has-error id="bcity" :form="form" field="city" class="invalid-feedback" role="alert"></has-error>
                    <!-- //City -->
                    <input
                      type="text"
                      name="pincode"
                      v-model="form.pincode"
                      placeholder="Zip / Postal Code *"
                      :class="{ 'is-invalid': form.errors.has('pincode') }"
                    /> 
                    <has-error id="bzip" :form="form" field="pincode" class="invalid-feedback" role="alert"></has-error>                   
                    <input type="text" name="phone" v-model="form.phone" placeholder="Mobile Phone" :class="{ 'is-invalid': form.errors.has('phone') }" />
                    <has-error id="bphone" :form="form" field="phone" class="invalid-feedback" role="alert"></has-error>
                    <div>
                      <input id="billadd" name="ship_to_bill" v-model="form.ship_to_bill" type="checkbox" value="1" />
                      <label id="shipadd">Shipping to bill address</label>
                      <button id="bill" class="btn btn-primary pull-right" type="submit">Continue</button>
                    </div>
                  </form>
                </div>
              </div>
              <div id="ship" class="col-sm-6">
                <div class="shopper-info">
                  <p>Shipping Information</p>
                  <form>
                    <input
                      type="text"
                      name="shipping_name"
                      v-model="form.shipping_name"
                      placeholder="Shipping Name"
                      :class="{ 'is-invalid': form.errors.has('shipping_name') }"
                    />
                    <has-error id="sname" :form="form" field="shipping_name" class="invalid-feedback" role="alert"></has-error>
                    <!-- //Shipping_name -->
                    <input
                      type="text"
                      name="shipping_address"
                      v-model="form.shipping_address"
                      placeholder="Shipping Address"
                      :class="{ 'is-invalid': form.errors.has('shipping_address') }"
                    />
                    <has-error id="saddress" :form="form" field="shipping_address" class="invalid-feedback" role="alert"></has-error>
                    <!-- //Shipping_address -->
                    <select
                      name="shipping_country_id"
                      v-model="form.shipping_country_id"
                      @change="getShippingState()"
                      :class="{ 'is-invalid': form.errors.has('shipping_country_id') }"
                    >
                      <option disabled value>-- Country --</option>
                      <option
                        v-for="country in countries"
                        :key="country.id"
                        :value="country.id"
                      >{{ country.name }} &nbsp; [{{country.sortname}}]</option>
                    </select>
                    <has-error id="scid" :form="form" field="shipping_country_id" class="invalid-feedback" role="alert"></has-error>
                    <!-- //Coutry -->
                    <select
                      name="shipping_state_id"
                      v-model="form.shipping_state_id"
                      @change="getShippingCity()"
                      :class="{ 'is-invalid': form.errors.has('shipping_state_id') }"
                    >
                      <option value="">-- State / Province / Region --</option>
                      <option
                        v-for="state in shppingState"
                        :key="state.id"
                        :value="state.id"
                      >{{ state.name }}</option>
                    </select>
                    <has-error id="ssid" :form="form" field="shipping_state_id" class="invalid-feedback" role="alert"></has-error>
                    <!-- //Shipping_state_id -->
                    <select name="shipping_city_id" v-model="form.shipping_city_id" :class="{ 'is-invalid': form.errors.has('shipping_city_id') }">
                      <option value="">-- City --</option>
                      <option v-for="city in shippingCity" :key="city.id" :value="city.id">{{ city.name }}</option>
                    </select>
                    <has-error id="scity" :form="form" field="shipping_city_id" class="invalid-feedback" role="alert"></has-error>
                       <!-- //Shipping_city_id -->
                     <input
                      type="text"
                      name="shipping_pincode"
                      v-model="form.shipping_pincode"
                      placeholder="Zip / Postal Code *"
                      :class="{ 'is-invalid': form.errors.has('shipping_pincode') }"
                    />
                    <has-error id="szip" :form="form" field="shipping_pincode" class="invalid-feedback" role="alert"></has-error> 
                     <!-- //Shipping_pincode -->                 
                    <input
                      type="text"
                      name="shipping_phone"
                      v-model="form.shipping_phone"
                      placeholder="Mobile Phone"
                      :class="{ 'is-invalid': form.errors.has('shipping_phone') }"
                    />
                    <has-error id="sphone" :form="form" field="shipping_phone" class="invalid-feedback" role="alert"></has-error>
                     <!-- //Shipping_phone -->
                  </form>
                </div>
                <div>
                  <button class="signup-form btn btn-primary" type="submit">Continue</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /#cart_items -->
  </div>
</template>

<script>
import Form from "vform";
import Header from "../public/header/header.vue";
import Header1 from "../public/common/header.vue";
export default {
  name: "CheckOut",
  components: {
    Header,
    Header1
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      form: new Form({
          name: "",
          address: "",
          pincode: "",
          country_id: "",
          state_id: "",
          city_id: "",
          phone: "",
          ship_to_bill: "",
          shipping_name: '',
          shipping_address: '',
          shipping_city_id: '',
          shipping_pincode: '',
          shipping_state_id: '',
          shipping_country_id: '',
          shipping_phone: '',        
      }),
    };
  },

  computed: {
    myProfile() {
      return this.$store.getters.getProfile;
    },
    countries() {
      return this.$store.getters.getCountry;
    },
    states() {
      return this.$store.getters.getState;
    },
    cities() {
      return this.$store.getters.getCity;
    },
    shppingState() {
      return this.$store.getters.shipInState;
    },
    shippingCity() {
      return this.$store.getters.shipInCity
    }
  },

  mounted() {
    /**
     *
     */
    if (this.token) {
      axios.get("/api/check-out").then((response) => {
        this.form.fill(response.data.userDetails);
      });
    }
    this.$store.dispatch("myProfile");
    this.$store.dispatch("allCountries");
    this.$store.dispatch("allStates");
    this.$store.dispatch("allCities");
    this.$store.dispatch('stateToship');
    this.$store.dispatch('cityToship')

    /**
     *
     */
    $(document).ready(function () {
      $("#bill").hide();
      $("#billadd").click(function () {
        if (this.checked) {
          $("#ship").hide();
          $("#bill").show();
          $("#billaddress").css("margin-left", "280px");
        } else {
          $("#ship").show();
          $("#bill").hide();
          $("#billaddress").css("margin-left", "");
        }
      });
    });
  },

  methods: {
    getState() {
      this.$store.dispatch("allStates", this.form.country_id);
    },

    getCity() {
      this.$store.dispatch("allCities", this.form.state_id);
    },
    getShippingState() {
      this.$store.dispatch('stateToship', this.form.shipping_country_id)
    },

    getShippingCity() {
      this.$store.dispatch('cityToship', this.form.shipping_state_id)
    },

    checkout() {
      if (this.token) {
        this.form.post("/api/check-out", this.shipping).then((response) => {
              Toast.fire({
                icon: "success",
                title: "Shiping detils saved Successfully!"
              });
              this.$router.push({ name: 'Review Order'});          
        })
        .catch(error => {
            if(error.response.data) {
              $("#bname").fadeOut(10000)
              $("#baddress").fadeOut(10000)
              $("#bcid").fadeOut(10000)
              $("#bsid").fadeOut(10000)
              $("#bcity").fadeOut(10000)
              $("#bzip").fadeOut(10000)
              $("#bphone").fadeOut(10000)             
              $("#sname").fadeOut(10000)
              $("#saddress").fadeOut(10000)
              $("#scid").fadeOut(10000)
              $("#ssid").fadeOut(10000)
              $("#scity").fadeOut(10000)
              $("#szip").fadeOut(10000)
              $("#sphone").fadeOut(10000)
            }
        })
      }
    },
  },
};
</script>

<style scoped>
.invalid-feedback{
  color: red;
}
#billadd {
  min-width: 18px;
  min-height: 18px;
  line-height: 18px;
  cursor: pointer;
  margin-top: 15px;
  /* margin-right: 10px; */
  /* float: left; */
  /* position: relative; */
}

/* #shipadd{ float: left;} */
</style>