<?php
// include('../../functions.php');
// include('../../connect.php');

use LDAP\Result;

include('../../autoloadfunctions.php');

/*En esta página se reciben las variables enviadas desde Wompi hacia nuestro servidor.
Antes de realizar cualquier movimiento en base de datos se deben comprobar algunos valores
Es muy importante comprobar la firma enviada desde Wompi
Ingresar  el valor de p_cust_id_cliente lo encuentras en la configuración de tu cuenta Wompi
Ingresar  el valor de s_key lo encuentras en la configuración de tu cuenta Wompi
*/

$s_key              = 'prod_events_nkQ2MMYRYnoowSd06pV1xorYwYkRYvpi';
// $s_key              = 'test_events_1Cy2sxe8IKy21Bz9u4DUr1vpq5hg9fSF';

// Takes raw data from the request
$json               = file_get_contents('php://input');

// Converts it into a PHP object
$response           = json_decode($json);

// Print data
// print_r($response->data->transaction);

$id                 = $response->data->transaction->id;
$status             = $response->data->transaction->status;
$reference          = $response->data->transaction->reference;
$amount_in_cents    = $response->data->transaction->amount_in_cents;
$timestamp          = $response->timestamp;
$checksum           = $response->signature->checksum;

// Cómo se escribe
$cadena_concatenada = $id . $status . $amount_in_cents . $timestamp . $s_key;
$signature          = hash("sha256", $cadena_concatenada);

// Inicializamos el objeto de respuesta
$responseObj = new stdClass();
$responseObj->signature = $signature;


// Validamos la firma
if ($checksum == $signature) {
  $responseObj->checksum = "Firma válida";
  //Recogemos información faltante
  $customer_email   = $response->data->transaction->customer_email;
  $payment_method   = $response->data->transaction->payment_method->type;
  $created_at   = $response->data->transaction->created_at;

  // Extraemos el id del comercio
  $shId = intval(substr($reference, -8, 2));

  // Si la firma esta bien podemos verificar los estado de la transacción
  switch ($status) {

    case "APPROVED":
      $responseObj->status = "APROBADA";
      $qry = "SELECT * FROM shop WHERE shId = '$shId'";
      if ($result = $conexion->query($qry)) {

        /* obtener el array de objetos */
        while ($obj = $result->fetch_object()) {
          $shPlan = $obj->shPlan;
          $shCreatedOn = $obj->shCreatedOn;
        }

        /* liberar el conjunto de resultados */
        $result->close();

        $insert = "INSERT INTO transactions VALUES(
        '0',
        '" . $id . "',
        '" . $reference . "',                
        '" . $customer_email . "',
        '" . $amount_in_cents . "',
        '" . $created_at . "',
        '" . $payment_method . "',
        '" . $status . "',
        '" . $shId . "'
        )";
        if ($conexion->query($insert) === TRUE) {
          $responseObj->insert = "Transacción insertada correctamente";
          $datePlan = date_create($shCreatedOn);
          $datePay = date_create($created_at);
          $interval = date_diff($datePay, $datePlan);
          $month = intval($interval->format("%m"));
          $addDate = date_add($datePlan, date_interval_create_from_date_string($month . ' months'));
          $newDatePlan = date_format($addDate, "Y-m-d");
          $month_plan = strval(date_format($addDate, "m"));
          $new_reference = genReference(4, $shId, $month_plan);
          $update = "UPDATE shop SET `shEnable` = 1, `shCreatedOn` = '" . $newDatePlan . "', `shReference` = '" . $new_reference . "' WHERE `shId` = '" . $shId . "' ";

          if ($conexion->query($update) === TRUE) {
            $responseObj->update = "Plan actualizado correctamente";
            // echo 'plan actualizado';
          } else {
            $responseObj->update = "Error al actualizar el plan";
            // echo 'Error: ' . $update . '<br>' . $conexion->error;
          }
        } else {
          $responseObj->insert = "Error al insertar la transacción";
          // echo "Error: " . $insert . "<br>" . $conexion->error;
        }
      } else {
        $responseObj->query = "Error al consultar la tienda";
        // echo "Error: " . $query . "<br>" . $conexion->error;
      }
      break;

    case "VOIDED":
      # code transacción anulada
      $responseObj->status = "ANULADA";
      // echo 'transacción anulada';
      break;

    case "DECLINED":
      # code transacción rechazada
      $responseObj->status = "RECHAZADA";
      // echo 'transacción rechazada';
      break;

    case "ERROR":
      # code transacción erronea
      $responseObj->status = "ERROR";
      // echo 'transacción erronea';
      break;
  }
} else {
  $responseObj->status = "Firma no validada";
  die('Firma no valida');
}

//return the json response :
header("Content-Type: application/json;charset=utf-8");
$responseJSON = json_encode($responseObj);
echo $responseJSON;
