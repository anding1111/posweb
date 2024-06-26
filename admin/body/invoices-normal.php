 <?php
    $invId = $_GET['invId'];
    $type = $_GET['type'];
    global $conexion;
    
    //logged in shop ID
    $loggedInShop = $_SESSION['shId'];

    $qry = $conexion->query("SELECT * FROM orders WHERE invId = ".$invId." AND `pId` != 0 AND `orEnable` = '".$type."' AND `shId` = '".$loggedInShop."' ");
    
    //Determinar el número de filas del resultado
    $numItems =  $qry->num_rows;
    $qrydata = mysqli_fetch_object($conexion->query("SELECT invId, cId, SUM(pMount) AS venta, cPayment FROM orders WHERE invId = ".$invId." AND  `orEnable` = '".$type."' AND shId = '".$loggedInShop."' GROUP BY cId"));
    $qrysaldo = mysqli_fetch_object($conexion->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment, shId, orEnable FROM `orders` WHERE `shId` = '".$loggedInShop."' AND `orEnable` = '".$type."' GROUP BY invId) AS subquery WHERE cId = '$qrydata->cId' AND shId = '".$loggedInShop."' AND `orEnable` = '".$type."' AND invId BETWEEN 0 AND '$invId' "));

    $typeInvoice = $shop->shInvoiceType;

    if ($typeInvoice == 0) {
        $typeName = "Factura";
    }elseif($typeInvoice == 1){
        $typeName = "Recibo";
    }elseif($typeInvoice == 2){
        $typeName = "Remision";
    }else {
        $typeName = "Salida de Almacen";
    }
    //Validate type order
    if ($type == 3) {
        $typeName = "Cotización";
    }
