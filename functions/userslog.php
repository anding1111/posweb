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

function dateDifference($date_1 , $date_2 , $differenceFormat = '%h Horas, %i Minutos, %s Segundos' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}