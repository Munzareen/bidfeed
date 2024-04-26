<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- <li class="active">
                    <a href="<?= base_url('admin/dashboard') ?>"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                </li> -->
                <li class="menu-title">ADMIN CONTROL</li><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>USER</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/user_listing') ?>">User Listing</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bank"></i>BANK MANAGEMENT</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/transaction') ?>">Transaction</a></li>
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/user_withdraw') ?>">User Withdraw</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>CONTENT</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/content?type=tc') ?>">Terms & Conditions</a></li>
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/content?type=pp') ?>">Privacy Policy</a></li>
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/content?type=faqs') ?>">FAQs</a></li>
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/content?type=contact') ?>">Contact</a></li>
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/content?type=about') ?>">About</a></li>
                        <li><i class="fa fa-share"></i><a href="<?= base_url('admin/content?type=rp') ?>">Return Policy</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
