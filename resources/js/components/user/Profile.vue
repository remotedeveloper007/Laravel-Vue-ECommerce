import Form from "vform";
<template>
  <div id="userdashboard">
    <Header v-bind:username="user.name" />
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
                  </li>
                  <li class="breadcrumb-item active">User Profile</li>
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
                :id="user.id"
                :username="user.name"
                :image="user.image"
                :email="user.email"
                :orderCount="this.count"
              />
              <!-- <Usersidebar v-bind:user="user" :orderCount="this.count" /> -->
              <!-- //.Part UserBar -->

              <!--    <div class=d"col-md-9">  -->
              <div class="box card-info card-outline">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                      <div class="row col-sm-12">
                        <div class="row">
                          <div class="column">
                            <div class="box">
                              <h3>Card 1</h3>
                              <p>Some text</p>
                              <p>Some text</p>
                            </div>
                          </div>

                          <div class="column">
                            <div class="box">
                              <h3>Card 2</h3>
                              <p>Some text</p>
                              <p>Some text</p>
                            </div>
                          </div>

                          <div class="column">
                            <div class="box">
                              <h3>Card 3</h3>
                              <p>Some text</p>
                              <p>Some text</p>
                            </div>
                          </div>
                        </div>
                        <!--  //row -->
                        <div class="row">
                          <div class="column">
                            <div class="box">
                              <h3>Card 1</h3>
                              <p>Some text</p>
                              <p>Some text</p>
                            </div>
                          </div>

                          <div class="column">
                            <div class="box">
                              <h3>Card 2</h3>
                              <p>Some text</p>
                              <p>Some text</p>
                            </div>
                          </div>

                          <div class="column">
                            <div class="box">
                              <h3>Card 3</h3>
                              <p>Some text</p>
                              <p>Some text</p>
                            </div>
                          </div>
                        </div>
                        <!--  //row -->
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
import Usersidebar from "./UserSidebar.vue";
export default {
  name: "Dashboard",
  components: {
    Header,
    Usersidebar,
  },
  data() {
    return {
      // isLoading: true,
      loggedIn: [],
      events: [],
      count: [],
      // id: this.id,
      // username: this.name,
      // email: this.email,
      // image: this.image,

      token: axios.defaults.headers.common["Authorization"],

      form: new Form({
        token: document.querySelector('meta[name="csrf-token"]'),
      }),
    };
  },
  computed: {
    user() {
      // if (this.token) {
      return this.$store.getters.getProfile;
      // }
    },
  },
  mounted() {
    this.$store.dispatch("myProfile");

    if (this.token) {
      axios.get("/api/orders").then((response) => {
        this.count = response.data.orderCount;
      });
    }
  },
  methods: {},
};
</script>



<style>
#upro {
  text-align: left;
}
#logout {
  cursor: pointer;
}
#breadcrumb {
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

.box {
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
  margin-bottom: 1rem;
}

.box {
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

/** ===============For Grid Box=================== */

* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 33%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {
  margin: 0 -5px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.box {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #fff;
  transition: 1s;
}
</style>