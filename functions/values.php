<?php 
function getValueLocal(){
	ob_start();
	system('getmac');
	$Content = ob_get_contents();
	ob_clean();
	return sha1(substr($Content, strpos($Content,'-')-2, 17));
}
function getValueByData($dat){
	global $conexion;
	$qry = $conexion->query("SELECT * FROM localvalues WHERE vaId = '$dat' ");	
	$val = $qry->num_rows;
	return ($val>0) ? true : false ;
}