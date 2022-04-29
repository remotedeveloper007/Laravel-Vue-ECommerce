<template>
  <div>
    <ul class="breadcrumb">
      <li>
        <i class="fas fa-home"></i>
        <router-link to="/admin">Home</router-link>
        <i class="fas fa-angle-right"></i>&nbsp;
      </li>
      <li>
        <a href="#">Manage Product</a>
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
                  Manage Product
                </h3>
                <!-- tools box -->
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
                      <th>Product Title</th>
                      <th>Image</th>
                      <th>Code</th>
                      <th>Color</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product, index) in getallProduct" :key="product.id">
                      <td>{{index+1}}</td>
                      <td>{{product.product_name}}</td>
                      <td>
                        <img :src="productImage(product.product_image)" width="50" height="40" alt />
                      </td>
                      <td>{{product.product_code}}</td>
                      <td>{{product.product_color}}</td>
                      <td>{{product.product_price}}</td>
                      <td
                        v-if="product.status == 1"
                        style="color:green;font-weight: bolder;"
                      >Publish</td>
                      <td v-else style="color:red;font-weight: bolder;">Unpublish</td>
                      <td>
                        <a v-if="product.status == 1" @click.prevent="unpublishProduct(product.id)">
                          <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="UnPublish Product">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="publishProduct(product.id)">
                          <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Publish Product">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a> 
                        <router-link :to="`/admin/manage-attributes/${product.id}`">
                          <button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View Attributes">
                            <i class="fas fa-eye"></i>
                          </button>
                        </router-link>                       
                        <router-link :to="`/admin/edit-product/${product.id}`">
                          <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Product">
                            <i class="fas fa-edit"></i>
                          </button>
                        </router-link>
                        <router-link :to="`/admin/manage-images/${product.id}`">
                        <!-- <a @click="editModal(category)" title="Add Alternate Images"> -->
                          <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add Alternate Images">
                            <i class="far fa-images"></i>
                          </button>
                        <!-- </a> -->
                        </router-link>                         
                        <a @click.prevent="deleteProduct(product.id)">
                          <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Product">
                            <i class="fa fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl.No</th>
                      <th>Product Title</th>
                      <th>Image</th>
                      <th>Code</th>
                      <th>Color</th>
                      <th>Price</th>
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
  </div>
</template>

<script>
export default {
  name: "ManageProduct",
  data() {
    return {
      id: []
    };
  },
  mounted() {
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
    /**
     * function taken from store/admin.js/actions: allProduct()
     * To fetch All Product details to Display
     */
    this.$store.dispatch("allProduct");
  },
  computed: {
    getallProduct() {
      return this.$store.getters.getProduct;
    }
  },
  methods: {
    productImage(img) {
      return "/product_image/" + img;
    },
    publishProduct(id) {
      axios
        .get("/admin/publish-product/" + id)
        .then(response => {
          this.$store.dispatch("allProduct");
          Toast.fire({
            icon: "success",
            title: "Produst Published Successfully"
          });
        })
        .catch(() => {});
    },
    unpublishProduct(id) {
      axios
        .get("/admin/unpublish-product/" + id)
        .then(response => {
          this.$store.dispatch("allProduct");
          Toast.fire({
            icon: "success",
            title: "Product Unpublished Succesfully"
          });
        })
        .catch(() => {});
    },
    deleteProduct(id) {
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
            .get("/admin/delete-product/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Product has been deleted.", "success");
              this.$store.dispatch("allProduct");
            })
            .catch(() => {});
        } else {
          Swal.fire("Cancelled!", "Product is safe.", "error");
          this.$store.dispatch("allProduct");
        }
      });
    }
  }
};
</script>

<style scoped>
</style>
