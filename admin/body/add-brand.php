<?php  
    
    if ( @$_POST['submit'] ) {
        
         //collecting userinfo
        $bName = formItemValidation($_POST['bName']);        
                        
                //current time now
                // $nowTime = date("Y-m-d H:i:s");

                //need to insert data
                // $myNewId = generateId();

                //logged in user ID
                // $loggedInUser = $_SESSION['uId'];

                //logged in shop ID
                $loggedInShop = $_SESSION['shId'];

                $qry = $conexion->query("INSERT INTO brands VALUES(
                                        '0',
                                        '".$bName."',
                                        '".$loggedInShop."'
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
                    <div class="panel panel-default w3-card-4">
                        <div class="titles">
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
                <!-- /.col-lg-6... -->
            </div>
            <!-- /.row -->