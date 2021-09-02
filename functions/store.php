<?php 

function getAllStores()
{
	global $conexion;
	return $conexion->query("SELECT * FROM store WHERE `stStatus` = '1' AND `shId` = '".$_SESSION['shId']."' ");
}


function getStoreNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM store WHERE stId = '$id' AND `shId` = '".$_SESSION['shId']."' "));

}

//Funcion para contar total Clientes
function getTotalStores()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM store WHERE `stStatus` = '1' AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}
//Funcion Busca Cliente Local y Cotizaciones
function getStoresDefault()
{
	global $conexion;
	$result = mysqli_query($conexion,("SELECT * FROM store WHERE `stStatus` = '3' OR ´stStatus´ = '4') AND `shId` = '".$_SESSION['shId']."' "));
	$response = array();
	while($row = mysqli_fetch_array($result) ){
		$response[] = array("id"=>$row['stId'],"name"=>$row['stName']);
	  }
	return $response;
	
}


