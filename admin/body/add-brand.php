<?php  
    
    if ( @$_POST['submit'] ) {
        
       
         //collecting userinfo
                      
        $bName = formItemValidation($_POST['bName']);        
                        
                //current time now
                $nowTime = date("Y-m-d H:i:s");

                //need to insert data
                $myNewId = generateId();

                //logged in user ID
                $loggedInUser = $_SESSION['uId'];

                $qry = $conexion->query("INSERT INTO brands VALUES(
                                        '0',
                                        '".$bName."'
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
                            NUEVA MARCA
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Marca añadida con éxito</div>
                            <?php 
                                    redirectTo('brands.php', 2);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            
                              
                            <form role="form" method="POST" action="">
                               
                                 <div class="form-group">
                                    <label>MARCA</label>
                                    <input class="form-control" name="bName" required="required" type="text" value="">
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