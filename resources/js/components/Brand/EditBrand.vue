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
        <a href="#">Edit Brand</a>
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
                  Edit Brand
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
                <form class="form-horizontal" v-on:submit.prevent="updateBrand()">
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
                      <has-error :form="form" field="brand_name"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="brandId" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <textarea
                        id="CKEditor"
                        v-model="form.brand_description"
                        name="brand_description"
                        rows="4"
                        cols="76"
                        :class="{ 'is-invalid': form.errors.has('brand_description') }"
                      ></textarea>
                      <has-error :form="form" field="brand_description"></has-error>
                    </div>
                  </div>

                  <div class="form-group row"></div>
                  <hr />
                  <div class="box-footer">
                    <center>
                      <button type="submit" class="btn btn-info pull-right">Update Brand</button>&nbsp;&nbsp;
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
export default {
  name: "EditBrand",
  mounted() {
    /**
     * Create ('/edit-brand/{id}') route at web.php page
     */
    axios
      .get(`/edit-brand/${this.$route.params.brandId}`)
      .then( (response) => {
        /**
         * data.brand taken from BrandController edit() function
         */
        this.form.fill(response.data.brand);
      })
      .catch(() => {});
  },
  data() {
    return {
      // Create a new form instance
      form: new Form({
        brand_name: "",
        brand_description: ""
      })
    };
  },
  computed: {},
  methods: {
    /**
     * Form data send to Controller from updateBrand() function
     * for update
     */
    updateBrand(){
       this.form.post(`/update-brand/${this.$route.params.brandId}`)
           .then( (response) => {
             this.$router.push('/manage-brand')
             Toast.fire({
               icon: "success",
               title: "Brand Updated Successfully"
             })
           })
           .catch(() => {})
    }
  }
};
</script>

<style scoped>
</style>
