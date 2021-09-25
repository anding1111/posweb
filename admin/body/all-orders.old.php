
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                    <div class="titles mb--10">
                        Lista de Ventas
                          
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


                            <div class="dataTable_wrapper">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-recibos" width="100%">                               
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Cliente</th>
                                            <th style="text-align:right">Total</th>                                            
                                            <th>Fecha</th>
                                            <th style="text-align:center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $qry = getAllOrders();
                                        while($data = mysqli_fetch_object( $qry )){
                                    ?>
                                            <tr class="odd gradeX">
                                                <td> 
                                                <?php echo($data->invId);?>
                                                </td>
                                                <td> 
                                                <?php  $client = getClientNameById($data->cId);
                                                echo($client->cName); ?>
                                                </td>
                                                <td style="text-align:right"> 
                                                <?php
                                                echo($data->totalOrder); ?>
                                                </td>                                       
                                                <td> 
                                                <?php echo($data->bDate); ?>
                                                </td>
                                                <td style="text-align:center">
                                                <a href="invoice.php?invId=<?php echo $data->invId; ?>&type=1" class="btn btn-default">Ver</a>
                                                <a href="#null_modal" class=" invoiceInfo btn btn-default btn-small" id="invId" data-toggle="modal" data-id="<?php echo $data->invId ?>">Anular</a>
                                                </td>
                                            </tr>                                                          
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:right">Total:</th>
                                            <th colspan="1" style="text-align:right"></th>
                                            <th style="text-align:right"></th>
                                            <th style="text-align:right"></th>
                                        </tr>
                                    </tfoot>
                                </table>                               
                            </div>
                            <!-- /.table-responsive -->
                            <!-- Modal Anulacion -->
                            <div class="modal fade" id="null_modal" role="dialog">
                                <div class="modal-dialog">                            
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <label class="modal-title" style="width: 100%; text-align:center;">ANULACIÓN DE FACTURA</label>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                    
                                        </div>
                                        <div class="modal-footer" style="text-align: center;">
                                            <button type="button" id="null-confirm" class="btn btn-default btn-lg" data-dismiss="modal" style="color:#fff;background-color:#33B5E5;">ANULAR FACTURA</button>
                                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="color:#fff;background-color:#33B5E5;">SALIR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin Modal Anulacion -->  
                            <script type="text/javascript">
                            $(document).ready(function() { 
                                $('.invoiceInfo').click(function(){   
                                    var userid = $(this).data('id');
                                    // AJAX request
                                    $.ajax({
                                        url: 'fetch-invoice.php',
                                        type: 'post',
                                        data: {userid: userid},
                                        success: function(response){ 
                                        // Add response in Modal body
                                        $('.modal-body').html(response);
                                        // Display Modal
                                        $('#null_modal').modal('show'); 
                                        }
                                    });
                                });
                                $("#null-confirm").click(function(){                     
                                var id = $('#numInvoice').val(); 
                                //var saldo = $('#saAbona').val(); 
                                $.ajax({
                                        url: "body/null-invoice.php",
                                        type: "post",
                                        data: {invId:id}
                                }).done(function(msg){                   
                                    window.location.reload();                                              
                                });
                            });
                            });
                          
                            </script>      
                            
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

        