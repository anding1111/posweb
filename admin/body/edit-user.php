<?php  

    $getUId = $_GET['uId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM users WHERE uId = '$getUId' AND `shId` = '".$_SESSION['shId']."' ") );
    
    if ( @$_POST['submit'] ) {

        $existingUName = $qry->uName;       
        //collecting userinfo        
        $uFullName = formItemValidation($_POST['uFullName']);
        $uName = formItemValidation($_POST['uName']);
        if ( $stores->num_rows > 1 ) {
        $idStore = formItemValidation($_POST['idStore']);
        } else {
            $idStore = $_SESSION['idStore'];
        }
        
        if(isset($_POST['uPassword'])){
            $uPassword =  formItemValidation($_POST['uPassword'] );
            $uPasswordAgain = formItemValidation($_POST['uPasswordAgain']);
            $uType = formItemValidation($_POST['uType']);
        } else{
            $uPassword =  null;
            $uPasswordAgain = null;            
            $uType = null;
        }

        if ( $uPassword == $uPasswordAgain ) { 
        
            if ( $existingUName != $uName ) {
                
                if ( !checkUniqueUsername( $uName ) ) {
                    if( $uPassword != null && $uPasswordAgain != null ){
                        $update = "UPDATE users SET uFullName = '".$uFullName."' , uName = '".$uName."' , uPassword = '".md5($uPassword)."' , uType = '".$uType."', idStore = '".$idStore."' WHERE `uId` = '".$getUId."' AND `shId` = '".$_SESSION['shId']."' ";
                    } else{
                        $update = "UPDATE users SET uFullName = '".$uFullName."' , uName = '".$uName."' , uType = '".$uType."', idStore = '".$idStore."' WHERE `uId` = '".$getUId."' AND `shId` = '".$_SESSION['shId']."' ";
                    }
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
                if( $uPassword != null && $uPasswordAgain != null ){
                    $update = "UPDATE users SET uFullName = '".$uFullName."' , uPassword = '".md5($uPassword)."' , uType = '".$uType."', idStore = '".$idStore."' WHERE `uId` = '".$getUId."' AND `shId` = '".$_SESSION['shId']."' ";
                } else{
                    $update = "UPDATE users SET uFullName = '".$uFullName."' WHERE `uId` = '".$getUId."' AND `shId` = '".$_SESSION['shId']."' ";
                }
                    $qry = $conexion->query($update) or die(mysqli_error($conexion));

                if ( $qry ) {
                    $insertSuccess = 1;
                    if ($getUId == $_SESSION['uId']) {
                        $_SESSION['idStore'] = $idStore;
                    }
                } else{
                    $insertError = 1;
                }
            }
        } else{

            $passwordNotMatched = 1;
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

                            <?php if(isset($passwordNotMatched)) : ?>
                                <div class="alert alert-danger">¡Lo siento! Las contraseñas no coinciden. Inténtalo de nuevo.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre y Apellido</label>
                                    <input class="form-control" name="uFullName" required="required" type="text" value="<?php if(isset($qry->uFullName)) echo $qry->uFullName; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Correo Electrónico (Usuario de iniciar sesión)</label>
                                    <input class="form-control" name="uName" required="required" type="text" readonly value="<?php if(isset($qry->uName)) echo $qry->uName; ?>">
                                </div>
                                
                                <?php if(checkAdmin()) : ?>
                                <div class="form-group">
                                    <label>Nueva Contraseña</label>
                                    <input class="form-control" name="uPassword" required="required" type="password">
                                </div>

                                <div class="form-group">
                                    <label>Repetir Nueva Contraseña</label>
                                    <input class="form-control" name="uPasswordAgain" required="required" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Seleccione un Perfíl</label>
                                    <?php $options = array( 
                                            "Administrador" => 'admin', 
                                            "Jefe Almacén" => 'manager',
                                            "Jefe Ventas" => 'replacement', 
                                            "Vendedor" => 'seller',
                                            "Asesor Comercial" => 'adviser',
                                            "Almacenista" => 'storer'
                                        );  ?>
                                    <select class="form-control" name="uType">
                                    <?php  foreach($options as $display => $value) {  ?>
                                        <option value='<?= $value ?>' <?php if($qry->uType == trim($value)) { ?>selected='selected'<?php } ?>>
                                            <?= $display ?>
                                        </option>
                                    <?php } ?>
                                    </select>   
                                </div>
                                <?php $stores = getAllStores(); 
                                    if ( $stores->num_rows > 1 ) { ?>
                                    <div class="form-group">
                                        <label>Seleccione Ubicación (Almacén o Bodega)</label>
                                        <select class="form-control" name="idStore">
                                        <?php while($row = mysqli_fetch_array($stores) ){
                                                    if (intval($qry->idStore) == intval($row['stId'])) {
                                                        echo '<option value="' . $row['stId'] . '" selected>' . $row['stName'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $row['stId'] . '">' . $row['stName'] . '</option>';
                                                    }
                                                } ?>
                                        </select>   
                                    </div>
                                <?php } ?>
                                <?php endif; ?>

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