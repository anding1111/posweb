<?php
include('../../autoloadfunctions.php');

// if ($result = $conexion->query($query)) {
//   print_r($result);

/* obtener el array de objetos */
// while ($obj = $result->fetch_object()) {
//   printf("%s (%s)\n", $obj->shPlan, $obj->shCreatedOn);
// }
$reference = "MIPOS-1105ADia";
$shId = intval(substr($reference, -8, 2));
echo $shId;
echo "<br>";
$qry = "SELECT * FROM shop WHERE shId = 11 ";
if ($result = $conexion->query($qry)) {

  /* obtener el array de objetos */
  while ($obj = $result->fetch_object()) {
    echo $obj->shPlan;
    echo "<br>";
    echo $obj->shCreatedOn;
  }

  /* liberar el conjunto de resultados */
  $result->close();
}


// $shop = $result->fetch_assoc();
// print_r($shop);
// $shPlan = $shop['shPlan'];
// $shCreatedOn = $shop['shCreatedOn'];
// }
// $qry = mysqli_fetch_object( $conexion->query( "SELECT * from shop WHERE `shId` = 11 " ) );
// echo $qry->shPlan;
