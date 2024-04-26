<?php include('include/head.php'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/lib/datatable/dataTables.bootstrap.min.css') ?>">
</head>
<body>
    <?php include('include/nav.php'); ?>
    <?php
    if($user_type=='trainer'){
      $user_type_text = "Trainer";
    }else if($user_type=='user'){
      $user_type_text = "User";
    }else{
      $user_type_text = "User Type is Required";
    }
    ?>
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
                                <h1>Order Details</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">Bank Management</a></li>
                                    <li><a href="#">Transactions</a></li>
                                    <li class="active">Order Details</li>
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
                                <strong class="card-title">Order Details</strong>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>Order Number :</b> <?= $order_details['order_number'] ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>Total Amount :</b> $<?= $order_details['order_total_amount'] ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>Country :</b> <?= $order_details['order_country'] ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>City :</b> <?= $order_details['order_city'] ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>State :</b> <?= $order_details['order_state'] ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>Address :</b> <?= $order_details['order_address'] ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>Status :</b> <?= ucfirst($order_details['order_status']) ?> </li>
                                            </div>
                                            <div class="col-md-6">
                                                <li class="list-group-item"><b>Created At :</b> <?= $order_details['order_created_at'] ?> </li>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID#</th>
                                            <th>Product Image</th>
                                            <th>Product Description</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach($order_details['order_products'] as $key => $order_products){
                                          ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><img src="<?= $order_products['product_image'] ?>" width="100" height="100" /></td>
                                                <td><?= $order_products['product_description'] ?></td>
                                                <td>$<?= $order_products['oi_price'] ?></td>
                                                <td><?= $order_products['pc_name'] ?></td>
                                            </tr>
                                          <?php
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
