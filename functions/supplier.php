<?php 



function getAllSuppliers()
{
	global $conexion;
	return $conexion->query("SELECT * FROM suppliers");
}


function getSupplierNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM suppliers WHERE sId = '$id' "));

}

//Funcion para contar total Proveedores
function getTotalSuppliers()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM suppliers");	
	return $query->num_rows;
	
}

