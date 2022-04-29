<template>
  <div>
    <ul class="breadcrumb icon">
      <li>
        <i class="fas fa-home"></i>
        <router-link to="/admin/dashboard">Home</router-link>
        <i class="fas fa-angle-right"></i>&nbsp;
      </li>
      <li>
        <a href="/admin/manage-users">Manage Users</a>
      </li>
    </ul>
    <!-- ************************************************** -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-manage"></i>
                  Manage Users
                </h3>
                <!-- tools box -->
                <div class="card-tools">
                  <!-- <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#addBrandModal"
                    @click="addModal"
                  >Add Brand</button>&nbsp;&nbsp; | &nbsp;&nbsp;-->
                  <button
                    type="button"
                    class="btn btn-tool btn-sm"
                    data-card-widget="collapse"
                    data-toggle="tooltip"
                    title="Collapse"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-tool btn-sm"
                    data-card-widget="remove"
                    data-toggle="tooltip"
                    title="Remove"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Sl.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user, index) in getUser" :key="user.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td
                        v-if="user.activity_status == 1"
                        style="color:green;font-weight: bolder;"
                      >UnBlock</td>
                      <td v-else style="color:red;font-weight: bolder;">Blocked</td>
                      <td>
                        <a v-if="user.activity_status == 1" @click.prevent="blockUser(user.id)">
                          <button class="btn btn-danger">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="unblockUser(user.id)">
                          <button class="btn btn-success">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <a @click="editModal(User)">
                          <button data-toggle="modal" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <a>
                          <button @click.prevent="deleteBrand(user.id)" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- ************************************************** -->
  </div>
</template>

<script>
export default {
  name: "ManageUsers",
  data() {
    return {
      id: []
    };
  },
  mounted() {
    this.$store.dispatch("allUser");
  },
  computed: {
    getUser() {
      return this.$store.getters.getUser;
    }
  },
  methods: {
    blockUser(id) {
      axios.get("/block/" + id).then(response => {
        this.$store.dispatch("allUser");
        Toast.fire({
          icon: "success",
          title: "User has been Block Successfully!"
        });
      });
    },

    unblockUser(id) {
      axios.get("/unblock/" + id).then(response => {
        this.$store.dispatch("allUser");
        Toast.fire({
          icon: "success",
          title: "User has been UnBlock Successfully!"
        });
      });
    }    
  }
};
</script>
