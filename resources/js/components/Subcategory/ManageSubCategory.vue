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
        <a href="#">Manage SubCategory</a>
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
                  Manage Sub category
                </h3>
                <!-- tools box -->
                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#addSubCategoryModal"
                    @click="addModal"
                  >Add SubCategory</button>&nbsp;&nbsp; | &nbsp;&nbsp;
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
                      <th>Sl No.</th>
                      <th>SubCategory Name</th>
                      <th>Category Name</th>
                      <th>Url</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(subcategory, index) in getallSubCategory" :key="subcategory.id">
                      
                      <td>{{index + 1}}</td>
                      <td>{{subcategory.name}}</td>
                      <template v-for="category in mainCategory">
                      <td :key="category.id" v-if="subcategory.parent_id == category.id">
                        {{category.name}}
                      </td></template>                    
                      <td>{{subcategory.url}}</td>
                      <td
                        v-if="subcategory.status == 1"
                        style="color:green;font-weight: bolder;"
                      >Published</td>
                      <td v-else style="color:red;font-weight: bolder;">Unpublished</td>
                      <td>
                        <a
                          v-if="subcategory.status == 1"
                          @click.prevent="unpublishSubCategory(subcategory.id)"
                        >
                          <button class="btn btn-danger">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="publishSubCategory(subcategory.id)">
                          <button class="btn btn-success">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <!-- <router-link :to="`/edit-subcategory/${subcategory.id}`"> -->
                        <a @click="editModal(subcategory)">
                          <button class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <!-- </router-link> -->
                        <!-- ======*******======###########=======*******====== -->
                        <a>
                          <button
                            @click.prevent="deleteSubCategory(subcategory.id)"
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
                      <th>Sl No.</th>
                      <th>SubCategory Name</th>
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
      id="addSubCategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-primary card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add SubCategory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="addSubCategory()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <h3
                style="text-align: center;margin-top: 10px;"
              >&darr; Form to Add New Sub Category &darr;</h3>
              <hr />
              <br />
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">Sub Category</label>

                <div class="col-sm-8">
                  <input
                    type="text"
                    name="name"
                    v-model="form.name"
                    class="form-control"
                    id="name"
                    placeholder="Sub Category Name"
                  />
                  <input type="hidden" name="_token" :value="csrf" />
                </div>
              </div>
              <div class="form-group row">
                <label for="parent_id" class="col-sm-4 control-label">Category</label>

                <div class="col-sm-8">
                  <select
                    class="form-control"
                    name="parent_id"
                    v-model="form.parent_id"
                    :class="{ 'is-invalid': form.errors.has('parent_id') }"
                  >
                    <option disabled value>Select Main Category</option>
                    <option
                      v-for="category in mainCategory"
                      :key="category.id"
                      :value="category.id"
                    >{{category.name}}</option>
                  </select>
                  <has-error :form="form" field="parent_id"></has-error>
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
              <button type="submit" class="btn btn-outline-primary">Add SubCategory</button>
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ********************************* Edit Category Modal *********************************  -->
    <div
      class="modal fade"
      id="editSubCategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-warning card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit SubCategory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="updateSubCategory()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <h3
                style="text-align: center;margin-top: 10px;"
              >&darr; Form to Edit Sub Category &darr;</h3>
              <hr />
              <br />
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">Sub Category</label>

                <div class="col-sm-8">
                  <input
                    type="text"
                    name="name"
                    v-model="form.name"
                    class="form-control"
                    id="scname"
                    placeholder="Sub Category Name"
                  />
                  <input type="hidden" id="id" :v-model="form.id" name="id" />
                  <input type="hidden" name="_token" :value="csrf" />
                </div>
              </div>
              <div class="form-group row">
                <label for="parent_id" class="col-sm-4 control-label">Category</label>

                <div class="col-sm-8">
                  <select
                    class="form-control"
                    name="parent_id"
                    v-model="form.parent_id"
                    :class="{ 'is-invalid': form.errors.has('parent_id') }"
                  >
                    <option disabled value>Select Main Category</option>
                    <option
                      v-for="category in mainCategory"
                      :key="category.id"
                      :value="category.id"
                    >{{category.name}}</option>
                  </select>
                  <has-error :form="form" field="parent_id"></has-error>
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
                    id="scurl"
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
              <button type="submit" class="btn btn-outline-primary">Update SubCategory</button>
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ********************************* //Modal End Edit Category *********************************  -->
  </div>
