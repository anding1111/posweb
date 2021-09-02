<?php

include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);
// Check connection
if (!$con) {
	die("Falló la conexión: " . mysqli_connect_error());
   }

	//Autocomplete Product
	if(isset($_POST['search'])){
		$search = mysqli_real_escape_string($con,$_POST['search']);
	   //Busca en Ventas y entradas de productos
		$query = "SELECT * FROM items WHERE pName like '%".$search."%' AND pEnable = '1' AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." ";
		$result = mysqli_query($con,$query);
	   
		$response = array();
		while($row = mysqli_fetch_array($result) ){
		  $response[] = array("value"=>$row['pId'],"label"=>$row['pName'], "price"=>$row['pPrice'], "cost"=>$row['pCost'], "qty"=>$row['pQuantity']);
		}	   
		echo json_encode($response);
	   }
	   

	//Autocomplete Client
	if(isset($_POST['search_customer'])){
		$search = mysqli_real_escape_string($con,$_POST['search_customer']);
	   
		$query = "SELECT * FROM client WHERE cName like '%".$search."%' AND (clEnable = '1' OR clEnable = '3' OR clEnable = '4') AND `shId` = '".$_SESSION['shId']."' ";
		$result = mysqli_query($con,$query);
	   
		$response = array();
		while($row = mysqli_fetch_array($result) ){

			//Read Credit Client
			$id = $row['cId'];
			$qrys = $con->query("SELECT subquery.cId, SUM(subquery.Compras) AS total, SUM(subquery.cPayment) AS pagado FROM (SELECT invId, cId, SUM(pMount)AS Compras, cPayment, shId FROM `orders` WHERE `orEnable` = '1' AND `shId` = '".$_SESSION['shId']."' GROUP BY invId) AS subquery WHERE cId = '$id' AND `shId` = '".$_SESSION['shId']."' ");
			$abonoCliente = 0;
			if($qrys->num_rows > 0){
				$qryss = mysqli_fetch_object($qrys);
				$saldoCliente = $qryss->total - $qryss->pagado;
			}
			$response[] = array("value"=>$row['cId'],"label"=>$row['cName'],"saldo"=>$saldoCliente);
		}
	   
		echo json_encode($response);
	   }

	   	   //Autocomplete IMEI
	if(isset($_POST['search_imei'])){
		$search = mysqli_real_escape_string($con,$_POST['search_imei']);
	   
		// $query = "SELECT * FROM serials WHERE seSerial like'%".$search."%'";
		$query = "SELECT * FROM serials WHERE seSerial like '%".$search."%' AND `shId` = '".$_SESSION['shId']."' ";
		$result = mysqli_query($con,$query);		
		// $row = mysqli_fetch_array($result);

		$response = array();
		while($row = mysqli_fetch_array($result) ){

			$product = getItemNameById($row['pId']);	
			$productName = $product->pName;
			$supplier = getSupplierNameById($row['sId']);
			$suppliertName = $supplier->sName;
			$serial = $row['seSerial'];
			$user = getUsernameByUserId($row['seAddedBy']);		
			$response[] = array("value"=>$productName,"supplier"=>$suppliertName,"serial"=>$serial,"user"=>$user,"date"=>$row['seDate'], "datesale"=>$row['seDateSale']);

		}
		echo json_encode($response);
	   }

	      //Respone Supplier Saldo
	if(isset($_POST['supplier'])){
		$search = mysqli_real_escape_string($con,$_POST['supplier']);
		$query = "SELECT `suId`, SUM(`puTotal`) AS Total, SUM(`puPayment`) AS Abonos FROM `purchases` WHERE `suId` = '$search' AND `shId` = '".$_SESSION['shId']."' GROUP BY `suId`";
		$result = mysqli_query($con,$query);
		$qry = mysqli_fetch_object($result);
		$saldo = 0;		
		$data = array();
		if (isset($qry)){
			$saldo = $qry->Total - $qry->Abonos;
			$data['id'] = $qry->suId;
			$data['saldo'] = $saldo;				
		}else{			
			$data['id'] = 0;
			$data['saldo'] = 0;
		}	
		echo json_encode($data);
		}

	   exit;
	
?>
