var oParams = {
    'host': HOST_URL,
};

var Loan = {};

// func needed in the ajaxCall func
function getParam(sParam){
   return oParams[sParam];
}

jQuery(function ($) {
    
    'use strict'

    function ltrim ( str, charlist ) { 
        charlist = !charlist ? ' \s\xA0' : (charlist+'').replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
        var re = new RegExp('^[' + charlist + ']+', 'g');
        return (str+'').replace(re, '');
    }

    
    
    // handle all forms from the submit() func
    function getForm(formname) {
        var objForm = formname.get(0);	
        var prefix = "";
        var submitDisabledElements = false;
        if (arguments.length > 1 && arguments[1] == true) {
        submitDisabledElements = true;
        }
        if (arguments.length > 2) {
        prefix = arguments[2];
        }
        var sXml = '';
        if (objForm && objForm.tagName == 'FORM') {
            var formElements = objForm.elements;		
            for(var i=0; i < formElements.length; i++){
            if (!formElements[i].name) {
                    continue;
            }
            if (formElements[i].name.substring(0, prefix.length) != prefix) {
                    continue;
            }
            if (formElements[i].type && (formElements[i].type == 'radio' || formElements[i].type == 'checkbox') && formElements[i].checked == false) {
                    continue;
            }
            if (formElements[i].disabled && formElements[i].disabled == true && submitDisabledElements == false) {
                    continue;
            }
            var name = formElements[i].name;
            if (name) {				
                    sXml += '&';
                    if(formElements[i].type=='select-multiple') {
                        for (var j = 0; j < formElements[i].length; j++) {
                        if (formElements[i].options[j].selected == true) {
                                sXml += name+"="+encodeURIComponent(formElements[i].options[j].value)+"&";
                        }
                        }
                    } else {
                        sXml += name+"="+encodeURIComponent(formElements[i].value);
                    }
            }
            }
        }	
        if (!sXml && objForm) {
            sXml += "&" + objForm.name + "="+ encodeURIComponent(objForm.value);
        }	
        return sXml;
    }

    // handle all ajax calls to server and return json if set or other

    $.fn.ajaxCall = function (sCall, sExtra = false, bNoForm = false, sType = 'GET') {
        
        var sUrl = getParam('host') +  sCall.replace(getParam('host'), '');
        var sParams;
        var headers = {};
        sParams = getForm(this);

        if (sType == 'POST' || sType == 'post') {
            headers = {
                'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
            }
        }

        if (bNoForm) {
            sParams = '';
        }    

        if (sExtra) {
            sParams += '&' + ltrim(sExtra, '&');
        }
        
        var oAjaxRequest = $.ajax({
            url: sUrl,
            type: sType,
            data: sParams,
            headers: headers
        });
        return oAjaxRequest;
    }

    $.ajaxCall = function(sCall, sExtra = false, sType = 'GET') {
        return $.fn.ajaxCall(sCall, sExtra, true, sType);
    }

    Loan.General = {
        Forms: {
            submit (element) {
                var elem = $(element);
                var form = elem.parents('form');
                elem.attr("disabled", true);
                $(".card").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
                // toastr.error('I do not think that word means what you think it means.', 'Inconceivable!')
                form.ajaxCall(form.attr('action'), null, null, 'POST').then(function (data) {
                    console.log(data);
                    if (data.app_status === true) {// Success
                        toastr['success'](data.message);
                        
                        if (data.status == 200) {
                            form.reset(); 
                        }

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
        },
        
    }

    Loan.Client = {
        submitToCyclos(element) {
            let elem = $(element);
            let id = elem.data("client-id");

            var buttonIcon = elem.find("#submit-active-button-icon");
            var saveIcon = "fa-credit-card";
            var loading = "fa-spinner fa-spin";
            var errorElem = $("#display-message");

            buttonIcon.removeClass(saveIcon).addClass(loading);
            elem.attr("disabled", true);
            $.ajaxCall('/ajax/mclient/send-to', `id=${id}`, 'POST').then(function (data) {
                // console.log(data);
                
                // alert('Agent has been Scheduled for Creation')

                if (data.app_status === true) {// Success
                    errorElem.html(data.message).removeClass("alert-danger").addClass("alert-success").removeClass("hidden");
                } else if(data.app_status === false) {// An error occured
                    errorElem.html(data.message).removeClass("alert-success").addClass("alert-danger").removeClass("hidden");
                }

                buttonIcon.addClass(saveIcon).removeClass(loading);
                elem.attr("disabled", false);
                
            }).catch(e => console.log(e));
        },
        attachDevice(element) {
            var elem = $(element);
            var container = $('#link-agent');
            // console.log(elem.attr('data-device'));
            container.attr('data-device', elem.attr('data-device'));
            container.modal('show');
        },
        detachDevice(element) {
            var elem = $(element);
            var container = $('#delink-agent');
            container.attr('data-device', elem.attr('data-device'));
            container.modal('show');
        },
        resetDevicePIN(element) {
            var elem = $(element);
            var container = $('#reset-device-pin');
            container.attr('data-device', elem.attr('data-device'));
            container.modal('show');
        }
    };

    $(document).on('change', '.check_all', function() {
        $(this).closest('.check_group').find('input[type=checkbox]').each(function() {
            if ($(this).is(':checked')) {
                $(this).attr('checked', false);
            } else {
                $(this).attr('checked', true);
            }
        });
    });

    if (jQuery().DataTable) {
        let table = $('#all-data-tables, .all-data-tables');

        let tableNoAjax = $('.all-data-tables-no-ajax');
        table.DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ordering:  true,
            ajax: getParam('host') + table.attr('data-url'),
            columnDefs: [
                { targets: -1, orderable: false},
            ]
        });

        tableNoAjax.DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }

    $(document).on('input', '.number-separator', function (e) {
        if (/^[0-9.,]+$/.test($(this).val())) {
            $(this).val(
                parseFloat($(this).val().replace(/,/g, '')).toLocaleString('en')
            );
        } else {
            $(this).val(
                $(this)
                .val()
                .substring(0, $(this).val().length - 1)
            );
        }
    });
    
});

// harness the isset() php func
function isset() {
    var a=arguments; var l=a.length; var i=0;
    if (l==0) { 
        throw new Error('Empty isset'); 
    }
    while (i!=l) {
        if (typeof(a[i])=='undefined' || a[i]===null) { 
            return false; 
        } else { 
            i++; 
        }
    }
    return true;
}