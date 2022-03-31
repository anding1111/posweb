
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                    <div class="titles mb--10">
                            Facturas con Proveedores
                            <a href="add-purchase.php" class="btn btn-info pull-right titlesbuttons">Añadir Factura</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                            
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <div class="col-md-8">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 titles" style="font-size:18px;">
                                                    <b>FECHA INICIAL: </b>
                                                    <input style="font-size:18px;" type="text" name="start_date" id="start_date" class="form-control input-daterange" autocomplete="off"/>
                                                </div>
                                                <div class="col-md-6 titles" style="font-size:18px;">
                                                    <b>FECHA FINAL: </b>
                                                    <input style="font-size:18px;" type="text" name="end_date" id="end_date" class="form-control input-daterange" autocomplete="off"/>
                                                </div> 
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <input style="height:45px; width:100%; margin-top:22px; font-size:16px; font-weight: bold;background-color:#287890;border-color:#287890;" type="button" name="search" id="search_purchases" value="CONSULTAR" class="btn btn-info" />                                        
                                        </div> 
                                    </div>                                       
                                </div>
                                <br>



                            <table class="table table-striped table-bordered table-hover" id="dataTables-all-compra" width="100%">
                               
                               
                                        <tfoot>
                                            <tr>
                                                <th colspan="1" style="text-align:right">Total:</th>
                                                <th colspan="1" style="text-align:right"></th>
                                                <th colspan="1" style="text-align:right"></th>
                                                <th colspan="1" style="text-align:right"></th>
                                                <th colspan="3" style="text-align:center"></th>
                                            </tr>
                                        </tfoot>
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