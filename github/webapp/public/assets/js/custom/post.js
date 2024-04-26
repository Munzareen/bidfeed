var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

// change post background color
$(document).on('click', '.post-bg-color', function(event){
    // event.preventDefault();
    var color = $(this).val();
    $('input[name="post_post_image"]').val('')
    $('#post-post').css({'background': color});
    $('#post_type').val('text');
}); 

$(document).on('change', 'input[name="post_post_image"]', function(event){
    $('.post-bg-color').prop("checked", false);
    $('#post-post').css({'background': 'none'});
    $('#post_type').val('file');
}); 

// Next button 1
$(document).on('click', '.next-btn-1', function(event){
    event.preventDefault();
    // $('#profile-2-tab').removeClass('active');
    // $('#profile-2').removeClass('active');
    // $('#profile-1-tab').addClass('active');
    // $('#profile-1').addClass('active');
});

// Previous button 1
$(document).on('click', '.previous-btn-1', function(event){
    event.preventDefault();
    
});