<?php  

    //Collect all information from database
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
        $shTerms = formItemValidation($_POST['shTerms']);        
        $shInvoiceType = formItemValidation($_POST['shInvoiceType']);
        $shInventory = formItemValidation($_POST['shInventory']);
        $shClientDefault = formItemValidation($_POST['shClientDefault']);
        $shColor = formItemValidation($_POST['shColor']);
        
        if ($_FILES['shLogo']['size'] == 0){
            $destination = $qry->shLogo;
        } else {
            // Crea nuevo nombre al logo
            $filename   = $_SESSION['shId'] . "-logo-" . time(); // Codigo de la tienda + -logo- + time
            $extension  = pathinfo( $_FILES["shLogo"]["name"], PATHINFO_EXTENSION ); // jpg
            $basename   = $filename . "." . $extension; // 11-logo-2635216534.jpg
            $source       = $_FILES["shLogo"]["tmp_name"];
            $destination  = "logos/{$basename}"; 
            
            // Mueve la imagen cargada a la carpeta: logos
            if (move_uploaded_file( $source, $destination ))  {
                $msg = "Imagen cargada con éxito";
            }else{
                $msg = "No se pudo cargar la imagen";
            }
        }

        //Actualiza los datos de la tienda
        $update = "UPDATE shop SET shName = '".$shName."', shAuxName = '".$shAuxName."', shDoc = '".$shDoc."', shTelf = '".$shTelf."', shDir = '".$shDir."', shMail = '".$shMail."', shWeb = '".$shWeb."', shDesc = '".$shDesc."', shSearch = '".$shSearch."', shPrinterName = '".$shPrinterName."', shPrinterType = '".$shPrinterType."', shLogo = '".$destination."', shTerms = '".$shTerms."', shInvoiceType = '".$shInvoiceType."', shInventory = '".$shInventory."', shClientDefault = '".$shClientDefault."', shColor = '".$shColor."' WHERE `shId` = '".$_SESSION['shId']."' ";
        $qry_update = $conexion->query($update) or die(mysqli_error($conexion));

        if ( $qry_update ) {
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
                                <div class="alert alert-danger">Opps Este nombre de tienda ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="" enctype="multipart/form-data">
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
                                    <label>Tipo de Recibo (Nombre del recibo para el cliente)</label>
                                    <?php $options = array( 
                                            "Factura" => 0, 
                                            "Recibo" => 1, 
                                            "Remision" => 2,
                                            "Salida de Almacen" => 3
                                        );  ?>
                                    <select class="form-control" name="shInvoiceType">
                                    <?php  foreach($options as $display => $value) {  ?>
                                        <option value='<?= $value ?>' <?php if($qry->shInvoiceType == trim($value)) { ?>selected='selected'<?php } ?>>
                                            <?= $display ?>
                                        </option>
                                    <?php } ?>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <label>Busqueda (Metodo de busqueda en el modulo ventas)</label>
                                    <?php $options = array( 
                                            "Nombre Producto" => 0, 
                                            "Código Barras | Añadir Automaticamente" => 1,
                                            "Código Barras | Seleccionar Manualmente" => 2
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
                                    <label>Manejo de Inventarios</label>
                                    <?php $options = array( 
                                            "Descontar del Inventario" => 0, 
                                            "No descontar del Inventario" => 1, 
                                            "Permitir Inventario negativo" => 2
                                        );  ?>
                                    <select class="form-control" name="shInventory">
                                    <?php  foreach($options as $display => $value) {  ?>
                                        <option value='<?= $value ?>' <?php if($qry->shInventory == trim($value)) { ?>selected='selected'<?php } ?>>
                                            <?= $display ?>
                                        </option>
                                    <?php } ?>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <label>Cliente por Defecto en Ventas (Al momento de hacer el recibo)</label>
                                    <?php $options = array( 
                                            "NO" => 0, 
                                            "SI" => 1
                                        );  ?>
                                    <select class="form-control" name="shClientDefault">
                                    <?php  foreach($options as $display => $value) {  ?>
                                        <option value='<?= $value ?>' <?php if($qry->shClientDefault == trim($value)) { ?>selected='selected'<?php } ?>>
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
                                            "Impresora 58mm" => 1,
                                            "Impresora Media Carta" => 2,
                                            "Impresora Completa Carta" => 3
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
                                    <label>Logo en factura (No se imprime en impresora térmica)</label>
                                    <div class="form-horizontal">
                                        <div class="col-sm-8" style="padding-left: 0px;">
                                            <input class="form-control" name="shLogo" type="file" name="uploadfile" accept="image/png, image/gif, image/jpeg" value=""/>                                   
                                        </div>
                                        <div class="col-sm-4" style="padding-left: 0px; margin-bottom: 15px;">
                                        <img id="imgLogo" src="<?php if(isset($qry->shLogo)) echo $qry->shLogo; ?>" alt="Logo" width="64" height="64">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Terminos o Condiciones (aparece en la parte de abajo de la factura)</label>
                                    <textarea class="form-control" name="shTerms" type="text"><?php if(isset($qry->shTerms)) echo $qry->shTerms; ?></textarea>
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