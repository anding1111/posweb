<?php 

function getAllShops()
{
	global $conexion;
	return $conexion->query("SELECT * FROM Shop WHERE shEnable = '1'  AND `shId` = '".$_SESSION['shId']."' ");
}

function getShopNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM Shop WHERE shId = '$id' AND `shId` = '".$_SESSION['shId']."' "));

}

//Funcion para contar total Shops
function getTotalShops()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM Shop WHERE shEnable = '1' AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}

