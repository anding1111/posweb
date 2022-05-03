<?php
// Juan Antonio Villalpando
// http://kio4.com/appinventor/340D_appinventor_mysqli_inject.htm

// 1.- IDENTIFICACION nombre de la base, del usuario, clave y servidor
$db_host = "localhost";
$db_name = "fixcomc1_parkapp";
$db_login = "fixcomc1_anding11";
$db_pswd = "INGeniero@11";

// 2.- CONEXION A LA BASE DE DATOS
$link = new mysqli($db_host, $db_login, $db_pswd, $db_name);

if ($link->connect_error) {
     exit('Error de conexion con la base de datos.');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link->set_charset("utf8mb4");
$boton = $_POST['boton'];

///////////////////////////////   INSERTAR - INSERT ////////////////////////////////////
if ($boton == "btnInsertar") {
     $User = $_POST['User'];
     $Password = md5($_POST['Password']);
     $stmt = $link->prepare("SELECT user, password FROM usuarios WHERE user = ? ");
     $stmt->bind_param("s", $User);
     $stmt->execute();
     $stmt->bind_result($user, $password);
     $stmt->fetch();
     if ($stmt->num_rows() > 0) {
          echo "already";
     } else {
          $stmt = $link->prepare("INSERT INTO usuarios (user, password) VALUES (?, ?)");
          $stmt->bind_param('ss', $uUser, $uPassword);
          $uUser = $User;
          $uPassword = $Password;
          /* ejecuta INSERT Shop */
          $stmt->execute();
          if ($stmt->affected_rows > 0) {
               $id_user = $stmt->insert_id;
               echo "successfully";
          } else {
               echo "error";
          }
     }
     $stmt->close();
}

///////////////////////////////   BORRAR - DELETE  ////////////////////////////////////
if ($boton == "btnBorrar") {
     $Nombre = $_POST['Nombre'];
     $stmt = $link->prepare("DELETE FROM personas WHERE Nombre = ?");
     $stmt->bind_param("s", $Nombre);
     $stmt->execute();
     $stmt->close();
     print("Datos borrados.");
}

//////////////////////////////   ACTUALIZAR - UPDATE  ///////////////////////////////
if ($boton == "btnActualizar") {
     $Nombre = $_POST['Nombre'];
     $Edad = $_POST['Edad'];
     $Ciudad = $_POST['Ciudad'];
     $stmt = $link->prepare("UPDATE personas SET Edad = ?, Ciudad = ? WHERE Nombre = ?");
     $stmt->bind_param("sss", $Edad, $Ciudad, $Nombre);
     $stmt->execute();
     $stmt->close();
     print("Datos modificados.");
}

///////////////////// BUSCAR POR NOMBRE - SEARCH BY NAME /////////////////////////////
if ($boton == "btnBuscarNombre") {
     $Nombre = $_POST['User'];
     echo "Nombre: " . $Nombre . "\n";
     $stmt = $link->prepare("SELECT shId, shName FROM shop WHERE shName = ?");
     $stmt->bind_param("s", $Nombre);
     $stmt->execute();
     $stmt->bind_result($shId, $shName);
     while ($stmt->fetch()) {
          echo $shId . "," . $shName . "\n";
     }
     $stmt->close();
}


///////////////////////////////////////////////////////////////////
