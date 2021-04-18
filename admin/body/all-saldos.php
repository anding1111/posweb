
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    <div class="titles mb--10">
                            Creditos
                            <a href="add-saldo.php" class="btn btn-info pull-right titlesbuttons">Añadir credito</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-credito-compra" width="100%">
                               
                               <thead>
                                   <tr>                                       
                                        <th>Cliente</th>
                                        <th style="text-align:right">Saldo</th> 
                                        <th style="text-align:center">Abonar</th>                                                    
                                   </tr>
                                </thead>
                                <tbody>
                                <?php  

                                    $qry = getAllSaldos();                                                                    
                                    while($data = mysqli_fetch_object( $qry )) {									   
									   if($data->total <> $data->pagado) {                                      
                                ?>
                                            <tr class="odd gradeX">
                                                <?php                                               
                                                $client = getCategoryNameById($data->cId);
                                                ?>
                                                <td> 
                                                <?php
                                                echo($client->cName);                                                   
                                                ?>
                                                </td>
                                                <td style="text-align:right"> 
                                                <?php 
                                                echo $data->total - $data->pagado;
                                                ?>
                                                </td>                                       
                                                <td style="text-align:center">
                                                <?php echo '<a href="#agree_modal" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-id="'.$data->cId.'">Abonar</a>';?>
                                                </td>                                        
                                            </tr>                                                           
                                       <?php }
									} ?> 
                                </tbody>
                               <tfoot>
                                   <tr>
                                       <th colspan="1" style="text-align:right">Total:</th>
                                       <th colspan="1" style="text-align:right"></th>
                                       <th colspan="1" style="text-align:right"></th>
                                   </tr>
                               </tfoot>
                           </table>
                           <!-- Modal Abono -->
                           <div class="modal fade" id="agree_modal" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="font-family: Raleway, sans-serif;">
                                                <div class="modal-header" style="background-color:#33B5E5;">
                                                    <button type="button" class="close" data-dismiss="modal" style="color:#fff">&times;</button>
                                                    <h3 class="modal-title text-center" style="color:#fff;">PAGO DE CREDITO</h3>
                                                    <h2 class="modal-title text-center" style="color:#fff" id="aId"></h2>
                                                </div>
                                                <div class="modal-body" style=" height: 70%; width: 100%; overflow-y:auto">
                                                   
                                                    <div class="row text-center" style="display: flex; align-items: center; padding-bottom:2px">
                                                    <label class="col-md-4 control-label" style="text-align: right; padding-right:2px; width:30%">Cliente:</label>  
                                                    <div class="col-md-8 inputGroupContainer">
                                                    <div class="input-group" style="width:100%;">
                                                    <span class="input-group-addon" style="width:50px"><i class="fa fa-user"></i></span>
                                                    <input  placeholder="Cliente" class="form-control" id="saName" type="text" readonly>
                                                    <input  type="hidden" placeholder="Cliente" class="form-control" id="saId" type="text" readonly>
                                                    
                                                        </div>
                                                    </div>
                                                    </div>

                                                    <div class="row text-center" style="display: flex; align-items: center; padding-bottom:2px">
                                                    <label class="col-md-4 control-label" style="text-align: right; padding-right:2px; width:30%">Saldo:</label> 
                                                        <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group" style="width:100%;">
                                                    <span class="input-group-addon" style="width:50px"><i class="fa fa-vcard"></i></i></span>
                                                    <input placeholder="Saldo actual" class="form-control" id="saSaldo" type="text" readonly>
                                                        </div>
                                                    </div>
                                                    </div>

                                                        <div class="row text-center" style="display: flex; align-items: center; padding-bottom:2px">
                                                    <label class="col-md-4 control-label" style="text-align: right; padding-right:2px; width:30%">Abona:</label>  
                                                        <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group" style="width:100%;">
                                                            <span class="input-group-addon" style="width:50px"><i class="fa fa-phone-square"></i></span>
                                                    <input  placeholder="Abono" class="form-control" id="saAbona" type="text" oninput="newSaldo()">
                                                        </div>
                                                    </div>
                                                    </div>
                                                                                               
                                                   
                                                    <div class="row text-center" style="display: flex; align-items: center; padding-bottom:2px">						   
                                                    <label class="col-md-4 control-label" style="text-align:right; padding-right:2px; width:30%">Nuevo Saldo:</label>
                                                        <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group" style="width:100%;">
                                                            <span class="input-group-addon" style="width:50px"><i class="fa fa-money"></i></span>
                                                    <input  placeholder="Valor" class="form-control" id="saSaldoNew" type="text" readonly>
                                                    </div>
                                                    </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                <div class="col-md-12" style="text-align:center;">
                                                    <button type="button" id="abono-confirm" class="btn btn-default btn-lg" data-dismiss="modal" style="color:#fff;background-color:#33B5E5;">ACEPTAR PAGO</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <!-- Fin Modal Abono -->                                                    

                            <script type="text/javascript">

                            $('#agree_modal').on('show.bs.modal', function (e) {
                                var rowid = $(e.relatedTarget).data('id');                           
                                $.ajax({
                                    type : 'post',
                                    url : 'fetch-saldo.php', //Here you will fetch records 
                                    data :  {rowid}, //Pass $id                                
                                    dataType:"json",
                                    success : function(data){  
                                        $('#saId').val(data.id);                                			
                                        $('#saName').val(data.name);
                                        $('#saSaldo').val(data.saldo);
                                        $('#saAbona').val(0);
                                        $('#saSaldoNew').val(data.saldo);                                            
                                    }
                                });
                            });	

                            $("#abono-confirm").click(function(){                     
                                var id = $('#saId').val(); 
                                var saldo = $('#saAbona').val(); 
                                $.ajax({
                                        url: "body/abono-saldo.php",
                                        type: "post",
                                        data: {dId:id, dSaldo:saldo}
                                }).done(function(msg){                   
                                    window.location.reload();                                              
                                });
                            });

                            function newSaldo() {                            
                                var newSaldo = $('#saSaldo').val() - $('#saAbona').val(); 
                                $('#saSaldoNew').val(newSaldo);                            
                            }

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