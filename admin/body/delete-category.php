<?php  

include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);


if ( @$_POST['dId'] ) {

	//$con = new mysqli("localhost", "root", "", "teinnova");
	
    $dId = $_POST['dId'];
	//$del = "DELETE FROM category WHERE cId = '".$dId."' ";
	// $qry = $con->query("DELETE FROM category WHERE cId = '".$dId."' ") or die(mysqli_error($con));
    $qry = $con->query("UPDATE category SET clEnable = '0' WHERE cId = '".$dId."' ") or die(mysqli_error($con));

	
    if ( $qry ) {
        
        redirectTo('categories.php', 1);      

    }
}

?>