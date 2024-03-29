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
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID#</th>
                                            <th>User Name</th>
                                            <th>User Phone</th>
                                            <th>User CNIC</th>
                                            <th>User Business</th>
                                            <th>Blocked</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach($user_obj as $user){
                                          ?>
                                          <tr>
                                              <td><?= $user['user_id'] ?></td>
                                              <td><?= $user['user_name'] ?></td>
                                              <td><?= $user['user_phone'] ?></td>
                                              <td><?= $user['user_cnic'] ?></td>
                                              <td><?= $user['user_business_name'] ?></td>
                                              <td>
                                                <?php
                                                if($user['user_is_blocked']>"0"){
                                                  ?><input type="checkbox" class="is_blocked" data-id="<?= $user['user_id'] ?>" value="0" checked><?php
                                                }else{
                                                  ?><input type="checkbox" class="is_blocked" data-id="<?= $user['user_id'] ?>" value="1"><?php
                                                }
                                                ?>
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
