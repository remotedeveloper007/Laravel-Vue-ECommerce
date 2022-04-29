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
        <a href="#">Edit Category</a>
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
                  Edit Category
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
                <form class="form-horizontal" v-on:submit.prevent="updateCategory()">
                  <h3
                    style="text-align: center;margin-top: 10px;"
                  >&darr; Form to Edit Category &darr;</h3>
                  <hr />
                  <br />
                  <div class="form-group row">
                    <label for="brandId" class="col-sm-3 control-label">Category Name</label>

                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="category_name"
                        v-model="form.category_name"
                        class="form-control"
                        id="categoryId"
                        placeholder="Category Name"
                        :class="{ 'is-invalid': form.errors.has('category_name') }"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="categoryId" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea
                        id="CKEditor"
                        v-model="form.category_description"
                        name="category_description"
                        rows="4"
                        cols="76"
                        :class="{ 'is-invalid': form.errors.has('category_description') }"
                      ></textarea>
                      <has-error :form="form" field="category_description"></has-error>
                    </div>
                  </div>
                  <div class="form-group row"></div>
                  <hr />
                  <div class="box-footer">
                    <center>
                      <button type="submit" class="btn btn-info pull-right">Update Category</button>&nbsp;&nbsp;
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
  name: "EditCategory",
  mounted() {
    /**
     *Create ('/edit-category/{id}') route at web.php page
     */
    axios
      .get(`/edit-category/${this.$route.params.categoryId}`)
      .then(response => {
        /**
         * data.category taken from CategoryController edit() function
         */

        this.form.fill(response.data.category);
      });
  },
  data() {
    return {
      form: new Form({
        category_name: "",
        category_description: ""
      })
    };
  },
  computed: {},
  methods: {
    updateCategory() {
      this.form
        .post(`/update-category/${this.$route.params.categoryId}`)
        .then(response => {
          this.$router.push("/manage-category");
          Toast.fire({
            icon: "success",
            title: "Category Updated Successfully"
          });
        })
        .catch(() => {});
    }
  }
};
</script>

<style scoped>
</style>
