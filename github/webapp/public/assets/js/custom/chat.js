var baseUrl = $('#baseUrl').val();
var apiBaseUrl = $('#apiBaseUrl').val();

/** Get chat messages */
$(document).on('click', '.get-message', function (event) {
    event.preventDefault();

    var source = $(this).attr('source');
    $('#source').val(source);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/get-message",
        type: "get",
        data: {
            source: source
        },
        success: function (res) {

            var data = JSON.parse(res);

            if (data.res_data.status == 1) {
                var html = '';
                var getChat = data.res_data.data.reverse();
                $.each(getChat, function (index, value) {

                    if(value.chat_sender_id == data.source){
                        html += '<div class="chat-user receiver">';
                            html += '<div class="chat-user-info">';
                                html += '<div class="chat-user-top">';
                                    html += '<p class="chat-user-name">'+ value.user_name +'</p>';
                                    html += '<p class="user-time">'+ value.created_at +'</p>';
                                html += '</div>';
                                html += '<div class="chat-text">';
                                    html += '<p>'+ value.chat_message +'</p>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                    }
                    else{
                        html += '<div class="chat-user sender">';
                            html += '<div class="chat-user-info">';
                                html += '<div class="chat-user-top">';
                                    html += '<p class="chat-user-name">'+ value.user_name +'</p>';
                                    html += '<p class="user-time">'+ value.created_at +'</p>';
                                html += '</div>';
                                html += '<div class="chat-text">';
                                    html += '<p>'+ value.chat_message +'</p>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                    }
                });
                $('#chat-list-data').html(html);
                scrollToBottom();
            }
            else if (data.res_data.status == 0) {
                $('#chat-list-data').html(data.res_data.message);
                not(data.message, 'error');
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});

/** send chat messages */
$(document).on('click', '#send-message', function (event) {
    event.preventDefault();

    var message = $('#chat-message').val();
    var source = $('#source').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: baseUrl + "/send-message",
        type: "post",
        data: {
            message: message,
            source: source
        },
        success: function (res) {

            var data = JSON.parse(res);

            if (data.status == 1) {

                html = '<div class="chat-user sender">';
                    html += '<div class="chat-user-info">';
                        html += '<div class="chat-user-top">';
                            html += '<p class="chat-user-name">'+ data.data[0].user_name +'</p>';
                            html += '<p class="user-time">'+ data.data[0].created_at +'</p>';
                        html += '</div>';
                        html += '<div class="chat-text">';
                            html += '<p>'+ data.data[0].chat_message +'</p>';
                        html += '</div>';
                    html += '</div>';
                html += '</div>';
                $('#chat-message').val('');
                $('#chat-message').focus();
                $('#chat-list-data').append(html);
                scrollToBottom();
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


function scrollToBottom() {
    var messages = document.getElementById('chat-list-data');
    messages.scrollTop = messages.scrollHeight;
}