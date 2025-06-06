             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default w3-card-4">
                    <div class="titles mb--10">
                            Informe Ventas
                            <!-- <a href="add-item.php" class="btn btn-info pull-right titlesbuttons">Nuevo producto</a> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                            <div class="table">
                                <br />
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="font-size:14px;">
                                            <div class="row col-md-12" style="font-size:14px;">
                                                <label class="container-custom">PRODUCTOS
                                                <input class="radio" type="radio" checked="checked" name="radio" value="1">
                                                <span class="checkmark-custom"></span>
                                                </label>
                                                <label class="container-custom">CLIENTES
                                                <input class="radio" type="radio" name="radio" value="2">
                                                <span class="checkmark-custom"></span>
                                                </label>
                                                <label class="container-custom">MARCAS
                                                <input class="radio" type="radio" name="radio" value="3">
                                                <span class="checkmark-custom"></span>
                                                </label>
                                            </div>
                                            <?php if (checkAdmin() || checkManager()) : ?>
                                            <div class="row col-md-12" style="font-size:14px;">
                                                <div class="form-group">
                                                    <label class="container-custom" for="sellerId">CAJERO(A):</label>
                                                    <select id="sellerId" name="sellerId" class="form-control">
                                                        <option value="">-- Todos --</option>
                                                        <?php
                                                        $resultSellers = mysqli_query($conexion, "SELECT DISTINCT id, uFullName FROM users WHERE softDelete = 0 AND shId = '".$_SESSION['shId']."' AND idStore = ".$_SESSION['idStore']."");
                                                        while ($row = mysqli_fetch_assoc($resultSellers)) {
                                                            echo "<option value='{$row['id']}'>{$row['uFullName']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                                <input type="hidden" id="sellerId" name="sellerId" value="<?php echo $_SESSION['usId']; ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-4">
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
                                            <div class="row col-md-12" id="timerState" data-timer="0">
                                                <div class="col-md-12 titles" style="font-size:18px;">
                                                <input type="button" name="timer" id="timer" value="HORAS" class="btn btn-info btn-mini"/>                                        
                                                </div>                                                
                                            </div>
                                            <div class="row col-md-12 viewTimer" style="display: none;">
                                                <div class="col-md-6 titles" style="font-size:18px;">
                                                    <b>HORA INICIAL: </b>
                                                    <input style="font-size:18px;" type="text" name="start_time" id="start_time" class="form-control input-timerstart" autocomplete="off"/>
                                                </div>
                                                <div class="col-md-6 titles" style="font-size:18px;">
                                                    <b>HORA FINAL: </b>
                                                    <input style="font-size:18px;" type="text" name="end_time" id="end_time" class="form-control input-timerend" autocomplete="off"/>
                                                </div> 
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-2" style="font-size:14px;">
                                            <label class="container-check">UTILIDAD
                                            <input id="checkbox" type="checkbox" name="checkbox[]" value="0" onclick="checkValidate();">
                                            <span class="checkmark-check"></span>
                                            </label>                                            
                                        </div>                                      
                                        <div class="col-md-2">
                                            <input style="height:45px; width:100%; margin-top:22px; font-size:16px; font-weight: bold;background-color:#287890;border-color:#287890;" type="button" name="search" id="search" value="CONSULTAR" class="btn btn-info" />                                        
                                        </div> 
                                    </div>                                       
                                </div>
                            <div id="printinf">
                                <br />
                                <table id="order_data" class="table table-bordered table-striped" width="100%">
                                
                                <tfoot>
                                   <tr>
                                       <th colspan="1" style="text-align:right">Total:</th>                                       
                                       <th></th>
                                       <th></th>
                                   </tr>                                 
                               </tfoot>
                                </table>
                                <table class="table table-bordered" id="table_credito">
                                    <tbody id="resume_credito" class="form-inline" style="font-size:22px; color:#2D7890;">
                                    <tr>
                                        <th colspan="4" class="text-center" id="totales"></th>                            
                                    </tr>                    
                                    </tbody>
                                </table>
                            </div>
                            </div>
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
            <script>
            function checkValidate() {
                if (document.getElementById('checkbox').checked) {
                    document.getElementById('checkbox').value = 1;
                } else {
                    document.getElementById('checkbox').value = 0;
                }
            }

            function imprimirinf() {				
			    window.print();                    
                }
        </script>
         
            <!-- /.row -->
        </div>