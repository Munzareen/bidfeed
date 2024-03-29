var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

/** User register */
$(document).on('click', '.add-cart', function(event){
    event.preventDefault();

    var productId = $(this).attr('product');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/add-to-cart",
        type: "get",
        data: {
            productId: productId
        },
        success: function (data) {

            if (data.status == 1) {
                $('#nav-cart-count').html(data.nav_cart_count);
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

/** Remove from cart */
$(document).on('click', '.remove-from-cart', function(e){
    e.preventDefault();
    
    var ele = $(this);
   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + '/remove-from-cart',
        type: "DELETE",
        data: {
            id: ele.attr("data-id")
        },
        success: function (data) {
            if (data.status == 1) {
                window.location.reload();
            }
            else if (data.status == 0) {
                not(data.message, 'error');
            }
        }
    });
    
});