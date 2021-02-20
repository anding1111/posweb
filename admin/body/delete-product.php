<?php

include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if ( @$_POST['dId'] ) {

	//$con = new mysqli("localhost", "root", "", "newpos");
    
    $dId = $_POST['dId'];
    $qry = $con->query("DELETE FROM product WHERE iId = '".$dId."' ") or die(mysqli_error($con));
    //fetching data from database
    // $abc = mysqli_fetch_object($qry);


    // //logged in user ID
    // //$loggedInUser = $_SESSION['uId'];
    // echo '<script language="javascript">alert("'.$abc->iId.'");</script>';

    // //current time now
    // $nowTime = date("Y-m-d H:i:s");


    // $message = "A user <b>{$abc->iId} </b> ({$abc->iId}) has siendo deleted. Do you want to really delete? ";

    // $con->query( "INSERT INTO notification VALUES(
    //                         '0',
    //                         'admin',
    //                         'trabajador',
    //                         '".$abc->iId."',
    //                         '".$message."',
    //                         '".$nowTime."',
    //                         '1'                        
    //     )" ) or die(mysqli_error($con));


    if ( $qry ) {
        
        redirectTo('products.php', 1);

    }
}

?>