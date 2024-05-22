$(document).ready(function() {
    
    if($('#companies').length) {
        $('#companies').DataTable();
    }

    if($('#seekers').length) {
        $('#seekers').DataTable();
    }

    if($('#jobs').length) {
        $('#jobs').DataTable();
    }

    //Create or Edit of Cron File
    if ( $('#admin-login').length > 0 ) {
        $('#admin-login').bootstrapValidator({
            live: 'enabled',
            excluded: [':disabled'],
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                adminUsername: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your username'
                        }
                    }
                },
                adminPassword: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your password'
                        }
                    }
                }
            }
        }).on('status.field.bv', function(e, data) {
            data.bv.disableSubmitButtons(false);
        }).on('success.form.bv', function(e, data) {
            e.preventDefault();

            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function(result) {
                if ( result.status == 0 ) {
                    NotifyAlert(result.text);
                    $form.bootstrapValidator('resetForm', true);
                    $('#SetCronModal').modal('hide');
                } else {
                    window.location.href = admin + "dashboard.php";
                }
            }, 'json');
        });
    }
    // End of the script  
    
});
//End of document ready

function NotifyAlert(message) {
    $.notify({
        message: message,
        icon: 'fa fa-circle',
    }, {
        allow_dismiss: false,
        placement: {
            from: 'bottom',
            align: 'left'
        },
        offset: {
            x: 100,
            y: 50
        },
        z_index: 9999,
        template: '<div data-notify="container" class="notify-box alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });
}
// End of the script