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
                                <h1>Transactions</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">Bank Management</a></li>
                                    <li class="active">Transactions</li>
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
                                <strong class="card-title">Transactions's</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID#</th>
                                            <th>Transaction no</th>
                                            <th>Order Total Amount</th>
                                            <th>Percent</th>
                                            <th>Percent Amount</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach($transaction_obj as $key => $transaction){
                                          ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $transaction['transaction_no'] ?></td>
                                                <td>$<?= number_format($transaction['transaction_order_total_amount']) ?></td>
                                                <td><?= $transaction['transaction_percent'] ?>%</td>
                                                <td>$<?= $transaction['transaction_percent_amount'] ?></td>
                                                <td><?= $transaction['transaction_created_at'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/view_order?id=' . $transaction['transaction_order_id']) ?>" class="btn btn-sm btn-info" title="View Details"><i class="fa fa-eye"></i></a>
                                                </td>
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
