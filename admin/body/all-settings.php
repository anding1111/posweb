<?php  

    
    if ( @$_POST['submit'] ) {
        
       
         //collecting userinfo
        
        $shName = formItemValidation($_POST['shName']);
        $shDoc = formItemValidation($_POST['shDoc']);
        $shTelf = formItemValidation($_POST['shTelf']);
        $shDir = formItemValidation($_POST['shDir']);
        $shEmail = formItemValidation($_POST['shEmail']);       
        $shWeb = formItemValidation($_POST['shWeb']);       
        $shDesc = formItemValidation($_POST['shDesc']);       
        $shColor = formItemValidation($_POST['shColor']);       
       
              
                //current time now
                $nowTime = date("Y-m-d H:i:s");

                //logged in user ID
                $loggedInUser = $_SESSION['uId'];


                $qry = $conexion->query("INSERT INTO shop VALUES(
                                        '0',
                                        '".$cName."',
                                        '".$cDoc."',
                                        '".$cTelf."',                                       
                                        '".$cDir."',
                                        '".$cEmail."',
                                        '".$loggedInUser."',
                                        '".$nowTime."',
                                        '1'
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
                    <div class="panel panel-default w3-card-4">
                    <div class="titles mb--10">
                            AJUSTES DE MI EMPRESA
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Datos guardados correctamente!</div>
                            <?php 
                                    redirectTo('settings.php', 0);

                            endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>                           
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre </label>
                                    <input class="form-control" name="shName" required="required" type="text" value="<?php echo @$_POST['shName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sub-Nombre (Nombre Auxiliar) </label>
                                    <input class="form-control" name="shAuxName" required="required" type="text" value="<?php echo @$_POST['shAuxName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="shDoc" required="required" type="text" value="<?php echo @$_POST['shDoc'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Teléfono:</label>
                                    <input class="form-control" name="ShTelf" required="required" type="text" value="<?php echo @$_POST['shTelf'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="shDir" required="required" type="text" value="<?php echo @$_POST['shDir'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input class="form-control" name="shEmail" required="required" type="text" value="<?php echo @$_POST['shEmail'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sitio Web</label>
                                    <input class="form-control" name="shWeb" required="required" type="text" value="<?php echo @$_POST['shDoc'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Descripción (Eslogan)</label>
                                    <input class="form-control" name="shDesc" required="required" type="text" value="<?php echo @$_POST['shDesc'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input class="form-control" name="shColor" required="required" type="text" value="<?php echo @$_POST['shColor'] ?>">
                                </div>
                                
                                <input type="submit" value="Guardar Cambios" class="btn btn-info btn-large" name="submit" />

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