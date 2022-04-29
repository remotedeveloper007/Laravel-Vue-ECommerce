<template>
  <div>
    <ul class="breadcrumb icon">
      <li>
        <i class="fas fa-home"></i>
        <router-link to="/admin">Home</router-link>
        <i class="fas fa-angle-right"></i>&nbsp;
      </li>
      <li>
        <a href="#">Manage Orders</a>
      </li>
    </ul>
    <!-- ************************************************** -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-manage"></i>
                  Manage Orders
                </h3>
                <!-- tools box -->
                <div class="card-tools">
                  /
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
                      <th>Order Number</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Oredr Date</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in Orders" :key="order.id">
                      <!-- <tr> -->
                      <td><router-link :to="{ name: 'Order Details', params: { id: order.id } }">{{ order.order_number }}</router-link></td>
                      <td>{{order.grandTotal | toCurrency}}</td>             
                      <td>{{order.status}}</td>
                      <td>{{order.created_at | myDate}}</td>
                      <td>
                        <a
                          v-if="order.status == 1"
                          @click.prevent="unpublishOrder()"
                        >
                          <button class="btn btn-danger">
                            <i class="fa fa-thumbs-down"></i>
                          </button>
                        </a>
                        <a v-else @click.prevent="publishOrder()">
                          <button class="btn btn-success">
                            <i class="fa fa-thumbs-up"></i>
                          </button>
                        </a>
                        <!-- ======*******======###########=======*******====== -->
                        <router-link :to="{ name: 'Order Details', params: { id: order.id } }">
                          <button data-toggle="modal" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                          </button>
                        </router-link>
                        <!-- ======*******======###########=======*******====== -->
                        <a>
                          <button
                            @click.prevent="deleteOrder()"
                            class="btn btn-danger"
                          >
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Order Number</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Oredr Date</th>
                      <th>Activity</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <!-- /.card-footer -->
              <div class="card-footer">
                <!-- <h3 class="card-title">Item's Details</h3> -->
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
              <!-- /.card-footer -->
            </div>
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
export default {
  name: "ManageOrders",
  data() {

    return {
      name: "",
      email:"",
    };
  },
  mounted() {
    this.$store.dispatch("allOrder");
  },

  computed: {
    Orders() {

      return this.$store.getters.getOrder;
    },
  },
  methods: {

  },
};
</script>
