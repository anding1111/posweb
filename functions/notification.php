<?php 


function getAllNotification()
{
	global $conexion;
	return $conexion->query("SELECT * FROM notification ORDER BY nId DESC");
}