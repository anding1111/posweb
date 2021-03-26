<?php  

    $getCId = $_GET['sId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM suppliers WHERE sID = '{$getCId}' ") ); 

    
    if ( @$_POST['submit'] ) {
        
         //collecting client info        
        $sName = formItemValidation($_POST['sName']);
        $sDoc = formItemValidation($_POST['sDoc']);
        $sTelf = formItemValidation($_POST['sTelf']);
        $sDir = formItemValidation($_POST['sDir']);


        $update = "UPDATE suppliers SET sName = '".$sName."', sDoc = '".$sDoc."', sTelf = '".$sTelf."', sDir = '".$sDir."' WHERE sId = '".$getCId."' ";

        $qry = $conexion->query($update) or die(mysqli_error($conexion));


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
                            Editar Proveedor
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Proveedor ha actualizado con éxito</div>
                            <?php 
                                    redirectTo('suppliers.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps Este proveedor ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    <input class="form-control" name="sName" required="required" type="text" value="<?php echo $qry->sName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="sDoc" required="required" type="text" value="<?php echo $qry->sDoc; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input class="form-control" name="sTelf" required="required" type="text" value="<?php echo $qry->sTelf; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="sDir" required="required" type="text" value="<?php echo $qry->sDir; ?>">
                                </div>
                                
                                <input type="submit" value="Actualizar" class="btn btn-info btn-large" name="submit" />


                            </form>

                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->