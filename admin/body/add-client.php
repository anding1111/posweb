<?php  
    
    if ( @$_POST['submit'] ) {
       
        //collecting userinfo
        $cName = formItemValidation($_POST['cName']);
        $cDoc = formItemValidation($_POST['cDoc']);
        $cTelf = formItemValidation($_POST['cTelf']);
        $cDir = formItemValidation($_POST['cDir']);
        $cEmail = formItemValidation($_POST['cEmail']);

        if (isset($_POST["cViewInv"]) && $_POST["cViewInv"] == 1){            
            $cViewInv = formItemValidation($_POST['cViewInv']);
        }else{
            $cViewInv = 0;
        }
                //current time now
                $nowTime = date("Y-m-d H:i:s");

                //logged in user ID
                $loggedInUser = $_SESSION['uId'];

                //logged in shop ID
                $loggedInShop = $_SESSION['shId'];

                $qry = $conexion->query("INSERT INTO client VALUES(
                                        '0',
                                        '".$cName."',
                                        '".$cDoc."',
                                        '".$cTelf."',                                       
                                        '".$cDir."',
                                        '".$cEmail."',
                                        '".$cViewInv."',                                       
                                        '".$loggedInUser."',
                                        '".$nowTime."',
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
                    <div class="panel panel-default w3-card-4">
                        <div class="titles">
                            Añadir un nuevo cliente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Cliente agregado con éxito</div>
                            <?php 
                                    redirectTo('clients.php', 0);

                            endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>                           
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    <input class="form-control" name="cName" required="required" type="text" value="<?php echo @$_POST['cName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="cDoc" required="required" type="text" value="<?php echo @$_POST['cDoc'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input class="form-control" name="cTelf" required="required" type="text" value="<?php echo @$_POST['cTelf'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="cDir" required="required" type="text" value="<?php echo @$_POST['cDir'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input class="form-control" name="cEmail" required="required" type="text" value="<?php echo @$_POST['cEmail'] ?>">
                                </div>
                                <div class="checkbox mt-20 mb-30">
                                    <label><input type="checkbox" value="1" name="cViewInv" checked><b>  VER PRECIOS</b>(EN FACTURA)</label>
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