var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

/** User register */
$(document).on('click', '.follow-user', function(event){
    event.preventDefault();

    $(this).attr('disabled', true);
    $('#sp-follow-user').removeClass('d-none');
    var id = $(this).attr('value'); 

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/create-follow",
        type: "POST",
        data: {
            id: id
        },
        success: function (res) {

            var data = JSON.parse(res);

            $('#sp-follow-user').addClass('d-none');
            $('#follow-user').attr('disabled', false);

            if (data.status == 1) {
                $('#follow-user').html('Following');
                not(data.message, 'success');
            }
            else if (data.status == 0) {
                not(data.message, 'error');
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});