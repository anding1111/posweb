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
if($_POST["checkbox"] == 1){
  $utilidad = 1;
}

$connect = mysqli_connect($server_db, $user_db, $password_db, $database_db);

$columns = array('pId', 'pQty', 'pMount');
$columnss = array('invId', 'Pagado');

$query = "SELECT orders.pId, orders.cId, SUM(orders.pQty) AS pQty, SUM(orders.pMount) AS pMount, SUM(orders.inCost * orders.pQty) AS pCost, items.pIdBrand FROM `orders` INNER JOIN items ON orders.pId = items.pId WHERE orders.orEnable = '1' AND orders.shId = '".$_SESSION['shId']."' AND ";
$querys = "SELECT `invId`, SUM(`cPayment`) AS Pagado FROM (SELECT `invId`, `cPayment`, `bDate` FROM `orders` WHERE `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' GROUP BY `invId`) AS subquery WHERE ";

if($_POST["is_date_search"] == "yes")
if($_POST["start_date"] == ''){
  $_POST["start_date"] = '2020-01-01';
}
if($_POST["end_date"] == ''){
  $_POST["end_date"] = '2100-01-01';
}
{
//  $query .= 'bDate BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"]." 23:59:59".'" AND ';
 $query .= 'bDate BETWEEN "'.$_POST["start_date"]." ".$_POST["start_time"].'" AND "'.$_POST["end_date"]." ".$_POST["end_time"].'" AND ';
//  $querys .= 'bDate BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"]." 23:59:59".'" AND ';
 $querys .= 'bDate BETWEEN "'.$_POST["start_date"]." ".$_POST["start_time"].'" AND "'.$_POST["end_date"]." ".$_POST["end_time"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
  $query .= '
  (orders.pId LIKE "%'.$_POST["search"]["value"].'%"  
  OR pQty LIKE "%'.$_POST["search"]["value"].'%"  
  OR pMount LIKE "%'.$_POST["search"]["value"].'%") GROUP BY '.$type.'
 ';
 $querys .= '
  (invId LIKE "%'.$_POST["search"]["value"].'%")
  ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
//  $querys .= 'ORDER BY '.$columnss[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
//  ';
}
else
{
 $query .= 'ORDER BY pId ASC ';
//  $querys .= 'ORDER BY invId ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));
// print_r($query);
// print_r($querys);
$result = mysqli_query($connect, $query . $query1);
$results = mysqli_query($connect, $querys . $query1);

$abonoAntes = 0;
$saldo = mysqli_fetch_array($results);
$abonoAntes = $saldo["Pagado"] ;

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
  $sub_array[] = $abonoAntes;
  $data[] = $sub_array;
  }

function get_all_data($connect)
{
 $query = "SELECT * FROM orders WHERE `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' ";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data,
);

echo json_encode($output);

?>