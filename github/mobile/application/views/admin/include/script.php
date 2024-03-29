<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
<script src="<?= base_url('assets/js/init/weather-init.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script src="<?= base_url('assets/js/init/fullcalendar-init.js') ?>"></script>
<!-- PROFILE Modal -->
<div class="modal fade" id="profile_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profile_modal">Admin Profile</h5>
      </div>
      <form action="<?= base_url('admin/update_profile') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label style="font-size: 11px;">Full Name:</label>
          <input type="hidden" name="admin_id" value="<?= $this->session->userdata('admin_info')->admin_id ?>">
          <input type="text" class="form-control" name="admin_name" value="<?= $this->session->userdata('admin_info')->admin_name ?>">

          <label style="font-size: 11px;">Profile Image:</label>
          <div class="custom-upload">
            <input type="file" name="admin_profile">
            <div class="fake-file">
                <input disabled="disabled" >
            </div>
          </div>
        </div>
        <div class="modal-header">
          <h5 class="modal-title" id="profile_modal">Change Password</h5>
        </div>
        <div class="modal-body">
          <label style="font-size: 11px;">New Password:</label>
          <input type="password" class="form-control" name="new_password">

          <label style="font-size: 11px;">Confirm Password:</label>
          <input type="password" class="form-control" name="confirm_password">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- PROFILE Modal -->
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Are you sure?</p>
      </div>
      <!--Body-->
      <!-- <div class="modal-body">

        <i class="fas fa-times fa-4x animated rotateIn"></i>

      </div> -->
      <!--Footer-->
      <div class="modal-footer flex-center">
        <button class="btn btn-outline-success" id="hit">Yes</button>
        <button class="btn btn-outline-success" data-dismiss="modal">No</button>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->
