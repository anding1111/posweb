<?php  
include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);


if ( @$_POST['dId'] ) {

    $dId = $_POST['dId'];
	$qry = $con->query("DELETE FROM suppliers WHERE sId = '".$dId."' ") or die(mysqli_error($con));
		

    if ( $qry ) {
        
        redirectTo('suppliers.php', 1);      

    }
}

?>