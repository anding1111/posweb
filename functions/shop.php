<?php

function getAllShops()
{
	global $conexion;
	return $conexion->query("SELECT * FROM shop WHERE shEnable = '1'  AND `shId` = '" . $_SESSION['shId'] . "' ");
}

function getShopNameById($id)
{

	global $conexion;
	return mysqli_fetch_object($conexion->query("SELECT * FROM shop WHERE shId = '$id' "));
}

//Funcion para contar total Shops
function getTotalShops()
{
	global $conexion;
	$query = $conexion->query("SELECT * FROM shop WHERE shEnable = '1' AND `shId` = '" . $_SESSION['shId'] . "' ");
	return $query->num_rows;
}

function checkPrinterType()
{
	global $conexion;
	$typeInvoice = mysqli_fetch_object($conexion->query("SELECT `shPrinterType` FROM shop WHERE shId = '" . $_SESSION['shId'] . "' "));
	return $typeInvoice->shPrinterType;
}
function checkStatusShop()
{
	global $conexion;
	$queryPay = mysqli_fetch_object($conexion->query("SELECT * FROM shop WHERE shId = '" . $_SESSION['shId'] . "' "));

	//Actualiza los datos de la tienda
	if ($queryPay->shEnable == 1) {
		if (date("Y-m-d H:i:s") > $queryPay->shDatePlan) {
			$update = "UPDATE shop SET `shEnable` = 3 WHERE `shId` = '" . $_SESSION['shId'] . "' ";
			$qryUpdate = $conexion->query($update) or die(mysqli_error($conexion));
			if ($qryUpdate) {
				$UpdatePay = 1;
			} else {
				$UpdatePay = -1;
			}
			//return $UpdatePay;
		}
	}
}

//Genera Refeferencia de pago
function genReference($n,$shId,$month)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';

	for ($i = 0; $i < $n; $i++) {
		$index = rand(0, strlen($characters) - 1);
		$randomString .= $characters[$index];
	}
	return 'miPOS-' . $shId . $month . $randomString;
}

//Genera Refeferencia de pago
function reference_gen($id, $date)
{
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < 4; $i++) {
		$index = rand(0, strlen($characters) - 1);
		$randomString .= $characters[$index];
	}
	$retVal = ($date != NULL) ? 'MIPOS' . $id . strftime("%m", strtotime($date)) . '-' . $randomString : $id . $randomString;;
	return $retVal;
}
