<?php  
    
    if ( @$_POST['submit'] ) {
        
       
         //collecting userinfo
        
        $pIdSupplier = formItemValidation($_POST['puIdSupplier']);   
        $puInvPurchase = formItemValidation($_POST['puInvPurchase']);
        $puTotal = formItemValidation($_POST['puTotal']);   
        $puAbono = formItemValidation($_POST['puAbono']);      
        $puDetail = formItemValidation($_POST['puDetail']);      

        //current time now
        $nowTime = date("Y-m-d H:i:s");

        //generate invoice number				
        $numRecibo = 0;       
        $result = mysqli_fetch_object($conexion->query("SELECT MAX(invId) AS 'maxN' FROM orders"));        
        $numRecibo = $result->maxN;        
        $invNum = $numRecibo + 1;

        //logged in user ID
        $loggedInUser = $_SESSION['uId'];

        $qry = $conexion->query("INSERT INTO purchases VALUES(
                                '0',
                                '".$pIdSupplier."', 
                                '".$puTotal."',
                                '".$puAbono."',                                       
                                '".$loggedInUser."',
                                '".$nowTime."',
                                '".$puInvPurchase."',
                                '".$puDetail."'
                                )") or die(mysqli_error($conexion));                

        if ( $qry ) {
            
            $insertSuccess = 1;

        } else{

            $insertError = 1;
        }
    }
?>

            <!-- /.col-lg-6... -->
            <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12 center-block" style="float:none"> 
                    <div class="panel panel-default">
                        <div class="panel-heading titles">
                            NUEVA FACTURA
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Factura añadida con éxito</div>
                            <?php 
                                    redirectTo('purchases.php', 2);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            
                              
                            <form role="form" method="POST" action="">

                                <div class="form-group">
                                    <label>PROVEEDOR</label>
                                    <select class="form-control" name="puIdSupplier" id="puIdSupplier" required onchange="selectSupplier()">
                                    <?php  
                                        $qry = getAllSuppliers();
                                        while($row = mysqli_fetch_object( $qry )){
                                    ?>
                                        <option value="<?php echo $row->sId; ?>"> <?php echo $row->sName; ?> </option>

                                    <?php } ?>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label>FACTURA DE COMPRA No.</label>
                                    <input class="form-control" name="puInvPurchase" required type="text" value="">
                                </div>    
                                <div class="form-group">
                                    <label id="PuSaldoOld" value="0">TOTAL</label>
                                    <input class="form-control" id="puTotal" name="puTotal" required type="text" value="0" oninput="newSaldo()">
                                    <input class="form-control" id="puSaldo" name="puSaldo" type="hidden" value="0">
                                </div> 

                                <div class="form-group">
                                    <label>ABONO</label>
                                    <div class="form-horizontal">
                                        <div class="col-sm-8" style="padding-left: 0px;">
                                            <input class="form-control" id="puAbono" name="puAbono" required type="text" value="0" oninput="newSaldo()">
                                        </div>
                                        <label class="col-sm-2 control-label" style="padding-left: 0px;">NUEVO SALDO: </label>
                                        <div class="col-sm-2" style="padding-left: 0px; margin-bottom: 15px;">
                                            <input class="form-control" id="puNewSaldo" required type="text" value="0" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>OBSERVACIONES</label>
                                    <textarea class="form-control" rows="3" name="puDetail" type="text" value=""></textarea>
                                </div> 

                                <input type="submit" value="GUARDAR" class="btn btn-info btn-large" name="submit" />


                            </form>

                            <script>

                            function selectSupplier() {
                            var idSupp = $('#puIdSupplier').val();
                           
                            // Fetch data
                            $.ajax({
                                url: "body/search-product.php",
                                type: 'post',
                                dataType: "json",
                                data: { supplier: idSupp },
                                success: function( data ) {
                                    //set supplier saldo selected
                                    if(data.saldo > 0){
                                        $('#PuSaldoOld').text("TOTAL ( Pendiente: $" + data.saldo + ")");
                                        $('#puSaldo').val(data.saldo);
                                        $('#puNewSaldo').val(data.saldo);
                                    } else{
                                        $('#PuSaldoOld').text("TOTAL");
                                        $('#puSaldo').val('0');
                                        $('#puNewSaldo').val('0');
                                    }                                                        
                                }
                            });
                            
                            }
                            function newSaldo() {
                                var total = parseInt($('#puTotal').val(), 10);
                                var saldo = parseInt($('#puSaldo').val(), 10);
                                var abono = parseInt($('#puAbono').val(), 10);                                                               
                                var newSaldo =  total + saldo - abono;                                
                                $('#puNewSaldo').val(newSaldo);                                 
                            }
            
                            </script>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->