/**
 *Mails quote to client.
 */

$(document).ready(function(){
    var send_mail_url = 'http://192.168.1.162/kejamove/app/mail_client';
    var email_input = $('#email_txt');
    email_input.on('change keyup focusout', function(){
        isEmail(email_input.val()) ? $('#send_mail').removeAttr('disabled') : $('#send_mail').attr('disabled', true);
    });

    $('#send_mail').click(function(){

        var $btn = $(this).button('loading');
        //get the form data
        var request_details = {
            'house_cleaning': $('input[name=house_cleaning]:checked').val(),
            'interior_decorator': $('input[name=interior_decorator]:checked').val(),
            'email_address': $('input[name=client_email]').val(),
            'user_id': $('input[name=user_id]').val(),
            'request_id': $('input[name=request_id]').val(),
            'house_size': $('input[name=house_size]').val()
        };
        //send the data via ajax
        $.ajax({
            type: 'post',
            url: send_mail_url,
            data: request_details,
            dataType: 'json'
        })
            .done(function(data){
                $btn.button('reset');
                $btn.addClass('hidden');
                $('#sent').removeClass('hidden');
            });
    });

    //email validation
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
});

