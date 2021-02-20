<?php

include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);
if(isset($_POST["invId"])) {
    $invId = $_POST["invId"];
    $qry = $conexion->query("SELECT * FROM customer WHERE invId = ".$invId." ");

    while ($row = $qry->fetch_assoc()) {              
        $update = "UPDATE items SET pQuantity = pQuantity + '".$row['pQty']."', pCost = '".$row['inCost']."' WHERE pId = '".$row['pId']."' ";
        $execute = $conexion->query($update) or die(mysqli_error($conexion));        
    }
    $delete = "DELETE FROM customer WHERE invId = ".$invId." ";
    $qryd = $con->query($delete) or die(mysqli_error($con));
   
}
exit;
?>