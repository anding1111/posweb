<?php  
    
    if ( @$_POST['submit'] ) {
        
       
         //collecting userinfo
        
        $pName = formItemValidation($_POST['pName']);
        $pIdBrand = formItemValidation($_POST['pIdBrand']);
        $pBarCode =  formItemValidation($_POST['pBarCode'] );        
        $pQuantity = formItemValidation($_POST['pQuantity']);  
        $pCost = formItemValidation($_POST['pCost']);   
        $pPrice = formItemValidation($_POST['pPrice']);
          
        //logged in shop ID
        $loggedInShop = $_SESSION['shId']; 
             

                $qry = $conexion->query("INSERT INTO items VALUES(
                                        '0',                                        
                                        '".$pBarCode."',
                                        '".$pName."',  
                                        '".$pIdBrand."',                                      
                                        '".$pQuantity."',
                                        '".$pCost."',                                       
                                        '".$pPrice."',
                                        '1',
                                        '".$loggedInShop."'
                                        
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
                            NUEVO PRODUCTO
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Producto Añadido Satisfactoriamente</div>
                            <?php 
                                    redirectTo('items.php', 2);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps! Algo salió mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>NOMBRE DEL PRODUCTO</label>                                    
                                    <input class="form-control" name="pName" required type="text" value="<?php echo @$_POST['pName'] ?>">
                                </div> 
                                <div class="form-group">
                                    <label>MARCA DEL PRODUCTO</label>
                                    <select class="form-control" name="pIdBrand" required>
                                    <?php  
                                        $qry = getAllBrands();
                                        while($row = mysqli_fetch_object( $qry )){
                                    ?>
                                        <option value="<?php echo $row->bId; ?>"> <?php echo $row->bName; ?> </option>

                                    <?php } ?>
                                    </select>
                                </div>                                

                                 <div class="form-group">
                                    <label>CODIGO DE BARRAS</label>
                                    <input class="form-control" name="pBarCode" required type="text" value="<?php echo @$_POST['pBarCode'] ?>">
                                </div>

                                 <div class="form-group" style="display:none;">
                                    <label>CANTIDAD</label>
                                    <input class="form-control" name="pQuantity" required type="text" value="0">
                                </div> 

                                <div class="form-group" style="display:none;">
                                    <label>COSTO DE COMPRA</label>
                                    <input class="form-control" name="pCost" required type="text" value="0">
                                </div>

                                <div class="form-group" style="display:none;">
                                    <label>COSTO DE COMPRA PROMEDIO</label>
                                    <input class="form-control" name="pCostProm" required type="text" value="0" readonly>
                                </div>

                                <div class="form-group" style="display:none;">
                                    <label>PRECIO DE VENTA</label>
                                    <input class="form-control" name="pPrice" required type="text" value="0">
                                </div> 
                                <div class="form-group" style="display:none;">
                                    <label>S/N</label>
                                    <input class="form-control" name="pSN" type="text" value="">
                                </div>      
                               

                                <input type="submit" value="GUARDAR" class="btn btn-info btn-large" name="submit" />


                            </form>
 
                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->