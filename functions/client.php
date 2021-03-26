<?php 



function getAllCategories()
{
	global $conexion;
	return $conexion->query("SELECT * FROM client WHERE clEnable = '1' ");
}


function getCategoryNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM client WHERE cId = '$id' "));

}

//Funcion para contar total Clientes
function getTotalCategories()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM client WHERE clEnable = '1' ");	
	return $query->num_rows;
	
}

