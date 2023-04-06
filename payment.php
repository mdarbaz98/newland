<?php 
    $invid = $_GET['invoiceId'];
    
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
        }
        
        iframe {
            width: 60%;
            border: 0px;
            height: 100vh;
            overflow-x: hidden !important;
            overflow-y: hidden !important;
            display: block;
            margin: 25px auto 0 auto;
        }
    </style>
</head>
<body>

<iframe src="https://kawaitoys.com/payment.php?invid=<?php echo $invid ?>" height="200" width="300" title="Iframe Example"></iframe>

</body>
</html>
