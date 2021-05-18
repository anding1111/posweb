<?php

function getAllCustomers()
{
	global $conexion;
	return $conexion->query("SELECT * FROM orders WHERE `pId` != '0' AND `orEnable` = 1 AND `shId` = '".$_SESSION['shId']."' ");
}

function getAllQuotations()
{
	global $conexion;
	return $conexion->query("SELECT * FROM orders WHERE `pId` != '0' AND `orEnable` = 3 AND `shId` = '".$_SESSION['shId']."' ");
}

//Funcion para contar total Ordenes
function getTotalCustomers()
{
	global $conexion;
	$query = $conexion->query("SELECT DISTINCT invId FROM orders WHERE pId != '0' AND `orEnable` = 1 AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}
//Funcion que devuelve el total de precio por factura
function getAllCustomersByInvId($invId)
{
	global $conexion;
	$result = $conexion->query("SELECT * FROM orders WHERE invId ='$invId' AND `orEnable` = 1 AND `shId` = '".$_SESSION['shId']."' ");
	$total = 0;
	while ($row = $result->fetch_assoc()) {
		$total = $total + $row['pMount'];
	}
	return $total;
}
//Funcion que devuelve el total de precio por factura
function getAllQuotationsByInvId($invId)
{
	global $conexion;
	$result = $conexion->query("SELECT * FROM orders WHERE invId ='$invId' AND `orEnable` = 3 AND `shId` = '".$_SESSION['shId']."' ");
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
	$resultC = mysqli_fetch_object( $conexion->query("SELECT * FROM orders WHERE invId ='$invId' AND `shId` = '".$_SESSION['shId']."' LIMIT 1") );		
	return $resultC;

}


