<?php 

function getAllSaldos()
{
	global $conexion;
	return $conexion->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment FROM `orders` WHERE  `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' GROUP BY invId) AS subquery GROUP BY subquery.cId");
}

function getAllSaldosHistory()
{
	global $conexion;
	return $conexion->query("SELECT * FROM `orders` WHERE pId = 0 AND `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' ");
}
//Get Total Saldos Proveedor
function getAllSaldosBetween($cid, $invId)
{
	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT `cId`, SUM(`pMount`) - SUM(`cPayment`) AS Total, SUM(`cPayment`) AS Abonos FROM `orders` WHERE `cId` = '$cid' AND `orEnable` = '1' AND shId = '".$_SESSION['shId']."' AND `invId` BETWEEN 0 AND '$invId' GROUP BY `cId`"));
}

//Get Saldos Proveedor
function getAllSaldosSuppliers()
{
	global $conexion;
	return $conexion->query("SELECT * FROM purchases WHERE `shId` = '".$_SESSION['shId']."' ");
	// return $conexion->query("SELECT `suId`, SUM(`puTotal`) AS Total, SUM(`puPayment`) AS Abonos FROM `purchases` GROUP BY `suId`");
}
//Get Total Saldos Proveedor
function getTotalAllSaldosSuppliers()
{
	global $conexion;
	return $conexion->query("SELECT `suId`, SUM(`puTotal`) AS Total, SUM(`puPayment`) AS Abonos FROM `purchases` WHERE `shId` = '".$_SESSION['shId']."' GROUP BY `suId`");
}

//Funcion para poner el punto de sepaaracion de miles
function numMiles($num){
	$numero = number_format($num, 0, ',', '.');
	return $numero;
	
}

//Funcion para conervir un string a integer PHP
function numIntPHP($num){
	return preg_replace('/[\$,\.]/', '', $num);
}

// function getSumItems($id){
// 	global $conexion;
// 	$query = $conexion->query("SELECT SUM(pQty) AS sumQty FROM orders WHERE pId = '$id' AND `shId` = '".$_SESSION['shId']."' ");	
// 	return mysqli_fetch_object($query);	
// }

// function getClientNameById($id){
// 	global $conexion;
// 	return mysqli_fetch_object($conexion->query("SELECT * FROM client WHERE cId = '$id' LIMIT 1"));
// }