
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                        <div class="titles mb--10">
                            Clientes

                            <a href="add-client.php" class="btn btn-info pull-right titlesbuttons">Nuevo Cliente</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="display table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nombre Cliente</th>
                                            <th>Documento</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Correo</th>
                                            <th style="text-align:center">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                        $qry = getAllClients();

                                        $i = 1;

                                        while($data = mysqli_fetch_object( $qry )){
                                    ?>

                                        <tr class="odd gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td> <a href="edit-client.php?cId=<?php echo $data->cId; ?> "><?php echo $data->cName; ?></a> </td>
                                            <td> <?php echo $data->cDoc; ?> </td>
                                            <td> <?php echo $data->cTelf; ?> </td>
                                            <td> <?php echo $data->cDir; ?> </td>
                                            <td> <?php echo $data->cEmail; ?> </td>
                                            <td style="text-align:center" data-cId="<?php echo $data->cId; ?>"> <button class="del-cata btn btn-danger" data-did="<?php echo $data->cId; ?>">Borrar</button>  </td>
                                        </tr>
                                        
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>

                                


                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Eliminar confirmacion</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h1>¿Quieres eliminar este cliente?</h1>
                                        </div>
                                        <div class="modal-footer">
                                           <!-- <button id="del-confirm"></button> -->
                                            <input id="del-confirm" type="button" name="yes" value="Yes" class="btn btn-primary" />
                                            <input type="button" name="no" value="No" class="btn btn-danger" />
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                             <script type="text/javascript">
                                $(function(){
                                    $(".del-cata").click(function(){
                                        //alert($(this).data("did"));
                                        var row = $(this);
                                        var id = $(this).data("did");
                                        if(confirm("Estas Seguro?")){
                                            $.ajax({
                                                url: "body/delete-client.php",
                                                type: "POST",
                                                data: {dId:id}												
                                            }).done(function(msg){
                                                row.closest("tr").remove();

                                            });
                                        }
                                    });
                                });

                                </script>  
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