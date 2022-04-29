<template>
  <div>
    <ul class="breadcrumb icon">
      <li>
        <i class="fas fa-home"></i>
        <router-link to="/admin">Home</router-link>
        <i class="fas fa-angle-right"></i>&nbsp;
      </li>
      <li>
        <a href="">Orders Number: {{order}}</a>
      </li>
    </ul>
    <!-- ************************************************** -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- .Item's Details -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Item's Details</h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <span v-for="order in OrderDetails" :key="order.id">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Order.No</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Discount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="pro in order.orders" :key="pro.id">
                        <td>{{ pro.order_number }}</td>
                        <td>
                          <img
                            :src="`/product_image/${pro.image}`"
                            width="70"
                            alt=""
                          />
                        </td>
                        <td>
                          {{ pro.product_name }}
                          <p>{{ pro.product_code }}</p>
                        </td>
                        <td>{{ pro.product_size }}</td>
                        <td>{{ pro.color }}</td>
                        <td>{{ pro.product_price }}</td>
                        <td>{{ pro.quantity }}</td>
                        <td>{{ pro.discount }}</td>
                      </tr>
                    </tbody>
                  </table>
                </span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.Item's Details -->
            <!-- /.card-body -->
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->

        <div class="row">
          <div class="col-md-6">
            <!-- .Payment Details -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Payment Details</h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Particulars</th>
                      <!-- <th>Progress</th>
                      <th style="width: 40px">Label</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>PaymentNo:</td>
                      <td>{{payment.paypal_payId}}</td>
                    </tr>
                    <tr>
                      <td>PayMode:</td>
                      <td>{{ payment.payment_mode }}</td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>{{ payment.payment_status}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.Payment Details -->
            <!-- /.card -->
            <!-- .Billing Details -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing Details</h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>particulars</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Name:</td>
                      <td>{{user.name}}</td>
                    </tr>
                    <tr>
                      <td>Address:</td>
                      <td>{{user.address}}</td>
                    </tr>
                    <tr>
                      <td>City:</td>
                      <td>Cron job running</td>
                    </tr>
                    <tr>
                      <td>Zipcode:</td>
                      <td>{{ user.pincode}}</td>
                    </tr>
                    <tr>
                      <td>State:</td>
                      <td>Fix and squish bugs</td>
                    </tr>
                    <tr>
                      <td>Country:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td>{{user.email}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.Billing Details -->
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Condensed Full Width Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div
                            class="progress-bar progress-bar-danger"
                            style="width: 55%"
                          ></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div
                            class="progress-bar bg-warning"
                            style="width: 70%"
                          ></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div
                          class="progress progress-xs progress-striped active"
                        >
                          <div
                            class="progress-bar bg-primary"
                            style="width: 30%"
                          ></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div
                          class="progress progress-xs progress-striped active"
                        >
                          <div
                            class="progress-bar bg-success"
                            style="width: 90%"
                          ></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- .Customer's Details -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer's Details</h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <!-- <th>Progress</th>
                      <th style="width: 40px">Label</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Name:</td>
                      <td>{{user.name}}</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td>{{user.email}}</td>
                    </tr>
                    <tr>
                      <td>Phone:</td>
                      <td>{{user.phone}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.Customer's Details -->
            <!-- /.card -->
             <!-- Shipping Details -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Shipping Details</h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Particulars</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Name:</td>
                      <td>{{ shipping.shipping_name }}</td>
                    </tr>
                    <tr>
                      <td>Address:</td>
                      <td>{{ shipping.shipping_address}}</td>
                    </tr>
                    <tr>
                      <td>City:</td>
                      <td>{{ shipping.shipping_city }}</td>
                    </tr>
                    <tr>
                      <td> Zipcode:</td>
                      <td>{{ shipping.shipping_pincode}}</td>
                    </tr>
                    <tr>
                      <td>State:</td>
                      <td>{{ shipping.shipping_state }}</td>
                    </tr>
                    <tr>
                      <td>Country:</td>
                      <td>{{ shipping.shipping_country }}</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td>{{ shipping.shipping_email }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.Shipping Details -->
            <!-- /.card -->
            <!-- card -->
            <!-- .Update Order's Status -->
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Order's Status</h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <br>
                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Status</label></div>
                    </div>
                  <div class="col-md-7">
                    <form @submit.prevent="updateStatus">
                      <div class="form-group">

                              <!-- <input type="hidden" name="order_no" v-model="order"> -->
                              <!-- <input type="text" v-model="order" value="{}"> -->
                              <select name="status" v-model="form.status" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled>Select status</option>
                                    <option value="New">New</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="In Processed">In Processed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Shipped">Shipped</option>
                              </select>                              
                      </div>
                      <div class="form-group"><input type="submit" class="btn btn-outline-primary" value="Update Status"></div>                  
                    </form>                  
                  </div>                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.Update Order's Status -->
            <!-- /.card -->
          </div>
          
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- ************************************************** -->
  </div>
</template>

<script>
import Form from "vform";
import axios from "axios";
export default {
  data() {
    return {
      adminLoggedIn: localStorage.getItem("admin"),
      user: [],
      payment: [],
      shipping: [],
      order: "",
      form: new Form({
        status: "",
        order_no: this.order,
      }),
    };
  },
  computed: {
    OrderDetails() {
      return this.$store.getters.fetchDetails
    }
  },
  mounted() {
    this.$store.dispatch('fetchOrderDetails',this.$route.params.id)
    // if(this.adminLoggedIn == true) {
      axios
        .get(`/admin/get-detail/${this.$route.params.id}`)
        .then((response) => {
          this.order = response.data.order;
          this.payment = response.data.payment;
          this.shipping = response.data.shipping;
          this.user = response.data.user;
          this.form.fill(response.data.order);
        });
    // }
  },
  created() {},
  methods: {
    updateStatus() {
      this.form
        .post(`/admin/update-status/${this.$route.params.id}`)
        .then((response) => {
            Toast.fire({
              icon: "success",
              title: "Order Status Updated Successfully!",
            });
        });
    },
  },
};
</script>

<style>
</style>