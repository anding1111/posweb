<?php
// Juan Antonio Villalpando
// http://kio4.com/appinventor/340D_appinventor_mysqli_inject.htm

// 1.- IDENTIFICACION nombre de la base, del usuario, clave y servidor
// TEST
// $db_host = "localhost";
// $db_name = "mipospro_pruebas";
// $db_login = "mipospro_pruebas";
// $db_pswd = "MIPOS.MIPOS.PRO";

//PRODUCTION
$db_host = "localhost";
$db_name = "mipospro_mipos";
$db_login = "mipospro_mipos";
$db_pswd = "MIPOS.MIPOS.PRO";

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
     $stmt = $link->prepare("SELECT shId, shName, shMail, shEnable FROM shop WHERE shMail = ? ");
     $stmt->bind_param("s", $User);
     $stmt->execute();
     $stmt->bind_result($shId, $shName, $shMail, $shEnable);
     $stmt->fetch();
     if ($stmt->num_rows() > 0) {
          echo $shMail . " ya se encuentra registrado en: <b>" . $shName . "<br>";
     } else {
          $stmt = $link->prepare("INSERT INTO shop (shId, shMail) VALUES (?, ?)");
          $stmt->bind_param('is', $shId, $shMail);
          $shId = 0;
          $shMail = $User;
          /* ejecuta INSERT Shop */
          $stmt->execute();
          if ($stmt->affected_rows > 0) {
               $id_shop = $stmt->insert_id;
               echo "Comercio Correctamente<br>";
               $insertStmt = $link->prepare("INSERT INTO store (stId, stName, shId) VALUES (?, ?, ?)");
               $stId = 0;
               $shId = $id_shop;
               /* ejecuta INSERT Store */
               foreach ($_POST['Store'] as $value) {
                    $insertStmt->bind_param('isi', $stId, $value, $shId);
                    $insertStmt->execute();
               }
               if ($insertStmt->affected_rows > 0) {
                    $id_store = $insertStmt->insert_id;
                    echo "Almacenes Correctamente<br>";
                    $stmt = $link->prepare("INSERT INTO users (id, uName, uPassword, shId, idStore) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param('issii', $id, $uName, $uPassword, $shId, $idStore);
                    $id = 0;
                    $uName = $User;
                    $uPassword = md5("password");
                    $shId = $id_shop;
                    $idStore = $id_store;
                    /* ejecuta INSERT User */
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                         echo "Usuario Correctamente<br>";
                         $stmt = $link->prepare("INSERT INTO client (cId, cName, clEnable, shId) VALUES (?, ?, ?, ?), (?, ?, ?, ?)");
                         $stmt->bind_param('isiiisii', $cId, $cName, $clEnable, $shId, $cId, $cName2, $clEnable2, $shId);
                         $cId = 0;
                         $cName = "Local";
                         $cName2 = "Cotizaciones";
                         $clEnable = 3;
                         $clEnable2 = 4;
                         $shId = $id_shop;
                         /* ejecuta INSERT clients */
                         $stmt->execute();
                         if ($stmt->affected_rows > 0) {
                              echo "Clientes Correctamente<br>";
                              $stmt = $link->prepare("INSERT INTO brands (bId, shId) VALUES (?, ?)");
                              $stmt->bind_param('ii', $bId, $shId);
                              $bId = 0;
                              $shId = $id_shop;
                              /* ejecuta INSERT brands */
                              $stmt->execute();
                              if ($stmt->affected_rows > 0) {
                                   echo "Marcas Correctamente<br>";
                                   $stmt = $link->prepare("INSERT INTO suppliers (sId, shId) VALUES (?, ?)");
                                   $stmt->bind_param('ii', $sId, $shId);
                                   $sId = 0;
                                   $shId = $id_shop;
                                   /* ejecuta INSERT Suppliers */
                                   $stmt->execute();
                                   if ($stmt->affected_rows > 0) {
                                        echo "Proveedores Correctamente<br>";
                                   } else {
                                        echo "Proveedores Error<br>";
                                   }
                              } else {
                                   echo "Marcas Error<br>";
                              }
                         } else {
                              echo "Clientes Error<br>";
                         }
                    } else {
                         echo "Usuario Error<br>";
                    }
               } else {
                    echo "Almacenes Error<br>";
               }
          } else {
               echo "Comercio Error<br>";
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
