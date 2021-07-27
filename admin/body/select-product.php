<?php

include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);
// Check connection
if (!$con) {
	die("Falló la conexión: " . mysqli_connect_error());
   }

/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
    */
    if(isset($_POST['row_id']))
        {
        $product_id = $_POST['row_id'];   
            if($product_id) {
                $result = $con->query("SELECT * FROM items WHERE pId = '$product_id' AND `shId` = '".$_SESSION['shId']."' ");
                $qryss = mysqli_fetch_object($result);
                echo json_encode($qryss);
            }
		}
?>

