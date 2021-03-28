<?php

function getAllCustomers()
{
	global $conexion;
	return $conexion->query("SELECT * FROM orders WHERE `pId` != '0'");
}

//Funcion para contar total Ordenes
function getTotalCustomers()
{
	global $conexion;
	$query = $conexion->query("SELECT DISTINCT invId FROM orders WHERE pId != '0'");	
	return $query->num_rows;
	
}
//Funcion que devuelve el total de precio por factura
function getAllCustomersByInvId($invId)
{
	global $conexion;
	$result = $conexion->query("SELECT * FROM orders WHERE invId ='$invId'");
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
	$resultC = mysqli_fetch_object( $conexion->query("SELECT * FROM orders WHERE invId ='$invId' LIMIT 1") );		
	return $resultC;

}


