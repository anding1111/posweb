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

        //logged in shop ID
        $loggedInShop = $_SESSION['shId'];

        $qry = $conexion->query("INSERT INTO suppliers VALUES(
                                '0',
                                '".$sName."',
                                '".$sDoc."',
                                '".$sTelf."',                                       
                                '".$sDir."',                     
                                '".$loggedInUser."',
                                '".$nowTime."',
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
                    <div class="panel panel-default w3-card-4">
                        <div class="titles">
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
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->