?>
        <div class="row">
       
            <!-- Start model invoice for normal printer -->
            <div id="page-wrap" class="w3-card-4">
                
            <!-- Printer DIV Zone -->
            <div id="printerZone">
                <div id="header">
                    <span id="InvoiceType"><b><?php echo $typeName; ?></b></span>
                </div>
                <div id="identity">
                    <div id="logo" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <img id="image" src="<?php echo $shop->shLogo; ?>" alt="logo" width="180" height="120" style="will-change: transform; image-rendering: -webkit-optimize-contrast;"/>
                    </div>
                    <div id="dataShop" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <input type="hidden" id="numItems" value="<?php echo $numItems; ?>" class="form-control">
                        <b><?php echo $shop->shName ?></b>
                        <br>
                        <?php echo $shop->shDesc ?>
                        <br>
                        <?php echo $shop->shDoc ?>
                        <br>
                        <?php echo $shop->shTelf ?>
                        <br>
                        <?php echo $shop->shDir ?>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div id="customer">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <br>
                        <b><span id="printFacturaClient"><?php  
                        $result = getClientNameById($qrydata->cId);                                      
                        echo $result->cName.'<br/>'; ?> </span></b>
                        <b><span id="printFacturaDoc"><?php                                           
                        echo $result->cDoc.'<br/>'; ?> </span></b>
                        <b><span id="printFacturaCel"><?php                                          
                        echo $result->cTelf.'<br/>'; ?> </span></b>
                        <b><span id="printFacturaDir"><?php                                           
                        echo $result->cDir.'<br/>'; ?> </span></b>
                        <input type="hidden" id="numItems" value="<?php echo($numItems); ?>" class="form-control">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <table id="meta" class="normal-printer">
                            <tr>
                                <td class="meta-head"><span id="InvoiceType"><b><?php echo $typeName; ?> No. </b></span></td>
                                <td><span id="printFacturaNum"><?php echo $invId.'<br/>'; ?></span></td>
                            </tr>
                            <tr>
                                <td class="meta-head"><b>Fecha</b></td>
                                <td><span id="printFacturaFech"><?php
                                if ($type == 1) {
                                    $Fecha = getFecha($invId);
                                } else {
                                    $Fecha = getFechaQuot($invId);                                            
                                }                                              
                                echo fechaCastellano($Fecha->bDate).'<br/>'; ?></span></td>
                            </tr>
                            <tr>
                                <td class="meta-head"><b>Hora</b></td>
                                <td>
                                    <div class="due"><span id="printFacturaHor"><?php                                                                                             
                                echo horaCastellano($Fecha->bDate).'<br/>';?></span>
                                </div></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table id="items" class="normal-printer">
                    <tr>
                        <th>Producto</th>
                        <th style="text-align:right">Cant.</th>
                        <th style="text-align:right">Vr. Unit.</th>
                        <th style="text-align:right">Vr. Total</th>
                    </tr>
                <?php while ($row = $qry->fetch_assoc()) {
                    ?>
                    <tr>                                           
                        <td class="description"> <?php
                        $pId= getItemNameById($row['pId']);                                                    
                        echo $pId->pName;
                        ?> </td>
                        <td style="text-align:right"> <?php
                        echo(numMiles($row['pQty']));
                        ?> </td> 
                        <td style="text-align:right"> <?php
                        echo(numMiles($row['pPrice']));
                        ?> </td>
                        <td style="text-align:right"> <?php
                        echo(numMiles($row['pMount']));
                        ?> </td> 
                    </tr>
                    <?php } ?>     
                    <tr>
                        <td colspan="1" rowspan="5" class="blank">
                        <div class="terminos" style="font-size:12px !important; text-align: justify; text-justify: inter-word; line-height: 1.6; padding-bottom:20px;">
                        <span><b>OBSERVACIONES: </b></span>
                            <?php 
                            if ($type == 3) {
                                $imeis = getIdClienteByInvIdQuotation($invId);
                            }else{
                                $imeis = getIdClienteByInvId($invId);
                            }
                            print_r($imeis->inSerial);                                                      
                            ?>
                        </div>
                        <div id="terms" class="terms">
                            <h5>Condiciones</h5>
                            <div id="printSerial">
                                <?php 
                            echo $shop->shTerms;                                                     
                            ?>                                          
                            </div>
                        </div>
                        </td>
                        <td colspan="2" style="text-align:right"><span id="typeOrder"><b><?php echo ($type == 1 ? "SubTotal: " : "Total: ");?> </b></span></td>
                        <td class="total-value" id="printSubTotal" ><b> $<?php 
                        if ($type == 3){
                            $total = getAllQuotationsByInvId($invId);
                            echo(numMiles($total));
                            ?>
                        </b> </td>
                        <?php
                        }else{
                            $total = getAllOrdersByInvId($invId);
                            echo(numMiles($total));
                            ?>                                        
                        </b> </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="balance" style="text-align:right">Saldo Anterior: </td>
                        <td class="total-value" id="printOldSaldo"><b>$<?php 
                        echo(numMiles(($qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado)) - $total));
                        ?> </b>                                          
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right"><b>Total: </b></td>
                        <td class="total-value" id="printTotal"> <b>$<?php 
                        echo(numMiles($qrydata->cPayment + ($qrysaldo->total - $qrysaldo->pagado)));
                        ?> </b>                                          
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="balance" style="text-align:right">Abona: </td>
                        <td class="total-value" id="printAbona"> <b>$<?php 
                        echo(numMiles($qrydata->cPayment));
                        ?> </b>                                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right"><b>Nuevo Saldo: </b></td>
                        <td class="total-value" id="printNewSaldo"> <b>$<?php 
                        echo(numMiles($qrysaldo->total - $qrysaldo->pagado));
                        ?> </b>                                          
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <!-- <div class="terminos" style="font-size:10px !important; text-align: justify; text-justify: inter-word; line-height: 1.6;">
                        <?php 
                        //echo $shop->shTerms;                                                     
                        ?>
                </div> -->
                <div id="img"></div> 
                </div>    
                <div class="row">                                                                        
                    <div class="btn text-center" role="group" style="width:100%;">
                        <button class="btn btn-info btn-large" type="button" style="font-size:22px; width:30%;vertical-align:middle;" onclick="window.location.href='../admin/buy-product.php'">SALIR</a></button>
                        <button class="btn btn-info btn-large" type="button" style="font-size:24px; width:30%;vertical-align:middle;" id="btnImprimirNormal">IMPRIMIR</span></button>
                        <!-- <button class="btn btn-info btn-large" type="button" style="font-size:22px; width:30%;vertical-align:middle;" onclick="printPDF()">PDF</span></button> -->
                    </div>
                </div>      
            </div>
            <!-- End model invoice for normal printer -->
           
            </div>
            <!-- /.row -->
        </div>
        <!-- /.row -->
<!-- Imprimir Recibo JavaScript -->
<!-- <script src="../dist/js/ticket.js"></script> -->
<!-- Crea html en canvas Javascript -->
<script src="../dist/js/html2canvas.min.js"></script> 
<!-- Exportar a PDF JavaScript -->
<script src="../dist/js/jspdf.min.js"></script>  
<!-- Imprimir usando PrintJS -->
<script src="../dist/js/print.min.js"></script>

<script>
document.getElementById("btnImprimirNormal").addEventListener("click", printNormal);
function printNormal() {
  printJS({
    printable: "printerZone",
    type: "html",
    targetStyles: ['*'],
    style: ['@page { size: letter portrait; margin: 0mm;} body {margin: 10;}']

  });
}

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
    
    window.scrollTo(0,0);     
    html2canvas(div, {
        canvas:canvas,
        onrendered: function (canvas) {
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

    html2canvas(srcEl, { canvas: scaledCanvas })
    .then(function(canvas) {
        var wd = originalWidth * 0.2645833333 *2;
        var hg = originalHeight * 0.2645833333 *2;
        var img = canvas.toDataURL('image/jpeg', 1.0);
        //srcEl.style.display = "none";
        //window.open(img);
        var doc = new jsPDF('p', 'mm', [wd, hg]);
        doc.addImage(img,'JPEG',1,1);
        doc.save('MP-00'+printFacturaNum+'.pdf');
        window.location.reload(); 
        //destIMG.src = canvas.toDataURL("image/png");
        //window.open(destIMG.src, "toDataURL() image", "width=800, height=800");
    });
};

</script>

       