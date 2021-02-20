<?php

include('../autoloadfunctions.php');
// include('../vendor/autoload.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);


 if(isset($_POST["rowid"])) {
	
	$IdClient = $_POST["rowid"];
	$consulta = "SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment FROM `customer` GROUP BY invId) AS subquery WHERE cId = '$IdClient' ";	
	$query = $con->query($consulta);
	// $abonoCliente = 0;
	if($query->num_rows > 0){
		$qry = mysqli_fetch_object($query);
		$saldoCliente = $qry->total - $qry->pagado;
		$client = getCategoryNameById($qry->cId);
	}
	
	$data = array();
	$data['id'] = $qry->cId;
	$data['name'] = $client->cName;		
	$data['saldo'] = $saldoCliente;	

	echo json_encode($data);
 }

 if(isset($_POST["rowid_supplier"])) {
	
	$idSupplier = $_POST["rowid_supplier"];
	$consulta = "SELECT `suId`, SUM(`puTotal`) AS Total, SUM(`puPayment`) AS Abonos FROM `purchases` WHERE `suId` = '$idSupplier' GROUP BY `suId`";
	$query = $con->query($consulta);
	// $abonoCliente = 0;
	if($query->num_rows > 0){
		$qry = mysqli_fetch_object($query);
		$saldoSupplier = $qry->Total - $qry->Abonos;
		$supplier = getSupplierNameById($qry->suId);		
	}
	
	$data = array();
	$data['id'] = $qry->suId;
	$data['name'] = $supplier->sName;		
	$data['saldo'] = $saldoSupplier;	

	echo json_encode($data);
 }

 exit;


?>