<?php  

    $getCId = $_GET['cId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM category WHERE cID = '{$getCId}' ") ); 

    
    if ( @$_POST['submit'] ) {
        
         //collecting categoryinfo        
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

                $update = "UPDATE category SET cName = '".$cName."', cDoc = '".$cDoc."', cTelf = '".$cTelf."', cDir = '".$cDir."', cEmail = '".$cEmail."', cViewInv = '".$cViewInv."' WHERE cId = '".$getCId."' ";

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
                            Editar Cliente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Categoría ha actualizado con éxito</div>
                            <?php 
                                    redirectTo('categories.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps Esta categoría ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    <input class="form-control" name="cName" required="required" type="text" value="<?php echo $qry->cName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="cDoc" required="required" type="text" value="<?php echo $qry->cDoc; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input class="form-control" name="cTelf" required="required" type="text" value="<?php echo $qry->cTelf; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="cDir" required="required" type="text" value="<?php echo $qry->cDir; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input class="form-control" name="cEmail" required="required" type="text" value="<?php echo $qry->cEmail; ?>">
                                </div>
                                <div class="checkbox" style="font-size:20px;">
                                    <label ><input class="cViewInv" type="checkbox" value="<?php echo $qry->cViewInv; ?>" name="cViewInv" onclick="clicViewInv()"><b>  VER PRECIOS</b>(EN FACTURA)</label>
                                </div> 

                                <input type="submit" value="Actualizar" class="btn btn-info btn-large" name="submit" />


                            </form>

 
                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
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
            </div>
            <!-- /.row -->
           
