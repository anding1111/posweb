<?php  

include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);


if ( @$_POST['dId'] ) {

    $dId = $_POST['dId'];
	
    $qry = $con->query("UPDATE client SET clEnable = '0' WHERE cId = '".$dId."' ") or die(mysqli_error($con));

	
    if ( $qry ) {
        
        redirectTo('clients.php', 1);      

    }
}

?>