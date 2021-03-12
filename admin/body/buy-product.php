<?php 
    
    if ( @$_POST['submit'] ) {
       
         //collecting userinfo
        $cId = formItemValidation($_POST['cId']);
        $cCredito = formItemValidation($_POST['cCredito']);
        $cPayment = 0;
        $cTotal = numIntPHP(formItemValidation($_POST['cTotal']));               
        $ifCredito = formItemValidation($_POST['ifCredito']);
        $inSerial = formItemValidation($_POST['inSerial']);
        $inSerial = trim($inSerial);
        if (empty($inSerial)) {
            $numRows = 0;            
        }else{
            $serial = explode(" ", $inSerial);
            $numRows = count($serial);
        }
        $sn = '';        
        
        //current time now
        $nowTime = date("Y-m-d H:i:s");
        //$nowTime = date("Y-m-d");

        $numRecibo = 0;       
        $result = mysqli_fetch_object($conexion->query("SELECT MAX(invId) AS 'maxN' FROM customer"));        
        $numRecibo = $result->maxN;        
        $invNum = $numRecibo + 1;   

        //logged in user ID
        $loggedInUser = $_SESSION['uId'];

        $numRows = formItemValidation($_POST['numRows']);
        $i = 1;
        $qry = 0;
        
        //Validate Credit
        if($ifCredito ==1 ){
            $cPayment = $cCredito;
        }else{
            $cPayment = $cTotal;
        }
        
        for ($i=0;$i<$numRows;$i++)
            {
            $pId = formItemValidation($_POST['pId_value'][$i]);
			$pQty = formItemValidation($_POST['qty'][$i]);
			$pPrice = formItemValidation($_POST['rate'][$i]);
            $pMount = formItemValidation($_POST['amount'][$i]);
            $pCost = formItemValidation($_POST['cost_value'][$i]);               

            $qryt = mysqli_fetch_object( $conexion->query("SELECT * FROM items WHERE pId = '$pId'") );
            $idif = $qryt->pQuantity - $pQty;
			
			if($pQty>0){
				
				if ($idif<0){
					echo '<script language="javascript">alert("¡No hay inventario suficiente de '.$qryt->pName.'!");</script>';					
				}else{
					
					 if ($idif<10){
						echo '<script language="javascript">alert("¡'.$qryt->pName.' menor a 50 unidades!");</script>';
                        }
                    //Update Qty on items  
					$update = "UPDATE items SET pQuantity = '".$idif."' WHERE pId = '".$pId."' ";
					$qryf = $conexion->query($update) or die(mysqli_error($conexion));            
					$qry = $conexion->query("INSERT INTO customer VALUES(
						'0',
						'".$invNum."',
						'".$pId."',                
						'".$cId."',
						'".$pPrice."',
						'".$pQty."',
                        '".$pCost."',
						'".$pMount."',
                        '".$cPayment."',
						'".$nowTime."',
                        '".$inSerial."'                 
						
                        )") or die(mysqli_error($conexion));

                    if( isset($serial[$i])){
                        $sn = $serial[$i];
                        //Update Serial on serials  
                        $update = "UPDATE serials SET seDateSale = '".$nowTime."' WHERE seSerial = '".$sn."' ";
                        $qryse = $conexion->query($update) or die(mysqli_error($conexion)); 
                    }
                    $sn ='';
                    
                    //Update Price                    
                    // $qrys = $conexion->query("UPDATE product SET 
                    //     cId = '".$cId."',
                    //     pId = '".$pId."', 
                    //     pPrice = '".$pPrice."', 
                    //     pAddedBy = '".$loggedInUser."', 
                    //     pEntryDate = '".$nowTime."' 
                    //     WHERE cId = '".$cId."' AND pId = '".$pId."' ")or die(mysqli_error($conexion));
				}  
					
			} 

            if ( $qry ) {
                $insertSuccess = 1;
            } else{
                $insertError = 1;
            } 
        } 
    }

