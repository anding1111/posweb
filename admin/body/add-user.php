<?php  

    
    if ( @$_POST['submit'] ) {
        
       $con = new mysqli($server_db, $user_db, $password_db, $database_db);

         //collecting userinfo
        
        $uFullName = formItemValidation($_POST['uFullName']);
        $uName = formItemValidation($_POST['uName']);
        $uPassword =  formItemValidation($_POST['uPassword'] );
        $uPasswordAgain = formItemValidation($_POST['uPasswordAgain']);
        $uType = formItemValidation($_POST['uType']);

     
        if ( $uPassword == $uPasswordAgain ) {
            
            //check uniqueness
            if ( !checkUniqueUsername( $uName ) ) {

                        
                        //current time now
                        $nowTime = date("Y-m-d H:i:s");

                        //need to insert data
                        $myNewId = generateId();

                        //logged in user ID
                        $loggedInUser = $_SESSION['uId'];

                        $qry = $con->query("INSERT INTO users VALUES(
                                                '0',
                                                '".$myNewId."',
                                                '".$uFullName."',
                                                '".$uName."',
                                                '".md5($uPassword)."',
                                                '".$uType."',
                                                1,
                                                0,
                                                '".$loggedInUser."',
                                                '".$nowTime."'
                            )") or die(mysqli_error($con));


                        if ( $qry ) {

                            /*if (!checkAdmin()) {*/
                                
                                $message = "Se agregó un nuevo usuario, <b>{$uName} </b> ({$myNewId}) ha sido creado. ";

                                $con->query( "INSERT INTO notification VALUES(
                                                        '0',
                                                        'admin',
                                                        '".$loggedInUser."',
                                                        '".$myNewId."',
                                                        '".$message."',
                                                        '".$nowTime."',
                                                        '0'        
                                    )" ) or die(mysqli_error($con));
                                
                            /*}*/


                            $insertSuccess = 1;



                } else{

                    $insertError = 1;
                }



            } else{

               

                //set used variable
                $uniquenessError = 1;

            }

        } else{

            $passwordNotMatched = 1;
        }
    }

?>


                <!-- /.col-lg-6... -->
                <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12 center-block" style="float:none"> 
                    <div class="panel panel-default">
                        <div class="panel-heading titles">
                            Añadir Nuevo Usuario
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Usuario Añadido Satisfactoriamente</div>
                            <?php 
                                    redirectTo('users.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            
                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps El nombre de usuario ya esta siendo usado. Prueba otro.</div>
                            <?php endif; ?>

                            <?php if(isset($passwordNotMatched)) : ?>
                                <div class="alert alert-danger">¡Lo siento! La contraseña no coincidió. Inténtalo de nuevo.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre y Apellido</label>
                                    <input class="form-control" name="uFullName" required="required" type="text" value="<?php echo @$_POST['uFullName'] ?>">
                                </div>

                                <div class="form-group">
                                    <label>Usuario (para inicio de sesión)</label>
                                    <input class="form-control" name="uName" required="required" type="text" value="<?php echo @$_POST['uName'] ?>">
                                </div>

                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="form-control" name="uPassword" required="required" type="password">
                                </div>

                                <div class="form-group">
                                    <label>Repetir Contraseña</label>
                                    <input class="form-control" name="uPasswordAgain" required="required" type="password">
                                </div>

                                <div class="form-group">
                                    <label>Seleccione un Perfíl</label>
                                    <select class="form-control" name="uType">
                                        <option value="admin" selected="selected">Desarrollador</option>
                                        <option value="manager">Administrador</option>
                                        <option value="replacement">Encargado</option>
										<option value="seller">Vendedor</option>
                                    </select>
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