<?php

header('Content-type: application/json');
function response($message = "", $success = 1) {
    $status = $success ? 'success' : 'error';

    $response_array = array('message' => $message, 'status' => $status);

    die(json_encode($response_array));
}
$subject = "";
$fullname = "";
$email = "";
$message = "";

if(isset($_POST['subject'])){
	$subject = htmlspecialchars($_POST['subject']);

}
if(isset($_POST['fullname']))
    $fullname = htmlspecialchars($_POST['fullname']);

if(isset($_POST['email']))
    $email = htmlspecialchars($_POST['email']);

if(isset($_POST['message']))
    $message = htmlspecialchars($_POST['message']);

if($subject == '' || $fullname == '' || $email == '' || $message == '') {
    response('Please review all the fields and then try to submit again.', 0);
}
$headers  = "From: noreply@youremailaddress.com\n";
$headers .= 'X-Mailer: PHP/' . phpversion();
$headers .= "X-Priority: 1\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\n";

$to = 'youremailaddress@youremailaddress.com'; // Your email here

$body = "This is contact form Gaia template <br><br>Subject: $subject <br> Name: $fullname <br> E-Mail: $email <br> Message: \n $message";

if (mail($to, "New message from Gaia template - {$subject}", $body, $headers)) {
	response('Thanks for contacting us. We\'ll respond as soon as possible.', 1);
}

response('Something bad happened. Please try again later.', 0);
