
<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BIDFEED Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://www.bitfeed.qlogictechnologies.com/webapp/public/assets/images/header-logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/cs-skin-elastic.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
    	body{
    		background:url("<?= base_url('assets/images/background_image.png') ?>") center top no-repeat fixed #e0c1e6;
    		color:#fff;
    		font-family: arial;
    	}
    </style>
</head>
<body>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?= base_url('assets/images/main_logo.png') ?>" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action="<?= base_url('admin/login_fun') ?>" method="post">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Email" name="admin_email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="admin_password" required>
                        </div>
                        <div class="checkbox">
                            <label class="pull-right">
                                <a href="<?= base_url('admin/forgot_password') ?>">Forgot Password?</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <br><br>
                        <div class="alert <?= $this->session->flashdata('message')['admin_status'] ?>" role="alert">
                          <?= $this->session->flashdata('message')['admin_message'] ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
