<?php 

function getAllSuppliers()
{
	global $conexion;
	return $conexion->query("SELECT * FROM suppliers WHERE `shId` = '".$_SESSION['shId']."' ");
}


function getSupplierNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM suppliers WHERE sId = '$id' AND `shId` = '".$_SESSION['shId']."' "));

}

//Funcion para contar total Proveedores
function getTotalSuppliers()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM suppliers WHERE `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}
