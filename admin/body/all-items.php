
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
                                            <td style="text-align:center" data-pId="<?php echo $data->pId; ?>">
                                            <button class="del-cata btn btn-danger" data-did="<?php echo $data->pId; ?>">Borrar</button>
                                            <?php $stores = getAllStores(); 
                                            if ( $stores->num_rows > 1 ) { ?>
                                            <a href="#transfer_modal" class=" itemInfo btn btn-default btn-small" id="pId" data-toggle="modal" data-id="<?php echo $data->pId ?>">Trasladar</a>
                                            <?php } ?>
                                        </td>
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

            <!-- Modal Transfer -->
            <div class="modal fade" id="transfer_modal" role="dialog">
                <div class="modal-dialog">                            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <label class="modal-title" style="width: 100%; text-align:center;">TRASLADAR PRODUCTO</label>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer" style="text-align: center; margin-top:40px;">
                            <button type="button" id="transfer-confirm" class="btn btn-default btn-lg" data-dismiss="modal" style="color:#fff;background-color:#33B5E5;">TRASLADAR PRODUCTO</button>
                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="color:#fff;background-color:#33B5E5;">SALIR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Modal Transfer -->  
            <script type="text/javascript">
            $(document).ready(function() { 
                $('.itemInfo').click(function(){   
                    var item_id = $(this).data('id');
                    // AJAX request
                    $.ajax({
                        url: 'fetch-item.php',
                        type: 'post',
                        data: {item_id},
                        success: function(response){ 
                        // Add response in Modal body
                        $('.modal-body').html(response);
                        // Display Modal
                        var numItems = $('#numItems').val();
                        if (numItems < 2) {
                            $('#transfer-confirm').prop('disabled', true);
                        } else {
                            $('#transfer-confirm').prop('disabled', false);
                        }
                        $('#transfer_modal').modal('show'); 
                        }
                    });
                });
                
                $("#transfer-confirm").click(function(){                     
                var pId = $('#idItem').val();
                var store_receive = $('#store_receive').val();
                var qty_send = Number($('#transferQty').val());
                $.ajax({
                        url: "body/transfer-item.php",
                        type: "post",
                        data: {pId, store_receive, qty_send}
                }).done(function(msg){  
                    window.location.reload();                                              
                });
                });
            });
            function qtyTransfer(){
                var qty_out = $('#qtyItem').val();
                var qty_transfer = $('#transferQty').val();
                if (Number(qty_transfer) > Number(qty_out)){
                    $('#transferQty').val(Number(qty_out));
                }
            }
            
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