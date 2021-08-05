<?php
    $idTransaction = $_GET['id'];
   
?>
    <div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title-pay">
									<img src="../../dist/img/logo-mipos.png" alt="logo SAEDI" style="width: 100%; max-width: 300px" />
								</td>

								<td>
									Referencia #: <span id="referencia"></span> <br />
									Fecha: <span id="fecha"></span> <br />
									<!-- Due: February 1, 2015 -->
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									MI POS<br />
									Bogotá DC<br />
									www.mipos.pro
								</td>

								<td>
									<?php echo $shop->shName;?><br />
									<?php echo getLoggedInUserName();?><br />
									<?php echo $shop->shMail;?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>ESTADO DE LA TRANSACCIÓN</td>

					<td><span id="estado"></span> </td>
				</tr>
                
				<tr class="details">
                    <td>Metodo de Pago</td>
                    
                    <td><span id="tipoPago"></span> </td>
				</tr>
                
				<tr class="heading">
                    <td>Descripción</td>
                    
					<td>Precio</td>
				</tr>
                
				<tr class="item">
                    <td>Renovacion MIPOS</td>
                    
                    <td>$<span id="monto"></span> </td>
				</tr>
				
				<tr class="total">
                    <td style="font-size:16px;">TOTAL</td>
                    
                    <td>$<span id="montoTotal"></span> </td>
				</tr>
			</table>
            <a href="dashboard.php" class="btn btn-info btn-large" style="font-size:22px; width:100%;vertical-align:middle;">CONTINUAR</a>
		</div>

<script>
$.ajax({
    type:'get',
    url:'https://production.wompi.co/v1/transactions/<?php echo $idTransaction; ?>',
    data: {},
    dataType: "json",
    success: function(response) {
		$("#referencia").text(response.data.reference);
		$("#fecha").text(response.data.created_at);
		if(response.data.status == "APPROVED"){
			$("#estado").text("APROBADA");
		}else{
			$("#estado").text("RECHAZADA");

		}
		$("#tipoPago").text(response.data.payment_method_type.split("_",1));
		$("#monto").text(numMiles((response.data.amount_in_cents)/100));
		$("#montoTotal").text(numMiles((response.data.amount_in_cents)/100));

		updTransaction(response.data);

    },
    error: function(response) {
        console.log('ERROR BLOCK');
        console.log(response);
    }
});

function updTransaction(responseData) {
       
        $.ajax({
            url: "body/update-transaction.php",
            type: 'post',
            data: {arrayData : responseData, datePlan : '<?php echo $shop->shDatePlan; ?>', typePlan : '<?php echo $shop->shPlan; ?>', customerEmail : '<?php echo $shop->shMail; ?>' },
            dataType: 'json',
            success:function(response) {
                console.log("SIPI");
                 
                } 
		});
}
</script>