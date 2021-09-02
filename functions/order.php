<?php

function getAllOrders()
{
	global $conexion;
	return $conexion->query("SELECT `invId`, `pId`, `cId`, SUM(`pMount`) AS totalOrder, `bDate` FROM orders WHERE `pId` != '0' AND `orEnable` = 1 AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." GROUP BY `invId` ");
}

function getAllQuotations()
{
	global $conexion;
	return $conexion->query("SELECT `invId`, `pId`, `cId`, SUM(`pMount`) AS totalOrder, `bDate` FROM orders WHERE `pId` != '0' AND `orEnable` = 3 AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." GROUP BY `invId` ");

}

//Funcion para contar total Ordenes
function getTotalOrders()
{
	global $conexion;
	$query = $conexion->query("SELECT DISTINCT invId FROM orders WHERE pId != '0' AND `orEnable` = 1 AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." ");	
	return $query->num_rows;
}

//Funcion que devuelve el total de precio por factura
function getAllOrdersByInvId($invId)
{
	global $conexion;
	$result = mysqli_fetch_object($conexion->query("SELECT SUM(pMount) AS Total FROM orders WHERE invId ='$invId' AND `orEnable` = 1 AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." GROUP BY `invId` "));
	$total = $result->Total;
	return $total;
}
//Funcion que devuelve el total de precio por factura
function getAllQuotationsByInvId($invId)
{
	global $conexion;
	$result = $conexion->query("SELECT * FROM orders WHERE invId ='$invId' AND `orEnable` = 3 AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." ");
	$total = 0;
	while ($row = $result->fetch_assoc()) {
		$total = $total + $row['pMount'];
	}
	return $total;
}

//Funcion que devuelve Id del Cliente
function getIdClienteByInvId($invId)
{
	global $conexion;
	$resultC = mysqli_fetch_object( $conexion->query("SELECT * FROM orders WHERE invId ='$invId' AND `orEnable` = '1' AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." LIMIT 1") );		
	return $resultC;

}
//Funcion que devuelve Id del Cliente
function getIdClienteByInvIdQuotation($invId)
{
	global $conexion;
	$resultC = mysqli_fetch_object( $conexion->query("SELECT * FROM orders WHERE invId ='$invId' AND `orEnable` = '3' AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." LIMIT 1") );		
	return $resultC;

}


