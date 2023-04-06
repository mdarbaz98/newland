<?php
error_reporting(1);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
if (strpos($actual_link, 'newlandpharmacy') OR strpos($actual_link, 'oneglobalpharma') OR strpos($actual_link, 'oneglobalpharma')) {
	$db_host="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com"; 
	$db_user="root";
	$db_name="global";
	$db_password="Iamawesome8425";
}elseif(strpos($actual_link, 'localhost')) {
	$db_host="localhost"; 
	$db_user="root";
	$db_name="global";
	$db_password="";
}else {
	$db_host="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com"; 
	$db_user="root";
	$db_name="global";
	$db_password="Iamawesome8425";
}
try
{
	$conn=new PDO("mysql:host={$db_host};dbname={$db_name};port=3306",$db_user,$db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


  </head>
  <body>

    <table class="table table-bordered">
        <thead>
            <th scope="col">Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Strength</th>
            <th scope="col">Quantity</th>
        </thead>
        <tbody>
            <?php
            $id = 0;
            $getProduct = $conn->prepare("SELECT productCode, productName FROM ogproduct WHERE productStatus='active' ORDER BY productName ASC");
            $getProduct->execute();
            while ($row = $getProduct->fetch(PDO::FETCH_ASSOC)) {
                
                $getStrength = $conn->prepare("SELECT strengthName, strengthCode FROM ogstrength WHERE strengthStatus='active' AND productCode=? ORDER BY strengthName ASC");
                $getStrength->execute([$row['productCode']]);
                while ($srow = $getStrength->fetch(PDO::FETCH_ASSOC)) {
                    $getQty = $conn->prepare("SELECT quantity FROM ogquantity WHERE qtyStatus='active' AND strengthCode=? ORDER BY quantity ASC");
                    $getQty->execute([$srow['strengthCode']]);
                    $qty = array();
                    while ($qrow = $getQty->fetch(PDO::FETCH_ASSOC)) {
                        array_push($qty, $qrow['quantity']);
                    }
                    $listq = implode(",",$qty);
                    ++$id;
            ?>  
            
                
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $row['productName'] ?></td>
                    <td><?php echo $srow['strengthName'] ?></td>
                    <td><?php echo $listq; ?></td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
