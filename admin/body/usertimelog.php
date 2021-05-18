
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                        <div class="titles mb--10">
                        Registro de llegada del usuario

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="display table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                            <th>Hora inicio</th>
                                            <th>Hora salida</th>
                                            <th>Total(Min)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  
                                        $qry = getOperativeLogData();
                                        $i = 1;
                                        while($data = mysqli_fetch_object( $qry )){
                                    ?>

                                        <tr class="odd gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo getFullUsernameByUserId($data->uId); ?> </td>
                                            <td> <?php 
                                            	$todayDate = new Carbon\Carbon( $data->loginTime );
                                            	echo($todayDate);  
                                            	// echo($todayDate->toFormattedDateString());  

                                             ?> </td>
                                            <td class="center"> 
                                            	<?php 
	                                            	$inTime = new Carbon\Carbon( $data->loginTime );
	                                            	echo($inTime->toTimeString());  
	                                             ?> 
                                            </td>
                                            <td class="center"> 
                                            	<?php 
	                                            	$outTime = new Carbon\Carbon( $data->logoutTime );
	                                            	echo($outTime->toTimeString());  
	                                             ?> 
                                            </td>
                                            <td class="center"> <?php 
                                                $total = $inTime->diffInMinutes($outTime);
                                                // echo $total;
                                                echo dateDifference($data->logoutTime, $data->loginTime);
                                                ?> 
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