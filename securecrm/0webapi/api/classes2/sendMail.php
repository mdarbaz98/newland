<?php
    require_once('vendor/autoload.php');
    function sendGridMailSender($sub, $to, $name, $msg){
        $emails1 = new \SendGrid\Mail\Mail();
        $emails1->setFrom("order@oneglobalpharma.com", "Newlands Pharmacy");
        $emails1->setSubject($sub);
        $emails1->addTo($to, $name);
        $emails1->addContent("text/html", $msg);
        // $emails1->addAttachment(
        //   $file_encoded,
        //   "application/pdf",
        //   "test.pdf",
        //   "attachment"
        // );
        $apiKey = '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';
        $sendgrid = new \SendGrid($apiKey);
        try
        {
            $response = $sendgrid->send($emails1);
            // print_r($response);
        }
        catch(Exception $e)
        {
            echo "<pre>";
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
    
?>
