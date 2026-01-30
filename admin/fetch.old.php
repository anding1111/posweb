<?php
include('../autoloadfunctions.php');

if($_POST["radio"] == 1){
  $type = 'pId';
}elseif ($_POST["radio"] == 2) {
  $type = 'cId';
}else {
  $type = 'pIdBrand';
}

$utilidad = 0;
if(isset($_POST["checkbox"]) && $_POST["checkbox"] == 1){
  $utilidad = 1;
}

$connect = mysqli_connect($server_db, $user_db, $password_db, $database_db);

$columns  = array('pId', 'pQty', 'pMount');
// $columnss = array('invId', 'Pagado');

/* =========================
   QUERY PRINCIPAL (tabla)
   ========================= */
$query = "SELECT 
            orders.pId, 
            orders.cId, 
            SUM(orders.pQty)                 AS pQty, 
            SUM(orders.pMount)               AS pMount, 
            SUM(orders.inCost * orders.pQty) AS pCost, 
            items.pIdBrand
          FROM `orders` 
          INNER JOIN items ON orders.pId = items.pId 
          WHERE orders.orEnable = '1' 
            AND orders.shId = '".$_SESSION['shId']."' 
            AND orders.idStore = ".$_SESSION['idStore']." AND ";

/* =========================
   QUERY DE TOTALES (EFECTIVO / TRANSFERENCIA)
   - 0 = Transferencia
   - 1 = Efectivo
   - 2 = Crédito (no se suma aquí)
   ========================= */
$querys = "SELECT
            COALESCE(SUM(CASE WHEN sub.tPayment > 0 THEN sub.cPayment ELSE 0 END), 0) AS Pagado,
            COALESCE(SUM(CASE WHEN sub.tPayment = 0 THEN sub.cPayment ELSE 0 END), 0) AS PagadoTransferencia
          FROM (
            SELECT 
              invId,
              MAX(tPayment) AS tPayment,     -- método por factura
              MAX(cPayment) AS cPayment,     -- pago por factura (evita duplicados si hay varias líneas)
              MAX(bDate)    AS bDate,
              MAX(idSeller) AS idSeller
            FROM `orders`
            WHERE `orEnable` = '1'
              AND `shId` = ".$_SESSION['shId']."
              AND `idStore` = ".$_SESSION['idStore']."
            GROUP BY invId
          ) AS sub
          WHERE 1=1 ";

/* =========================
   RANGOS DE FECHA
   ========================= */
if(empty($_POST["start_date"])){
  $_POST["start_date"] = '2018-04-21';
}
if(empty($_POST["end_date"])){
  $_POST["end_date"] = '2100-01-01';
}
$start_time = isset($_POST["start_time"]) ? $_POST["start_time"] : '00:00:00';
$end_time   = isset($_POST["end_time"])   ? $_POST["end_time"]   : '23:59:59';

$query  .= 'bDate BETWEEN "'.$_POST["start_date"].' '.$start_time.'" AND "'.$_POST["end_date"].' '.$end_time.'" AND ';
$querys .= ' AND sub.bDate BETWEEN "'.$_POST["start_date"].' '.$start_time.'" AND "'.$_POST["end_date"].' '.$end_time.'"';

/* =========================
   FILTRO POR CAJERO / ROL
   ========================= */
$sellerId = (int)$_SESSION['usId']; // ID del usuario logueado

if ($_SESSION['uType'] === 'admin' || $_SESSION['uType'] === 'manager') {
    // Si es admin o manager y seleccionó un cajero, se filtra por ese cajero
    if (!empty($_POST["sellerId"])) {
        $sellerId = (int) $_POST["sellerId"];
        $query  .= "(orders.idSeller = $sellerId) AND ";
        $querys .= " AND sub.idSeller = $sellerId";
        // Si no se selecciona nada, no se añade filtro => muestra todos
    }
} else {
    // Si no es admin o manager, siempre se filtra por el usuario logueado
    $query  .= "(orders.idSeller = $sellerId) AND ";
    $querys .= " AND sub.idSeller = $sellerId";
}

