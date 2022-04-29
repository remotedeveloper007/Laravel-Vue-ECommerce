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
        <a href="#">Manage Coupons</a>
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
                  Manage Caopons
                </h3>
                <!-- tools box -->
                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-outline-primary"
                    data-toggle="modal"
                    data-target="#addCouponModal"
                    @click="addModal"
                  >Add Coupon</button>&nbsp;&nbsp; | &nbsp;&nbsp;
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
                      <th>Id</th>
                      <th>Coupon Code</th>
                      <th>Amount</th>
                      <th>Coupon Type</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(coupon, index) in Coupons" :key="coupon.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{coupon.coupon_code}}</td>
                      <td>
                        {{coupon.amount}}
                        <span v-if="coupon.amount_type == 'Percentage'">%</span>
                        <span v-else>$</span>
                      </td>
                      <td>{{coupon.amount_type}}</td>
                      <td>{{coupon.expiry_date}}</td>
                      <td
                        style="color:green;font-weight: bolder;"
                        v-if="coupon.status == 1"
                      >Published</td>
                      <td style="color:red;font-weight: bolder;" v-else>UnPublished</td>
                      <td>
                        <a v-if="coupon.status == 1" @click.prevent="unpublishCoupon(coupon.id)">
                          <button class="btn btn-danger">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="publishCoupon(coupon.id)">
                          <button class="btn btn-success">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <!-- <router-link :to="`/admin/edit-category/${category.id}`"> -->
                        <a @click="editModal(coupon)">
                          <button class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <!-- </router-link> -->
                        <!-- ======*******======###########=======*******====== -->
                        <a>
                          <button @click.prevent="deleteCoupon(coupon.id)" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Coupon Code</th>
                      <th>Amount</th>
                      <th>Coupon Type</th>
                      <th>Expiry Date</th>
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
      id="addCouponModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-primary card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Coupon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" v-on:submit.prevent="addCoupon()">
            <div class="modal-body">
              <h3 style="text-align: center;margin-top: 10px;">&darr; Form to Add New Coupon &darr;</h3>
              <hr />
              <br />
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">Coupon Code</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="coupon_code"
                    v-model="form.coupon_code"
                    class="form-control"
                    id="coupon_code"
                    placeholder="Coupon Code"
                    :class="{ 'is-invalid' :form.errors.has('coupon_code') }"
                    required
                    autofocus
                  />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error :form="form" field="coupon_code" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">Amount</label>

                <div class="col-sm-8">
                  <input
                    type="number"
                    name="amount"
                    min="1"
                    v-model="form.amount"
                    class="form-control"
                    id="name"
                    placeholder="Amount"
                  />
                  <has-error :form="form" field="amount" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="amount_type" class="col-sm-4 control-label">Amount Type</label>
                <div class="col-sm-8">
                  <select
                    class="form-control"
                    name="amount_type"
                    v-model="form.amount_type"
                    :class="{ 'is-invalid': form.errors.has('amount_type') }"
                  >
                    <option disabled value>Select Amount Type</option>
                    <option value="Percentage">Percentage</option>
                    <option value="Fixed">Fixed</option>
                  </select>
                  <has-error :form="form" field="amount_type" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">Expiry Date</label>
                <div class="input-group col-sm-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input
                    type="date"
                    name="expiry_date"
                    v-model="form.expiry_date"
                    id="expiry_date"
                    class="form-control"
                    autocomplete="off"
                    required
                    autofocus
                  />
                  <has-error :form="form" field="expiry_date" class="invalid-feedback" role="alert"></has-error>
                </div>
                <!-- /.input group -->
              </div>
              <div class="row">
                <label for="status" class="col-sm-4 control-label">Status</label>
                <div class="col-sm-8">
                  <input
                    type="checkbox"
                    name="status"
                    v-model="form.status"
                    id="status"
                    required
                    value="1"
                  />
                  <has-error :form="form" field="status" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row"></div>
            </div>
            <div id="footer" class="modal-footer">
              <button type="submit" class="btn btn-outline-primary">Add Coupon</button>
              <button type="submit" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--  ********************************* //Add Category Modal ***************************   -->
    <!-- ********************************* Edit Brand Modal ***************************** -->
    <div
      class="modal fade"
      id="editCouponModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card-warning card-outline col-md-12">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Coupon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" v-on:submit.prevent="updateCoupon()">
            <div class="modal-body">
              <h3 style="text-align: center;margin-top: 10px;">&darr; Form to Edit Coupon &darr;</h3>
              <hr />
              <br />
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">Coupon Code</label>
                <div class="col-sm-8">
                  <input
                    type="text"
                    name="coupon_code"
                    v-model="form.coupon_code"
                    class="form-control"
                    id="coupon_code"
                    placeholder="Coupon Code"
                    :class="{ 'is-invalid' :form.errors.has('coupon_code') }"
                    required
                    autofocus
                  />
                  <input type="hidden" name="_token" :value="csrf" />
                  <has-error :form="form" field="coupon_code" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-4 control-label">Amount</label>

                <div class="col-sm-8">
                  <input
                    type="text"
                    name="amount"
                    v-model="form.amount"
                    class="form-control"
                    id="amount"
                    placeholder="Amount"
                  />
                  <has-error :form="form" field="amount" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="amount_type" class="col-sm-4 control-label">Amount Type</label>
                <div class="col-sm-8">
                  <select
                    class="form-control"
                    name="amount_type"
                    v-model="form.amount_type"
                    :class="{ 'is-invalid': form.errors.has('amount_type') }"
                  >
                    <option disabled value>Select Amount Type</option>
                    <option value="Percentage">Percentage</option>
                    <option value="Fixed">Fixed</option>
                  </select>
                  <has-error :form="form" field="amount_type" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="url" class="col-sm-4 control-label">Expiry Date</label>
                <div class="input-group col-sm-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input
                    type="date"
                    name="expiry_date"
                    v-model="form.expiry_date"
                    id="expiry_date"
                    class="form-control"
                    autocomplete="off"
                    required
                    autofocus
                  />
                  <has-error :form="form" field="expiry_date" class="invalid-feedback" role="alert"></has-error>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-4 control-label">Status</label>
                <div class="col-sm-8">
                  <input
                    type="checkbox"
                    name="status"
                    v-model="form.status"
                    id="status"
                    required
                    value="1"
                  />
                  <has-error :form="form" field="status" class="invalid-feedback" role="alert"></has-error>
                </div>
              </div>
              <div class="form-group row"></div>
            </div>
            <div class="modal-footer">
              <center>
                <button type="submit" class="btn btn-outline-primary">Update Coupon</button>
                <button type="submit" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
              </center>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ********************************* //Edit Brand Modal End ***************************** -->
  </div>
