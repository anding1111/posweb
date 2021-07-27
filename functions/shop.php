<?php 

function getAllShops()
{
	global $conexion;
	return $conexion->query("SELECT * FROM shop WHERE shEnable = '1'  AND `shId` = '".$_SESSION['shId']."' ");
}

function getShopNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM shop WHERE shId = '$id' "));

}

//Funcion para contar total Shops
function getTotalShops()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM shop WHERE shEnable = '1' AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}

function checkPrinterType()
{
	global $conexion;
	$typeInvoice = mysqli_fetch_object($conexion->query("SELECT `shPrinterType` FROM shop WHERE shId = '".$_SESSION['shId']."' "));
	return $typeInvoice->shPrinterType;
}