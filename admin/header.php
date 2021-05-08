<?php 
//date_default_timezone_set('America/Bogota');
//setlocale(LC_TIME, 'es_ES');
//locale_set_default('es');

include('../autoloadfunctions.php');
include('../vendor/autoload.php');

?>

<!DOCTYPE html>
<html lang="es">
<?php 
	//setlocale(LC_TIME, 'es_ES.UTF-8');
	//date_default_timezone_set('America/Bogota');
	//setlocale(LC_ALL, 'es_CO.UTF-8');
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador Facturación</title>

     <!-- jQuery UI 1.12.1 -->
     <link href="../bower_components/jqueryui/dist/css/jquery-ui.min.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables 1.10.22 CSS Boostrap 3, pfd, print, scroll -->
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables/DataTables-1.10.22/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables/Buttons-1.6.4/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables/Scroller-2.0.3/css/scroller.bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../bower_components/datatables/media/css/datatables.min.css"/> -->

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Time Picker CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <!-- jQuery 3.4.1 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>


</head>
<body>
            <!-- Shop -->
            <?php
            $id = $_SESSION['shId'];
            $shop = getShopNameById($id);

            ?>

               <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-user">
            
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Bienvenido(a) <strong> <?php echo getLoggedInUserName(); ?> </strong> <!--<i class="fa fa-user fa-fw"></i>-->  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- </nav> -->
            <!-- /.navbar-top-links -->