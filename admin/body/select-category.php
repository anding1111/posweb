<?php
include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);

$html = '';
//$con = new mysqli("localhost", "root", "", "newpos");
$id_category = $_POST['id_category'];
//echo '<script language="javascript">alert("'.$id_category.'");</script>';

$result = $con->query("SELECT * FROM product WHERE cId = '$id_category'");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['pId'].'">'.$row['pName'].'</option>';
    }
}
echo $html;
?>

