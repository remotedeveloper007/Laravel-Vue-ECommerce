import Form from "vform";
<template>
  <div>
    <Header :username="myProfile.name" />
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>User Profile</h3>
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
                  <li class="breadcrumb-item active">Change Password</li>
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
              <Usersidebar
                :id="myProfile.id"
                :username="myProfile.name"
                :image="myProfile.image"
                :email="myProfile.email"
                 :orderCount="this.count" 
              />
              <!-- //.Part UserBar -->

              <!--    <div class="col-md-9">  -->
              <div class="card">
                <div class="category-tab">
                  <ul class="nav nav-tabs">
                    <li>
                      <router-link :to="{ name: 'dashboard' }" data-toggle="tab">Profile Setting</router-link>
                    </li>
                    <li class="active">
                      <router-link
                        :to="{ name: 'changepassword' }"
                        data-toggle="tab"
                      >Change Password</router-link>
                    </li>
                    <li>
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
                    <div class="tab-pane active" id="password">
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <center>
                            <h4>Change Password</h4>
                          </center>
                          <div class="signup-form">
                            <form @submit.prevent="updatePassword">
                              <div class="form-group field">
                                <label
                                  for="password"
                                  class="col-sm-4 control-label"
                                >Current Password</label>
                                <div class="col-sm-8">
                                  <input
                                    type="password"
                                    name="current_password"
                                    v-model="form.current_password"
                                    placeholder="Current Password"
                                  />
                                  <!-- <span class="help is-danger" v-text="errors.get('current_password')"></span> -->
                                </div>                               
                                <!-- <has-error id="error" :form="form" field="current_password" class="invalid-feedback" role="alert"></has-error> -->
                              </div>
                              <div class="form-group field">
                                <label for="password" class="col-sm-4 control-label">New Password</label>
                                <div class="col-sm-8">
                                  <input
                                    id="password"
                                    type="password"
                                    name="new_password"
                                    class="form-control"
                                    v-model="form.new_password"
                                    placeholder="New Password"
                                  />
                                  <!-- <span class="help is-danger" v-text="errors.get('new_password')"></span> -->
                                </div>                                
                                <!-- <has-error :form="form" field="new_password" id="error"></has-error> -->
                              </div>
                              <div class="form-group field">
                                <label
                                  for="password"
                                  class="col-sm-4 control-label"
                                >Confirm Password</label>
                                <div class="col-sm-8">
                                  <input
                                    type="password"
                                    name="password_confirmation"
                                    v-model="form.password_confirmation"
                                    placeholder="Confirm Password"             
                                  />
                                  <!-- <span class="help is-danger" v-text="errors.get('password_confirmation')"></span> -->
                                  <!-- <has-error :form="form" field="password_confirmation" id="error"></has-error> -->
                                </div>                              
                                <!-- <has-error id="error" :form="form" field="password_confirmation"></has-error> -->
                              </div>
                              <center>
                                <button type="submit" class="btn btn-default">Change Password</button>
                              </center>
                            </form>
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->

                    <!-- My Order Details -->

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
import Form from "vform";
// import axios from "axios";
import Header from "../public/header/header.vue";
import Usersidebar from "./UserSidebar.vue";
export default {
  name: "ChangePassword",
  components: {
    Header,
    Usersidebar,
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      errors: {},
      count: [],
      // error: true,
      current_password: "",
      new_password: "",
      password_confirmation: "",
      form: new Form({
        current_password: "",
        new_password: "",
        password_confirmation: "",
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

    $(document).ready(function () {
      $( "has-error" ).fadeOut( "slow" );
    });

    if(this.token) {
      axios.get('/api/orders').then((response) => {
        this.count = response.data.orderCount;
      })
    }    
  },

  methods: {

    // CurrentPwd() {
    //   if (this.token) {
    //     axios
    //       .post("/api/current-password", {
    //         current_password: this.current_password,
    //       })
    //       .then((response) => {
    //         //  console.log(response.data)
    //       });
    //   }
    // },

    updatePassword() {
       if (this.token) {
        this.form
          .post(`/api/update-password/${this.$route.params.id}`)
          .then((response) => {
              Toast.fire({
                icon: "success",
                title: "Password updated Successfully!"
              });
              this.form.reset();
          })
          .catch(error => {
            // console.log(error.response.data)
            if(error.response.data) {
              $("#error").fadeOut(8000)
            }          
          })
       }
    },
  },

  // created() {
    // , {
    //       current_password: this.current_password,
    //       new_password: this.new_password,
    //       password_confirmation: this.password_confirmation,          
    //     }
  //   // this.$store.dispatch("myProfile");
  //   axios.get('/api/myAccount').then((response) => {
  //     this.events = response.data.authUser
  //     this.isLoading = false
  //   })
  // }
};
</script>

<style>
#error{
  margin-left: 190px;
  color: red;
}
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