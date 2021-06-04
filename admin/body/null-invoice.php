<?php

include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);
if(isset($_POST["invId"])) {
    $invId = $_POST["invId"];
    $qry = $conexion->query("SELECT * FROM orders WHERE invId = ".$invId." AND `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' ");

    while ($row = $qry->fetch_assoc()) { 
        $itemStored = getItemNameById($row['pId']);
        $newCostItems = ( ($row['pQty'] * $row['inCost']) + ($itemStored->pQuantity * $itemStored->pCost) ) / ($row['pQty'] + $itemStored->pQuantity);             
        $update = "UPDATE items SET pQuantity = pQuantity + '".$row['pQty']."', pCost = '".$newCostItems."' WHERE pId = '".$row['pId']."'AND `shId` = '".$_SESSION['shId']."' ";
        $execute = $conexion->query($update) or die(mysqli_error($conexion));        
    }
    $update = "UPDATE orders SET `orEnable` = 0 WHERE `invId` = ".$invId." AND `orEnable` = '1' AND  `shId` = '".$_SESSION['shId']."' ";
    $qryd = $con->query($update) or die(mysqli_error($con));
   
}
exit;
?>