<?php  

    $getiId = $_GET['iId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object( $conexion->query("SELECT * FROM brands WHERE bId = '$getiId' ") );
    
    //$existingPName = $qry->iId;
        
    if ( @$_POST['submit'] ) {
          
    //collecting userinfo

        $bId = formItemValidation($_POST['bId']);
        $bName = formItemValidation($_POST['bName']);

        $update = "UPDATE brands SET bName = '".$bName."' WHERE bId = '".$bId."' ";

        $qry = $conexion->query($update) or die(mysqli_error($conexion));
        //$qry = mysql_query($update) or die(mysql_error());


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
                    <div class="titles">
                        Editar Marca
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">La marca se ha actualizado con éxito</div>
                            <?php 
                                    redirectTo('brands.php', 1);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            <?php if(isset($uniquenessError)) : ?>
                                <div class="alert alert-danger">Opps Este nombre de marca ya está en uso. Prueba otro.</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                            <div class="form-group">                                    
                                    <input type="hidden" class="form-control" name="bId" value="<?php echo $qry->bId; ?>" autocomplete="off">
                                </div> 
                                <div class="form-group">
                                    <label>MARCA:</label>
                                    <input class="form-control" name="bName" required="required" type="text" value="<?php echo $qry->bName; ?>">
                                </div>  
                                               
                                <input type="submit" value="Actualizar" class="btn btn-info btn-large" name="submit" />

                            </form>

                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->