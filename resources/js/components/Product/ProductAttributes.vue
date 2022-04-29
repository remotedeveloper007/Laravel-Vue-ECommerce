import Form from 'vform';
<template>
  <div>
    <ul class="breadcrumb">
      <li>
        <i class="fas fa-home"></i>
        <router-link to="/admin">Home</router-link>
        <i class="fas fa-angle-right"></i>&nbsp;
      </li>
      <li>
        <a href="#">Product Details</a>
      </li>
    </ul>
    <!-- /.col -->

    <!-- /.content -->
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
                  Manage Product Attributes
                  <!-- {{ this.$route.params.id }} -->
                </h3>
                <!-- tools box -->
                <div class="card-tools"> 
                  <a href="javascript:void(0);" type="button" class="add_button btn btn-info" @click="addModal" title="Add Attributes">
                    <i class="fas fa-plus-circle"></i>Add
                  </a> &nbsp;&nbsp;
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
                <table id="example2" class="table table-bordered table-hover sortable">
                  <thead>
                    <tr>
                      <th>Sl.No</th>
                      <th>SKU</th>
                      <th>Product Name</th>
                      <th>Color</th>
                      <th>Size</th>
                      <th>Price</th>
                      <th>Stock</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(attributes, index) in productAttributes" :key="attributes.id">
                      <!-- <template v-for="product in getProduct"> -->
                      <td>{{ index + 1 }}</td>
                      <td>{{ attributes.sku }}</td>
                      <template v-for="product in getProduct">
                        <td
                          :key="product.id"
                          v-if="attributes.product_id == product.id"
                        >{{product.product_name}}</td>
                        <td
                          :key="product.id"
                          v-if="attributes.product_id == product.id"
                        >{{product.product_color}}</td>
                      </template>
                      <td>{{ attributes.size }}</td>
                      <td>{{ attributes.price }}</td>
                      <td>{{ attributes.stock }}</td>
                      <td>
                        <a @click="editModal(attributes)">
                          <button class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <a>
                          <button
                            @click.prevent="deleteAttribute(attributes.id)"
                            class="btn btn-danger"
                          >
                            <i class="fa fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                      <!-- </template> -->
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl.No</th>
                      <th>SKU</th>
                      <th>Product Name</th>
                      <th>Color</th>
                      <th>Size</th>
                      <th>Price</th>
                      <th>Stock</th>
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
    <!-- //Manage Product Attributes -->


    <!-- *********************************** Add Attrubute moduals ***************************** -->
    <div
      class="modal fade"
      id="addAttributeModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-primary card-outline col-md-12">
          <div class="modal-header">
            <h5 class="add">&darr; Form to Add New Attribute &darr;</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="addAttribute()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <br />
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">SKU</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="sku"
                    placeholder="SKU"
                    v-model="form.sku"
                    class="form-control"
                    :class="{ 'is-invalid' :form.errors.has('sku') }"
                    required
                    autofocus
                  />
                  <!-- <input type="hidden" id="id" :v-model="form.id" name="id" /> -->
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error :form="form" field="sku" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="size" class="col-sm-4 control-label">Size</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="size"
                    placeholder="Size"
                    v-model="form.size"
                    class="form-control"
                    id="size"
                    :class="{ 'is-invalid' :form.errors.has('size') }"
                    required
                    autofocus
                  />
                  <has-error :form="form" field="size" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="price" class="col-sm-4 control-label">Price</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="price"
                    v-model="form.price"
                    class="form-control"
                    id="price"
                    placeholder="Price"
                    required
                    autofocus
                    :class="{ 'is-invalid' :form.errors.has('price') }"
                  />
                  <has-error :form="form" field="price" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">Stock</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="stock"
                    v-model="form.stock"
                    class="form-control"
                    id="stock"
                    placeholder="Stock"
                    required
                    autofocus
                    :class="{ 'is-invalid' :form.errors.has('stock') }"
                  />
                  <has-error :form="form" field="stock" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary">Save Attributes</button>
              <button type="submit" id="close" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- *********************************** Attrubute update moduals ***************************** -->

    <div
      class="modal fade"
      id="editAttributeModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-warning card-outline col-md-12">
          <div class="modal-header">
            <h5 class="head">&darr; Form to Edit Attribute &darr; {{ this.$route.params.id }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            class="form-horizontal"
            v-on:submit.prevent="updateAttribute()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <br />
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">SKU</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="sku"
                    v-model="form.sku"
                    class="form-control"
                    :class="{ 'is-invalid' :form.errors.has('sku') }"
                    disabled
                  />
                  <input type="hidden" id="id" :v-model="form.id" name="id" />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error :form="form" field="name" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="size" class="col-sm-4 control-label">Size</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="size"
                    v-model="form.size"
                    class="form-control"
                    id="size"
                    :class="{ 'is-invalid' :form.errors.has('size') }"
                    disabled
                  />
                  <has-error :form="form" field="size" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="price" class="col-sm-4 control-label">Price</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="price"
                    v-model="form.price"
                    class="form-control"
                    id="price"
                    placeholder="Price"
                    required
                    autofocus
                    :class="{ 'is-invalid' :form.errors.has('price') }"
                  />
                  <has-error :form="form" field="price" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">Stock</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="stock"
                    v-model="form.stock"
                    class="form-control"
                    id="stock"
                    placeholder="Stock"
                    required
                    autofocus
                    :class="{ 'is-invalid' :form.errors.has('stock') }"
                  />
                  <has-error :form="form" field="stock" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary">Update Attributes</button>
              <button type="submit" id="close" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- *********************************** //Attrubute update moduals End Here *************************** -->

        <!-- App Product Attributes -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- <div class="col-md-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <a data-widget="pushmenu" href="#">
                    <span class="fas fa-edit"></span>
                  </a>&nbsp;
                  <i class="fas fa-manage"></i>
                  Add Product Attributes
                </h3>
                tools box
                <div class="card-tools">
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
                    ata-toggle="tooltip"
                    title="Remove"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                /. tools
              </div>

              <div class="card-body">
                <form
                  class="form-horizontal"
                  v-on:submit.prevent="addAttribute()"
                  enctype="multipart/form-data"
                >
                  <div class="control-group">
                    <div>
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Activity</th>
                          </tr>
                        </thead>
                        <tbody class="field_wrapper">
                          <tr>
                            <td>
                              <input
                                type="text"
                                name="sku"
                                id="sku"
                                v-model="form.sku"
                                class="form-control"
                                placeholder="SKU"
                                :class="{ 'is-invalid': form.errors.has('sku') }"
                              />
                              <has-error :form="form" field="sku"></has-error>
                              <input type="hidden" name="_token" :value="csrf" />
                            </td>
                            <td>
                              <input
                                type="text"
                                name="size"
                                id="size"
                                v-model="form.size"
                                class="form-control"
                                placeholder="Size"
                                :class="{ 'is-invalid': form.errors.has('size') }"
                              />
                              <has-error :form="form" field="size"></has-error>
                            </td>
                            <td>
                              <input
                                type="text"
                                name="price"
                                id="price"
                                v-model="form.price"
                                class="form-control"
                                placeholder="Price"
                                :class="{ 'is-invalid': form.errors.has('price') }"
                              />
                              <has-error :form="form" field="price"></has-error>
                            </td>
                            <td>
                              <input
                                type="text"
                                name="stock"
                                id="stock"
                                v-model="form.stock"
                                class="form-control"
                                placeholder="Stock"
                                :class="{ 'is-invalid': form.errors.has('stock') }"
                              />
                              <has-error :form="form" field="stock"></has-error>
                            </td>
                            <td>
                              <a
                                href="javascript:void(0);"
                                type="button"
                                class="add_button btn btn-info"
                                title="Add field"
                              >
                                <i class="fas fa-plus-circle"></i>Add
                              </a>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5">
                              <button type="submit" class="btn btn-outline-primary">Save Attribute</button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>  -->
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  <!-- *********************************** //App Product Attributes End Here *************************** --> 

  </div>
</template>

<script>
export default {
  name: "ProductDetails",

  data() {
    return {
      csrf: "",

      form: new Form({
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        id: [],
        product_id: "",
        sku: "",
        size: "",
        price: "",
        stock: ""
      })
    };
  },

  computed: {
    productAttributes() {
      return this.$store.getters.getAttribute;
    },
    getProduct() {
      return this.$store.getters.getProduct;
    }
  },
  // created: function() {
  //   this.getAttribute(this.$route.params.productId);
  // },

  methods: {
    getAttribute() {
      this.$store.dispatch("proAttributes", this.$route.params.pid);
    },
    /**
     * To Toggle Add Modal for Attribute Update
     */
    addModal(attributes) {
      // this.editmode = true;
      this.form.reset();
      $("#addAttributeModal").modal("show");
    },
    /**
     * Function to Add Product Attributes
     */
    addAttribute() {
      this.form
        .post(`/admin/save-attribute/${this.$route.params.pid}`)
        .then(response => {
          this.$store.dispatch("proAttributes", this.$route.params.pid);
          Toast.fire({
            icon: "success",
            title: "ProductAttribute Saved Succesfully"
          });
        })
        .catch(() => {});

        $("#addAttributeModal").modal("hide");
    },

    /**
     * To Toggle Edit Modal for Attribute Update
     */
    editModal(attributes) {
      // this.editmode = true;
      this.form.reset();
      $("#editAttributeModal").modal("show");
      this.form.fill(attributes);
    },
    /** 
     * Function to Update Product Attributes
     */
    updateAttribute() {
      this.form
        .post("/admin/update-attribute/" + this.form.id)
        .then(response => {
          this.$store.dispatch("proAttributes", this.$route.params.pid);
          Toast.fire({
            icon: "success",
            title: "ProductAttribute Updated Succesfully!"
          });
        })
        .catch(() => {});

      $("#editAttributeModal").modal("hide"); 
    }
  },

  mounted() {
    this.getAttribute();

    this.$store.dispatch("allProduct");
    /**
     *
     */
    $(document).ready(function() {
      var maxField = 10; //Input fields increment limitation
      var addButton = $(".add_button"); //Add button selector
      var wrapper = $(".field_wrapper"); //Input field wrapper
      var fieldHTML =
        '<tr><td><input type="text" v-model="form.sku" name="sku[]" id="sku" class="form-control" placeholder="SKU" /></td><td><input type="text" v-model="form.size" name="size[]" id="size" class="form-control" placeholder="Size" /></td><td><input type="text" v-model="form.price" name="price[]" id="price" class="form-control" placeholder="Price" /></td><td><input type="text" v-model="form.stock" name="stock[]" id="stock" class="form-control" placeholder="Stock" /></td><td class="trashIconContainer"><a href="javascript:void(0);" class="remove_button"><i class="far fa-trash-alt"></i></a></td></tr>'; //New input field html
      var x = 1; //Initial field counter is 1

      //Once add button is clicked
      $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
          x++; //Increment field counter
          $(wrapper).append(fieldHTML); //Add field html
        }
      });

      //Once remove button is clicked
      $(wrapper).on("click", ".remove_button", function(e) {
        e.preventDefault();
        $(this)
          .closest("tr")
          .remove();
        // $(this)
        //     .parent("tr")
        //     .remove(); //Remove field html
        x--; //Decrement field counter
      });
    }); // jQuery End
  },

  watch: {
    $route(to, from) {
      this.getAttribute();
    }
  }
};
</script>

<style scoped>
#row {
  float: right;
}
.add {
  margin-left: 90px;
  margin-top: 5px;
}
.head {
  margin-left: 120px;
  margin-top: 5px;
}
#close {
  margin-right: 120px;
}
</style>
