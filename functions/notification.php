<?php 

function getAllNotification()
{
	global $conexion;
	return $conexion->query("SELECT * FROM notification  WHERE `shId` = '".$_SESSION['shId']."' ORDER BY nId DESC");
}