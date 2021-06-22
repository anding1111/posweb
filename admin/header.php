<?php 
include('../autoloadfunctions.php');
include('../vendor/autoload.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Punto de Venta en la NUBE - Tu negocio en cualquier lugar y a cualquier hora">
    <meta name="author" content="SAEDI SAS">

    <link rel="icon" type="image/png" href="../dist/img/icons/favicon.png"/>

    <title>miPOS | WEB</title>

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

    <!-- PrintJS CSS -->
    <link rel="stylesheet" type="text/css" href="../dist/css/print.min.css">

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
<?php 
	// setlocale(LC_TIME, 'es_ES.UTF-8');
	// date_default_timezone_set('America/Bogota');
	// setlocale(LC_ALL, 'es_CO.UTF-8');
    setlocale(LC_ALL, 'es_ES');
?>
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
                    <i class="fa fa-user-circle fa-fw"></i><strong> <?php echo getLoggedInUserName(); ?> </strong> <!--<i class="fa fa-user fa-fw"></i>-->  <i style="color:#D4D4D4;" class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    <input type="hidden" id="shPrinter" value="<?php echo $shop->shPrinterName; ?>">
                    <input type="hidden" id="printerType" value="<?php echo $shop->shPrinterType; ?>">
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