<?php  
include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);

session_start();
if ( @$_POST['dId'] ) {

	// $con = new mysqli("localhost", "root", "", "newpos");
    
    $dId = $_POST['dId'];
    $qry = $con->query("UPDATE users SET softDelete = 1 WHERE uId = '".$dId."' ") or die(mysqli_error($con));


    if ( $qry ) {
        
        //fetching data from database
        $abc = mysqli_fetch_object($con->query("SELECT * FROM users WHERE uId = ".$dId." "));


        //logged in user ID
        $loggedInUser = $_SESSION['uId'];

        //current time now
        $nowTime = date("Y-m-d H:i:s");


        $message = "Un Usuario <b>{$abc->uName} </b> ({$abc->uId}) ha sido borrado. Quieres borrarlo realmente? ";

        $con->query( "INSERT INTO notification VALUES(
                                '0',
                                'admin',
                                '".$loggedInUser."',
                                '".$abc->uId."',
                                '".$message."',
                                '".$nowTime."',
                                '1'                        
            )" ) or die(mysqli_error($con));


    }
}

?>