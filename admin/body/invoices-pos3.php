<?php
$invId = $_GET['invId'];
$type = $_GET['type'];

$loggedInShop = $_SESSION['shId'];

$getPrevNext = $conexion->query("SELECT * FROM orders 
    WHERE ( 
            invId = IFNULL((SELECT MIN(invId) FROM orders WHERE invId > " . $invId . " AND `pId` != 0 AND orEnable = 1 AND shId = " . $loggedInShop . " AND idStore = " . $_SESSION['idStore'] . ")," . $invId . ") 
            OR  invid = IFNULL((SELECT MAX(invId) FROM orders WHERE invId < " . $invId . " AND `pId` != 0 AND orEnable = 1 AND shId = " . $loggedInShop . " AND idStore = " . $_SESSION['idStore'] . ")," . $invId . ")
          ) AND shId = " . $loggedInShop . " AND idStore = " . $_SESSION['idStore'] . " GROUP BY invID ASC;");
$data = array();
while ($row = $getPrevNext->fetch_row()) {
    $data[] = $row[1];
}

$qry = $conexion->query("SELECT * FROM orders WHERE invId = " . $invId . " AND `pId` != 0 AND `orEnable` = '" . $type . "' AND `shId` = '" . $loggedInShop . "' ");
$numItems =  $qry->num_rows;
$qrydata = mysqli_fetch_object($conexion->query("SELECT invId, cId, SUM(pMount) AS venta, cPayment, idSeller FROM orders WHERE invId = " . $invId . " AND  `orEnable` = '" . $type . "' AND shId = '" . $loggedInShop . "' GROUP BY cId"));
$qrysaldo = mysqli_fetch_object($conexion->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment, shId, orEnable FROM `orders` WHERE `shId` = '" . $loggedInShop . "' AND `orEnable` = '" . $type . "' GROUP BY invId) AS subquery WHERE cId = '$qrydata->cId' AND shId = '" . $loggedInShop . "' AND `orEnable` = '" . $type . "' AND invId BETWEEN 0 AND '$invId' "));

$typeInvoice = $shop->shInvoiceType;
if ($typeInvoice == 0) $typeName = "Factura";
elseif ($typeInvoice == 1) $typeName = "Recibo";
elseif ($typeInvoice == 2) $typeName = "Remision";
else $typeName = "Salida de Almacen";
if ($type == 3) $typeName = "Cotización";

$viewCredits = $_SESSION['shViewCredits'];
?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default w3-card-4">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <div class="table" style="background-color: white;" id="printers">
                        <!-- Header -->
                        <div class="col-sm-12 invoice-col header-rigth" style="text-align:center;">
                            <img id="logoEmpresa" src="<?php echo $shop->shLogo; ?>" data-print="1" style="max-height:100px; max-width:100%;" /><br>
                            <b style="font-size:22px; font-family:Helvetica, Arial, sans-serif;"><span id="printShopName"><?php echo $shop->shName ?></span></b><br>
                            <b style="font-size:16px; font-family:Helvetica, Arial, sans-serif;"><span id="printShopDesc"><?php echo $shop->shDesc ?></span></b><br>
                            <b style="font-size:12px;">NIT. <span id="printShopDoc"><?php echo $shop->shDoc ?></span></b><br>
                            <b style="font-size:12px;"><span id="printShopDir"><?php echo $shop->shDir ?></span></b><br>
                        </div>

                        <!-- Info Cliente -->
                        <div class="row invoice-info" style="font-size:12px;">
                            <div class="col-sm-6 invoice-col" id="ocultar">
                                <br>
                                <span id="InvoiceType"><b><?php echo $typeName; ?> No.: </b></span><span id="printFacturaNum"><?php echo $invId . '<br/>'; ?></span>
                                <span id="printFacturaFech"><?php
                                    if ($type == 1) $Fecha = getFecha($invId);
                                    else $Fecha = getFechaQuot($invId);
                                    echo fechaCastellano($Fecha->bDate) . '<br/>'; ?></span>
                                <b>Hora: </b><span id="printFacturaHor"><?php echo horaCastellano($Fecha->bDate) . '<br/>'; ?></span>
                                <b>Cliente: </b><span id="printFacturaClient"><?php $result = getClientNameById($qrydata->cId); echo $result->cName . '<br/>'; ?> </span>
                                <b>Documento: </b><span id="printFacturaDoc"><?php echo $result->cDoc . '<br/>'; ?> </span>
                                <b>Celular: </b><span id="printFacturaCel"><?php echo $result->cTelf . '<br/>'; ?> </span>
                                <b>Dirección: </b><span id="printFacturaDir"><?php echo $result->cDir . '<br/>'; ?> </span>
                                <input type="hidden" id="numItems" value="<?php echo ($numItems); ?>" class="form-control">
                            </div>
                        </div>

                        <!-- Tabla Productos -->
                        <table class="table table-hover" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th style="text-align:right">Cant.</th>
                                    <th id="ocultar" style="text-align:right">Vr. Unit.</th>
                                    <th style="text-align:right">Vr. Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($numItems > 0) {
                                    while ($row = $qry->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php $pId = getItemNameById($row['pId']); echo $pId->pName; ?></td>
                                            <td style="text-align:right"><?php echo (numMiles($row['pQty'])); ?></td>
                                            <td style="text-align:right"><?php echo (numMiles($row['pPrice'])); ?></td>
                                            <td style="text-align:right"><?php echo (numMiles($row['pMount'])); ?></td>
                                        </tr>
                                <?php }
                                } else {
                                    echo '<tr><td colspan="4">Abono</td></tr>';
                                } ?>

                                <!-- Totales -->
                                <tr>
                                    <td colspan="3" style="text-align:right"><br><span id="typeOrder"><b><?php echo ($viewCredits == 0 ? "Total:" : "SubTotal:"); ?> </b></span></td>
                                    <td id="printSubTotal" style="text-align:right"><br> <b>$<?php
                                        if ($type == 3) {
                                            $total = getAllQuotationsByInvId($invId);
                                            echo (numMiles($total));
                                        } else {
                                            $total = getAllOrdersByInvId($invId);
                                            echo (numMiles($total));
                                        } ?> </b></td>
                                </tr>

                                <?php if ($viewCredits == 1) { ?>
                                    <tr>
                                        <td colspan="3" style="text-align:right"><b>Saldo Anterior: </b></td>
                                        <td id="printOldSaldo" style="text-align:right"><b>$<?php echo (numMiles(($qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado)) - $total)); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align:right"><b>Total: </b></td>
                                        <td id="printTotal" style="text-align:right"><b>$<?php echo (numMiles($qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado))); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align:right"><b>Abona: </b></td>
                                        <td id="printAbona" style="text-align:right"><b>$<?php echo (numMiles($qrydata->cPayment)); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align:right"><b>Nuevo Saldo: </b></td>
                                        <td id="printNewSaldo" style="text-align:right"><b>$<?php echo (numMiles($qrysaldo->total - $qrysaldo->pagado)); ?></b></td>
                                    </tr>
                                <?php } ?>

                                <!-- Observaciones -->
                                <tr>
                                    <td><b>OBSERVACIONES: </b></td>
                                    <td colspan="3" id="printSerial"><b><?php $imeis = getIdClienteByInvId($invId); print_r($imeis->inSerial); ?></b></td>
                                </tr>

                                <!-- Footer Tienda -->
                                <tr style="font-size:8px; text-align: center !important">
                                    <td colspan="4">
                                        <br><br>
                                        <b style="font-size:10px;">Atendido por: <?php echo getNameWithUserId($qrydata->idSeller); ?></b><br>
                                        <b style="font-size:10px;"><?php echo $shop->shWeb ?></b><br>
                                        <b style="font-size:8px;"> Cel. <?php echo $shop->shTelf ?></b><br>
                                        <b>Software de Facturación miPOS.pro</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- QR opcional -->
                        <div id="printQR" data-print="1" data-url="https://mipos.pro/ticket/<?php echo $invId; ?>"></div>

                    </div>
                </div>

                <!-- Botones -->
                <div class="row">
                    <div class="btn text-center" role="group" style="width:100%;">
                        <button class="btn btn-info btn-large" type="button" style="font-size:22px; width:30%;" onclick="window.location.href='./admin/buy-product.php'">SALIR</button>
                        <button class="btn btn-info btn-large" type="button" style="font-size:24px; width:30%;" id="btnImprimir">IMPRIMIR</button>
                        <button class="btn btn-info btn-large" type="button" style="font-size:22px; width:30%;" onclick="printPDF()">PDF</button>
                    </div>
                </div>

                <!-- Hidden viewCredits -->
                <input type="hidden" id="viewCredits" value="<?php echo $viewCredits; ?>" />

            </div>
        </div>
    </div>
</div>

<!-- Imprimir Recibo JavaScript -->
 <script src="../dist/js/ticket3.js"></script>
 <!-- Crea html en canvas Javascript -->
 <script src="../dist/js/html2canvas.min.js"></script>
 <!-- Exportar a PDF JavaScript -->
 <script src="../dist/js/jspdf.min.js"></script>
 <!-- Imprimir usando PrintJS -->
 <script src="../dist/js/print.min.js"></script>