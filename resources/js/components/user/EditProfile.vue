import Form from "vform";
<template>
  <div>
    <Header :username="myProfile.name"/>
    <!--===============================================================================================-->
    <div class="page-head">
      <div class="container">
        <h3>User Profile <i class="fa fa-angle-right"></i> Setting</h3>
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
                  <li class="breadcrumb-item active">Edit</li>
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
                    <li class="active">
                      <a href="#setting" data-toggle="tab">Profile Setting</a>
                    </li>
                    <li>
                      <router-link :to="{ name: 'changepassword' }" data-toggle="tab">Change Password</router-link>
                    </li>
                    <li>
                      <router-link :to="{ name: 'myorder'}" data-toggle="tab">My Order</router-link>
                    </li>
                    <li>
                      <router-link :to="{ name: 'mywishlist'}" data-toggle="tab">My Wishlist</router-link>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <center>
                            <h4>&darr; Edit Profile &darr;</h4>
                          </center>
                          <div class="signup-form">
                            <form @submit.prevent="updateUser">
                              <div class="form-group field">
                                <label
                                  for="password"
                                  class="col-sm-4 control-label"
                                >Address</label>
                                <div class="col-sm-8">
                                  <input
                                    type="text"
                                    name="address"
                                    class="form-control"
                                    v-model="form.address"
                                    placeholder="Address"
                                    :class="{ 'is-invalid': form.errors.has('address') }"
                                  />
                                  <!-- <span class="help is-danger" v-text="errors.get('current_password')"></span> -->
                                </div>                               
                                <has-error id="error" :form="form" field="address" class="invalid-feedback" role="alert"></has-error>
                              </div> 
                              <!-- //Addres -->
                              <div class="form-group field">
                                <label
                                  for="country"
                                  class="col-sm-4 control-label"
                                >Country</label>
                                <div class="col-sm-8">
                                  <select name="country_id" v-model="form.country_id" @change="getState()">
                                      <option value>Select Country</option>
                                      <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name	}} &nbsp; [{{country.sortname}}]</option>
                                  </select>
                                  <!-- <span class="help is-danger" v-text="errors.get('current_password')"></span> -->
                                </div>                               
                                <has-error id="error" :form="form" field="country_id"></has-error>
                              </div>  <!-- //Country -->
                              <div class="form-group field">
                                <label
                                  for="state"
                                  class="col-sm-4 control-label"
                                >State</label>
                                <div class="col-sm-8">
                                    <select name="state_id" v-model="form.state_id" @change="getCity()">
                                      <option value>Select State</option>
                                      <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name	}}</option>
                                    </select>
                                  <!-- <span class="help is-danger" v-text="errors.get('current_password')"></span> -->
                                </div>                               
                                <has-error id="error" :form="form" field="state_id"></has-error>
                              </div>  <!-- //State -->
                              <div class="form-group field">
                                <label
                                  for="city"
                                  class="col-sm-4 control-label"
                                >City</label>
                                <div class="col-sm-8">
                                    <select name="city_id" v-model="form.city_id">
                                      <option value>Select City</option>
                                      <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                                    </select>
                                  <!-- <span class="help is-danger" v-text="errors.get('current_password')"></span> -->
                                </div>                               
                                <has-error id="error" :form="form" field="city_id"></has-error>
                              </div>  <!-- //City -->                       
                              <div class="form-group field">
                                <label for="password" class="col-sm-4 control-label">Pin Code</label>
                                <div class="col-sm-8">
                                  <input
                                    id="pincode"
                                    type="number"
                                    name="pincode"
                                    class="form-control"
                                    v-model="form.pincode"
                                    placeholder="Pin Code"
                                    :class="{ 'is-invalid': form.errors.has('pincode') }"
                                  />
                                  <!-- <span class="help is-danger" v-text="errors.get('new_password')"></span> -->
                                </div>                                
                                <has-error :form="form" field="pincode" id="error"></has-error>
                              </div>  <!-- //Pincode -->

                              <div class="form-group field">
                                <label for="password" class="col-sm-4 control-label">Phone Number</label>
                                <div class="col-sm-8">
                                  <input
                                    id="phone"
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    v-model="form.phone"
                                    placeholder="Mobile Number"
                                    :class="{ 'is-invalid': form.errors.has('phone') }"
                                  />
                                  <!-- <span class="help is-danger" v-text="errors.get('new_password')"></span> -->
                                </div>                                
                                <has-error :form="form" field="phone" id="error"></has-error>
                              </div> <!-- //Mobile -->                             
                              <div class="form-group field">
                                <label
                                  for="password"
                                  class="col-sm-4 control-label"
                                >User's Avatar</label>
                                <div class="col-sm-8">
                                  <div class="col-sm-2">
                                    <img :src="form.image" alt width="50" height="40" />
                                  </div>
                                  <div class="col-sm-10">
                                    <input
                                      type="file"
                                      id="image"
                                      name="image"
                                      @change="changePhoto($event)"
                                      :class="{ 'is-invalid': form.errors.has('image') }"
                                    />
                                  </div>
                                </div>                              
                                <has-error id="error" :form="form" field="image"></has-error>
                              </div>
                                <center>
                                  <button type="submit" class="btn btn-default">Update</button>
                                </center>                                
                            </form>
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </div>
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
  name: "Setting",
  components: {
    Header,
    Usersidebar
  },
  props: ['name'],
  data() {
    return {
      token: axios.defaults.headers.common['Authorization'],
      count: [],
      // country_id: '',
      // state_id: '',
      // city_id: '',

      form: new Form({
          address: '',
          city_id: '',
          pincode: '',
          state_id: '',
          country_id: '',
          image: '' ,  
      })      
    };
  },

  computed: {
    myProfile() {
      return this.$store.getters.getProfile
    },    
    countries() {
       return this.$store.getters.getCountry
    },
    states() {
      return this.$store.getters.getState
    },
    cities() {
      return this.$store.getters.getCity
    }
  },
  mounted() {
    this.$store.dispatch("myProfile")
    this.$store.dispatch('allCountries')
    this.$store.dispatch('allStates')
    this.$store.dispatch('allCities')
    if(this.token) {
      axios.get('/api/orders').then((response) => {
        this.count = response.data.orderCount;
      })
    }
  },

  methods: {
     getState() {
       this.$store.dispatch('allStates', this.form.country_id)
     },

     getCity() {
       this.$store.dispatch('allCities', this.form.state_id)
     },

    changePhoto(event) {
      let file = event.target.files[0];
      if (file.size > 2048567) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
          footer: "<a href>Why do I have this issue?</a>"
        });
      } else {
        let reader = new FileReader();
        reader.onload = event => {
          this.form.image = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },

    updateUser() {
      // console.log(this.token)
      if(this.token) {
        this.form.post(`/api/update-user/${this.$route.params.id}`).then((response) => { 
            this.$store.dispatch("myProfile")          
            Toast.fire({
                  icon: "success",
                  title: "User Updated Successfully!"
            });
            this.form.reset();             
        })
        .catch((error) => {
            if(error.response.data) {
              $("#error").fadeOut(8000)
            }          
        })
        
      } else {
        this.$store.dispatch('logout')
      }
      
    },        
  }

};
</script>

<style>
select{
  margin-bottom: 10px;
}
#logout{
  cursor: pointer;
}
#breadcrumb{
  font-size: 20px;
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