<?php include('include/head.php'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/lib/datatable/dataTables.bootstrap.min.css') ?>">
</head>
<body>
    <?php include('include/nav.php'); ?>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include('include/side_nav.php'); ?>
        <div class="alert <?= $this->session->flashdata('message')['admin_status'] ?>" role="alert">
          <?= $this->session->flashdata('message')['admin_message'] ?>
        </div>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Detail Order</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">Order</a></li>
                                    <li class="active">Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                  <div class="col-md-6">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Order Pickup</strong>
                          </div>
                          <div class="card-body">
                            <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th scope="col">Address</th>
                                      <th scope="col">Nearest</th>
                                      <th scope="col">From Name</th>
                                      <th scope="col">Contact</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th><?= $get_detail_order['pickup']->pickup_address ?></th>
                                      <td><?= $get_detail_order['pickup']->pickup_nearest ?></td>
                                      <td><?= $get_detail_order['pickup']->pickup_from_name ?></td>
                                      <td><?= $get_detail_order['pickup']->pickup_from_contact ?></td>
                                  </tr>
                              </tbody>
                            </table>

                          </div>
                      </div> <!-- .card -->
                  </div><!--/.col-->

                  <div class="col-md-6">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Order Deliver</strong>
                          </div>
                          <div class="card-body">
                            <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th scope="col">Address</th>
                                      <th scope="col">Nearest</th>
                                      <th scope="col">From Name</th>
                                      <th scope="col">Contact</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th><?= $get_detail_order['delivery']->delivery_address ?></th>
                                      <td><?= $get_detail_order['delivery']->delivery_nearest ?></td>
                                      <td><?= $get_detail_order['delivery']->delivery_from_name ?></td>
                                      <td><?= $get_detail_order['delivery']->delivery_from_contact ?></td>
                                  </tr>
                              </tbody>
                            </table>

                          </div>
                      </div> <!-- .card -->
                  </div><!--/.col-->

                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Order Information</strong>
                          </div>
                          <div class="card-body">
                            <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th scope="col">Orderer Name</th>
                                      <th scope="col"><?= $get_detail_order['information']->user_name ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Location</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_location ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Type</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_type ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Piece</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_item_piece ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Name</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_name ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order KG</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_kg ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Note</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_note ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Instruction</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_instruction ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Collect Amount</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_collect_amount ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Open Parcel</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_open_parcel ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Restricted</th>
                                      <th scope="col"><?= $get_detail_order['information']->order_restricted ?></th>
                                  </tr>
                                  <tr>
                                      <th scope="col">Order Status</th>
                                      <th scope="col">
                                          <select name="selectSm" id="order_status" class="form-control-sm form-control" data-id="<?= $get_detail_order['information']->order_id ?>">
                                              <option value=""><?= $get_detail_order['information']->order_status ?></option>
                                              <option value="pending">Pending</option>
                                              <option value="approved">Approved</option>
                                          </select>
                                      </th>
                                  </tr>
                              </thead>

                            </table>

                          </div>
                      </div> <!-- .card -->
                  </div><!--/.col-->

                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Order Delivery Chargies</strong>
                          </div>
                          <div class="card-body">
                            <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th scope="col">Amount</th>
                                      <th scope="col">KG</th>
                                      <th scope="col">Location</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th scope="row"><?= $get_detail_order['chargies']->dc_amount ?></th>
                                      <td><?= $get_detail_order['chargies']->dc_kg ?></td>
                                      <td><?= $get_detail_order['chargies']->dc_location ?></td>
                                  </tr>

                              </tbody>
                            </table>
                            <div class="message_">

                            </div>
                          </div>
                      </div> <!-- .card -->
                  </div><!--/.col-->

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="clearfix"></div>

        <?php include('include/footer.php') ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <?php include('include/script.php') ?>
    <!-- Scripts -->
    <script src="<?= base_url('assets/js/lib/data-table/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/lib/data-table/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/init/datatables-init.js') ?>"></script>

    <script>

    </script>



</body>
</html>
