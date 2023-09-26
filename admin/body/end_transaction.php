<?php
date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, 'es_CO');

// $idTransaction = $_GET['id'];

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
							<b>Referencia:</b> <span id="referencia"></span> <br />
							<b>Fecha:</b> <span id="fecha"></span> <br />
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
							<?php echo $shop->shName; ?><br />
							<?php echo getLoggedInUserName(); ?><br />
							<?php echo $shop->shMail; ?>
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

			<td>Valor</td>
		</tr>

		<tr class="item">
			<td>Renovación MIPOS</td>

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
	function getQueryParam(param) {
		location.search.substr(1)
			.split('&')
			.some(function(item) { // returns first occurence and stops
				return item.split('=')[0] == param && (param = item.split('=')[1])
			})
		return param
	}
	$(document).ready(function() {
		//Referencia de payco que viene por url
		var ref_wompi = getQueryParam('id');
		//Url Rest Metodo get, se pasa la url y la ref_wompi como paremetro
		// var urlapp = 'https://sandbox.wompi.co/v1/transactions/' + ref_wompi;
		var urlapp = 'https://production.wompi.co/v1/transactions/' + ref_wompi;
		$.get(urlapp, function(response) {
			// console.log(response);
			if (response) {
				var status;
				// Transaccion Aprobada
				if (response.data.status == "APPROVED") {
					status = "APROBADA";
					console.log('transacción aceptada');
				}
				// Transaccion Rechazada
				if (response.data.status == "DECLINED") {
					status = "RECHAZADA";
					console.log('transacción rechazada');
				}
				//Transaccion Anulada
				if (response.data.status == "VOIDED") {
					status = "ANULADA";
					console.log('transacción anulada');
				}
				//Transaccion Fallida
				if (response.data.status == "ERROR") {
					status = "FALLIDA";
					console.log('transacción fallida');
				}
				var inputDateTime = response.data.created_at;
				var date = new Date(inputDateTime);
				var GMTtime = ((date.getUTCMonth() + 1) + '/' + date.getUTCDate() + '/' + date.getUTCFullYear() + ' ' + (date.getUTCHours() - 5) + ':' + date.getUTCMinutes() + ':' + date.getUTCSeconds() + " GMT -5");
				$('#fecha').html(GMTtime);
				$('#referencia').text(response.data.reference);
				$('#estado').html(status);
				// var motivo = response.data.payment_method.payment_description.split(',');
				// $('#motivo').text(motivo[0]);
				// $('#recibo').text(response.data.id);
				$("#tipoPago").text(response.data.payment_method_type.split("_",1));
				// $('#autorizacion').text(response.data.x_approval_code);
				$('#monto').text(numMiles(((response.data.amount_in_cents) / 100)) + ' ' + response.data.currency);
				$('#montoTotal').text(numMiles(((response.data.amount_in_cents) / 100)) + ' ' + response.data.currency);
			} else {
				alert('Error consultando la información');
			}
		});
	});


</script>