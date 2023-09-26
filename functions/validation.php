<?php 


function formItemValidation( $input )
{
	return filter_var($input, FILTER_SANITIZE_STRING);

}



//check uniqueness
function checkUniqueUsername($matchingValue)
{

	global $conexion;
	$qry = $conexion->query("SELECT * FROM users WHERE uName = '".$matchingValue."' ");

	if ( mysqli_affected_rows($conexion) ) {
		//already used
		return 1;
	}

	//still available
	return 0;
}

//generate a unique id
function generateId()
{
	global $conexion;
	$qry = mysqli_fetch_object( $conexion->query("SELECT * FROM users WHERE `shId` = '".$_SESSION['shId']."' ORDER BY id DESC LIMIT 1") );
	$newId = $qry->uId + 1;

	return $newId;
}