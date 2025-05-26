 <?php
    $invId = $_GET['invId'];
    $type = $_GET['type'];
    
    //logged in shop ID
    $loggedInShop = $_SESSION['shId'];

    //Get Prev and Next ID Invoice
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

    //Determinar el número de filas del resultado
    $numItems =  $qry->num_rows;
    $qrydata = mysqli_fetch_object($conexion->query("SELECT invId, cId, SUM(pMount) AS venta, cPayment FROM orders WHERE invId = " . $invId . " AND  `orEnable` = '" . $type . "' AND shId = '" . $loggedInShop . "' GROUP BY cId"));
    $qrysaldo = mysqli_fetch_object($conexion->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment, shId, orEnable FROM `orders` WHERE `shId` = '" . $loggedInShop . "' AND `orEnable` = '" . $type . "' GROUP BY invId) AS subquery WHERE cId = '$qrydata->cId' AND shId = '" . $loggedInShop . "' AND `orEnable` = '" . $type . "' AND invId BETWEEN 0 AND '$invId' "));

    $typeInvoice = $shop->shInvoiceType;

    if ($typeInvoice == 0) {
        $typeName = "Factura";
    } elseif ($typeInvoice == 1) {
        $typeName = "Recibo";
    } elseif ($typeInvoice == 2) {
        $typeName = "Remision";
    } else {
        $typeName = "Salida de Almacen";
    }
    //Validate type order
    if ($type == 3) {
        $typeName = "Cotización";
    }
    ?>
 <div class="row">

     <div class="col-lg-6 col-lg-offset-3">
         <div class="panel panel-default w3-card-4">
             <!-- /.panel-heading -->
             <div class="panel-body">
                 <div class="dataTable_wrapper">
                     <div class="table" style="background-color: white;" id="printers">
                         <!-- info row -->
                         <div class="col-sm-12 invoice-col header-rigth" style="text-align:center;">
                             <b style="font-size:22px; font-family:Helvetica, Arial, sans-serif;"><span id="printShopName"><?php echo $shop->shName ?></span></b><br>
                             <b style="font-size:16px; font-family:Helvetica, Arial, sans-serif;"><span id="printShopDesc"><?php echo $shop->shDesc ?></span></b><br>
                             <b style="font-size:12px;">NIT. <span id="printShopDoc"><?php echo $shop->shDoc ?></span></b><br>
                             <b style="font-size:12px;"><span id="printShopDir"><?php echo $shop->shDir ?></span></b><br>
                         </div>
                         <div class="row invoice-info" style="font-size:12px;">
                             <div class="col-sm-6 invoice-col" id="ocultar">
                                 <br>
                                 <span id="InvoiceType"><b><?php echo $typeName; ?> No.: </b></span><span id="printFacturaNum"><?php echo $invId . '<br/>'; ?></span>
                                 <span id="printFacturaFech"><?php
                                                                if ($type == 1) {
                                                                    $Fecha = getFecha($invId);
                                                                } else {
                                                                    $Fecha = getFechaQuot($invId);
                                                                }
                                                                echo fechaCastellano($Fecha->bDate) . '<br/>'; ?></span>
                                 <b>Hora: </b><span id="printFacturaHor"><?php
                                                                            echo horaCastellano($Fecha->bDate) . '<br/>'; ?></span>
                                 <b>Cliente: </b><span id="printFacturaClient"><?php
                                                                                $result = getClientNameById($qrydata->cId);
                                                                                echo $result->cName . '<br/>'; ?> </span>
                                 <b>Documento: </b><span id="printFacturaDoc"><?php
                                                                                echo $result->cDoc . '<br/>'; ?> </span>
                                 <b>Celular: </b><span id="printFacturaCel"><?php
                                                                            echo $result->cTelf . '<br/>'; ?> </span>
                                 <b>Dirección: </b><span id="printFacturaDir"><?php
                                                                                echo $result->cDir . '<br/>'; ?> </span>
                                 <input type="hidden" id="numItems" value="<?php echo ($numItems); ?>" class="form-control">
                             </div>
                             <!-- /.col -->
                         </div>
                         <!-- /.row -->
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
                                 <?php
                                    if ($numItems > 0) {
                                        while ($row = $qry->fetch_assoc()) {
                                    ?>
                                         <tr>
                                             <td> <?php
                                                    $pId = getItemNameById($row['pId']);
                                                    echo $pId->pName;
                                                    ?> </td>
                                             <td style="text-align:right"> <?php
                                                                            echo (numMiles($row['pQty']));
                                                                            ?> </td>
                                             <td style="text-align:right"> <?php
                                                                            echo (numMiles($row['pPrice']));
                                                                            ?> </td>
                                             <td style="text-align:right"> <?php
                                                                            echo (numMiles($row['pMount']));
                                                                            ?> </td>
                                         </tr>
                                 <?php }
                                    } else {
                                        echo '<tr><td colspan="4">Abono</td></tr>';
                                    } ?>
                                 <tr>
                                     <td colspan="3" style="text-align:right"><br><span id="typeOrder"><b><?php echo ($type == 1 ? "SubTotal:" : "Total:"); ?> </b></span></td>
                                     <td id="printSubTotal" style="text-align:right"><br> <b>$<?php
                                                                                                if ($type == 3) {
                                                                                                    $total = getAllQuotationsByInvId($invId);
                                                                                                    echo (numMiles($total));
                                                                                                ?>
                                         </b> </td>
                                 <?php
                                                                                                } else {
                                                                                                    $total = getAllOrdersByInvId($invId);
                                                                                                    echo (numMiles($total));
                                    ?>
                                     </b> </td>
                                 </tr>
                                 <tr>
                                     <td colspan="3" style="text-align:right"><b>Saldo Anterior: </b></td>
                                     <td id="printOldSaldo" style="text-align:right"> <b>$<?php
                                                                                                    echo (numMiles(($qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado)) - $total));
                                                                                            ?> </b>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td colspan="3" style="text-align:right"><b>Total: </b></td>
                                     <td id="printTotal" style="text-align:right"> <b>$<?php
                                                                                                    echo (numMiles($qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado)));
                                                                                        ?> </b>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td colspan="3" style="text-align:right"><b>Abona: </b></td>
                                     <td id="printAbona" style="text-align:right"> <b>$<?php
                                                                                                    echo (numMiles($qrydata->cPayment));
                                                                                        ?> </b>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td colspan="3" style="text-align:right"><b>Nuevo Saldo: </b></td>
                                     <td id="printNewSaldo" style="text-align:right"> <b>$<?php
                                                                                                    echo (numMiles($qrysaldo->total - $qrysaldo->pagado));
                                                                                            ?> </b>
                                     </td>
                                 </tr>
                             <?php } ?>
                             <tr>
                                 <td><b>OBSERVACIONES: </b></td>
                                 <td colspan="3" id="printSerial"> <b>
                                         <?php
                                            $imeis = getIdClienteByInvId($invId);
                                            print_r($imeis->inSerial);
                                            ?> </b>
                                 </td>
                             </tr>
                             <tr style="font-size:8px; text-align: center !important">
                                 <td colspan="4">
                                     <br>
                                     <br>
                                     <b style="font-size:10px;">Atendido por: <?php echo getLoggedInUserName(); ?> </b>
                                     <br>
                                     <b style="font-size:10px;"><?php echo $shop->shWeb ?> </b>
                                     <br>
                                     <b style="font-size:8px;"> Cel. <?php echo $shop->shTelf ?></b>
                                     <br>
                                     <b>Software de Facturación miPOS.pro</b>
                                 </td>
                             </tr>
                             </tbody>
                         </table>
                         <div id="img"></div>

                     </div>
                     <div class="row">
                         <div class="btn text-center" role="group" style="width:100%;">
                             <button class="btn btn-info btn-large" type="button" style="font-size:22px; width:30%;vertical-align:middle;" onclick="window.location.href='../admin/buy-product.php'">SALIR</a></button>
                             <button class="btn btn-info btn-large" type="button" style="font-size:24px; width:30%;vertical-align:middle;" id="btnImprimir">IMPRIMIR</span></button>
                             <button class="btn btn-info btn-large" type="button" style="font-size:22px; width:30%;vertical-align:middle;" onclick="printPDF()">PDF</span></button>
                         </div>
                     </div>
                     <!-- /.table-responsive -->
                 </div>
                 <!-- /.panel-body -->
             </div>
             <!-- /.panel -->
         </div>
         <!-- /.col-lg-12 -->

     </div>
     <!-- /.row -->
 </div>
 <!-- /.row -->
 <!--Floating Button-->
 <a style="left: 30px !important;" href="invoice.php?invId=<?php echo $data[0]; ?>&type=1" class="float-np">
     <b><i style="font-weight:bolder;" class="fa fa-angle-left fa-2x my-float-np"></i></b>
 </a>
 <a href="invoice.php?invId=<?php echo $data[1]; ?>&type=1" class="float-np">
     <b><i style="font-weight:bolder ;" class="fa fa-angle-right fa-2x my-float-np"></i></b>
 </a>
 <!--/Floating Button-->
 <!-- Imprimir Recibo JavaScript -->
 <script src="../dist/js/ticket.js"></script>
 <!-- Crea html en canvas Javascript -->
 <script src="../dist/js/html2canvas.min.js"></script>
 <!-- Exportar a PDF JavaScript -->
 <script src="../dist/js/jspdf.min.js"></script>
 <!-- Imprimir usando PrintJS -->
 <script src="../dist/js/print.min.js"></script>

 <script>
     function genPDF() {
         document.getElementById('printers').parentNode.style.overflow = 'visible'; //might need to do this to grandparent nodes as well, possibly.
         var div = document.querySelector('#printers');
         var canvas = document.createElement('canvas');
         var scaleBy = 2;
         var w = 1000;
         var h = 1400;
         canvas.width = w * scaleBy;
         canvas.height = h * scaleBy;
         canvas.style.width = w + 'px';
         canvas.style.height = h + 'px';
         var context = canvas.getContext('2d');
         context.scale(scaleBy, scaleBy);

         window.scrollTo(0, 0);
         html2canvas(div, {
             canvas: canvas,
             onrendered: function(canvas) {
                 //document.body.appendChild(canvas);
                 document.getElementById('printers').parentNode.style.overflow = 'hidden';
                 var img = canvas.toDataURL();
                 window.open(img);
             }
         });
         window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
     };

     function printPDF() {
         var src = document.getElementById("printers");
         var img = document.getElementById("img");
         takeHighResScreenshot(src, img, 2); // This time we provide desired scale factor directly, no more messing with DPI
     }

     function takeHighResScreenshot(srcEl, destIMG, scaleFactor) {
         var invoice = document.getElementById("printFacturaNum").textContent;
         // Save original size of element
         var originalWidth = srcEl.offsetWidth;
         var originalHeight = srcEl.offsetHeight;
         // Force px size (no %, EMs, etc)
         srcEl.style.width = originalWidth + "px";
         srcEl.style.height = originalHeight + "px";

         // Position the element at the top left of the document because of bugs in html2canvas. The bug exists when supplying a custom canvas, and offsets the rendering on the custom canvas based on the offset of the source element on the page; thus the source element MUST be at 0, 0.
         // See html2canvas issues #790, #820, #893, #922
         srcEl.style.position = "fixed";
         srcEl.style.top = "0";
         srcEl.style.left = "0";

         // Create scaled canvas
         var scaledCanvas = document.createElement("canvas");
         scaledCanvas.width = originalWidth * scaleFactor;
         scaledCanvas.height = originalHeight * scaleFactor;
         scaledCanvas.style.width = originalWidth + "px";
         scaledCanvas.style.height = originalHeight + "px";
         var scaledContext = scaledCanvas.getContext("2d");
         scaledContext.scale(scaleFactor, scaleFactor);

         html2canvas(srcEl, {
                 canvas: scaledCanvas
             })
             .then(function(canvas) {
                 var wd = originalWidth * 0.2645833333 * 2;
                 var hg = originalHeight * 0.2645833333 * 2;
                 var img = canvas.toDataURL('image/jpeg', 1.0);
                 //srcEl.style.display = "none";
                 //window.open(img);
                 var doc = new jsPDF('p', 'mm', [wd, hg]);
                 doc.addImage(img, 'JPEG', 1, 1);
                 doc.save('MP-00' + printFacturaNum + '.pdf');
                 window.location.reload();
                 //destIMG.src = canvas.toDataURL("image/png");
                 //window.open(destIMG.src, "toDataURL() image", "width=800, height=800");
             });
     };
 </script>