<?php 

function getAllClients()
{
	global $conexion;
	return $conexion->query("SELECT * FROM client WHERE (clEnable = '1' OR clEnable = '3' OR clEnable = '4')  AND `shId` = '".$_SESSION['shId']."' ");
}


function getClientNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM client WHERE cId = '$id' AND `shId` = '".$_SESSION['shId']."' "));

}

//Funcion para contar total Clientes
function getTotalClients()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM client WHERE (clEnable = '1' OR clEnable = '3' OR clEnable = '4') AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}
//Funcion Busca Cliente Local y Cotizaciones
function getClientsDefault()
{
	global $conexion;
	$result = mysqli_query($conexion,("SELECT * FROM client WHERE (clEnable = '3' OR clEnable = '4') AND `shId` = '".$_SESSION['shId']."' "));
	$response = array();
	while($row = mysqli_fetch_array($result) ){
		$response[] = array("id"=>$row['cId'],"name"=>$row['cName']);
	  }
	return $response;
	
}


