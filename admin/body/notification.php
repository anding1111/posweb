        <?php  

            if ( isset($_GET['confId'] ) AND isset($_GET['delCon'] )) {
                
                if($_GET['delCon']){

                    $qry = $conexion->query("DELETE FROM users WHERE uId = ".$_GET['confId']." ");

                    if ( $qry) {
                        $deleteUpdate = 1;
                    }
                }

                if($_GET['confId']){

                    $qry = $conexion->query("UPDATE users SET uFlag = 1 WHERE uId = ".$_GET['confId']." ");

                    if ( $qry) {
                        $notiUpdate = 1;
                    }
                }

            }


        ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                        <div class="titles mb--10">
                        Reportes

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="display table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Usuario</th>
                                            <th>Detalles</th>
                                            <th>Tiempo</th>
                                            <th style="text-align:center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                        $qry = $conexion->query("SELECT u.* , n.* FROM users u, notification n WHERE u.shId = '".$_SESSION['shId']."' AND n.shId = '".$_SESSION['shId']."' AND u.uid=n.newUserId ");
                                        $i = 1;
                                        while($data = mysqli_fetch_object( $qry )){
                                    ?>

                                        <tr class="odd gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo getUsernameByUserId($data->nFromWhom);  ?> </td>
                                            <td class="center"> <?php echo $data->nMessage; ?> </td>
                                            
                                            <td class="center"> <?php 
                                            $databaseDate = new Carbon\Carbon( $data->nDate );
                                            echo $databaseDate->diffForHumans();
                                            ?> 
                                            </td>
                                            <td style="text-align:center"> 
                                                <a href="javascript:updateStatus(<?php echo $data->newUserId .', '. $data->delete; ?>)">Aprobar</a> | <a href="#">Rechazar</a> </th>
                                            </td>
                                        </tr>
                                        
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
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



        <script type="text/javascript">
            function updateStatus(id, delC)
            {
                if (confirm("¿De verdad quieres confirmar el borrado de este usuario?")) 
                {
                    window.location.href='notifications.php?confId='+id+'&delCon='+delC;

                };
            }

        </script>