<?php
include('../autoloadfunctions.php');

$connect = mysqli_connect($server_db, $user_db, $password_db, $database_db);
mysqli_set_charset($connect, "utf8");

$columns = array('sName', 'puTotal', 'puPayment', 'puSaldo', 'puDate', 'puInvPurchase', 'puDetail');

$query = "SELECT purchases.puId, purchases.suId, purchases.puTotal, purchases.puPayment, (purchases.puTotal - purchases.puPayment) AS puSaldo, purchases.puDate, purchases.puInvPurchase, purchases.puDetail, suppliers.sId, suppliers.sName FROM `purchases` INNER JOIN suppliers ON purchases.suId = suppliers.sId WHERE purchases.shId = '".$_SESSION['shId']."' AND ";

// if($_POST["is_date_search"] == "yes")
if($_POST["start_date"] == ''){
  $_POST["start_date"] = '2020-01-01';
}
if($_POST["end_date"] == ''){
  $_POST["end_date"] = '2100-01-01';
}
{
 $query .= 'puDate BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"]. " 23:59:59". '" AND ';
}

if(isset($_POST["search"]["value"]))
{
  $query .= '
  (suppliers.sName LIKE "%'.$_POST["search"]["value"].'%"  
  OR purchases.puInvPurchase LIKE "%'.$_POST["search"]["value"].'%"  
  OR purchases.puDetail LIKE "%'.$_POST["search"]["value"].'%") 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY purchases.puId ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));
// print_r($query);
$result = mysqli_query($connect, $query . $query1);

$data = array();
header('Content-type: application/json; charset=utf-8');

while($row = mysqli_fetch_array($result))
  {
    $sub_array = array();
  $sub_array[] = $row["sName"];
  $sub_array[] = $row["puTotal"];
  $sub_array[] = $row["puPayment"];
  $sub_array[] = $row["puSaldo"];
  $sub_array[] = $row["puDate"];
  $sub_array[] = $row["puInvPurchase"];
  $sub_array[] = $row["puDetail"];
  $data[] = $sub_array;
  }

function get_all_data($connect)
{
 $query = "SELECT * FROM purchases WHERE `shId` = ".$_SESSION['shId']." ";
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