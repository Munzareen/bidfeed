<?php include('include/head.php');?>
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
                                <h1><?= $head_title ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Admin Control</a></li>
                                    <li><a href="#">User</a></li>
                                    <li class="active"><?= $head_title ?></li>
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
                          <div class="card-body">
                            <form action="<?= base_url('admin/user_update') ?>" method="post" enctype="multipart/form-data">
                                <label for="user_name">Name</label>
                                <input type="text" name="user_name" class="form-control" required value="<?= $user_obj->user_name ?>">

                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" disabled value="<?= $user_obj->user_email ?>">

                                <label for="user_dob">Date of Birth</label>
                                <input type="Date" name="user_dob" class="form-control" required value="<?= $user_obj->user_dob ?>">

                                <label for="user_phone">Phone No</label>
                                <input type="text" name="user_phone" class="form-control" required value="<?= $user_obj->user_phone ?>">

                                <label for="user_gender">Gender</label>
                                <select name="user_gender" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="male" <?php if($user_obj->user_gender == 'male'){ echo "selected"; }  ?>>Male</option>
                                    <option value="female" <?php if($user_obj->user_gender == 'female'){ echo "selected"; }  ?>>Female</option>
                                    <option value="other" <?php if($user_obj->user_gender == 'other'){ echo "selected"; }  ?>>Other</option>
                                </select>

                                <label for="user_image">Profile Image</label>
                                <input type="file" name="user_image" class="form-control">
                                <input type="hidden" name="user_id" value="<?= $user_obj->user_id ?>">
                                <input style="float:right;margin-top:05px;" type="submit" class="btn btn-success" name="" value="Submit">
                            </form>
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
</body>
</html>
