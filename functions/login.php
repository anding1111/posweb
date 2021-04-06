<?php 

function loginDataReceive($username, $password){

	if ( checkFormValidation($username) AND checkFormValidation($password) ) {
		$myUsername = $username;
		$myPassword = md5($password);
		global $conexion;
		$qry = $conexion->query("SELECT * FROM users WHERE (uName = '". $myUsername."' AND uPassword='". $myPassword ."') AND uFlag = '1'  ");
		//$conex->query("SELECT * FROM  `fixers` where lat='".$_REQUEST['lat']."'" );

		if ( mysqli_affected_rows($conexion) ) {
			
			//fetching data from db
			$myData = mysqli_fetch_object( $qry );

			$_SESSION['username']	= $username;
			$_SESSION['uType']		= $myData->uType;
			$_SESSION['uId']		= $myData->uId;
			$_SESSION['shId']		= $myData->shId;

			return 1;

		} else{
			
			return 2;

		}

	} else{

		return 3;
	}


}

function checkFormValidation($value){

	if ( !empty($value) ) {
		return 1;
	}

	return 0;
}

function logOut(){

	if ( isset( $_SESSION['username'] ) ) {
		
		global $conexion;
		$nowTime = date("Y-m-d H:i:s");
        $insert  = $conexion->query("INSERT INTO logouttime VALUES(
                                '0',
                                '". $_SESSION['uId'] ."',
                                '$nowTime'
                        )") or die(mysqli_error($conexion));

		if ( $insert ) {

			session_destroy();

			return 4;	//successfully logout
			
		}

		return 5;	//Not success
	}

}
