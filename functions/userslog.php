<?php 


function getAllFromUserLoginTime()
{
	global $conexion;
	return $conexion->query("SELECT * FROM logintime ORDER BY id DESC");
}



function getAllFromUserLogoutTime()
{
	global $conexion;
	return $conexion->query("SELECT * FROM logout ORDER BY id DESC");
}



function getOperativeLogData()
{
	global $conexion;
	return $conexion->query("SELECT i.* , o.* FROM logintime i, logouttime o WHERE i.uId=o.uId");
}