?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading titles">
                        <?php echo $shop->shName?> POS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <?php if(isset($insertSuccess)) : ?>
                                <div class="alert alert-success">El producto fue comprado con éxito</div>
                            <?php 
                                    //redirectTo('buy-product.php', 0);                                    
                                    $mariae = "invoice.php?invId=".$invNum;
                                    redirectTo($mariae, 0);
                                    endif; ?>

                            <?php if(isset($insertError)) : ?>
                                <div class="alert alert-danger">Opps Algo salio mal. Inténtalo de nuevo</div>
                            <?php endif; ?>
                              
                            <form role="form" method="POST" action="" id="printer"> 

                            <div class="col-lg-12">
                                <div class="col-lg-9">
                                    <!-- </div> -->
                                    <div class="form-group wraper">
                                        <div class="topleft">
                                            <label style="font-size:14px">INGRESE EL NOMBRE DEL PRODUCTO:</label> <br>
                                            <input type="text" id="autocomplete" class="form-control" style="margin-bottom: 8px;"/>
                                        </div>
                                        <div class="topright">
                                            
                                                <?php
                                                $date = new DateTime();
                                                //echo $date->format('l, F jS, Y'); 
                                                echo '<div><p>';
                                                $Fecha = date('d-m-Y H:i:s');
                                                echo fechaCastellano($Fecha);
                                                echo '</p></div>';
                                                ?>
                                                <div>
                                                <span id="tick2"></span>
                                                </div>                                                   
                                           
                                        </div>
                                    </div>

                                    <div class="form-group wraper">
                                        <table class="table table-bordered table-fixed" id="product_info_table">
                                            <thead class="head-fixed">
                                                <tr>
                                                <!-- <th style="width:12%">Cod.</th> -->
                                                <th style="width:12%">Disp.</th>
                                                <th style="width:34%">Descripción</th>
                                                <th style="width:12%">Cant.</th>
                                                <th style="width:15%">Vr. Unit.</th>
                                                <th style="width:18%">Vr. Total</th>
                                                <th style="width:9%; text-align:center;">Borr.</th>
                                                </tr>
                                            </thead>

                                            <tbody class="body-fixed">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group wraper">
                                        <div class="topjustify">
                                            <label style="font-size:14px">OBSERVACIONES:</label> <br>
                                            <textarea class="form-control" rows="1" name="inSerial" type="text" value=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3"> 
                                    <table class="table wraper" id="product_info_table_2">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <div class="form-inline">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">CLIENTE</legend>                                                    
                                                    <input type="text" id="autocomplete_customer" class="form-control" required/>
                                                    <input type="hidden" id="cId" name="cId" value="0">
                                                    <div class="form-inline" id="oculta-saldo" style="width:100%; padding-top:10px;">
                                                        <label style="font-size:12px; width:25%;">Saldo: </label>
                                                        <input style="text-align:center; font-size:18px; background-color:coral; width:72%;" id="saldoCliente" name="saldoCliente" value="0" readonly>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <td>
                                            <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">TOTAL</legend>       
                                                    <!-- <label style="font-size:14px;width:20%;vertical-align:middle; text-align:right">TOTAL:</label> -->
                                                    <input id="gross_total" class="form-control" name="cTotal" style="font-size:30px;width:100%;height:65px;text-align:center;" required="required" type="text" value="" readonly="readonly">
                                            </fieldset>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>
                                            <div class="form-inline">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">FORMA DE PAGO</legend>
                                                    <div class="form-group" style="width:100%;">
                                                        <!-- <label style="width:25%">Selecc.</label> -->
                                                        <select class="form-control fPago" name="fPago" style="width:100%">
                                                            <option value="1" selected id="ocultar">Contado</option>
                                                            <option value="2" id="mostrar">Credito</option>                                                            
                                                        </select>
                                                    </div>
                                                    <input type="hidden" id="ifCredito" name="ifCredito" value="0">
                                                    <div class="form-inline" id="mostrar-ocultar" style="width:100%; padding-top:10px;"> 
                                                        <label style="font-size:12px; width:25%;">Abono: </label>
                                                        <input type="text" name="cCredito" value="0" style="font-size:18px; width:72%; padding-left:10px;">
                                                    </div>
                                                   
                                                </fieldset>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <input type="submit" value="COBRAR" style="font-size:26px; font-weight: bold; width:100%;vertical-align:middle;" class="btn btn-info btn-large" name="submit"/>
                                            <input type="hidden" name="numRows" id="num_rows" value="">
                                            </td>
                                        </tr>
                                                            
                                        </tbody>
                                    </table>
                                  
                                </div>
                            </div>
                        </form> 

