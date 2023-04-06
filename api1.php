<?php
    header("Content-type:application/json");
    $con = mysqli_connect("localhost", "globa7ox_oneglobalbrandnew", "#[JZYJ,N?[mV", "globa7ox_oneglobalbrandnew");

    if(!$con) {
        die('Could not connect: '.mysqli_error());
    }

    $result = mysqli_query($con, "SELECT * FROM ogquantity");

    while($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    print(json_encode($output, JSON_PRETTY_PRINT));

    mysqli_close($con);
?>