<?php 

//LOCAL
$server_db = "localhost";
$user_db = "root";
$password_db = "";
$database_db = "mipospro_mipos";

//PRODUCTION
// $server_db = "localhost";
// $user_db = "mipospro_mipos";
// $password_db = "MIPOS.MIPOS.PRO";
// $database_db = "mipospro_mipos";

//PRODUCTION
// $server_db = "localhost";
// $user_db = "fixcomc1_teinnova";
// $password_db = "TEINNOVA.COM.CO";
// $database_db = "fixcomc1_teinnova";

$conexion = mysqli_connect($server_db, $user_db, $password_db, $database_db);
mysqli_set_charset($conexion,"utf8");

