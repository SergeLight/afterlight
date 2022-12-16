import ajaxRequest from "./classes/ajaxRequest";
import "jquery-validation"

let returnFormError = function(errorObject, FrontEndVal = false){
    Object.entries(errorObject).map(item => {
        let className = item[0];
        let message = FrontEndVal ? item[1] : item[1][0]
        $('.error-'+className).text(message).show();
    })
}

$(function() {

    $(document).on('keyup', '.form-input', function () {
        let id = $(this).attr('id');
        $('.error-'+id).hide();
    });


    $(document).on('click', '.change-auth', function () {
        let changeTo = $(this).data('change-to');
        $('.auth-wrapper').hide();
        $('.'+changeTo+'-wrap').show();
    });

    $(document).on('submit', '#register-user-form', function (e) {

        e.preventDefault();
        let data = $('#register-user-form').serializeArray();

        ajaxRequest.post(data, '/register-submit')
        .done(function(json){

            if(json.hasOwnProperty('login') && json.login === 'success'){
                window.location.href = '/wall'
            }else if(json.hasOwnProperty('error')){
                returnFormError(json.error)
            }else if(json.hasOwnProperty('authError')){
                $('.default-message').text(json.authError).show()            }
        });
    });

    $('#register-user-form').validate({
        focusCleanup: true,
        errorElement: 'span',
        rules: {
            username: {
                required: true,
                minlength: 5,
                maxlength: 50,
                validateAlphaNumeric: true
            },
            email: {
                required: true,
                minlength: 5,
                maxlength: 50,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 50,
            },
            password_confirm:{
                equalTo: "#password"
            }
        },
        showErrors: function(errorMap) {
            returnFormError(errorMap, true);
        },
        submitHandler: function() {
            let data = $('#register-user-form').serializeArray();

            ajaxRequest.post(data, '/register-submit')
            .done(function(json){

                if(json.hasOwnProperty('login') && json.login === 'success'){
                    window.location.href = '/wall'
                }else if(json.hasOwnProperty('error')){
                    returnFormError(json.error)
                }else if(json.hasOwnProperty('authError')){
                    $('.default-message').text(json.authError).show()
                }
            });
        }
    });


    $('#login-user-form').validate({
        focusCleanup: true,
        errorElement: 'span',
        rules: {
            username_login: {
                required: true,
                minlength: 5,
                maxlength: 50,
                validateAlphaNumeric: true
            },
            password_login: {
                required: true,
                minlength: 6,
                maxlength: 50,
            }
        },
        showErrors: function(errorMap) {
            returnFormError(errorMap, true);
        },
        submitHandler: function() {
            let data = $('#login-user-form').serializeArray();

            ajaxRequest.post(data, '/login-submit')
            .done(function(json){

                if(json.hasOwnProperty('login') && json.login === 'success'){
                    window.location.href = '/wall'
                }else if(json.hasOwnProperty('error')){
                    returnFormError(json.error)
                }else if(json.hasOwnProperty('authError')){
                    $('.default-message').text(json.authError).show()
                }
            });
        }
    });

    $.validator.addMethod("validateAlphaNumeric", function (input) {
        return input.match(/^[a-zA-Z0-9_]+$/);
    }, 'Please use letters and numbers only');
});

