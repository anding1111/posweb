<?php 

function getAllCategories()
{
	global $conexion;
	return $conexion->query("SELECT * FROM client WHERE clEnable = '1'  AND `shId` = '".$_SESSION['shId']."' ");
}


function getCategoryNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM client WHERE cId = '$id' AND `shId` = '".$_SESSION['shId']."' "));

}

//Funcion para contar total Clientes
function getTotalCategories()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM client WHERE clEnable = '1' AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}

