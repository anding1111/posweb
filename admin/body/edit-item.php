<?php  

    $getPId = $_GET['pId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM items WHERE pID = '$getPId' ") );
    
    $existingPName = $qry->pName;
    
    if ( @$_POST['submit'] ) {      
         //collecting userinfo
        
        $pName = formItemValidation($_POST['pName']);
        $pIdBrand = formItemValidation($_POST['pIdBrand']);
        $pBarCode = formItemValidation($_POST['pBarCode']);
        $pQuantitys = formItemValidation($_POST['pQuantitys']);
        $pCost = formItemValidation($_POST['pCost']);   
        $pPrice = formItemValidation($_POST['pPrice']);  
        //echo "<script type='text/javascript'>alert('$qry->pQuantity');</script>";
        $pQuantity = $qry->pQuantity + $pQuantitys;
        
        
        if ( $existingPName != $pName ) {
            //echo "<script type='text/javascript'>alert('$conexion');</script>";            
            
            if ( !checkUniqueUsername( $pName ) ) {

                $update = "UPDATE items SET pName = '".$pName."', pIdBrand = '".$pIdBrand."', pBarCode = '".$pBarCode."', pQuantity = '".$pQuantity."', pCost = '".$pCost."', pPrice = '".$pPrice."' WHERE pId = '".$getPId."' ";

                $qry = $conexion->query($update) or die(mysqli_error($conexion));
               
                if ( $qry ) {

                    $insertSuccess = 1;

                } else{

                    $insertError = 1;
                }

            } else{              

                //set used variable
                $uniquenessError = 1;

            }

        } else{       
                    
                $update = "UPDATE items SET pBarCode = '".$pBarCode."', pIdBrand = '".$pIdBrand."' WHERE pId = '".$getPId."' ";

                $qry = $conexion->query($update) or die(mysqli_error($conexion));
                //$qry = mysql_query($update) or die(mysql_error());

                if ( $qry ) {

                    $insertSuccess = 1;

                } else{

                    $insertError = 1;
                }
            }  
            
            //current time now
              
                $update = "UPDATE items SET pQuantity = '".$pQuantity."' WHERE pId = '".$getPId."' ";

                $qry = $conexion->query($update) or die(mysqli_error($conexion));
                //$qry = mysql_query($update) or die(mysql_error());

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
                    <div class="titles">
                        Editar producto
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">El producto se ha actualizado con éxito</div>
                            <?php 
                                    redirectTo('items.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps! Algo salió mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps Este nombre de producto ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>NOMBRE DEL PRODUCTO</label>
                                    <input class="form-control" name="pName" required="required" type="text" value="<?php echo $qry->pName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>MARCA DEL PRODUCTO</label>
                                    <select class="form-control" name="pIdBrand" required>
                                    <?php  
                                        $qrys = getAllBrands();
                                        while($row = mysqli_fetch_object( $qrys )){
                                            if ($row->bId == $qry->pIdBrand ){
                                    ?>
                                                <option value="<?php echo $row->bId; ?>" selected> <?php echo $row->bName; ?> </option>
                                    <?php } else {
                                    ?>
                                        <option value="<?php echo $row->bId; ?>"> <?php echo $row->bName; ?> </option>

                                    <?php } }?>
                                    </select>
                                </div>      
                                <div class="form-group">
                                    <label>CÓDIGO DE BARRAS</label>
                                    <input class="form-control" name="pBarCode" required="required" type="text" value="<?php echo $qry->pBarCode; ?>">
                                </div>
                                 <div class="form-group">
                                    <label>CANTIDAD DISPONIBLE</label>
                                    <input class="form-control" name="pQuantity" required="required" type="text" value="<?php echo $qry->pQuantity; ?>" readonly>
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label>COSTO DE COMPRA</label>
                                    <input class="form-control" name="pCost"  id="pCost" required="required" type="text" value="<?php echo $qry->pCost; ?>" oninput="promCost()" >
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label>COSTO PROMEDIO</label>
                                    <input class="form-control" name="pCostProm" id="pCostProm" required="required" type="text" value="<?php echo $qry->pCost; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>PRECIO DE VENTA</label>
                                    <input class="form-control" name="pPrice" required="required" type="text" value="<?php echo $qry->pPrice; ?>">
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label>ENTRADAS</label>
                                    <input class="form-control" name="pQuantitys" required="required" type="text" value="0">
                                </div>                                    

                                <input type="submit" value="Actualizar" class="btn btn-info btn-large" name="submit" />

                            </form>
                            <script type="text/javascript">
                            function promCost() {
                                var subAmount = Number($("#pCost").val()) + Number($("#pCostProm").val());
                                var prom = subAmount / 2;
                                $("#pCostProm").val(prom);
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