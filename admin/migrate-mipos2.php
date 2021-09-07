<?php

include('../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);
//Funciones
function storeById($id){

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM store WHERE shId = '$id' "));

}

//Crea stores
if(isset($_GET["store"])) {
    $qry = $con->query("SELECT * FROM shop ORDER BY `shId` ASC");
    $numItems =  $qry->num_rows;
    while($row = mysqli_fetch_array($qry) ){
        $qry_insert = $con->query("INSERT INTO store VALUES(
            '0',
            'Principal',
            '1',                
            '1',
            'Descripcion',
            '".$row['shId']."'     
            
            )") or die(mysqli_error($con));
    }
}

//Actualiza usuario con su store
if(isset($_GET["users"])) {
$qry = $con->query("SELECT * FROM users ORDER BY `id` ASC");
    while($row = mysqli_fetch_array($qry) ){
        $store = storeById($row['shId'])->stId;
        $update = "UPDATE users SET idStore = '".$store."' WHERE id = '".$row['id']."' ";
        $qry_users = $con->query($update) or die(mysqli_error($con));
    }
}
//Actualiza orders con su store
if(isset($_GET["orders"])) {
$qry = $con->query("SELECT * FROM orders ORDER BY `cmId` ASC");
    while($row = mysqli_fetch_array($qry) ){
        $store = storeById($row['shId'])->stId;
        $update = "UPDATE orders SET idStore = '".$store."' WHERE cmId = '".$row['cmId']."' ";
        $qry_users = $con->query($update) or die(mysqli_error($con));
    }
}
//Actualiza items con su store y su idAux
if(isset($_GET["items"])) {
$n = 11;
$qry = $con->query("SELECT * FROM items WHERE `idAux` = 0 ORDER BY `pId` ASC");
    while($row = mysqli_fetch_array($qry) ){
        $store = storeById($row['shId'])->stId;
        $update = "UPDATE items SET idStore = '".$store."', idAux = '".$n."' WHERE pId = '".$row['pId']."' ";
        $qry_users = $con->query($update) or die(mysqli_error($con));
        $n = $n + 1;
    }
}

exit;

?>