<?php 



function getAllCategories()
{
	global $conexion;
	return $conexion->query("SELECT * FROM category WHERE clEnable = '1' ");
}


function getCategoryNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM category WHERE cId = '$id' "));

}

//Funcion para contar total Categories
function getTotalCategories()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM category WHERE clEnable = '1' ");	
	return $query->num_rows;
	
}