/* =========================
   BÚSQUEDA
   ========================= */
if (isset($_POST["search"]["value"])) {
  $sv = mysqli_real_escape_string($connect, $_POST["search"]["value"]);

  if ($_POST["radio"] == 1) {
    // Productos: buscar por nombre de producto
    $query .= ' (items.pName LIKE "%'.$sv.'%") ';
  } else {
    // comportamiento anterior (por id/cant/valor)
    $query .= ' (orders.pId LIKE "%'.$sv.'%"  
                 OR pQty LIKE "%'.$sv.'%"  
                 OR pMount LIKE "%'.$sv.'%") ';
  }

  // Mantén tu agrupación exactamente igual que antes
  $query .= ' GROUP BY '.$type.' ';
}

/* =========================
   ORDEN
   ========================= */
if(isset($_POST["order"]))
{
  $colIndex = (int)$_POST['order']['0']['column'];
  $dir      = ($_POST['order']['0']['dir'] === 'desc') ? 'DESC' : 'ASC';
  $orderCol = isset($columns[$colIndex]) ? $columns[$colIndex] : 'pId';

  $query .= 'ORDER BY '.$orderCol.' '.$dir.' ';
}
else
{
  $query .= 'ORDER BY pId ASC ';
}

/* =========================
   PAGINACIÓN
   ========================= */
$query1 = '';
if(isset($_POST["length"]) && $_POST["length"] != -1)
{
  $query1 = 'LIMIT ' . (int)$_POST['start'] . ', ' . (int)$_POST['length'];
}

/* =========================
   EJECUCIÓN
   ========================= */
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query)); // sin LIMIT para recordsFiltered
$result  = mysqli_query($connect, $query . $query1);

// ¡IMPORTANTE!: los totales NO deben paginarse
$results = mysqli_query($connect, $querys);
$saldo   = mysqli_fetch_assoc($results);

$abonoAntes               = isset($saldo["Pagado"]) ? (int)$saldo["Pagado"] : 0;                 // EFECTIVO
$abonoAntesTrasferencia   = isset($saldo["PagadoTransferencia"]) ? (int)$saldo["PagadoTransferencia"] : 0; // TRANSFER

/* =========================
   ARMADO DE DATA
   ========================= */
$data = array();

while($row = mysqli_fetch_array($result))
{
  $sub_array = array();

  if($_POST["radio"] == 1){
    $product = getItemNameById($row["pId"]);
    $sub_array[] = $product->pName;
  }elseif ($_POST["radio"] == 2) {
    $client = getClientNameById($row["cId"]);
    $sub_array[] = $client->cName;
  }else {  
    $brand = getBrandNameById($row["pIdBrand"]);
    $sub_array[] = $brand->bName;
  }

  if($utilidad == 0) {
    $endMount = $row["pMount"];
  }else{
    $endMount = $row["pMount"] - $row["pCost"];
  }

  $sub_array[] = $row["pQty"];
  $sub_array[] = $endMount;
  $sub_array[] = $row["pCost"];
  $sub_array[] = $abonoAntes;               // Total EFECTIVO (rango + filtros)
  $sub_array[] = $abonoAntesTrasferencia;   // Total TRANSFERENCIAS (rango + filtros)

  $data[] = $sub_array;
}

/* =========================
   TOTAL REGISTROS
   ========================= */
function get_all_data($connect)
{
    $query = "SELECT COUNT(*) FROM orders 
              WHERE `orEnable` = '1' 
                AND `shId` = " . mysqli_real_escape_string($connect, $_SESSION['shId']) . " 
                AND `idStore` = " . mysqli_real_escape_string($connect, $_SESSION['idStore']);
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_row($result);
    return (int) $row[0];
}

/* =========================
   RESPUESTA
   ========================= */
$output = array(
 "draw"            => intval($_POST["draw"]),
 "recordsTotal"    => get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"            => $data,
);

echo json_encode($output);
?>
