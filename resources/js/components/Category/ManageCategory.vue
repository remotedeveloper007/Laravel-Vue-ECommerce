import Form from 'vform';

<template>
  <div>
    <ul class="breadcrumb">
      <li>
        <i class="fas fa-home"></i>
        <router-link to="/home">Home</router-link>
        <i class="fas fa-angle-right"></i>&nbsp;
      </li>
      <li>
        <a href="#">Manage Category</a>
      </li>
    </ul>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <a data-widget="pushmenu" href="#">
                    <span class="fas fa-bars"></span>
                  </a>&nbsp;
                  <i class="fas fa-manage"></i>
                  Manage Category
                </h3>
                <!-- tools box -->
                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#addCategoryModal"
                     @click="addModal"
                  >Add Category</button>&nbsp;&nbsp; | &nbsp;&nbsp;
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
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Category Id</th>
                      <th>Category Name</th>
                      <th>Url</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category, index) in parentCategory" :key="category.id">
                      <td>{{index + 1}}</td>
                      <td>{{category.name}}</td>
                      <td>{{category.url}}</td>
                      <td
                        v-if="category.status == 1"
                        style="color:green;font-weight: bolder;"
                      >Published</td>
                      <td v-else style="color:red;font-weight: bolder;">Unpublished</td>
                      <td>
                        <a
                          v-if="category.status == 1"
                          @click.prevent="unpublishCategory(category.id)"
                        >
                          <button class="btn btn-danger">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="publishCategory(category.id)">
                          <button class="btn btn-success">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <!-- <router-link :to="`/admin/edit-category/${category.id}`"> -->
                        <a @click="editModal(category)">
                          <button class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <!-- </router-link> -->
                        <!-- ======*******======###########=======*******====== -->
                        <a>
                          <button
                            @click.prevent="deleteCategory(category.id)"
                            class="btn btn-danger"
                          >
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Category Id</th>
                      <th>Category Name</th>
                      <th>Url</th>
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
    <!-- ********************************* Add Category Modal ***************************** -->
    <div
      class="modal fade"
      id="addCategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-primary card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="addCategory()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <h3
                style="text-align: center;margin-top: 10px;"
              >&darr; Form to Add New Category &darr;</h3>
              <hr />
              <br />
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">Category Name</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="name"
                    v-model="form.name"
                    class="form-control"
                    id="name"
                    placeholder="Category Name"
                    :class="{ 'is-invalid' :form.errors.has('name') }"
                    required
                    autofocus
                  />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error
                    :form="form"
                    field="name"
                    class="invalid-feedback"
                    role="alert"
                  ></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">URL</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="url"
                    v-model="form.url"
                    class="form-control"
                    id="url"
                    placeholder="URL"
                    :class="{ 'is-invalid' :form.errors.has('url') }"
                    required
                    autofocus
                  />
                  <has-error :form="form" field="url" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row"></div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add Category</button>
              <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--  ********************************* //Add Category Modal ***************************   -->
    <!-- ********************************* Edit Brand Modal ***************************** -->
    <div
      class="modal fade"
      id="editCategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-warning card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="updateCategory()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <h3 style="text-align: center;margin-top: 10px;">&darr; Form to Edit Category &darr;</h3>
              <hr />
              <br />
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">Category Name</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="name"
                    v-model="form.name"
                    class="form-control"
                    id="cname"
                    placeholder="Category Name"
                    :class="{ 'is-invalid' :form.errors.has('name') }"
                    required
                    autofocus
                  />
                  <input type="hidden" id="id" :v-model="form.id" name="id" />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error
                    :form="form"
                    field="name"
                    class="invalid-feedback"
                    role="alert"
                  ></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">URL</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="curl"
                    v-model="form.url"
                    class="form-control"
                    id="url"
                    placeholder="URL"
                    :class="{ 'is-invalid' :form.errors.has('url') }"
                    required
                    autofocus
                  />
                  <has-error :form="form" field="url" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row"></div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update Category</button>
              <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ********************************* //Edit Brand Modal End ***************************** -->
  </div>
</template>

<script>
export default {
  name: "ManageCategory",
  data() {
    return {
      csrf: "",
      id: [],
      form: new Form({
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        id: [], 
        name: "",
        url: ""
        // category_description: ""
      })
    };
  },
  mounted() {
    /**
     * allCategory function taken from store/admin/actions: allCategory()
     */
    this.$store.dispatch("allCategory");
  },
  computed: {
    parentCategory() {
      /**
       * Fetch category for category field with parent_id = NULL
       */
      return this.$store.getters.getCategory;
    },

  },
  methods: {
    addModal() {
      // this.form.editmode = false;
      this.form.reset();
      $("#addCategoryModal").modal("show");
    },
    /**
     *  Add New Category into Category table
     */
    addCategory() {
      // this.$Progress.start();
      this.form
        .post("/admin/add-category")
        .then(response => {
          this.$store.dispatch("allCategory");
          Toast.fire({
            icon: "success",
            title: "Category Added Successfully"
          });
        })
        .catch(() => {});
      // this.$Progress.finish();
      $("#addCategoryModal").modal("hide");        
    },
    /**
     * To Toggle Edit Modal for Category Update
     */
    editModal(category) {
      // this.editmode = true;
      this.form.reset();
      $("#editCategoryModal").modal("show");
      this.form.fill(category);
    },
    /**
     * Form data send to Controller from updateCategory() function
     * for update
     */
    updateCategory() {
      // this.$Progress.start();
      this.form
        .post("/admin/update-category/" + this.form.id)
        .then(response => {
          this.$store.dispatch("allCategory");
          Toast.fire({
            icon: "success",
            title: "Category Updated Successfully"
          });
        })
        .catch(() => {
           this.$Progress.fail();
        });
      $("#editCategoryModal").modal("hide");
    },
    /**
     * 
     */
    publishCategory(id) {
      axios
        .get("/admin/publish-category/" + id)
        .then((response) => {
          this.$store.dispatch("allCategory");
          Toast.fire({
            icon: "success",
            title: "Category Publish Successfully"
          });
        })
        .catch(() => {});
    },
    unpublishCategory(id) {
      axios.get("/admin/unpublish-category/" + id).then((response) => {
        this.$store.dispatch("allCategory");
        Toast.fire({
          icon: "success",
          title: "Category Unpublish Successfully"
        });
      }).catch(() => {});
    },
    deleteCategory(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        // Send request to server
        if (result.value) {
          axios
            .get("/delete-category/" + id)
            .then(() => {
              this.$store.dispatch("allCategory");
              Swal.fire("Deleted!", "Category has been deleted.", "success");
            })
            .catch(() => {});
        } else {
          Swal.fire("Cancelled!", "Category is safe.", "error");
          this.$store.dispatch("allCategory");
        }
      });
    }
  }
};
</script>

<style scoped>
</style>
