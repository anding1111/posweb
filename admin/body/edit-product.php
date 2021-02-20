<?php  


    $getiId = $_GET['iId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM product WHERE iId = '$getiId' ") );
    $qryi = mysqli_fetch_object( $conexion->query("SELECT * FROM items WHERE pId = '$qry->pId' ") );
    $qryc = mysqli_fetch_object( $conexion->query("SELECT * FROM category WHERE cId = '$qry->cId' ") );

    //$existingPName = $qry->iId;
        
    if ( @$_POST['submit'] ) {
          
       
         //collecting userinfo

        $iId = formItemValidation($_POST['iId']);
        
       //$pId = formItemValidation($_POST['pId']);       
        
        $pPrice = formItemValidation($_POST['pPrice']);

        //$cId = formItemValidation($_POST['cId']); 
        

        
              
                $update = "UPDATE product SET pPrice = '".$pPrice."' WHERE iId = '".$iId."' ";

                $qry = $conexion->query($update) or die(mysqli_error($conexion));
                //$qry = mysql_query($update) or die(mysql_error());


                if ( $qry ) {

                    $insertSuccess = 1;

                } else{

                    $insertError = 1;
                }
         
        }
?>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading titles">
                        Editar Precio
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">El producto se ha actualizado con éxito</div>
                            <?php 
                                    redirectTo('products.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps Este nombre de producto ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                            <div class="form-group">                                    
                                    <input type="hidden" class="form-control" name="iId" value="<?php echo $qry->iId; ?>" autocomplete="off">
                                </div> 
                                <div class="form-group">
                                    <label>PRODUCTO:</label>
                                    <input class="form-control" name="pId" required="required" type="text" value="<?php echo $qryi->pName; ?>" disabled>
                                </div>  
                                <div class="form-group">
                                    <label>CLIENTE</label>
                                    <input class="form-control" name="cId" required="required" type="text" value="<?php echo $qryc->cName; ?>" disabled>
                                </div>  
                                <div class="form-group">
                                    <label>PRECIO</label>
                                    <input class="form-control" name="pPrice" required="required" type="text" value="<?php echo $qry->pPrice; ?>">
                                </div>                                

                                <input type="submit" value="Actualizar" class="btn btn-info btn-large" name="submit" />


                            </form>

 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
            <!-- /.row -->
        </div>