<?php  
    
    if ( @$_POST['submit'] ) {
        
       
         //collecting userinfo
        $pId = formItemValidation($_POST['pId']);        
        $pPrice = formItemValidation($_POST['pPrice']);        
        $cId = $_POST['cId']; 
                
                //current time now
                $nowTime = date("Y-m-d H:i:s");

                //need to insert data
                $myNewId = generateId();

                //logged in user ID
                $loggedInUser = $_SESSION['uId'];

                $qry = $conexion->query("INSERT INTO product VALUES(
                                        '0',
                                        '".$cId."',                                       
                                        '".$pId."',
                                        '".$pPrice."',
                                        '".$loggedInUser."',
                                        '".$nowTime."'
                    )") or die(mysqli_error($conexion));

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
                            NUEVO PRECIO
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Producto añadido con éxito</div>
                            <?php 
                                    redirectTo('products.php', 2);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="">
                                <div class="form-group">
                                    <label>PRODUCTO</label>
                                    <select class="form-control" name="pId">
                                    <?php  

                                        $qry = getAllItems();
                                        while($row = mysqli_fetch_object( $qry )){
                                    ?>

                                        <option value="<?php echo $row->pId; ?>"> <?php echo $row->pName; ?> </option>

                                    <?php } ?>
                                    </select>
                                </div>

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
                                    <label>PRECIO</label>
                                    <input class="form-control" name="pPrice" required="required" type="text" value="<?php echo @$_POST['pPrice'] ?>">
                                </div>                                

                                <input type="submit" value="GUARDAR" class="btn btn-info btn-large" name="submit" />


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