/*  Wizard */
jQuery(function($) {
    "use strict";
    // Chose below which method to send the email, available:
    // PHPMailer text/html > phpmailer/send_email_2.php
    // PHPMailer with html template > phpmailer/send_email_2_template.php
    // PHPMailer with html template SMTP > phpmailer/send_email_2_template_smtp.php
    $('form#wrapped').attr('action', 'phpmailer/send_email_2_template.php');
    $("#wizard_container").wizard({
        stepsWrapper: "#wrapped",
        submit: ".submit",
        unidirectional: false,
        beforeSelect: function(event, state) {
            if ($('input#website').val().length != 0) {
                return false;
            }
            if (!state.isMovingForward)
                return true;
            var inputs = $(this).wizard('state').step.find(':input');
            return !inputs.length || !!inputs.valid();
        }
    }).validate({
        errorPlacement: function(error, element) {
            if (element.is(':radio') || element.is(':checkbox')){
                error.insertBefore(element.next());
            } else {
                error.insertAfter(element);
            }
        }
    });
    //  progress bar
    $("#progressbar").progressbar();
    $("#wizard_container").wizard({
        afterSelect: function(event, state) {
            $("#progressbar").progressbar("value", state.percentComplete);
            $("#location").text("" + state.stepsComplete + " of " + state.stepsPossible + " completed");
        }
    });
});