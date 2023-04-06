<?php
require 'vendor/autoload.php';
$bytes = random_bytes(36);
$unicode = bin2hex($bytes);
$email = new \SendGrid\Mail\Mail();
$email->setFrom("no-reply@Newlands Pharmacy.com", "Newlands Pharmacy");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("sandeepparekh10@gmail.com", "Sandeep Parekh");
$email->addContent("text/html", "
    <h1>Magic link request</h1>
    <p>Hey Sandeep Parekh, you asked us to send you a magic link for quickly signing into your Newlands Pharmacy Website.</p>
    <a href='directlogin/" . $unicode . "'>Login Here</a>
");
$apiKey = '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';
$sendgrid = new \SendGrid($apiKey);
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo "<pre>";
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
