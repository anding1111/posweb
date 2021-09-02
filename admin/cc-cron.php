<?php
//PRODUCTION
$server_db = "localhost";
$user_db = "mipospro_base_cordillera_admin";
$password_db = "oKdSLUPr@}tj";
$database_db = "mipospro_cordillera_country";

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

$qry_insert = $con->query("INSERT INTO tbl_role VALUES(
    '0',
    'Andres',
    '11',                
    '1'   
    )") or die(mysqli_error($con));
exit;

?>