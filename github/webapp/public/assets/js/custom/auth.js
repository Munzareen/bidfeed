var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

/** User register */
$("#register-form").submit(function (event) {
    event.preventDefault();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/user_create",
        type: "POST",
        data: $('#register-form').serialize(),
        success: function (res) {

            var data = JSON.parse(res);

            if (data.status == 1) {
                not(data.message, 'success');
                localStorage.setItem('userId', data.data.user_id);
                window.location.href = baseUrl + '/otp-verification';
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

/** Otp verification */
$("#otp-btn").click(function (event) {
    event.preventDefault();

    var otp_form = $('#otp-from').serializeArray();
    otp_form.push({ name: "user_id", value: localStorage.getItem('userId') });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/otp_verify",
        type: "POST",
        data: otp_form,
        success: function (res) {

            var data = JSON.parse(res);

            if (data.status == 1) {
                not(data.message, 'success');
                localStorage.removeItem("userId");
                window.location.href = baseUrl;
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

/** User login */
$("#login-btn").click(function (event) {
    event.preventDefault();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/login",
        type: "POST",
        data: $('#login-form').serialize(),
        success: function (res) {

            var data = JSON.parse(res);

            if (data.status == 1) {
                window.location.href = baseUrl+"/home";
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