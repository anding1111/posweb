<?php  

    // $getshId = $_GET['shId'];

    //collect all informaion from database
    // $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM shop WHERE shId = '{$getshId}' ") ); 
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM shop WHERE `shId` = '".$_SESSION['shId']."' ") ); 
    
    if ( @$_POST['submit'] ) {
        
         //collecting client info        
         $shName = formItemValidation($_POST['shName']);
         $shAuxName = formItemValidation($_POST['shAuxName']);
         $shDoc = formItemValidation($_POST['shDoc']);
         $shTelf = formItemValidation($_POST['shTelf']);
         $shDir = formItemValidation($_POST['shDir']);
         $shMail = formItemValidation($_POST['shMail']);       
         $shWeb = formItemValidation($_POST['shWeb']);       
         $shDesc = formItemValidation($_POST['shDesc']);       
         $shSearch = formItemValidation($_POST['shSearch']);       
         $shPrinterName = formItemValidation($_POST['shPrinterName']);       
         $shPrinterType = formItemValidation($_POST['shPrinterType']);        
         $shColor = formItemValidation($_POST['shColor']);        

        $update = "UPDATE shop SET shName = '".$shName."', shAuxName = '".$shAuxName."', shDoc = '".$shDoc."', shTelf = '".$shTelf."', shDir = '".$shDir."', shMail = '".$shMail."', shWeb = '".$shWeb."', shDesc = '".$shDesc."', shSearch = '".$shSearch."', shPrinterName = '".$shPrinterName."', shPrinterType = '".$shPrinterType."', shColor = '".$shColor."' WHERE `shId` = '".$_SESSION['shId']."' ";
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
                    <div class="panel panel-default w3-card-4">
                    <div class="titles">
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
                                <div class="alert alert-danger">Opps Este cliente ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="shName" required="required" type="text" value="<?php if(isset($qry->shName)) echo $qry->shName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sub-Nombre (Nombre Auxiliar)</label>
                                    <input class="form-control" name="shAuxName" type="text" value="<?php if (isset($qry->shAuxName)) echo $qry->shAuxName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Identificación</label>
                                    <input class="form-control" name="shDoc" required="required" type="text" value="<?php if(isset($qry->shDoc)) echo $qry->shDoc; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" name="shTelf" required="required" type="text" value="<?php if(isset($qry->shTelf)) echo $qry->shTelf; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="shDir" required="required" type="text" value="<?php if(isset($qry->shDir)) echo $qry->shDir; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input class="form-control" name="shMail" required="required" type="text" value="<?php if(isset($qry->shMail)) echo $qry->shMail; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sitio Web</label>
                                    <input class="form-control" name="shWeb" required="required" type="text" value="<?php if(isset($qry->shWeb)) echo $qry->shWeb; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Descripción (Eslogan)</label>
                                    <input class="form-control" name="shDesc" required="required" type="text" value="<?php if(isset($qry->shDesc)) echo $qry->shDesc; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Busqueda (Metodo de busqueda en el modulo ventas)</label>
                                    <?php $options = array( 
                                            "Nombre Producto" => 0, 
                                            "Código Barras" => 1
                                        );  ?>
                                    <select class="form-control" name="shSearch">
                                    <?php  foreach($options as $display => $value) {  ?>
                                        <option value='<?= $value ?>' <?php if($qry->shSearch == trim($value)) { ?>selected='selected'<?php } ?>>
                                            <?= $display ?>
                                        </option>
                                    <?php } ?>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <label>Nombre Impresora (Exactamente como aparece en Windows)</label>
                                    <input class="form-control" name="shPrinterName" required="required" type="text" value="<?php if(isset($qry->shPrinterName)) echo $qry->shPrinterName; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tipo Impresora (Tamaño de papel)</label>
                                    <?php $options = array( 
                                            "Impresora 80mm" => 0, 
                                            "Impresora 58mm" => 1
                                        );  ?>
                                    <select class="form-control" name="shPrinterType">
                                    <?php  foreach($options as $display => $value) {  ?>
                                        <option value='<?= $value ?>' <?php if($qry->shPrinterType == trim($value)) { ?>selected='selected'<?php } ?>>
                                            <?= $display ?>
                                        </option>
                                    <?php } ?>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input class="form-control" name="shColor" required="required" type="text" data-jscolor="{}" value="<?php if(isset($qry->shColor)) echo $qry->shColor; ?>">
                                </div>
                                
                                <input type="submit" value="Actualizar Datos" class="btn btn-info btn-large" name="submit" />


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