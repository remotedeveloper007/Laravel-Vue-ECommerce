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
        <a href="#">Product Alternate Image</a>
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
                  Manage Product Images
                  <!-- {{ this.$route.params.id }} -->
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
                  v-on:submit.prevent="updateAlternateImage()"
                  enctype="multipart/form-data"
                >
                  <table id="example2" class="table table-bordered table-hover sortable">
                    <thead>
                      <tr>
                        <th>Product Id</th>
                        <th>Product Title</th>
                        <th>Code</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Image 3</th>
                        <!-- <th>Activity</th> -->
                      </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td>{{getProduct.id}}</td>
                        <td>{{getProduct.product_name}}</td>
                        <td>{{getProduct.product_code}}</td>
                        <td>
                          <img
                            :src="productImage(getProduct.product_image)"
                            width="50"
                            height="40"
                            alt
                          />
                        </td>

                        <!-- Alternate Image 1 -->
                        <td v-if="getProduct.alternate_image1 == null">     
                          <input @change="changePhoto1($event)" type="file" name="alternate_image1" id="img1" style="display: none;" />
                          <label for="img1">
                            <img :src="changeImage1()" width="50" height="45" id="img1" data-toggle="tooltip" data-placement="top" title="Upload Image"/>
                          </label>
                        </td>                        
                        <td v-else>
                          <input @change="changePhoto2($event)" type="file" id="img2" name="alternate_image1" style="display:none;"/>
                          <label for="img2">
                          <img
                            :src="changeImage2()"
                            width="50"
                            height="40"
                            alt=""
                            id="img3" data-toggle="tooltip" data-placement="top" title="Update Image"
                          />
                          </label>
                        </td>

                        <!-- Alternate Image 2  -->
                         <td v-if="getProduct.alternate_image2 == null">
                          <input @change="changePhoto3($event)" type="file" name="alternate_image2" id="img3" style="display: none;" />
                          <label for="img3">
                            <img :src="changeImage3()" width="50" height="45" id="img3" data-toggle="tooltip" data-placement="top" title="Upload Image"/>
                          </label>
                        </td>                        
                        <td v-else>
                          <input @change="changePhoto4($event)" type="file" id="img4" name="alternate_image2" style="display:none;"/>
                          <label for="img4">
                          <img
                            :src="changeImage4()"
                            width="50"
                            height="40"
                            alt=""
                            id="img4" data-toggle="tooltip" data-placement="top" title="Update Image"
                          />
                          </label>
                        </td>                                                                                               
                       </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="6" v-if="getProduct.alternate_image1 == null">
                          <button
                            type="submit"
                            class="btn btn-outline-primary"
                          >Save Alternate Images</button>
                        </td>
                        <td colspan="6" v-else>
                          <button
                            type="submit"
                            class="btn btn-outline-primary"
                          >Update Alternate Images</button>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
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
    <!-- //Manage Product Attributes -->
  </div>
</template>


<script>
import Form from "vform";
export default {
  name: "ProductDetails",

  data() {
    return {
      csrf: "",

      form: new Form({
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        alternate_image1: "",
        alternate_image2: ""
      })
    };
  },

  computed: {
    getProduct() {
      return this.$store.getters.getProImg;
    }
  },
  // created: function() {
  //   this.getAttribute(this.$route.params.productId);
  // },

  methods: {
    productById() {
      this.$store.dispatch("allProImg", this.$route.params.id);
    },
    productImage(img) {
      return "/product_image/" + img;
    },

    updateAlternateImage() {
      this.form
        .post(`/admin/update-altimage/${this.$route.params.id}`)
        .then(response => {
          this.$store.dispatch("allProImg", this.$route.params.id);
          Toast.fire({
            icon: "success",
            title: "Alternate Images Updated Succesfully"
          });
        })
        .catch(() => {});
    },
/**
 * Alternate Image 1 for v-if part
 */
    changePhoto1(event) {
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
          this.form.alternate_image1 = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    changeImage1(){
      let img = this.form.alternate_image1;
      if(img.length > 100){
        return this.form.alternate_image1
      } else {
        return "/assets/admin/default/camera-icon.jpg";
      }

    },

/**
 * Update Alternate Image 1 for v-else part
 */
    changePhoto2(event) {
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
          this.form.alternate_image1 = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    changeImage2(){
      let img = this.form.alternate_image1;
      if(img.length > 100){
        return this.form.alternate_image1
      } else {
        return "/product_image/" + this.form.alternate_image1;
      }
    },

/**
 *  Alternate Image 2 for v-if part
 */
    changePhoto3(event) {
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
          this.form.alternate_image2 = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    changeImage3(){
      let img = this.form.alternate_image2;
      if(img.length > 100){
        return this.form.alternate_image2
      } else {
        return "/assets/admin/default/camera-icon.jpg";
      }
    },

/**
 * Update Alternate Image 2 for v-else part
 */
    changePhoto4(event) {
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
          this.form.alternate_image2 = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    changeImage4(){
      let img = this.form.alternate_image2;
      if(img.length > 100){
        return this.form.alternate_image2
      } else {
        return "/product_image/" + this.form.alternate_image2;
      }
    },


  },

  mounted() {
    this.productById();

    /**
     *
     */
     axios.get(`/admin/editProduct/${this.$route.params.id}`)
        .then((response) => {
        this.form.fill(response.data.product)
    })
  },

  watch: {
    $route(to, from) {
      this.productById();
    }
  }
};
</script>

<style scoped>
#img1{
  cursor:pointer;
}

#img2{
  cursor:pointer;
}

#img3{
  cursor:pointer;
}
#img4{
  cursor:pointer;
}
</style>
