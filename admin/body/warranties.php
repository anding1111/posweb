
                <!-- /.col-lg-6... -->
                <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12 center-block" style="float:none"> 
                    <div class="panel panel-default w3-card-4">
                        <div class="titles">
                            CONSULTA GARANTIAS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">Producto Añadido Satisfactoriamente</div>
                            <?php 
                                    redirectTo('stockin.php', 2);

                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps! Algo salió mal. Inténtalo de nuevo</div>
                            <?php endif; ?>

                            
                              
                            <form role="form" method="POST" action="" id="form">
                                <div class="form-group">
                                    <label>IMEI O SERIAL</label>
                                    <input type="text" id="autocomplete_imei" class="form-control" required/>
                                    <!-- <input type="hidden" id="pId" name="pId" value="0">                                     -->
                                    <!-- <input class="form-control" name="pName" required type="text" value="<?php //echo @$_POST['pName'] ?>"> -->
                                </div> 
                                <div class="form-group">
                                    <label>PROVEEDOR</label>                                    
                                    <input class="form-control" id="pSupplier" name="pSupplier" readonly type="text" value="">
                                </div>                               

                                 <div class="form-group">
                                    <label>IMEI O SERIAL</label>                                    
                                    <input class="form-control" id="pSerial" name="pSerial" readonly type="text" value="">
                                </div>                                 

                                <div class="form-group">
                                    <label>AÑADIDO POR: </label>
                                    <input class="form-control" id='pUser' name="pUser" readonly type="text" value="">
                                </div> 
                                <div class="form-group">
                                    <label>FECHA INGRESO</label>
                                    <input class="form-control" id="pDate" name="pDate" readonly type="text" value="">
                                </div>  
                                <div class="form-group">
                                    <label>FECHA VENTA</label>
                                    <input class="form-control" id="pDateSale" name="pDate" readonly type="text" value="">
                                </div>  

                                <input type="button" value="LIMPIAR" class="btn btn-info btn-large" onclick="resetForm()" />


                            </form>
<script>
    $(document).ready(function(){  
            $( "#autocomplete_imei" ).focus();
    });
    $( function() {

    // Select Product
    $( "#autocomplete_imei" ).autocomplete({
        autoFocus: true,
        classes: {
            "ui-autocomplete": "highlight"
        },
        // minLength: 3,
        source: function( request, response ) {
        // Fetch data
            $.ajax({
            url: "body/search-product.php",
            type: 'post',
            dataType: "json",
            data: {
                search_imei: request.term
            },
            success: function( data ) {
                response( data );
            }
            });
        },
        select: function (event, ui) {
        
            $('#autocomplete_imei').val(ui.item.value); // display the selected text
            $('#pSupplier').val(ui.item.supplier); // set supplier the selected product
            $('#pSerial').val(ui.item.serial); // set serial the selected product
            $('#pUser').val(ui.item.user); // set user the selected product
            $('#pDate').val(ui.item.date); // set date input the selected product
            $('#pDateSale').val(ui.item.datesale); // set date sale the selected product
            //set cost the selected product
                    
            return false;
        }
    });

});
function promCost() {
var subAmount = Number($("#pCostOld").val()) + Number($("#pCostNew").val());
if($("#pCostOld").val() > 0){
    var prom = subAmount / 2;
}else{
    var prom = subAmount;
}

$("#pCostProm").val(prom);    
}

function resetForm() {
    document.getElementById("form").reset();
    $( "#autocomplete_imei" ).focus();
}                    
                        
</script>


                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            <!-- /.row -->
        </div>