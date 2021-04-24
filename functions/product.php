<?php 

function getAllProducts()
{
	global $conexion;
	return $conexion->query("SELECT * FROM product AND `shId` = '".$_SESSION['shId']."' ");
}


function getProductNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM product WHERE pId = '$id' AND `shId` = '".$_SESSION['shId']."' "));

}


function generateInvoiceId($length=16){

	$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
	
}
//Funcion para contar total productos
function getTotalProducts()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM product  AND `shId` = '".$_SESSION['shId']."' ");	
	return $query->num_rows;
	
}
