<?php

function getAllStockin()
{
	global $conexion;
	return $conexion->query("SELECT s.stId, i.pName, s.stQuantity, s.stNewCost, su.sName, s.stDate FROM stockin AS s INNER JOIN items AS i ON s.pId = i.pId INNER JOIN suppliers AS su ON s.stIdSupplier = su.sId WHERE s.shId = " . $_SESSION['shId'] . " ");
}
