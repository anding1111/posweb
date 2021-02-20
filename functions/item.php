<?php 

function getAllItems()
{
	global $conexion;
	return $conexion->query("SELECT * FROM items WHERE pEnable = '1' ");
}


function getItemNameById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM items WHERE pId = '$id' "));

}

function generateInvoiceIds($length=16){

	$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
	
}
//Funcion para contar total productos
function getTotalItems()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM items WHERE pEnable = '1' ");	
	return $query->num_rows;
	
}
