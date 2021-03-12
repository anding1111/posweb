<?php  

    $getshId = $_GET['shId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM shop WHERE shId = '{$getshId}' ") ); 

    
    if ( @$_POST['submit'] ) {
        
         //collecting categoryinfo        
         $shName = formItemValidation($_POST['shName']);
         $shDoc = formItemValidation($_POST['shDoc']);
         $shTelf = formItemValidation($_POST['shTelf']);
         $shDir = formItemValidation($_POST['shDir']);
         $shEmail = formItemValidation($_POST['shEmail']);       
         $shWeb = formItemValidation($_POST['shWeb']);       
         $shDesc = formItemValidation($_POST['shDesc']);       
         $shColor = formItemValidation($_POST['shColor']);   
        

                $update = "UPDATE shop SET shName = '".$shName."', shDoc = '".$shDoc."', shTelf = '".$shTelf."', shDir = '".$shDir."', shEmail = '".$shEmail."', shWeb = '".$shWeb."', shDesc = '".$shDesc."', shColor = '".$shColor."' WHERE shId = '".$getshId."' ";

                $qry = $conexion->query($update) or die(mysqli_error($conexion));


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
                        AJUSTES DE MI TIENDA
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Datos de la Tienda se han actualizado con éxito</div>
                            <?php 
                                    redirectTo('settings.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps Esta categoría ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="shName" required="required" type="text" value="<?php echo $qry->shName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sub-Nombre (Nombre Auxiliar)</label>
                                    <input class="form-control" name="shAuxName" required="required" type="text" value="<?php echo $qry->shAuxName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="shDoc" required="required" type="text" value="<?php echo $qry->shDoc; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" name="shTelf" required="required" type="text" value="<?php echo $qry->shTelf; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="shDir" required="required" type="text" value="<?php echo $qry->shDir; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input class="form-control" name="shMail" required="required" type="text" value="<?php echo $qry->shMail; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sitio Web</label>
                                    <input class="form-control" name="shWeb" required="required" type="text" value="<?php echo $qry->shWeb; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Descripción (Eslogan)</label>
                                    <input class="form-control" name="shDesc" required="required" type="text" value="<?php echo $qry->shDesc; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input class="form-control" name="shColor" required="required" type="text" value="<?php echo $qry->shColor; ?>">
                                </div>
                                
                                <input type="submit" value="Actualizar Datos" class="btn btn-info btn-large" name="submit" />


                            </form>

 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <script>
                function clicViewInv(){
                    var valId =  $('.cViewInv').val();                    
                    if(valId == 1) {
                        $('.cViewInv').val(0);
                    }else{
                        $('.cViewInv').val(1); 
                    }              
                
                }
            </script>
           

            <!-- /.row -->
        </div>