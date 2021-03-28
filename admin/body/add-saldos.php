<?php  
    
    if ( @$_POST['submit'] ) {
       
        //collecting userinfo
        $pId = 1;       
        $pCredito = formItemValidation($_POST['pCredito']);        
        $cId = $_POST['cId']; 
                
        //current time now
        $nowTime = date("Y-m-d H:i:s");

        //generate invoice number
        $numRecibo = 0;       
        $result = mysqli_fetch_object($conexion->query("SELECT MAX(invId) AS 'maxN' FROM orders"));        
        $numRecibo = $result->maxN;        
        $invNum = $numRecibo + 1;

        //logged in user ID
        //$loggedInUser = $_SESSION['uId'];

        $qry = $conexion->query("INSERT INTO orders VALUES(
                                '0',
                                '".$invNum."', 
                                '0',
                                '".$cId."',                                       
                                '0',
                                '0',
                                '0',
                                '".$pCredito."',
                                '0',
                                '".$nowTime."',
                                ''
            )") or die(mysqli_error($conexion));

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
                            NUEVO CREDITO
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Credito añadido con éxito</div>
                            <?php 
                                    redirectTo('saldo.php', 2);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            
                              
                            <form role="form" method="POST" action="">
                               
                                 <div class="form-group">
                                    <label>CLIENTE</label>
                                    <select class="form-control" name="cId">
                                    <?php  

                                        $qry = getAllCategories();
                                        while($row = mysqli_fetch_object( $qry )){
                                    ?>

                                        <option value="<?php echo $row->cId; ?>"> <?php echo $row->cName; ?> </option>

                                    <?php } ?>
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label>VALOR CREDITO</label>
                                    <input class="form-control" name="pCredito" required="required" type="text" value="<?php echo @$_POST['pCredito'] ?>">
                                </div>                                

                                <input type="submit" value="GUARDAR" class="btn btn-info btn-large" name="submit" />


                            </form>

 
                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->