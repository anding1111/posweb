
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading titles">
                        Tabla de Precios
                            <a href="add-product.php" class="btn btn-info pull-right titlesbuttons">Nuevo Precio</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#sl</th>
                                            <th>Nombre del Cliente</th>  
                                            <th>Nombre del Producto</th>                                   
                                            <th>Precio</th>                                            
                                            <th>Añadido por</th>
                                            <th>Añadido</th>
                                            <th>Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                        
                                        $qry = getAllProducts();                                        
                                        
                                        $i = 1;                                        
                                        
                                        while($data = mysqli_fetch_object( $qry )){                                            
                                            
                                            $datai = getItemNameById($data->pId);
                                            $datac = getCategoryNameById($data->cId);
                                            
                                            
                                    ?>

                                        <tr class="odd gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td> <a href="edit-product.php?iId=<?php echo $data->iId; ?> "><?php echo $datac->cName; ?></a> </td>
                                            <td> <a href="edit-product.php?iId=<?php echo $data->iId; ?> "><?php echo $datai->pName; ?></a> </td>
                                                                                   
                                            <td> <?php echo '$'.$data->pPrice; ?> </td>
                                            
                                            <td class="center"> <?php echo getUsernameByUserId($data->pAddedBy); ?> </td>
                                            
                                            <td class="center"> <?php 
                                            //$databaseDate = new Carbon\Carbon( $data->pEntryDate );
                                            echo $data->pEntryDate;

                                            //echo $databaseDate->diffForHumans();
                                                ?> 
                                            </td>
                                            <td class="center" data-pId="<?php echo $data->iId; ?>"> <button class="del-cata btn btn-danger" data-did="<?php echo $data->iId; ?>">Borrar</button>  </td>

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
                                            <h1>¿Quieres eliminar este producto?</h1>
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
                                                url: "body/delete-product.php",
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