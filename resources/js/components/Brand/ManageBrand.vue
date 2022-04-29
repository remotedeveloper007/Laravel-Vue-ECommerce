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
        <a href="#">Manage Brand</a>
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
                  <i class="fas fa-manage"></i>
                  Manage Brand
                </h3>
                <!-- tools box -->
                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#addBrandModal"
                    @click="addModal"
                  >Add Brand</button>&nbsp;&nbsp; | &nbsp;&nbsp;
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
                      <th>Brand Id</th>
                      <th>Brand Name</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(brand, index) in getallbrand" :key="brand.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{brand.brand_name}}</td>
                      <td
                        v-if="brand.publication_status == 1"
                        style="color:green;font-weight: bolder;"
                      >Published</td>
                      <td v-else style="color:red;font-weight: bolder;">Unpublished</td>
                      <td>
                        <a
                          v-if="brand.publication_status == 1"
                          @click.prevent="unpublishBrand(brand.id)"
                        >
                          <button class="btn btn-danger">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="publishBrand(brand.id)">
                          <button class="btn btn-success">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <a @click="editModal(brand)">
                          <button
                            data-toggle="modal"
                            class="btn btn-primary"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <a>
                          <button @click.prevent="deleteBrand(brand.id)" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Brand Id</th>
                      <th>Brand Name</th>
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
    <!-- ********************************* Add Brand Modal ***************************** -->
    <div
      class="modal fade"
      id="addBrandModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <!-- <span v-if="editmode == true"><div class="modal-content card-warning card-outline col-md-12"></span> -->
        <div class="modal-content card-primary card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title">Add Brand</h5>
            <!-- <h5 class="modal-title" v-show="editmode">Edit Brand</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="addBrand()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <h3
                style="text-align: center;margin-top: 10px;"
              >&darr; Form to Add New Brand &darr;</h3>
              <hr />
              <br />

              <div class="form-group row">
                <label for="brand_name" class="col-sm-3 control-label">Brand Name</label>

                <div class="col-sm-9">
                  <input
                    type="text"
                    name="brand_name"
                    v-model="form.brand_name"
                    class="form-control"
                    id="brandId"
                    placeholder="Brand Name"
                    :class="{ 'is-invalid': form.errors.has('brand_name') }"
                  />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error :form="form" field="brand_name"></has-error>
                </div>
              </div>

              <div class="form-group row"></div>
            </div>
            <div class="modal-footer">
              <span>
                <button v-show="editmode" type="submit" class="btn btn-warning">Update Brand</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Add Brand</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ********************************* Edit Brand Modal ***************************** -->
    <div
      class="modal fade"
      id="editBrandModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <!-- <span v-if="editmode == true"><div class="modal-content card-warning card-outline col-md-12"></span> -->
        <div class="modal-content card-warning card-outline col-md-12">
          <div class="modal-header">
            <!-- <h5 class="modal-title" v-if="editmode == false">Add Brand</h5> -->
            <h5 class="modal-title">Edit Brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="updateBrand()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <!-- <h3 style="text-align: center;margin-top: 10px;"  v-if="editmode == false">&darr; Form to Add New Brand &darr;</h3> -->
              <h3 style="text-align: center;margin-top: 10px;">&darr; Form to Edit Brand &darr;</h3>
              <hr />
              <br />

              <div class="form-group row">
                <label for="brand_name" class="col-sm-3 control-label">Brand Name</label>

                <div class="col-sm-9">
                  <input
                    type="text"
                    name="brand_name"
                    v-model="form.brand_name"
                    class="form-control"
                    id="brandId"
                    placeholder="Brand Name"
                    :class="{ 'is-invalid': form.errors.has('brand_name') }"
                  />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error :form="form" field="brand_name"></has-error>
                </div>
              </div>

              <div class="form-group row"></div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-warning">Update Brand</button>
              <!-- <button v-show="!editmode" type="submit" class="btn btn-primary">Add Brand</button> -->
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ********************************* Edit Brand Modal End ***************************** -->
  </div>
</template>

<script>
export default {
  name: "ManageBrand",
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      editmode: false,
      // Create a new form instance
      form: new Form({
        id: "",
        brand_name: ""
      })
    };
  },
  mounted() {
    //allBrand function taken from store/index/actions: allBrand()
    this.$store.dispatch("allBrand");
  },
  computed: {
    getallbrand() {
      return this.$store.getters.getBrand;
    }
  },
  methods: {
    addModal() {
      // this.form.editmode = false;
      this.form.reset();
      $("#addBrandModal").modal("show");
    },
    addBrand() {
      // console.log('Brand Added')
      this.$Progress.start();
      this.form
        .post("/add-brand")
        .then(response => {
          this.$store.dispatch("allBrand");
          Toast.fire({
            icon: "success",
            title: "Brand Added Successfully"
          });
        })
        .catch(() => {});
      this.$Progress.finish();
      $("#addBrandModal").modal("hide");
    },
    /**
     * To Toggle Edit Modal for Brand Update
     */
    editModal(brand) {
      // this.editmode = true;
      this.form.reset();
      $("#editBrandModal").modal("show");
      this.form.fill(brand);
    },
    /**
     * Form data send to Controller from updateBrand() function
     * for update
     */
    updateBrand() {
      // console.log('Update brand');
      this.$Progress.start();
      this.form
        .post("/update-brand/" + this.form.id)
        .then((response) => {
          this.$store.dispatch("allBrand");
          Toast.fire({
            icon: "success",
            title: "Brand Updated Successfully"
          });
        })
        .catch(() => {
          this.$Progress.fail();
        });
        $("#editBrandModal").modal("hide");
    },
    /**
     * Published Brand by brand id
     */
    publishBrand(id) {
      // console.log(id)
      axios.get("/publish-brand/" + id).then(() => {
        this.$store.dispatch("allBrand");
        Toast.fire({
          icon: "success",
          title: "Brand Published Successfully"
        });
      });
    },
    unpublishBrand(id) {
      // console.log(id)
      axios.get("/unpublish-brand/" + id).then(() => {
        this.$store.dispatch("allBrand");
        Toast.fire({
          icon: "success",
          title: "Brand UnPublished Successfully"
        });
      });
    },
    deleteBrand(id) {
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
            .get("delete-brand/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Brand has been deleted.", "success");
              this.$store.dispatch("allBrand");
            })
            .catch(() => {});
        } else {
          Swal.fire("Cancelled!", "Brand is safe.", "error");
          this.$store.dispatch("allBrand");
        }
      });
    }
  }
};
</script>

<style scoped>
</style>
