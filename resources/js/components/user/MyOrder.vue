import Form from "vform";
<template>
  <div>
    <Header :username="myProfile.name"/>
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>My Order</h3>
      </div>
    </div>
    <br />
    <!--===============================================================================================-->

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="container">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <!--
          <div class="col-sm-6">
            <h1>Profile</h1>
              </div>-->
              <div class="col-sm-12">
                <ol id="breadcrumb" class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">
                    <i class="fa fa-home"></i>&nbsp;
                    <a href="/">Home</a>
                  </li>&nbsp; <i class="fa fa-angle-right"></i>
                  <li class="breadcrumb-item"><a href="/profile">User Profile</a></li>&nbsp;
                  <i class="fa fa-angle-right"></i>
                  <li class="breadcrumb-item active">My Order</li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>
      </div>
      <div class="container">
        <section class="content">
          <div class="container-fluid">
            <div class="row">

                <!-- Part UserBar -->
                <Usersidebar :id="myProfile.id" :username="myProfile.name" :image="myProfile.image" :email="myProfile.email" :orderCount="this.count" /> 
                <!-- //.Part UserBar -->

              <!--    <div class="col-md-9">  -->
              <div class="card">
                <div class="category-tab">
                  <ul class="nav nav-tabs">
                    <li>
                      <router-link :to="{ name: 'dashboard' }" data-toggle="tab">Profile Setting</router-link>
                    </li>
                    <li>
                      <router-link :to="{ name: 'changepassword' }" data-toggle="tab">Change Password</router-link>
                    </li>
                    <li class="active">
                      <router-link :to="{ name: 'myorder' }" data-toggle="tab">My Order</router-link>
                    </li>
                    <li>
                      <router-link :to="{ name: 'mywishlist' }" data-toggle="tab">My Wishlist</router-link>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <div class="tab-content">

                    <!-- /.tab-pane -->

                   <!-- Change Password -->

                    <!-- /.tab-pane -->

                    <!-- My Order Details -->
                    <div class="tab-pane active" id="order">
                      <div class="row">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Order</th>
                            <!-- <th>Product</th> -->
                            <!-- <th>Payment Mode</th> -->
                            <th>Grand Total</th>
                            <th>Order's date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(order, index) in orders" :key="order.id">
                            <td>#{{index + 1}}</td>
                            <!-- <td></td> -->                            
                            <!-- <td>{{order.payment_mode}}</td>                            -->
                            <td>{{order.grandTotal | toCurrency}}</td>
                            <td>{{order.created_at | myDate}}</td>
                            <td><router-link :to="`/user/order-details/${order.id}`">Order Details</router-link></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Order</th>
                            <!-- <th>Product</th> -->
                            <!-- <th>Payment Mode</th> -->
                            <th>Grand Total</th>
                            <th>Order's date</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                      </div>
                    </div>
                    <!-- /.tab-pane -->

                     <!-- My Wishlist -->

                    <!-- /.tab-pane -->
                  </div>
                </div>
              </div>
              <!--  </div> -->
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Header from "../public/header/header.vue";
import Usersidebar from './UserSidebar.vue';
export default {
  name: "Profile",
  components: {
    Header,
    Usersidebar
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      isLoading: true,
      events: [],
      orders: [],
      count: 0,
      // payments: [],
      form: new Form({})      
    };
  },


  computed: {
    myProfile() {
      return this.$store.getters.getProfile
    }
  },
  mounted() {
    this.$store.dispatch("myProfile")
    if(this.token) {
      axios.get('/api/orders').then((response) => {
        this.count = response.data.orderCount;
        this.orders = response.data.order;
        // this.payments = response.data.payment
      })
    }
  },

};
</script>

<style>
.box-profile {
  margin-top: 10px;
/*  margin-bottom: 5px; */
}
.name {
  margin-top: 30px;
  margin-bottom: 10px;
}

.text-muted {
  color: #6c757d !important;
}

p {
  margin-top: 0;
  margin-bottom: 30px;
}

.profile-username {
  font-size: 21px;
  margin-top: 5px;
}

.img-circle {
  border-radius: 50%;
}

.profile-user-img {
  border: 3px solid #adb5bd;
  margin: 0 auto;
  padding: 3px;
  width: 100px;
}

.img-fluid {
  max-width: 100%;
  height: auto;
}

img {
  vertical-align: middle;
  border-style: none;
}

/** ================================== */
.card-primary.card-outline {
  border-top: 3px solid #007bff;
  border-top-width: 3px;
  border-top-style: solid;
  border-top-color: rgb(0, 123, 255);
}

.card {
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
  margin-bottom: 1rem;
}

.card {
  position: relative;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  justify-content: center;
  padding: 1.25rem;
}

.card-header:first-child {
  border-radius: calc(0.25rem - 0) calc(0.25rem - 0) 0 0;
}

.card-header {
  background-color: transparent;
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  padding: 0.75rem 1.25rem;
  position: relative;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}
.p-2 {
  padding: 0.5rem !important;
}
.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgba(0, 0, 0, 0.03);
  border-bottom: 0 solid rgba(0, 0, 0, 0.125);
}

.card-body {
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1.25rem;
}

*,
::after,
::before {
  box-sizing: border-box;
}

div {
  display: block;
}
.text-center {
  text-align: center !important;
}

.list-group {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  padding-left: 0;
  margin-bottom: 0;
}

dl,
ol,
ul {
  margin-top: 0;
  margin-bottom: 1rem;
}

*,
::after,
::before {
  box-sizing: border-box;
}
/*
ul {
  display: block;
  list-style-type: disc;
  margin-block-start: 1em;
  margin-block-end: 1em;
  margin-inline-start: 0px;
  margin-inline-end: 0px;
  padding-inline-start: 40px;
}
*/
.list-group-unbordered > .list-group-item {
  border-left: 0;
  border-radius: 0;
  border-right: 0;
  padding-left: 0;
  padding-right: 0;
}
.list-group-item:first-child {
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}
.list-group-item {
  position: relative;
  display: block;
  padding: 15px 10px;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.125);
}

*,
::after,
::before {
  box-sizing: border-box;
}
li {
  display: list-item;
  text-align: -webkit-match-parent;
}

a:not([href]) {
  color: inherit;
  text-decoration: none;
}

.float-right {
  float: right !important;
}
a {
  color: #007bff;
  text-decoration: none;
  background-color: transparent;
}
</style>