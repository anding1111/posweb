 <?php 
 $sInvId = $_GET['sInvId'];
 $sPrice = $_GET['sPrice'];
 
    global $conexion;
	//current time now
		$nowTime = date("Y-m-d H:i:s");

		//generate invoice number		
		$numRecibo = 0;       
		$result = mysqli_fetch_object($conexion->query("SELECT MAX(invId) AS 'maxN' FROM orders"));        
		$numRecibo = $result->maxN;        
		$invNum = $numRecibo + 1;
		
		$qry = $conexion->query("INSERT INTO orders VALUES(
                                        '0',
                                        '".$invNum."', 
                                        '0',
                                        '".$sInvId."',                                       
                                        '0',
                                        '0',
                                        '0',
                                        '0',
                                        '".$sPrice."',
                                        '".$nowTime."',
                                        ''
                    )") or die(mysqli_error($conexion));   
    
?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                               <!-- <div class="table-responsive" id="printer"> -->
                               <?php 
                                    //redirectTo('buy-product.php', 0);                                    
                                    $mariac = "saldo.php";
                                    redirectTo($mariac, 0);
                                     ?>
                                                      
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

        <script>

            function imprimir() {                    

                    var els = document.querySelectorAll('#ocultar');
                    for (var i=0; i < els.length; i++) {
                        els[i].setAttribute("style", "display:none;");
                    }
                    var divToPrint=document.getElementById("printer");                    
                    newWin= window.open("");
                    newWin.document.write(divToPrint.outerHTML);
                    newWin.print();
                    newWin.close();
                    //location.reload();                    
                    //window.location.href = "buy-product.php";
                    
                }
        </script>

       