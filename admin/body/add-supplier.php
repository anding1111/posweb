<?php  

    
    if ( @$_POST['submit'] ) {
        
       
         //collecting userinfo        
        $sName = formItemValidation($_POST['sName']);
        $sDoc = formItemValidation($_POST['sDoc']);
        $sTelf = formItemValidation($_POST['sTelf']);
        $sDir = formItemValidation($_POST['sDir']);
       
        //current time now
        $nowTime = date("Y-m-d H:i:s");

        //logged in user ID
        $loggedInUser = $_SESSION['uId'];

        $qry = $conexion->query("INSERT INTO suppliers VALUES(
                                '0',
                                '".$sName."',
                                '".$sDoc."',
                                '".$sTelf."',                                       
                                '".$sDir."',                     
                                '".$loggedInUser."',
                                '".$nowTime."'
            )") or die(mysqli_error($conexion));

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
                            Añadir un nuevo Proveedor
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Proveedor agregado con éxito</div>
                            <?php 
                                    redirectTo('suppliers.php', 0);

                            endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>                           
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    <input class="form-control" name="sName" required="required" type="text" value="<?php echo @$_POST['sName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="sDoc" required="required" type="text" value="<?php echo @$_POST['sDoc'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input class="form-control" name="sTelf" required="required" type="text" value="<?php echo @$_POST['sTelf'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="sDir" required="required" type="text" value="<?php echo @$_POST['sDir'] ?>">
                                </div>

                                <input type="submit" value="Añadir Ahora" class="btn btn-info btn-large" name="submit" />

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