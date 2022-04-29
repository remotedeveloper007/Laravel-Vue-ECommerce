<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ this.count }}</h3>

                                <p>New Orders</p>
                                <div class="icon">
                                    <i class="fab fa-opencart"></i>
                                </div>
                            </div>
                            <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div>-->
                            <router-link
                                to="/admin/manage-orders"
                                class="small-box-footer"
                            >
                                More info
                                <i class="fas fa-arrow-circle-right"></i>
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><sup style="font-size: 20px">0</sup></h3>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <p>Users</p>
                            </div>
                            <!-- <div class="icon">
                <i class="ion ion-stats-user"></i>
              </div>-->
                            <router-link
                                to="/admin/manage-users"
                                class="small-box-footer"
                            >
                                More info
                                <i class="fas fa-arrow-circle-right"></i>
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>0</h3>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <p>Seller Registrations</p>
                            </div>
                            <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
                            <router-link
                                to="/admin/manage-sellers"
                                class="small-box-footer"
                            >
                                More info
                                <i class="fas fa-arrow-circle-right"></i>
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>0</h3>
                                <div class="icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <p>Unique Visitors</p>
                            </div>
                            <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
                            <a href="#" class="small-box-footer">
                                More info
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- =================================Monthly Recap Report================================ -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Recap Report</h5>

                                <div class="card-tools">
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-card-widget="collapse"
                                    >
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-tool dropdown-toggle"
                                            data-toggle="dropdown"
                                        >
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu dropdown-menu-right"
                                            role="menu"
                                        >
                                            <a href="#" class="dropdown-item"
                                                >Action</a
                                            >
                                            <a href="#" class="dropdown-item"
                                                >Another action</a
                                            >
                                            <a href="#" class="dropdown-item"
                                                >Something else here</a
                                            >
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item"
                                                >Separated link</a
                                            >
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-card-widget="remove"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-center">
                                            <strong
                                                >Sales: 1 Jan, 2014 - 30 Jul,
                                                2014</strong
                                            >
                                        </p>

                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas
                                                id="salesChart"
                                                height="180"
                                                style="height: 180px;"
                                            ></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Goal Completion</strong>
                                        </p>

                                        <div class="progress-group">
                                            Add Products to Cart
                                            <span class="float-right">
                                                <b>160</b>/200
                                            </span>
                                            <div class="progress progress-sm">
                                                <div
                                                    class="progress-bar bg-primary"
                                                    style="width: 80%"
                                                ></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->

                                        <div class="progress-group">
                                            Complete Purchase
                                            <span class="float-right">
                                                <b>310</b>/400
                                            </span>
                                            <div class="progress progress-sm">
                                                <div
                                                    class="progress-bar bg-danger"
                                                    style="width: 75%"
                                                ></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text"
                                                >Visit Premium Page</span
                                            >
                                            <span class="float-right">
                                                <b>480</b>/800
                                            </span>
                                            <div class="progress progress-sm">
                                                <div
                                                    class="progress-bar bg-success"
                                                    style="width: 60%"
                                                ></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            Send Inquiries
                                            <span class="float-right">
                                                <b>250</b>/500
                                            </span>
                                            <div class="progress progress-sm">
                                                <div
                                                    class="progress-bar bg-warning"
                                                    style="width: 50%"
                                                ></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3 col-6">
                                        <div
                                            class="description-block border-right"
                                        >
                                            <span
                                                class="description-percentage text-success"
                                            >
                                                <i class="fas fa-caret-up"></i>
                                                17%
                                            </span>
                                            <h5 class="description-header">
                                                $35,210.43
                                            </h5>
                                            <span class="description-text"
                                                >TOTAL REVENUE</span
                                            >
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div
                                            class="description-block border-right"
                                        >
                                            <span
                                                class="description-percentage text-warning"
                                            >
                                                <i
                                                    class="fas fa-caret-left"
                                                ></i>
                                                0%
                                            </span>
                                            <h5 class="description-header">
                                                $10,390.90
                                            </h5>
                                            <span class="description-text"
                                                >TOTAL COST</span
                                            >
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div
                                            class="description-block border-right"
                                        >
                                            <span
                                                class="description-percentage text-success"
                                            >
                                                <i class="fas fa-caret-up"></i>
                                                20%
                                            </span>
                                            <h5 class="description-header">
                                                $24,813.53
                                            </h5>
                                            <span class="description-text"
                                                >TOTAL PROFIT</span
                                            >
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block">
                                            <span
                                                class="description-percentage text-danger"
                                            >
                                                <i
                                                    class="fas fa-caret-down"
                                                ></i>
                                                18%
                                            </span>
                                            <h5 class="description-header">
                                                1200
                                            </h5>
                                            <span class="description-text"
                                                >GOAL COMPLETIONS</span
                                            >
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- =================================Sale Report================================ -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">
                                        Online Store Visitors
                                    </h3>
                                    <a href="javascript:void(0);"
                                        >View Report</a
                                    >
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg"
                                            >820</span
                                        >
                                        <span>Visitors Over Time</span>
                                    </p>
                                    <p
                                        class="ml-auto d-flex flex-column text-right"
                                    >
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i>
                                            12.5%
                                        </span>
                                        <span class="text-muted"
                                            >Since last week</span
                                        >
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas
                                        id="visitors-chart"
                                        height="200"
                                    ></canvas>
                                </div>

                                <div
                                    class="d-flex flex-row justify-content-end"
                                >
                                    <span class="mr-2">
                                        <i
                                            class="fas fa-square text-primary"
                                        ></i>
                                        This Week
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i>
                                        Last Week
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Sales</h3>
                                    <a href="javascript:void(0);"
                                        >View Report</a
                                    >
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg"
                                            >$18,230.00</span
                                        >
                                        <span>Sales Over Time</span>
                                    </p>
                                    <p
                                        class="ml-auto d-flex flex-column text-right"
                                    >
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i>
                                            33.1%
                                        </span>
                                        <span class="text-muted"
                                            >Since last month</span
                                        >
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas
                                        id="sales-chart"
                                        height="200"
                                    ></canvas>
                                </div>

                                <div
                                    class="d-flex flex-row justify-content-end"
                                >
                                    <span class="mr-2">
                                        <i
                                            class="fas fa-square text-primary"
                                        ></i>
                                        This year
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i>
                                        Last year
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- =================================Sale Report================================ -->
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      count: "",
    }
  },

  mounted() {
    axios.get('/admin/view-order').then((response) => {
      this.count = response.data.totalOrder
    })
  }
}
</script>

<style></style>
