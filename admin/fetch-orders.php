<?php 
include('../autoloadfunctions.php');

extract($_POST);
$totalCount = $conexion->query("SELECT invId, cId, bDate, SUM(pMount) AS total_order FROM orders WHERE pId != '0' AND orEnable = $order_type AND shId = ".$_SESSION['shId']." AND idStore = ".$_SESSION['idStore']." GROUP BY invId ")->num_rows;
$search_where = "";
if(!empty($search)){
    $search_where = " WHERE ";
    $search_where .= " client.cName LIKE '%{$search['value']}%' ";
    $search_where .= " OR result.total_order LIKE '%{$search['value']}%' ";
    $search_where .= " OR date_format(result.bDate,'%M %d, %Y') LIKE '%{$search['value']}%' ";
}
$columns_arr = array("id",
                     "name",
                     "total_order",
                     "unix_timestamp(order_date)");
$query = $conexion->query("SELECT client.cName AS name, result.invId AS id, result.bDate AS order_date, result.total_order AS total_order FROM client INNER JOIN ( SELECT invId, cId, bDate, SUM(pMount) AS total_order FROM orders WHERE pId != '0' AND orEnable = $order_type AND shId = ".$_SESSION['shId']." AND idStore = ".$_SESSION['idStore']." GROUP BY invId) result ON result.cId = client.cId {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} LIMIT {$length} OFFSET {$start};");
$recordsFilterCount = $conexion->query("SELECT client.cId, client.cName, result.invId, result.cId, result.bDate, result.total_order FROM client INNER JOIN ( SELECT invId, cId, bDate, SUM(pMount) AS total_order FROM orders WHERE pId != '0' AND orEnable = $order_type AND shId = ".$_SESSION['shId']." AND idStore = ".$_SESSION['idStore']." GROUP BY invId) result ON result.cId = client.cId {$search_where} ")->num_rows;

$recordsTotal    = $totalCount;
$recordsFiltered = $recordsFilterCount;
$data = array();
$i= 1 + $start;
while($row = $query->fetch_assoc()){
    // $row['no'] = $i++;
    // $row['date'] = date("F d, Y",strtotime($row['order_date']));
    $data[] = $row;
}
echo json_encode(array('draw'=>$draw,
                       'recordsTotal'=>$recordsTotal,
                       'recordsFiltered'=>$recordsFiltered,
                       'data'=>$data
                       )
);
