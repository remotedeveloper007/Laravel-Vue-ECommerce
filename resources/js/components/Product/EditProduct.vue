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
        <a href="#">Edit Product</a>
      </li>
    </ul>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-md-9">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Edit Product
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
                <form
                  class="form-horizontal"
                  v-on:submit.prevent="updateProduct()"
                  enctype="multipart/form-data"
                >
                  <h3
                    style="text-align: center;margin-top: 10px;"
                  >&darr; Form to edit Product &darr;</h3>
                  <hr />
                  <br />
                  <div class="form-group row">
                    <label for="priductId" class="col-sm-3 control-label">Product Name</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="product_name"
                        v-model="form.product_name"
                        class="form-control"
                        id="product_name"
                        placeholder="Product Name"
                      />
                      <has-error :form="form" field="product_name"></has-error>
                    </div>
                  </div>
                  <!-- Select Product Brand -->
                  <!-- <div class="form-group row">
                    <label for="brand_id" class="col-sm-3 control-label">Product Brand</label>

                    <div class="col-sm-9">
                      <select
                        class="form-control"
                        name="brand_id"
                        v-model="form.brand_id"
                        :class="{ 'is-invalid': form.errors.has('brand_id') }"
                      >
                        <option disabled value>Select Brand</option>
                        <option
                          v-for="brand in getallBrand"
                          :key="brand.id"
                          :value="brand.id"
                        >{{brand.brand_name}}</option>
                      </select>
                      <has-error :form="form" field="brand_id"></has-error>
                    </div>
                  </div> -->
                  <!-- Select Product category -->
                  <div class="form-group row">
                    <label for="category_id" class="col-sm-3 control-label">Product Category</label>

                    <div class="col-sm-9">
                      <select
                        style="width: 100%;"
                        class="form-control"
                        name="category_id"
                        v-model="form.category_id"
                        :class="{ 'is-invalid': form.errors.has('category_id') }"
                      >
                        <option disabled value>Select Category</option>
                        <option
                          v-for="category in getallCategory"
                          :key="category.id"
                          :value="category.id"
                        >{{category.category_name}}</option>
                      </select>
                      <has-error :form="form" field="category_id"></has-error>
                    </div>
                  </div>

                  <!-- Select Product Sub Category -->
                  <div class="form-group row">
                    <label for="subcategory_id" class="col-sm-3 control-label">Product SubCategory</label>

                    <div class="col-sm-9">
                      <select
                        class="form-control"
                        name="subcategory_id"
                        v-model="form.subcategory_id"
                        :class="{ 'is-invalid': form.errors.has('subcategory_id') }"
                      >
                        <option disabled value>Select Sub Category</option>
                        <option
                          v-for="subcategory in getallSubCategory"
                          :key="subcategory.id"
                          :value="subcategory.id"
                        >{{subcategory.subcategory_name}}</option>
                      </select>
                      <has-error :form="form" field="subcategory_id"></has-error>
                    </div>
                  </div>
                  <!-- Product Image -->
                  <div class="form-group row">
                    <label for="id" class="col-sm-3 control-label">Product Image</label>
                    
                    <div class="input-group col-sm-9">
                      <img class="col-sm-2" :src="updateImage()" alt width="50" height="40" />
                      <div class="custom-file col-sm-10">                       
                        <input
                          @change="changePhoto($event)"
                          type="file"
                          name="product_image"
                          class="custom-file-input"
                          id="productId"
                        />
                        <label class="custom-file-label" for="productId">Choose file</label>
                        <has-error :form="form" field="product_image"></has-error>
                      </div>
                      <!-- <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>-->
                      <has-error :form="form" field="product_image"></has-error>
                    </div>                   
                  </div>

                  <!-- Product Model -->
                  <div class="form-group row">
                    <label for="id" class="col-sm-3 control-label">Product Code</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="product_code"
                        v-model="form.product_code"
                        class="form-control"
                        id="product_code"
                        placeholder="Product Code"
                      />
                      <has-error :form="form" field="product_code"></has-error>
                    </div>
                  </div>
                  <!-- Product Price -->
                  <div class="form-group row">
                    <label for="priductId" class="col-sm-3 control-label">Product Price</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="product_price"
                        v-model="form.product_price"
                        class="form-control"
                        id="product_price"
                        placeholder="Product Price"
                      />
                      <has-error :form="form" field="product_price"></has-error>
                    </div>
                  </div>

                  <!-- Product Color -->
                  <div class="form-group row">
                    <label for="id" class="col-sm-3 control-label">Product Color</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="product_color"
                        v-model="form.product_color"
                        class="form-control"
                        id="product_color"
                        placeholder="Product Color"
                      />
                      <has-error :form="form" field="product_color"></has-error>
                    </div>
                  </div> 

                  <!-- Product New Price -->
                  <!-- <div class="form-group row">
                    <label for="priductId" class="col-sm-3 control-label">Product New Price</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="product_new_price"
                        v-model="form.product_new_price"
                        class="form-control"
                        id="product_new_price"
                        placeholder="Product New Price"
                      />
                      <has-error :form="form" field="product_new_price"></has-error>
                    </div>
                  </div> -->
                  <!-- Product Quantity -->
                  <!-- <div class="form-group row">
                    <label for="priductId" class="col-sm-3 control-label">Product Quantity</label>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        name="product_quantity"
                        v-model="form.product_quantity"
                        class="form-control"
                        id="product_quantity"
                        placeholder="Product Quantity"
                      />
                      <has-error :form="form" field="product_quantity"></has-error>
                    </div>
                  </div> -->
                  <!-- Product Materials & Care -->
                    <div class="form-group row">
                    <label for="care" class="col-sm-3 control-label">Materials & Care</label>
                    <div class="col-sm-9">
                      <textarea
                        id="CKEditor"
                        v-model="form.care"
                        name="care"
                        rows="4"
                        cols="76"
                        :class="{ 'is-invalid': form.errors.has('care') }"
                      ></textarea>
                      <has-error :form="form" field="care"></has-error>
                    </div>
                  </div>                  
                  <!-- Product Description -->
                  <div class="form-group row">
                    <label for="productId" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <textarea
                        id="CKEditor"
                        v-model="form.description"
                        name="product_description"
                        rows="4"
                        cols="76"
                        :class="{ 'is-invalid': form.errors.has('product_description') }"
                      ></textarea>
                      <has-error :form="form" field="product_description"></has-error>
                    </div>
                  </div>
                  <div class="form-group row"></div>
                  <hr />
                  <div class="box-footer">
                    <center>
                      <button type="submit" class="btn btn-info pull-right">update Product</button>&nbsp;&nbsp;
                      <button type="submit" class="btn btn-default">Cancel</button>
                    </center>
                  </div>
                </form>
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
import Form from 'vform'; 
export default {
  name: "EditProduct",
  data() {
    return {
      form: new Form({
        product_name: "",
        // brand_id: "",
        category_id: "",
        subcategory_id: "",
        product_image: "",
        product_code: "",
        product_price: "",
        product_color: "",
        // product_new_price: "",
        // product_quantity: "",
        care: "",
        description: ""
      })
    };
  },
  mounted() {
    this.$store.dispatch("allBrand");
    this.$store.dispatch("allCategory");
    this.$store.dispatch("allSubcategory");
    /**
     * 
     */ 
    axios.get(`/admin/editProduct/${this.$route.params.id}`)
         .then((response) => {
           this.form.fill(response.data.product)
         })
  },
  computed: {
    getallBrand() {
      /**
       * Fetch Brand for Product Brand field
       */
      return this.$store.getters.getBrand;
    },

    getallCategory() {
      /**
       * Fetch Category for Product Category field
       */
      return this.$store.getters.getCategory;
    },

    getallSubCategory() {
      /**
       * Fetch SubCategory for Product SubCategory field
       */
      return this.$store.getters.getSubcategory;
    }
  },
  methods: {
    updateProduct() {
      this.form
        .post(`/update-product/${this.$route.params.productId}`)
        .then(response => {
          this.$router.push("/admin/manage-product");
          Toast.fire({
            icon: "success",
            title: "Product Updated Successfully"
          });
        })
        .catch(() => {});
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
          this.form.product_image = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    updateImage(){
      let img = this.form.product_image;
      if(img.length > 100){
        return this.form.product_image
      } else {
        return "/product_image/" + this.form.product_image;
      }
    }
  }
};
</script>

<style scoped>
</style>
