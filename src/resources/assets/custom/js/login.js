$(function () {
    Loan.login = {
        loginUser(element) {
            var elem = $(element);
            var form = elem.parents('form');
            elem.attr("disabled", true);
            $(".login-box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
            form.ajaxCall('/login/user', null, null, 'POST').then(function (data) {
                console.log(data);
                if (data.app_status === true) {// Success
                    toastr['success'](data.message);

                    if (data.status == 301) {
                        window.location = data.redirect_url;
                    }
                } else if(data.app_status === false) {// An error occured
                    toastr["error"](data.message)
                }
                $(".overlay").remove();
                elem.attr("disabled", false);
            });
            
            return false;
        },

        resetPassword(element) {
            var elem = $(element);
            var form = elem.parents('form');
            elem.attr("disabled", true);
            $(".login-box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
            form.ajaxCall('reset/password', null, null, 'POST').then(function (data) {
                console.log(data);
                if (data.app_status === true) {// Success
                    toastr['success'](data.message);

                    if (data.status == 301) {
                        window.location = data.redirect_url;
                    }
                } else if(data.app_status === false) {// An error occured
                    toastr["error"](data.message)
                }
                $(".overlay").remove();
                elem.attr("disabled", false);
            });
            
            return false;
        },
        changePassword(element) {
            var elem = $(element);
            var form = elem.parents('form');
            elem.attr("disabled", true);
            $(".login-box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
            form.ajaxCall('reset/change-password', null, null, 'POST').then(function (data) {
                console.log(data);
                if (data.app_status === true) {// Success
                    toastr['success'](data.message);

                    if (data.status == 301) {
                        window.location = data.redirect_url;
                    }
                } else if(data.app_status === false) {// An error occured
                    toastr["error"](data.message)
                }
                $(".overlay").remove();
                elem.attr("disabled", false);
            });
            
            return false;
        }
    };
});