var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

/** Confirm Bid */
$(document).on('click', '#confirm-bid', function(event){
    event.preventDefault();

    var productId = $(this).attr('product');
    var amount = $('.pp_price').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/create-bid",
        type: "post",
        data: {
            productId: productId,
            amount: amount
        },
        success: function (res) {

            var data = JSON.parse(res);

            if (data.status == 1) {
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
