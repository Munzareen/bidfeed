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
                                <h1>Delivery Chargies</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">Chargie's</a></li>
                                    <li class="active">Create Charge</li>
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
                  <div class="col-md-6 offset-md-3">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Create Charge</strong>
                          </div>
                          <div class="card-body">
                              <!-- Credit Card -->
                              <div id="pay-invoice">
                                  <div class="card-body">
                                      <form method="post">
                                          <div class="form-group">
                                              <label for="cc-payment" class="control-label mb-1">Charge Amount</label>
                                              <input id="dc_amount" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                          </div>
                                          <div class="form-group">
                                              <label for="cc-payment" class="control-label mb-1">Charge KG</label>
                                              <input id="dc_kg" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                          </div>
                                          <div class="form-group">
                                              <label for="cc-payment" class="control-label mb-1">Charge Location</label>
                                              <select name="selectSm" id="dc_location" class="form-control-sm form-control">
                                                  <option value="">Please select</option>
                                                  <option value="karachi_to_karachi">Karachi to karachi</option>
                                              </select>
                                          </div>
                                          <div>
                                              <button id="submit_chargies" type="submit" class="btn btn-lg btn-info btn-block">
                                                  <i class="fa fa-lock fa-lg"></i>&nbsp;<span id="payment-button-amount">Submit</span>
                                              </button>
                                          </div>
                                          <div class="message_">

                                          </div>
                                      </form>
                                  </div>
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