<script type="text/javascript">
    var tableSize = 0; 
    var deleted = 0;                                                                         						

    $(document).ready(function(){ 
        
        $('#mostrar-ocultar').hide("linear");
        $('#oculta-saldo').hide("linear");      

        $("#gross_total").val(0); 
        $('#autocomplete_customer').val('');   
        $( "#autocomplete" ).focus();
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
            if(event.keyCode == 27) {
                alert("Presiono Escape");
                event.preventDefault();
                return false;
            }
        });         	

    });
    $( function() {

        // Single Select
        $( "#autocomplete" ).autocomplete({
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
                    search: request.term
                },
                success: function( data ) {
                    response( data );
                }
                });
            },
            select: function (event, ui) {
            // Set selection
            getProductData(ui.item.value);
            $('#autocomplete').val(''); // display the selected text            
                return false;
            }
        });
        // Single Select Customer
        $( "#autocomplete_customer" ).autocomplete({
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
                    search_customer: request.term
                },
                success: function( data ) {
                    response( data );
                }
                });
            },
            select: function (event, ui) {
          
            $('#autocomplete_customer').val(ui.item.label); // display the selected text
            $('#cId').val(ui.item.value); // set value the selected customer id

            if(ui.item.saldo != 0){
                $('#oculta-saldo').show("swing");
            } else {
                $('#oculta-saldo').hide("swing");
            }
            $('#saldoCliente').val(numMiles(ui.item.saldo)); // set value saldo the selected customer
            subAmount();
            return false;
            }
        });
        // Getter
        // var autoFocus = $( ".selector" ).autocomplete( "option", "autoFocus" );
        
        // Setter
        // $( ".selector" ).autocomplete( "option", "autoFocus", true );
    });

    function split( val ) {
    return val.split( /,\s*/ );
    }
    function extractLast( term ) {
    return split( term ).pop();
    }

    //Add new row  
	function getProductData(row_id) {
        var table = $("#product_info_table");
        var count_table_tbody_tr = $("#product_info_table tbody tr").length;
        var num_row = count_table_tbody_tr + 1 + deleted;
        tableSize = num_row;
        var html = '<tr id="row_'+num_row+'">'+                  
                   '<td style="width:12%"><input type="hidden" name="pId_value[]" id="pId_value_'+num_row+'" class="form-control"><input type="text" name="code[]" id="disp_'+num_row+'" class="form-control" disabled><input type="hidden" name="code_value[]" id="disp_value_'+num_row+'" class="form-control"></td>'+
                   '<td style="width:34%"><input type="text" name="name[]" id="name_'+num_row+'" class="form-control" disabled><input type="hidden" name="name_value[]" id="name_value_'+num_row+'" class="form-control"></td>'+
                   '<td style="width:12%"><input type="number" min="1" name="qty[]" id="qty_'+num_row+'" class="form-control" required oninput="subAmount('+num_row+')"><input type="hidden" name="cost_value[]" id="cost_value_'+num_row+'" class="form-control"></td>'+
                   '<td style="width:15%"><input type="text" name="rate[]" id="rate_'+num_row+'" class="form-control" required oninput="subAmount('+num_row+')"><input type="hidden" name="rate_value[]" id="rate_value_'+num_row+'" class="form-control"></td>'+
                   '<td style="width:18%"><input type="text" name="amount[]" id="amount_'+num_row+'" class="form-control" value="" readonly></td>'+
                   '<td style="width:9%; text-align:center;"><button type="button" class="btn btn-default" onclick="removeRow(\''+num_row+'\')"><i class="fa fa-close"></i></button></td>'+
                   '</tr>';
        if(count_table_tbody_tr >= 1) {
            $("#product_info_table tbody tr:last").after(html);  
        } else {
                $("#product_info_table tbody").html(html);
            }

            $.ajax({
                url: "body/select-product.php",
                type: 'post',
                data: {row_id : row_id},
                dataType: 'json',
                success:function(response) {
            
                    // setting the rate value into the rate input field	   
                    $("#pId_value_"+num_row).val(response.pId);

                    // $("#code_"+num_row).val(response.pBarCode);
                    // $("#code_value_"+num_row).val(response.pBarCode);
                    $("#disp_"+num_row).val(response.pQuantity);
                    $("#disp_value_"+num_row).val(response.pQuantity);

                    $("#name_"+num_row).val(response.pName);
                    $("#name_value_"+num_row).val(response.pName);
                    
                    $("#rate_"+num_row).val(response.pPrice);
                    $("#rate_value_"+num_row).val(response.pPrice);

                    $("#qty_"+num_row).val(1);
                    $("#qty_value_"+num_row).val(1);

                    $("#cost_value_"+num_row).val(response.pCost);

                    var total = Number(response.pPrice) * 1;
                    //total = total.toFixed(2);
                    $("#amount_"+num_row).val(total);
                    //$("#amount_value_"+num_row).val(total);		  	            
                    subAmount();                
                } // /success
            }); // /ajax function to fetch the product data 

     return false; 
    }  

    function removeRow(tr_id) {
        //console.log(tr_id);
        $("#product_info_table tbody tr#row_"+tr_id).remove();
        deleted++;
        subAmount(1);
    }
    function subAmount(row = null) {
        //console.log("Nueva "+ row)
        if(row == null){
            var row = $("#product_info_table tbody tr").length;
        }                                
        if(row) {                                    
            var subAmount = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());        
            $("#amount_"+row).val(subAmount);                           
            getTotal();
        } else {
            alert('No hay productos');
        }
    }
    function getTotal(){                                                
        var totalSubAmount = 0;
        for(x = 0; x < tableSize; x++) {  
            var subtotal = $("#amount_"+(x+1)).val();
            
            if (subtotal === undefined) {
            }else{                
                var totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+(x+1)).val());
            }                          
                                                          
        }
        var saldoBefore = numInt($("#saldoCliente").val());
        totalSubAmount = Number(totalSubAmount) + Number(saldoBefore);
        $("#gross_total").val(numMiles(totalSubAmount));
        $("#num_rows").val(tableSize - deleted);
    }                               

    function imprimir() {
        var divToPrint=document.getElementById("printer");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
   
    const selectElement = document.querySelector('.fPago');

    selectElement.addEventListener('change', (event) => {
            
        var showValue = $(".fPago").val();
        if(showValue == 2){
            $('#mostrar-ocultar').show("swing");
            $('#ifCredito').val(1);
        } else {
            $('#mostrar-ocultar').hide("swing");
            $('#ifCredito').val(0);
        }
        
    });

        // <!--/. tells about the time  -->
    function show2(){
        if (!document.all&&!document.getElementById)
        return
        thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
        var Digital=new Date()
        var hours=Digital.getHours()
        var minutes=Digital.getMinutes()
        var seconds=Digital.getSeconds()
        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12
        if (hours<=9)
        hours="0"+hours
        if (minutes<=9)
        minutes="0"+minutes
        if (seconds<=9)
        seconds="0"+seconds
        var ctime=hours+":"+minutes+":"+seconds+" "+dn
        thelement.innerHTML=ctime
        setTimeout("show2()",1000)
        }
        window.onload=setTimeout("hide_alert()", 5000)
        window.onload=show2
        //-->
        function hide_alert(){  
        $("#info-temp").attr('hidden', 'hidden');  
    }

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