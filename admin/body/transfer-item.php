<?php

include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);
if(isset($_POST["pId"])) {
    $pId = $_POST["pId"];
    $store_receive = $_POST["store_receive"];
    $qty_send = $_POST["qty_send"];

    $qry = mysqli_fetch_object($conexion->query("SELECT * FROM items WHERE pId = ".$pId." AND `pEnable` = '1' AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." "));
    $qry_items = $conexion->query("SELECT * FROM items WHERE idAux = ".$qry->idAux." AND `pEnable` = '1' AND `shId` = ".$_SESSION['shId']." ");
    while ($row = $qry_items->fetch_assoc()) {
        if ($row['idStore'] == $_SESSION['idStore']){
            $update = "UPDATE items SET pQuantity = pQuantity - '".$qty_send."' WHERE pId = '".$row['pId']."'AND `shId` = ".$_SESSION['shId']." ";
            $execute = $conexion->query($update) or die(mysqli_error($conexion));
        }
        if ($row['idStore'] == $store_receive){
            $price = $row['pPrice'];
            if ($price == 0) {
                $price = $qry->pPrice;
            }
            $newCostItems = ( ($row['pQty'] * $row['inCost']) + ($qty_send * $qry->pCost) ) / ($row['pQty'] + $qty_send);             
            $update = "UPDATE items SET pQuantity = pQuantity + '".$qty_send."', pCost = '".round($newCostItems)."', pPrice = '".$price."' WHERE pId = '".$row['pId']."'AND `shId` = ".$_SESSION['shId']." ";
            $execute = $conexion->query($update) or die(mysqli_error($conexion));  
        }
    }
   
}
exit;
?>