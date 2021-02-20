<?php
include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);

$html = '';
//$con = new mysqli("localhost", "root", "", "newpos");
$id_price = $_POST['id_price'];
$increment = $_POST['increment'];

$result = $con->query("SELECT * FROM price WHERE vId = '$id_price'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //$html .= '<input id="prices_'.$increment.'" class="form-control" name="pPrice" style="width:25%;" required="required" type="text" value="'.$row['vPrice'].'" style="width:20%;">';
    $html .= $row['vPrice'];   
}
echo $html;
?>

