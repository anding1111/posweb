<?php  

    $getUId = $_GET['uId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM users WHERE uID = '$getUId' ") );

    $existingUName = $qry->uName;
    
    if ( @$_POST['submit'] ) {
       
         //collecting userinfo        
        $uFullName = formItemValidation($_POST['uFullName']);
        $uName = formItemValidation($_POST['uName']);
        $uType = formItemValidation($_POST['uType']);
        
        if ( $existingUName != $uName ) {
            
            if ( !checkUniqueUsername( $uName ) ) {
                $update = "UPDATE users SET uFullName = '".$uFullName."' , uName = '".$uName."' , uType = '".$uType."' WHERE uId = '".$getUId."' ";
                //$update = "UPDATE users SET uName = '".$uName."' , uType = '".$uType."' WHERE uId = '".$getUId."' ";

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
                $update = "UPDATE users SET uType = '".$uType."' WHERE uId = '".$getUId."' ";
                $qry = $conexion->query($update) or die(mysqli_error($conexion));

                if ( $qry ) {
                    $insertSuccess = 1;
                } else{
                    $insertError = 1;
                }
        }
    }

?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading titles">
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
                                    <input class="form-control" name="uFullName" required="required" type="text" value="<?php echo $qry->uName; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Usuario (para inicio de sesión)</label>
                                    <input class="form-control" name="uName" required="required" type="text" value="<?php echo $qry->uName; ?>">
                                </div>

                                <div class="form-group">
                                <label>Seleccione un Perfíl</label>
                                    <select class="form-control" name="uType">
                                        <option value="manager" selected="selected">Administrador</option>
                                        <option value="replacement">Encargado</option>
										<option value="seller">Vendedor</option>
                                    </select>
                                </div>

                                <input type="submit" value="Update" class="btn btn-info btn-large" name="submit" />

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