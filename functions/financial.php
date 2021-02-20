<?php 

function getAllSaldos()
{
	global $conexion;
	//return $conexion->query("SELECT * FROM saldo  WHERE sSaldo != 0");
	return $conexion->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment FROM `customer` GROUP BY invId) AS subquery GROUP BY subquery.cId");
}

function getAllSaldosHistory()
{
	global $conexion;
	//return $conexion->query("SELECT * FROM saldo  WHERE sSaldo != 0");
	return $conexion->query("SELECT * FROM `customer` WHERE pId = 0");
}
//Get Total Saldos Proveedor
function getAllSaldosBetween($cid, $invId)
{
	global $conexion;
	//return $conexion->query("SELECT * FROM saldo  WHERE sSaldo != 0");
	// return mysqli_fetch_object($conexion->query("SELECT `cId`, SUM(`pMount`) AS Total, SUM(`cPayment`) AS Abonos FROM `customer` WHERE `cId` = '$cid' AND `invId` BETWEEN 0 AND '$invId' GROUP BY `cId`"));
	return mysqli_fetch_object($conexion->query("SELECT `cId`, SUM(`pMount`) - SUM(`cPayment`) AS Total, SUM(`cPayment`) AS Abonos FROM `customer` WHERE `cId` = '$cid' AND `invId` BETWEEN 0 AND '$invId' GROUP BY `cId`"));
}


//Get Saldos Proveedor
function getAllSaldosSuppliers()
{
	global $conexion;
	return $conexion->query("SELECT * FROM purchases");
	// return $conexion->query("SELECT `suId`, SUM(`puTotal`) AS Total, SUM(`puPayment`) AS Abonos FROM `purchases` GROUP BY `suId`");
}
//Get Total Saldos Proveedor
function getTotalAllSaldosSuppliers()
{
	global $conexion;
	//return $conexion->query("SELECT * FROM saldo  WHERE sSaldo != 0");
	return $conexion->query("SELECT `suId`, SUM(`puTotal`) AS Total, SUM(`puPayment`) AS Abonos FROM `purchases` GROUP BY `suId`");
}


function getClientNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM category WHERE cId = '$id' LIMIT 1"));

}


function getSumItems($id)
{
	global $conexion;
	$query = $conexion->query("SELECT SUM(pQty) AS sumQty FROM customer WHERE pId = '$id' ");	
	return mysqli_fetch_object($query);
	
}

function numMiles($num){
	$numero = number_format($num, 0, ',', '.');
	return $numero;

}

function numIntPHP($num){
    return preg_replace('/[\$,\.]/', '', $num);
}