</template>

<script>
import Form from "vform";
export default {
  name: "ManageCoupon",
  data() {
    return {
      csrf: "",
      id: [],
      form: new Form({
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        id: [],
        coupon_code: "",
        amount: "",
        amount_type: "",
        expiry_date: "",
        status: ""
      })
    };
  },

  computed: {
    Coupons() {
      /**
       * Fetch category for category field with parent_id = NULL
       */
      return this.$store.getters.getCoupon;
    }
  },
  mounted() {
    /**
     * allCategory function taken from store/admin/actions: allCategory()
     */
    return this.$store.dispatch("allCoupon");
  },

  methods: {
    addModal() {
      // this.form.editmode = false;
      this.form.reset();
      $("#addCouponModal").modal("show");
    },
    /**
     *  Add New Category into Category table
     */
    addCoupon() {
      // this.$Progress.start();
      this.form
        .post("/admin/addCoupon")
        .then(response => {
          this.$store.dispatch("allCoupon");
          Toast.fire({
            icon: "success",
            title: "Coupon Added Successfully"
          });
        })
        .catch(() => {});
      // this.$Progress.finish();
      $("#addCouponModal").modal("hide");
    },

    /**
     * To Toggle Edit Modal for Category Update
     */
    editModal(coupon) {
      // this.editmode = true;
      this.form.reset();
      $("#editCouponModal").modal("show");
      this.form.fill(coupon);
    },
    /**
     * Form data send to Controller from updateCategory() function
     * for update
     */
    updateCoupon() {
      // this.$Progress.start();
      this.form
        .post("/admin/updateCoupon/" + this.form.id)
        .then(response => {
          this.$store.dispatch("allCoupon");
          Toast.fire({
            icon: "success",
            title: "Coupon Updated Successfully"
          });
        })
        .catch(() => {
          this.$Progress.fail();
        });
      $("#editCouponModal").modal("hide");
    },

    /**
     *
     */
    publishCoupon(id) {
      axios
        .get("/admin/publish-coupon/" + id)
        .then(response => {
          this.$store.dispatch("allCoupon");
          Toast.fire({
            icon: "success",
            title: "Coupon Publish Successfully"
          });
        })
        .catch(() => {});
    },

    unpublishCoupon(id) {
      axios
        .get("/admin/unpublish-coupon/" + id)
        .then(response => {
          this.$store.dispatch("allCoupon");
          Toast.fire({
            icon: "success",
            title: "Coupun Unpublish Successfully"
          });
        })
        .catch(() => {});
    },

    deleteCoupon(id) {
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
            .get("/admin/delete-coupon/" + id)
            .then(() => {
              this.$store.dispatch("allCoupon");
              Swal.fire("Deleted!", "Coupon has been deleted.", "success");
            })
            .catch(() => {});
        } else {
          Swal.fire("Cancelled!", "Coupon is safe.", "error");
          this.$store.dispatch("allCoupon");
        }
      });
    }
  }
};
</script>

<style scoped>
#footer {
  text-align: center justify;
}

#status {
  padding-left: 29px !important;
  min-width: 22px;
  min-height: 22px;
  line-height: 22px;
  display: inline-block;
  position: relative;
  vertical-align: top;
  margin-bottom: 0;
  font-weight: 400;
  cursor: pointer;
}
</style>
