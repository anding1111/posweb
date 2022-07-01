<?php

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if (@$_POST['submit']) {

    //collecting product entry
    $pId = formItemValidation($_POST['pId']);
    $pQuantity = formItemValidation($_POST['pQuantity']);
    $pCost = formItemValidation($_POST['pCost']);
    $pPrice = formItemValidation($_POST['pPrice']);
    $pQty = formItemValidation($_POST['pQty']);
    $pCostOld = formItemValidation($_POST['pCostOld']);

    //collecting product IMEI or SN
    $pIdSupplier = formItemValidation($_POST['pIdSupplier']);
    // Se evalúa a true ya que $var está vacia
    $pSN = formItemValidation($_POST['pSN']);
    $pSN = trim($pSN);
    if (empty($pSN)) {
        $numRows = 0;
    } else {
        $serial = explode(" ", $pSN);
        $numRows = count($serial);
    }
    $sn = '';
    //current time now
    $nowTime = date("Y-m-d H:i:s");
    //logged in user ID
    $loggedInUser = $_SESSION['uId'];
    //logged in shop ID
    $loggedInShop = $_SESSION['shId'];

    $update = "UPDATE items SET pQuantity = pQuantity + '" . $pQuantity . "', pCost = '" . $pCost . "', pPrice = '" . $pPrice . "'  WHERE pId = '" . $pId . "' AND `shId` = '" . $loggedInShop . "' ";

    $qry = $conexion->query($update) or die(mysqli_error($conexion));

    if ($qry) {

        for ($i = 0; $i < $numRows; $i++) {
            if (isset($serial[$i])) {
                $sn = $serial[$i];
            } else {
                $sn = '';
            }
            $con->query("INSERT INTO serials VALUES(
                    '0',                            
                    '" . $pId . "',
                    '" . $pIdSupplier . "',
                    '" . $serial[$i] . "',
                    '" . $loggedInUser . "',
                    '" . $nowTime . "',
                    NULL,
                    '" . $loggedInShop . "'                                 
                )") or die(mysqli_error($con));
        }

        $insertSuccess = 1;
    } else {

        $insertError = 1;
    }
}
?>

<!-- /.col-lg-6... -->
<div class="col-lg-6 col-md-8 col-sm-9 col-xs-12 center-block" style="float:none">
    <div class="panel panel-default w3-card-4">
        <div class="titles">
            ENTRADA DE PRODUCTOS
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

            <?php if (isset($insertSuccess)) : ?>
                <div class="alert alert-success">Producto Añadido Satisfactoriamente</div>
            <?php
                redirectTo('stockin.php', 2);

            endif; ?>

            <?php if (isset($insertError)) : ?>
                <div class="alert alert-danger">Opps! Algo salió mal. Inténtalo de nuevo</div>
            <?php endif; ?>

            <form role="form" method="POST" action="">
                <div class="form-group">
                    <label>NOMBRE DEL PRODUCTO</label>
                    <input type="text" id="autocomplete_product" class="form-control" required />
                    <input type="hidden" id="pId" name="pId" value="0">
                </div>
                <div class="form-group">
                    <label>PROVEEDOR</label>
                    <select class="form-control" name="pIdSupplier" required>
                        <?php
                        $qry = getAllSuppliers();
                        while ($row = mysqli_fetch_object($qry)) {
                        ?>
                            <option value="<?php echo $row->sId; ?>"> <?php echo $row->sName; ?> </option>

                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>CANTIDAD</label>
                    <input class="form-control" id="pQuantity" name="pQuantity" required type="text" value="0" oninput="promCost()">
                    <input class="form-control" id="pQty" name="pQty" type="hidden" value="0">
                </div>
                
                <div class="form-group">
                    <label id="pCostOldLabel" value="0">COSTO DE COMPRA</label>
                    <input class="form-control" id="pCostOld" name="pCostOld" type="hidden" value="0">
                    <div class="form-horizontal">
                        <div class="col-sm-6" style="padding-left: 0px;">
                            <input class="form-control" id="pCostNew" required type="text" value="0" oninput="promCost()">
                        </div>
                        <label class="col-sm-2 control-label" style="padding-left: 0px;">PROMEDIO: </label>
                        <div class="col-sm-4" style="padding-left: 0px; margin-bottom: 15px;">
                            <input class="form-control" id="pCost" name="pCost" required type="text" value="0" readonly>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group" style="display:none;">
                    <label>COSTO DE COMPRA PROMEDIO</label>
                    <input class="form-control" name="pCostProm" required type="text" value="0" readonly>
                </div> -->

                <div class="form-group">
                    <label>PRECIO DE VENTA</label>
                    <input class="form-control" id='pPrice' name="pPrice" required type="text" value="0">
                </div>
                <div class="form-group">
                    <label>Seriales o IMEIs</label>
                    <textarea class="form-control" rows="3" name="pSN" type="text" value=""></textarea>
                </div>

                <input type="submit" value="GUARDAR" class="btn btn-info btn-large" name="submit" />

            </form>
            <script>
                $(function() {

                    // Select Product
                    $("#autocomplete_product").autocomplete({
                        autoFocus: true,
                        classes: {
                            "ui-autocomplete": "highlight"
                        },
                        // minLength: 3,
                        source: function(request, response) {
                            // Fetch data
                            $.ajax({
                                url: "body/search-product.php",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    search: request.term
                                },
                                success: function(data) {
                                    response(data);
                                }
                            });
                        },
                        select: function(event, ui) {

                            $('#autocomplete_product').val(ui.item.label); // display the selected text
                            $('#pId').val(ui.item.value); // set value the selected product
                            $('#pPrice').val(ui.item.price); // set price the selected product
                            $('#pQty').val(ui.item.qty); // set qty the selected product
                            //set cost the selected product
                            if (ui.item.cost > 0) {
                                $('#pCostOldLabel').text("COSTO DE COMPRA ( antes: $" + ui.item.cost + ")");
                                $('#pCostOld').val(ui.item.cost);
                            } else {
                                $('#pCostOldLabel').text("COSTO DE COMPRA");
                                $('#pCostOld').val('0');
                            }
                            return false;
                        }
                    });

                });

                function promCost() {
                    var subAmount = (Number($("#pCostOld").val())) * Number($("#pQty").val()) + Number($("#pCostNew").val()) * Number($("#pQuantity").val());
                    var qtys = Number($("#pQty").val()) + Number($("#pQuantity").val());
                    if ($("#pCostOld").val() > 0 && (qtys >= Number($("#pQuantity").val()))) {
                        var prom = Math.round(subAmount / qtys);
                    } else {
                        var prom = Number($("#pCostNew").val());
                    }
                    $("#pCost").val(prom);
                }
            </script>



        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
<!-- /.row -->
</div>