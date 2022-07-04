<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default w3-card-4">
            <div class="titles mb--10">
                Entrada de Productos
                <!-- <a href="add-item.php" class="btn btn-info pull-right titlesbuttons">Nuevo producto</a> -->
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="display table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th style="text-align:center">Producto</th>
                                <th style="text-align:right">Cantidad</th>
                                <th style="text-align:right">Costo</th>
                                <th style="text-align:center">Proveedor</th>
                                <th style="text-align:right">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qry = getAllStockin();
                            $i = 1;
                            while ($data = mysqli_fetch_object($qry)) {
                            ?>

                                <tr class="odd gradeX">
                                    <td> <?php echo $i; ?> </td>
                                    <td style="text-align:center"> <?php echo $data->pName; ?> </td>
                                    <td style="text-align:right"> <?php echo $data->stQuantity; ?> </td>
                                    <td style="text-align:right"> <?php echo $data->stNewCost; ?> </td>
                                    <td style="text-align:center"> <?php echo $data->sName; ?> </td>
                                    <td style="text-align:right"> <?php echo $data->stDate; ?> </td>
                                </tr>

                            <?php $i++;
                            } ?>
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total:</th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                            </tr>
                        </tfoot> -->
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