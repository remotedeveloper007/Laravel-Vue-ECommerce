<template>
  <div class="col-md-3">
    <div class="box card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img
            class="profile-user-img img-fluid img-circle"
            :src="avatar(image)"
            width="150"
            height="150"
            alt="User profile picture"
          />
        </div>
        <span>
          <h3 class="profile-username name text-center">{{ username }}</h3>
        </span>
        <p class="text-muted text-center">{{ email }}</p>
        <ul id="upro" class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <router-link id="size" :to="{ name: 'dashboard' }">
              <i class="fa fa-user"></i>
              <b>Profile</b>
              <!-- <a class="float-right">1,322</a> -->
            </router-link>
          </li>
          <li class="list-group-item">
            <router-link id="size" :to="`/user/edit-profile/` + id">
              <i class="fa fa-edit"></i>
              <b>Edit Profile</b>
              <!-- <a class="float-right">1,322</a> -->
            </router-link>
          </li>
          <li class="list-group-item">
            <router-link id="size" :to="`/user/change-password/` + id">
              <i class="fa fa-key"></i>
              <b>Change Password</b>
              <!-- <a class="float-right">1,322</a> -->
            </router-link>
          </li>
          <li class="list-group-item">
            <router-link id="size" :to="`/user/my-order/` + id">
              <i class="fa fa-list"></i>
              <b>My Order</b>
              <span class="badge float-right">{{ orderCount }}</span>
            </router-link>
          </li>
          <li class="list-group-item">
            <router-link id="size" :to="`/user/my-wishlist/` + id">
              <i class="fa fa-heart"></i>
              <b>My Wishlist</b>
              <span class="badge float-right">0</span>
              <!-- <a class="float-right">13,287</a> -->
            </router-link>
          </li>
        </ul>
        <a id="logout" @click="deleteUser" class="btn btn-primary btn-block">
          <span id="size">
            <i class="fa fa-power-off"></i>
            <b>Delete Account</b>
          </span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: "",
    username: { type: String },
    image: { type: String },
    email: { type: String },
    orderCount: 0,
  },
  data() {
    return {
      loggedIn: [],
      events: [],
      token: axios.defaults.headers.common["Authorization"],

      form: new Form({
        token: document.querySelector('meta[name="csrf-token"]'),
      }),

      isUser: this.username,
      // isAvatar: this.image,
    };
  },
  computed: {
    // myProfile() {
    //   return this.$store.getters.getProfile;
    // },
  },
  mounted() {
    // this.$store.dispatch("myProfile");
  },
  methods: {
    changeValue: function () {
      this.isUser = !this.isUser;
      this.$emit("username", this.isUser);
    },
    //
    avatar(img) {
      if (!this.image) {
        return "/users_avatar/1604075940.png";
      } else {
        return "/users_avatar/" + img;
      }
    },
    /**
     * Get Authnticated User data
     */
    deleteUser() {
      if (this.token) {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          // Send request to server
          if (result.value) {
            axios
              .get("/api/delete-user/" + this.id)
              .then(() => {
                this.$router.push({ name: "register" });
                this.$store.dispatch("deleteUser");
                Swal.fire(
                  "Deleted!",
                  "User Account has been deleted.",
                  "success"
                );
              })
              .catch(() => {});
          } else {
            Swal.fire("Cancelled!", "User Account is safe.", "error");
            this.$router.push({ name: "dashboard" });
          }
        });
      } else {
        this.$store.dispatch("logout");
      }
    },
  },
};
</script>

<style scoped>
#size {
  font-size: 18px;
}
</style>