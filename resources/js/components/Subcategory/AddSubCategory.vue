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
        <a href="#">Add SubCategory</a>
      </li>
    </ul>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-manage"></i>
                  Add Sub category
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
                  v-on:submit.prevent="addSubCategory()"
                  enctype="multipart/form-data"
                >
                  <h3
                    style="text-align: center;margin-top: 10px;"
                  >&darr; Form to Add New Sub Category &darr;</h3>
                  <hr />
                  <br />
                  <div class="form-group row">
                    <label for="subcategoryId" class="col-sm-3 control-label">Sub Category Name</label>

                    <div class="col-sm-9">
                      <input
                        type="text"
                        name="subcategory_name"
                        v-model="form.subcategory_name"
                        class="form-control"
                        id="subcategoryId"
                        placeholder="Sub Category Name"
                      />
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="categoryId" class="col-sm-3 control-label">Category</label>

                    <div class="col-sm-9">
                      <select
                        style="width: 100%;"
                        class="form-control"
                        name="categoryId"
                        v-model="form.categoryId"
                        :class="{ 'is-invalid': form.errors.has('categoryId') }"
                      >
                        <option disabled value>Select Category</option>
                        <option
                          v-for="category in getallCategory"
                          :key="category.id"
                          :value="category.id"
                        >{{category.category_name}}</option>
                      </select>
                      <has-error :form="form" field="categoryId"></has-error>
                    </div>
                  </div>                 
                  <div class="form-group row"></div>
                  <hr />
                  <div class="box-footer">
                    <center>
                      <button type="submit" class="btn btn-info pull-right">Add SubCategory</button>&nbsp;&nbsp;
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
  name: "AddSubCategory",
  data() {
    return {
      form: new Form({
        subcategory_name: "",
        categoryId: "",
      })
    };
  },
  mounted() {
    /**
     * 
     */
    this.$store.dispatch('allCategory')
  },
  computed: {
    getallCategory() {
      /**
       * Fetch category for category field
       */
      return this.$store.getters.getCategory;
    }
  },
  methods: {
    addSubCategory() {
      this.form.post("/add-subcategory").then(() => {
        this.$router.push("/manage-subcategory");
        Toast.fire({
          icon: "success",
          title: "SubCategory Added Successfully"
        });
      });
    }
  }
};
</script>

<style scoped>
</style>
