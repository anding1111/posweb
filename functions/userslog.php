<?php 

function getAllFromUserLoginTime()
{
	global $conexion;
	return $conexion->query("SELECT * FROM logintime WHERE `shId` = '".$_SESSION['shId']."' ORDER BY id DESC");
}


function getAllFromUserLogoutTime()
{
	global $conexion;
	return $conexion->query("SELECT * FROM logout WHERE `shId` = '".$_SESSION['shId']."' ORDER BY id DESC");
}


function getOperativeLogData()
{
	global $conexion;
	return $conexion->query("SELECT i.* , o.* FROM logintime i, logouttime o WHERE i.shId = '".$_SESSION['shId']."' AND o.shId = '".$_SESSION['shId']."' AND i.uId=o.uId");
}