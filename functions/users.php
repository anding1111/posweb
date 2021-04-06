<?php 

function getAllUser()
{
	global $conexion;
	return $conexion->query("SELECT * FROM users WHERE softDelete = 0");
}

function getLoggedInUserName()
{
	// if(isset($_SESSION['username'])){
	// 	return $_SESSION['username'];
    // }
	return $_SESSION['username'];
}

function getLoggedInUserID()
{

	return $_SESSION['uId'];
}

function getUsernameByUserId($value)
{
	global $conexion;
	$qry = mysqli_fetch_object( $conexion->query( "SELECT uName from users WHERE uId = '".$value."' " ) );

	return $qry->uName;
}

function getAllAdmin(){
	global $conexion;
	return $conexion->query("SELECT * FROM users WHERE uType = 'admin'");
	
}

function checkAdmin()
{
	if ( $_SESSION['uType'] == 'admin' ) {
		return 1;
	}

	return 0;
}

function checkManager()
{
	if ( $_SESSION['uType'] == 'manager' ) {
		return 1;
	}

	return 0;
}

function checkClark()
{
	if ( $_SESSION['uType'] == 'clark' ) {
		return 1;
	}

	return 0;
}

function checkAddedUserByLoggedInUser()
{

	$loggedInUser = $_SESSION['uId'];

	global $conexion;
	$qry = $conexion->query("SELECT * FROM users WHERE uAddedBy='".$loggedInUser."' AND uType='admin' ");

	if ( mysqli_affected_rows($conexion) ) {
		
		$cnt = 0;

		while ( $row = mysqli_fetch_object( $qry ) ) {
			//$cnt = $cnt + 1;
			//$cnt++;

			$cnt = $cnt + 1;
		}

		if ( $cnt >= 2 ) {
			
			$notAllowed = 1;
			return $notAllowed;	

		}

		//return $cnt;
	}

	$allowed = 0;
	return $allowed;
	
}

//Funcion para contar total Users
function getTotalUsers()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM users");	
	return $query->num_rows;
	
}
