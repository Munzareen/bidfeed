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
                                <h1>Order</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">Order's</a></li>
                                    <li class="active">Listing</li>
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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Order's</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID#</th>
                                            <th>Order Location</th>
                                            <th>Order Name</th>
                                            <th>Order piece</th>
                                            <th>Order KG</th>
                                            <th>Order Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $i=1;
                                        foreach($get_order as $order){
                                          ?>
                                          <tr>
                                              <td><?= $i ?></td>
                                              <td><?= $order['order_location'] ?></td>
                                              <td><?= $order['order_name'] ?></td>
                                              <td><?= $order['order_item_piece'] ?></td>
                                              <td><?= $order['order_kg'] ?></td>
                                              <td><?= date('y M (d) D', strtotime($order['order_created'])) ?></td>
                                              <td>
                                                <a href="<?=base_url('admin/detail_order?order_id=').$order['order_id'] ?>"><i class="fa fa-eye" style="font-size:20px;color:green"></i></a> | 
                                                <a href="<?=base_url('admin/delete_order?order_id=').$order['order_id'] ?>"><i class="fa fa-trash-o" style="font-size:20px;color:red"></i></a>
                                              </td>
                                          </tr>
                                          <?php
                                          $i++;
                                        }
                                      ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


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
