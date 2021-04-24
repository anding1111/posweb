
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                    <div class="titles mb--10">
                            Tabla de productos

                            <a href="add-item.php" class="btn btn-info pull-right titlesbuttons">Nuevo producto</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-inventario" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>nombre del producto</th>
                                            <th>Código de barras</th>
                                            <th style="text-align:right">Cantidad</th> 
                                            <th style="text-align:right">Vr Unitario</th> 
                                            <th style="text-align:right">Vr Total</th>                                             
                                            <th style="text-align:center">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  
                                        $qry = getAllItems();
                                        $i = 1;
                                        while($data = mysqli_fetch_object( $qry )){
                                    ?>

                                        <tr class="odd gradeX">
                                            <td> <?php echo $i; ?> </td>
                                           
                                            <td> <a href="edit-item.php?pId=<?php echo $data->pId; ?> "><?php echo $data->pName; ?></a> </td>
                                            <td> <?php echo $data->pBarCode; ?> </td>
                                            <td style="text-align:right"> <?php echo $data->pQuantity; ?> </td> 
                                            <td style="text-align:right"> <?php echo $data->pCost; ?> </td>   
                                            <td style="text-align:right"> <?php echo $data->pCost * $data->pQuantity; ?> </td>                                  
                                            <td style="text-align:center" data-pId="<?php echo $data->pId; ?>"> <button class="del-cata btn btn-danger" data-did="<?php echo $data->pId; ?>">Borrar</button>  </td>

                                        </tr>
                                        
                                    <?php $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right">Total:</th>
                                            <th style="text-align:right"></th>
                                            <th style="text-align:right"></th>
                                            <th style="text-align:right"></th>
                                            <th style="text-align:right"></th>
                                        </tr>
                                    </tfoot>
                                </table>                                

                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h1>¿Quieres eliminar este producto??</h1>
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
                                        if(confirm("Estás seguro?")){
                                            $.ajax({
                                                url: "body/delete-item.php",
                                                type: "post",
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