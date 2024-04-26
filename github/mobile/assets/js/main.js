var base_url = window.location.origin + '/mobile/';
$(document).ready(function() {
  // Menu Trigger
  $('#menuToggle').on('click', function(event) {
    var windowWidth = $(window).width();
    if (windowWidth < 1010) {
      $('body').removeClass('open');
      if (windowWidth < 760) {
        $('#left-panel').slideToggle();
      } else {
        $('#left-panel').toggleClass('open-menu');
      }
    } else {
      $('body').toggleClass('open');
      $('#left-panel').removeClass('open-menu');
    }

  });
  $(".menu-item-has-children.dropdown").each(function() {
    $(this).on('click', function() {
      var $temp_text = $(this).children('.dropdown-toggle').html();
      $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
    });
  });
  // Load Resize
  $(window).on("load resize", function(event) {
    var windowWidth = $(window).width();
    if (windowWidth < 1010) {
      $('body').addClass('small-device');
    } else {
      $('body').removeClass('small-device');
    }

  });
  $('.custom-upload input[type=file]').change(function() {
    $(this).next().find('input').val($(this).val());
  });
  $('.is_blocked').on('change', function() {
    var user_id = $(this).data('id');
    var value = $(this).val();
    console.log();
    $('#modalConfirmDelete').modal('show');
    $('#hit').on('click', function() {
      $.get(base_url + "admin/user_blocked?user_id=" + user_id + "&value=" + value, function(res) {
        if (res.status > 0) {
          $('#modalConfirmDelete').modal('hide');
          location.reload();
        } else {
          $('#modalConfirmDelete').modal('hide');
          location.reload();
        }
      }, 'json')
    })
  })
});
$("#submit_category").on('click',function(e){
  e.preventDefault();
  var category_name = $("#category_name").val();
  $.post(base_url + "admin/create_category_fun",{category_name:category_name},function(res){
    if(res.status>0){
      $("#category_name").val('');
      $(".message_").html("<p style='text-align: center;padding: 22px;color: #2ec547;font-weight: 900;'>"+res.message+"</p>");
    }else{
      $(".message_").html("<p style='text-align: center;padding: 22px;color: #ff4343;font-weight: 900;'>"+res.message+"</p>");
    }
  },'json')
})
$("#submit_chargies").on('click',function(e){
  e.preventDefault();
  var dc_amount = $("#dc_amount").val();
  var dc_kg = $("#dc_kg").val();
  var dc_location = $("#dc_location").val();
  $.post(base_url + "admin/create_chargies_fun",{dc_amount:dc_amount,dc_location:dc_location,dc_kg:dc_kg},function(res){
    if(res.status>0){
      $("#dc_amount").val('');
      $("#dc_kg").val('');
      $("#dc_location").val('');
      $(".message_").html("<p style='text-align: center;padding: 22px;color: #2ec547;font-weight: 900;'>"+res.message+"</p>");
    }else{
      $(".message_").html("<p style='text-align: center;padding: 22px;color: #ff4343;font-weight: 900;'>"+res.message+"</p>");
    }
  },'json')
})
$("#order_status").on('change',function(e){
  e.preventDefault();
  var value_change = $("#order_status").val();
  var order_id = $(this).attr("data-id");
  $.post(base_url + "admin/order_status",{order_id:order_id,value_change:value_change},function(res){
    if(res.status>0){
      $(".message_").html("<p style='text-align: center;padding: 22px;color: #2ec547;font-weight: 900;'>"+res.message+"</p>");
    }else{
      $(".message_").html("<p style='text-align: center;padding: 22px;color: #ff4343;font-weight: 900;'>"+res.message+"</p>");
    }
  },'json')

})
