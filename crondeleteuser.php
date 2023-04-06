<?php
  include('include/database.php');  
  $deleteUser=$conn->prepare("DELETE FROM ogcustomer WHERE userid=''");
  $deleteUser->execute();
?>