</template>

<script>
export default {
  name: "ManageSubCategory",
  data() {
    return {
      csrf: "",
      form: new Form({
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        id: [],
        name: "",
        parent_id: "",
        url: ""
      })
    };
  },
  mounted() {
    /**
     *
     */
    this.$store.dispatch("allCategory");
    /**
     * allSubcategory function taken from store/admin/actions: allSubcategory()
     * to Dispaly data
     */
    this.$store.dispatch("allSubcategory");
  },
  computed: {
    mainCategory() {
      /**
       * Fetch category for category field with parent_id = NULL
       */
      return this.$store.getters.getCategory;
    },
    /**
     * getallCategory() function fetch all Category from
     * store/admin/getters: getCategory() function for dispaly ManageCategory.vue
     */
    getallSubCategory() {
      return this.$store.getters.getSubcategory;
    }
  },
  methods: {
    addModal() {
      // this.form.editmode = false;
      this.form.reset();
      $("#addSubCategoryModal").modal("show");
    },
    /**
     *  Add New SubCategory into Category table
     */
    addSubCategory() {
      this.form
        .post("/admin/add-subcategory")
        .then(() => {
          this.$store.dispatch("allSubcategory");
          Toast.fire({
            icon: "success",
            title: "SubCategory Added Successfully"
          });
        })
        .catch(() => {});
      $("#addSubCategoryModal").modal("hide");
    },
    /**
     * To Toggle Edit Modal for Category Update
     */
    editModal(subcategory) { 
      // this.editmode = true;
      this.form.reset();
      $("#editSubCategoryModal").modal("show");
      this.form.fill(subcategory);
    },
    /**
     * Form data send to Controller from updateCategory() function
     * for update
     */
    updateSubCategory() {
      // this.$Progress.start();
      this.form
        .post("/admin/update-subcategory/" + this.form.id)
        .then(response => {
          this.$store.dispatch("allSubcategory");
          Toast.fire({
            icon: "success",
            title: "SubCategory Updated Successfully"
          });
        })
        .catch(() => {
          this.$Progress.fail();
        });
      $("#editSubCategoryModal").modal("hide");
    },

    /**
     * Publish Specific resource from Category table
     * By Category Id
     */
    publishSubCategory(id) {
      axios
        .get("/admin/publish-category/" + id)
        .then((response) => {
          this.$store.dispatch("allSubcategory");
          Toast.fire({
            icon: "success",
            title: "SubCategory Publish Successfully"
          });
        })
        .catch(() => {});
    },
    /**
     * UnPublish Specific resource from Category Table
     * By Category Id
     */
    unpublishSubCategory(id) {
      axios.get("/admin/unpublish-category/" + id).then((response) => {
        this.$store.dispatch("allSubcategory");
        Toast.fire({
          icon: "success",
          title: "SubCategory Unpublish Successfully"
        });
      }).catch(() => {});
    },
    /**
     * Delete Specific resource from Category Table
     * By Category Id
     */
    deleteSubCategory(id) {
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
              this.$store.dispatch("allSubcategory");
              Swal.fire("Deleted!", "SubCategory has been deleted.", "success");
            })
            .catch(() => {});
        } else {
          Swal.fire("Cancelled!", "SubCategory is safe.", "error");
          this.$store.dispatch("allSubcategory");
        }
      });
    }
  }
};
</script>

<style scoped>
</style>
