<?php 
    //autoload
    include('autoloadfunctions.php');
	//date_default_timezone_set('America/Bogota');
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="dist/img/icons/favicon.ico"/>
    <!--===============================================================================================-->

    <title>miPOS - WEB</title>

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="dist/css/util-login.css">
        <link rel="stylesheet" type="text/css" href="dist/css/main-login.css">
    <!--===============================================================================================-->

</head>

<body class="login">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" role="form" method="POST" action="">
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-chart"></i>
                    </span>
                    
                    <span class="login100-form-title p-b-34 p-t-27">
                        miPOS
                    </span>
                    <?php 
                    // $dat = getValueLocal();
                    // if (getValueByData($dat)) {
                    //     echo ("Dispositivo Licenciado. ¡Gracias por su compra!");
                        
                        if($_POST) :
                            //received data from user
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                        if( loginDataReceive($username, $password) == 1){

                            redirectTo('admin/dashboard.php', 0);
                            //inserting user information            
                            $nowTime = date("Y-m-d H:i:s");
                            $q  = $conexion->query("INSERT INTO logintime VALUES(
                                                    '0',
                                                    '". $_SESSION['uId'] ."',
                                                    '".$nowTime."',
                                                    '". $_SESSION['shId'] ."'
                                            )") or die(mysqli_error($conexion));
    
                        ?>
                            <div class="alert alert-success">Ingreso Satisfactorio</a>.</div>
                        <?php
                        }
                        
                        if( loginDataReceive($username, $password) == 2){
                        ?>
                            <div class="alert alert-danger">Error en usuario o contraseña</a>.
                            </div>
                        <?php
                        }
                           
                        if( loginDataReceive($username, $password) == 3){
                        ?>
                            <div class="alert alert-danger">Debe llenar todos los campos!</a>.
                            </div>
                        <?php
                        }
                        endif;                        
                    // } else {
                    //     echo ("¡Dispositivo no autorizado!. Comuniquese con soporte POSWEB");                        
                    // }

                   ?>
                    <div class="wrap-input100 validate-input" data-validate = "Enter username" style="margin-top: 30px;">
                        <input class="input100" type="text" name="username" placeholder="Usuario">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Contraseña" value="">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Ingresar
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!--===============================================================================================-->
	<script src="dist/js/main-login.js"></script>
    <!--===============================================================================================-->

</body>

</html>
