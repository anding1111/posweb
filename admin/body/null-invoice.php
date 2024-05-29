<?php

include('../../autoloadfunctions.php');
// Null only invoice, but quotations non null
$con = new mysqli($server_db, $user_db, $password_db, $database_db);
if (isset($_POST["invId"])) {
    $invId = $_POST["invId"];
    $qry = $conexion->query("SELECT * FROM orders WHERE invId = " . $invId . " AND `orEnable` = '1' AND `shId` = " . $_SESSION['shId'] . " AND `idStore` = " . $_SESSION['idStore'] . " ");

    while ($row = $qry->fetch_assoc()) {
        $itemStored = getItemNameById($row['pId']);
        $newQty = ($row['pQty'] + $itemStored->pQuantity);
        if ($newQty == 0) {
            $newQty = 1;
        }
        $newCostItems = (($row['pQty'] * $row['inCost']) + ($itemStored->pQuantity * $itemStored->pCost)) / $newQty;
        $update = "UPDATE items SET pQuantity = pQuantity + '" . $row['pQty'] . "', pCost = '" . round($newCostItems) . "' WHERE pId = '" . $row['pId'] . "'AND `shId` = " . $_SESSION['shId'] . " AND `idStore` = " . $_SESSION['idStore'] . " ";
        $execute = $conexion->query($update) or die(mysqli_error($conexion));
    }
    $update = "UPDATE orders SET `orEnable` = 0 WHERE `invId` = " . $invId . " AND `orEnable` = '1' AND  `shId` = " . $_SESSION['shId'] . " AND `idStore` = " . $_SESSION['idStore'] . " ";
    $qryd = $con->query($update) or die(mysqli_error($con));
}
exit;
