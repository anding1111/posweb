<?php  

    $getUId = $_GET['uId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM users WHERE uId = '$getUId' AND `shId` = '".$_SESSION['shId']."' ") );
    
    if ( @$_POST['submit'] ) {
        $existingUName = $qry->uName;
       
         //collecting userinfo        
        $uFullName = formItemValidation($_POST['uFullName']);
        $uName = formItemValidation($_POST['uName']);
        $uType = formItemValidation($_POST['uType']);
        
        if ( $existingUName != $uName ) {
            
            if ( !checkUniqueUsername( $uName ) ) {
                $update = "UPDATE users SET uFullName = '".$uFullName."' , uName = '".$uName."' , uType = '".$uType."' WHERE `uId` = '".$getUId."' AND `shId` = '".$_SESSION['shId']."' ";
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
            //current time now
            $update = "UPDATE users SET uFullName = '".$uFullName."' , uType = '".$uType."' WHERE `uId` = '".$getUId."' AND `shId` = '".$_SESSION['shId']."' ";
            $qry = $conexion->query($update) or die(mysqli_error($conexion));

            if ( $qry ) {
                $insertSuccess = 1;
            } else{
                $insertError = 1;
            }
        }
    }

?>

                <!-- /.col-lg-6... -->
                <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12 center-block" style="float:none"> 
                    <div class="panel panel-default w3-card-4">
                    <div class="titles">
                        Editar usuario
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Usuario actualizado correctamente</div>
                            <?php 
                                    redirectTo('users.php', 1);
                                    endif; ?>
                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps El nombre de usuario ya esta siendo usado. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre y Apellido</label>
                                    <input class="form-control" name="uFullName" required="required" type="text" value="<?php if(isset($qry->uFullName)) echo $qry->uFullName; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Usuario (para inicio de sesión)</label>
                                    <input class="form-control" name="uName" required="required" type="text" value="<?php if(isset($qry->uName)) echo $qry->uName; ?>">
                                </div>

                                <div class="form-group">
                                <label>Seleccione un Perfíl</label>
                                    <select class="form-control" name="uType">
                                        <option value="admin">Desarrollador</option>
                                        <option value="manager" selected="selected">Administrador</option>
                                        <option value="replacement">Encargado</option>
										<option value="seller">Vendedor</option>
                                    </select>
                                </div>

                                <input type="submit" value="ACTUALIZAR" class="btn btn-info btn-large" name="submit" />

                            </form>
                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->