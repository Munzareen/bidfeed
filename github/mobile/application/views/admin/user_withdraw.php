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
                                <h1>User's Withdraw</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">Bank Management</a></li>
                                    <li class="active">User's Withdraw</li>
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
                                <strong class="card-title">User's</strong>
                                <a href="<?= base_url('admin/user_create') ?>" class="btn btn-sm btn-success pull-right" title="Add User"><i class="fa fa-plus"></i></a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID#</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Withdraw Amount</th>
                                            <th>Percent</th>
                                            <th>Percent Amount</th>
                                            <th>Deposit Amount</th>
                                            <th>Bank Name</th>
                                            <th>Bank Account Holder Name</th>
                                            <th>Bank Account No</th>
                                            <th>Bank Iban</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach($user_withdraw_obj as $key => $user_withdraw){
                                          ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $user_withdraw['user_name'] ?></td>
                                                <td><?= $user_withdraw['user_email'] ?></td>
                                                <td>$<?= $user_withdraw['withdraw_amount'] ?></td>
                                                <td>2.5%</td>
                                                <td>$<?= $cal_percent = ($user_withdraw['withdraw_amount'] / 100) * 2.5 ?></td>
                                                <td>$<?= $user_withdraw['withdraw_amount'] - $cal_percent ?></td>
                                                <td><?= $user_withdraw['bank_bank_name'] ?></td>
                                                <td><?= $user_withdraw['bank_account_holder_name'] ?></td>
                                                <td><?= $user_withdraw['bank_account_no'] ?></td>
                                                <td><?= $user_withdraw['bank_iban_no'] ?></td>

                                                <td><?= ucfirst($user_withdraw['withdraw_status']) ?></td>
                                                <td><?= $user_withdraw['created_at'] ?></td>
                                                <td>
                                                    <? if($user_withdraw['withdraw_status'] == 'pending'){ ?>
                                                    <a href="<?= base_url('admin/withdraw_status?id=' . $user_withdraw['withdraw_id'] .'&status=approved') ?>" class="btn btn-sm btn-success" title="Approve"><i class="fa fa-check"></i></a>
                                                    <a href="<?= base_url('admin/withdraw_status?id=' . $user_withdraw['withdraw_id'] .'&status=rejected' ) ?>" class="btn btn-sm btn-danger" title="Reject"><i class="fa fa-times"></i></a>
                                                    <? } else{ echo "---"; }?>
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
