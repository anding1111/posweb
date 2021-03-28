<?php  
include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if ( @$_POST['dId'] ) {

	// $con = new mysqli("localhost", "root", "", "teinnova");
	
    $dId = $_POST['dId'];
    $dSaldo = $_POST['dSaldo'];

    //current time now
    $nowTime = date("Y-m-d H:i:s");
    
    //generate invoice number
    $numRecibo = 0;       
    $result = mysqli_fetch_object($con->query("SELECT MAX(invId) AS 'maxN' FROM orders"));        
    $numRecibo = $result->maxN;        
    $invNum = $numRecibo + 1;

    //logged in user ID
    //$loggedInUser = $_SESSION['uId'];

    $qry = $con->query("INSERT INTO orders VALUES(
                            '0',
                            '".$invNum."', 
                            '0',
                            '".$dId."',                                       
                            '0',
                            '0',
                            '0',
                            '0',
                            '".$dSaldo."',                                    
                            '".$nowTime."',
                            ''
                        )") or die(mysqli_error($con));
	
}

if ( @$_POST['dIdSupplier'] ) {

	// $con = new mysqli("localhost", "root", "", "teinnova");
	
    $pIdSupplier = $_POST['dIdSupplier'];
    $puAbono = $_POST['dSaldo'];

    //current time now
    $nowTime = date("Y-m-d H:i:s");
    
    //generate invoice number
    $numRecibo = 0;       
    $result = mysqli_fetch_object($con->query("SELECT MAX(invId) AS 'maxN' FROM orders"));        
    $numRecibo = $result->maxN;        
    $invNum = $numRecibo + 1;

    //logged in user ID
    $loggedInUser = $_SESSION['uId'];
    
    $qry = $con->query("INSERT INTO purchases VALUES(
                            '0',
                            '".$pIdSupplier."', 
                            '0',
                            '".$puAbono."',                                       
                            '".$loggedInUser."',
                            '".$nowTime."',
                            '0',
                            'Abono'
                        )") or die(mysqli_error($con));

}

exit;

?>