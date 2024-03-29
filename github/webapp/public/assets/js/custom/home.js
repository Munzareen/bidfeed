var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

/** Confirm Bid */
$(document).on('click', '.like-this', function(event){
    event.preventDefault();

    var source = $(this).attr('source');
    var type = $(this).attr('type');
    var this_ele = $(this);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/create-like",
        type: "post",
        data: {
            source: source,
            type: type
        },
        success: function (res) {

            var data = JSON.parse(res);

            if (data.status == 1) {
                if (this_ele.hasClass("active-like")) {
                    this_ele.removeClass("active-like");
                }
                else {
                    this_ele.addClass("active-like");
                }
                // not(data.message, 'success');
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
