<?php

include('../autoloadfunctions.php');
// include('../vendor/autoload.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if(isset($_POST["userid"])) {

    $invId = $_POST['userid'];
    $qry = $conexion->query("SELECT * FROM orders WHERE invId = ".$invId." AND `pId` != 0 AND `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' ");
    $numItems =  $qry->num_rows;
    $qrydata = mysqli_fetch_object($conexion->query("SELECT invId, cId, SUM(pMount) AS venta, cPayment FROM orders WHERE invId = ".$invId." AND `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' GROUP BY cId"));
    $qrysaldo = mysqli_fetch_object($conexion->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment FROM `orders` WHERE `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' GROUP BY invId) AS subquery WHERE cId = '$qrydata->cId' AND invId BETWEEN 0 AND '$invId' "));

    $result = getCategoryNameById($qrydata->cId);
    $Fecha = getFecha($invId);                                                
    $fechaInvoice = fechaCastellano($Fecha->bDate);
    $horaInvoice = horaCastellano($Fecha->bDate);
    $subTotalInvoice = getAllCustomersByInvId($invId);
    $saldoOldInvoice =  $qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado) - $subTotalInvoice;
    $totalInvoice =  $qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado);
    $abonaInvoice =  $qrydata->cPayment;
    $newSaldoInvoice =  $qrysaldo->total - $qrysaldo->pagado;
    // $imeis = getIdClienteByInvId($invId);
    // $imeisInvoice = $imeis->inSerial;  

    $response = "<div class='row' style='font-size:12px; margin-left:10px;'>
    <div class='col-sm-6 invoice-col'>    
    <b>Factura No.: </b>".$invId."<br>    
    <b>Fecha: </b>".$fechaInvoice."<br/>
    <b>Hora: </b>". $horaInvoice."<br/>    
    <input type='hidden' id='numInvoice' value='".$invId."'>
    </div>
    <div class='col-sm-6 invoice-col'>    
    <b>Cliente: </b>".$result->cName."<br/>
    <b>Documento: </b>".$result->cDoc."<br/>
    <b>Celular: </b>".$result->cTelf."<br/>
    <input type='hidden' id='numItems' value='".$numItems."'>
    </div>
    </div>";

    $response .= "<div class='col-sm-12' style='margin-top: 15px;'>";
    $response .= "<table class='table table-hover' border='0' width='100%'>";
    $response .= "<thead style='display: block;'>
    <tr>                                
    <th style='width:45%'>Producto</th>                                
    <th style='width:10%; text-align:right'>Cant.</th>
    <th style='width:20%; text-align:right'>Vr. Unit.</th>
    <th style='width:25%; text-align:right'>Vr. Total</th>
    </tr>
    <tbody style='display: block; max-height: 30vh; overflow-y: auto; overflow-x: hidden;'>";

    while( $row = $qry->fetch_assoc() ){
        $id = $row['pId'];
        $item= getItemNameById($row['pId']);                                                    
        $itemName = $item->pName;
        $qty = $row['pQty'];
        $price = $row['pPrice'];
        $mount = $row['pMount'];
        $response .= "<tr>";
        $response .= "<td style='width:45%'>".$itemName."</td><td style='text-align:right; width:10%'>".$qty."</td><td style='text-align:right; width:20%'>".$price."</td><td style='text-align:right; width:25%'>".$mount."</td>";
        $response .= "</tr>";
        
    }
    $response .= "</tbody>    
    </table>
    <div class='col-sm-6 invoice-col'>    
    <b>SubTotal: </b>$".numMiles($subTotalInvoice)."<br>    
    <b>Saldo Anterior: </b>$".numMiles($saldoOldInvoice)."<br>
    <b>Total: </b>$".numMiles($totalInvoice)."<br>
    </div>
    <div class='col-sm-6 invoice-col'>    
    <b>Abonó: </b>$".numMiles($abonaInvoice)."<br>
    <b>Nuevo Saldo: </b>$".numMiles($newSaldoInvoice)."<br>    
    </div>
    </div>";

    echo $response;
}
exit;

?>