<?php 


function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 19);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
function horaCastellano ($fecha) {
  $hora = date('h', strtotime($fecha));
  $minuto = date('i', strtotime($fecha));
  $segundo = date('s', strtotime($fecha));
  $ampm = date('A', strtotime($fecha));
  return $hora.":".$minuto.":".$segundo." ".$ampm;

}

function getFecha ($inv){
  global $conexion;
  $query = $conexion->query("SELECT bDate FROM orders WHERE `pId` != '0' AND `orEnable` = 1 AND invId = ".$inv." AND `shId` = '".$_SESSION['shId']."' LIMIT 1 ");
  return mysqli_fetch_object($query);
}

function getFechaQuot ($inv){
  global $conexion;
  $query = $conexion->query("SELECT bDate FROM orders WHERE `pId` != '0' AND `orEnable` = 3 AND invId = ".$inv." AND `shId` = '".$_SESSION['shId']."' LIMIT 1 ");
  return mysqli_fetch_object($query);
}