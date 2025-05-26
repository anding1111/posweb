<?php  
include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if ( @$_POST['dId'] ) {
	
	//$con = new mysqli("localhost", "root", "", "teinnova");
    
    $dId = $_POST['dId'];
    // $qry = $con->query("DELETE FROM items WHERE pId = '".$dId."' ") or die(mysqli_error($con));
    $qry = $con->query("UPDATE items SET pEnable = '0' WHERE pId = '".$dId."' ") or die(mysqli_error($con));


    if ( $qry ) {
        
        redirectTo('items.php', 0);

    }
}

?>