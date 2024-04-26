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
                                <h1>User's Listing</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">User's</a></li>
                                    <li class="active">User's Listing</li>
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
                                            <th>User Phone</th>
                                            <th>User DOB</th>
                                            <th>User Gender</th>
                                            <th>Blocked</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach($user_obj as $user){
                                          ?>
                                            <tr>
                                                <td><?= $user['user_id'] ?></td>
                                                <td><?= $user['user_name'] ?></td>
                                                <td><?= $user['user_email'] ?></td>
                                                <td><?= $user['user_phone'] ?></td>
                                                <td><?= $user['user_dob'] ?></td>
                                                <td><?= $user['user_gender'] ?></td>
                                                <td>
                                                    <?php
                                                    if($user['user_is_blocked']>"0"){
                                                    ?><input type="checkbox" class="is_blocked" data-id="<?= $user['user_id'] ?>" value="0" checked><?php
                                                    }else{
                                                    ?><input type="checkbox" class="is_blocked" data-id="<?= $user['user_id'] ?>" value="1"><?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('admin/user_edit?id=' . $user['user_id']) ?>" class="btn btn-sm btn-primary" title="Edit User"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url('admin/user_delete?id=' . $user['user_id']) ?>" class="btn btn-sm btn-danger" title="Delete User" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash"></i></a>
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
