<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Quotare - Multipurpose Quotation Request HTML Wizard Form">
    <meta name="author" content="Ansonika">
    <title>Quotare - Multipurpose Quotation Request HTML Wizard Form</title>

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="../css/custom.css" rel="stylesheet">
    
    <script type="text/javascript">
    function delayedRedirect(){
        window.location = "../index.html"
    }
    </script>
</head>

<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';

$mail = new PHPMailer(true);

try {

    //Recipients - main edits
    $mail->setFrom('info@quotare.com', 'Message from Quotare');                  // Email Address and Name FROM
    $mail->addAddress('jhon@quotare.com', 'Jhon Doe');                           // Email Address and Name TO - Name is optional
    $mail->addReplyTo('noreply@quotare.com', 'Message from Quotare');            // Email Address and Name NOREPLY
    $mail->isHTML(true);                                                       
    $mail->Subject = 'Message from Quotare';                                     // Email Subject

    //The email body message
    $message = "<strong>Details</strong><br />";
    $message .= "Which SEO Service do you need:<br />";
                foreach($_POST['seo_services'] as $value) 
                    { 
                        $message .=   "- " .  trim(stripslashes($value)) . "<br />"; 
                    };
    $message .= "<br />Have you done any SEO/SEM work in the past: " . $_POST['seo_work'] . "<br />";
    $message .= "Do you have a website: " . $_POST['website_available'] . "<br />";
    $message .= "Keywords to rank: " . $_POST['keywords'] . "<br />";

    $message .= "<br />What is your Budget: " . $_POST['budget_slider'] . "<br />";

    $message .= "<br /><strong>User Details</strong><br />";
    $message .= "First and Last name: " . $_POST['first_last_name'] . "<br />";
    $message .= "Email: " . $_POST['email'] . "<br />";
    $message .= "Website: " . $_POST['website_user'] . "<br />";

    // Get the email's html content
    $email_html = file_get_contents('template-email.html');

    // Setup html content
    $body = str_replace(array('message'),array($message),$email_html);
    $mail->MsgHTML($body);

    $mail->CharSet = 'UTF-8'; //Force UTF for special characters

    $mail->send();

    // Confirmation/autoreplay email send to who fill the form
    $mail->ClearAddresses();
    $mail->addAddress($_POST['email']); // Email address entered on form
    $mail->isHTML(true);
    $mail->Subject    = 'Confirmation'; // Custom subject
    
    // Get the email's html content
    $email_html_confirm = file_get_contents('confirmation.html');

    // Setup html content
    $body = str_replace(array('message'),array($message),$email_html_confirm);
    $mail->MsgHTML($body);

    $mail->CharSet = 'UTF-8'; //Force UTF for special characters

    $mail->Send();

    echo '<div id="success">
            <div class="icon icon--order-success svg">
                 <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                  <g fill="none" stroke="#8EC343" stroke-width="2">
                     <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                     <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                  </g>
                 </svg>
             </div>
            <h4><span>Request successfully sent!</span>Thank you for your time</h4>
            <small>You will be redirect back in 5 seconds.</small>
        </div>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    
?>
<!-- END SEND MAIL SCRIPT -->    

</body>
</html>