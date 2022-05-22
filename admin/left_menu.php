<body>
  <script>
    //Funcion para convertir un numero en moneda separada por miles
    function numMiles(num) {
      var numero = Number(num).toLocaleString('es-CO');;
      return numero;
    };

    // Funcion para obtener el numero de un string 
    function numInt(i) {
      var num = Number(i.replace(/[\$,\.]/g, '') * 1);
      return num;
    };
  </script>
  <?php
  setlocale(LC_ALL, 'es_ES');
  date_default_timezone_set('America/Bogota');

  // Shop  
  $id = $_SESSION['shId'];
  $shop = getShopNameById($id);

  //Validate Pay
  if ($shop->shEnable == 3) {
    $today = date_create('now');
    $datePlan = date_create($shop->shDatePlan);
    $interval = date_diff($datePlan, $today);
    $month = intval($interval->format("%m")) + 1;
    //if(time() >= $_SESSION['last_run'] + (60 * 1)) { // 60 * 5 es 5 minutos
    // Si el tiempo es mayor a 1 minuto
  ?>
    <div class="alertPay warning">
      <span class="closebtnPay" onclick="closePay()">&times;</span>
      <form style="text-align: center;">
        <span class="spanPay"><strong>¡Hola <?php echo $shop->shName; ?>!</strong> Tienes <strong><?php echo $month ?> meses</strong> pendientes por pagar</span>
        <span class="spanPay">
          <script src="https://checkout.wompi.co/widget.js"
          data-render="button"
          data-public-key="pub_prod_RFgJ2fOjDPgigvVXTpLThQCGZ3ZV2xxS"
          data-currency="COP"
          data-amount-in-cents="<?php echo ($shop->shCostPlan * $month) * 100; ?>"
          data-reference="<?php echo $shop->shReference; ?>"
          data-redirect-url="https://cloud.mipos.pro/admin/end-transaction.php">
          </script>
        </span>
      </form>
    </div>
  <?php
    //}
  }
  ?>

  <!-- /.navbar-header -->
  <ul class="nav navbar-top-links navbar-user">
    <!-- /.dropdown Stores-->
    <?php
    $stores = getAllStores();
    if ($stores->num_rows > 1) { ?>
      <div class="fleft">
        <select id="cd-dropdown" class="cd-dropdown">
          <?php while ($row = mysqli_fetch_array($stores)) {
            if (intval($_SESSION['idStore']) == intval($row['stId'])) {
              echo '<option class="icon-stack" value="' . $row['stId'] . '" selected>' . $row['stName'] . '</option>';
            } else {
              echo '<option class="icon-stack" value="' . $row['stId'] . '">' . $row['stName'] . '</option>';
            }
          } ?>
        </select>
      </div>
    <?php } ?>

    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user-circle fa-fw"></i><strong> <?php echo getLoggedInUserName(); ?> </strong>
        <!--<i class="fa fa-user fa-fw"></i>--> <i style="color:#D4D4D4;" class="fa fa-caret-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-user">
        <input type="hidden" id="shPrinter" value="<?php echo $shop->shPrinterName; ?>">
        <input type="hidden" id="printerType" value="<?php echo $shop->shPrinterType; ?>">
        <li class="divider"></li>
        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
      </ul>
      <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
  </ul>
  <!-- </nav> -->
  <!-- /.navbar-top-links -->
  <div id="wrapper">
    <div class="overlay"></div>
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
      <ul class="nav sidebar-nav">
        <li class="sidebar-brand">
          <a href="#">
            <?php echo $shop->shName ?>
          </a>
        </li>
        <li>
          <a href="dashboard.php"><i class="fa fa-home fa-fw"></i> Inicio</a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cart-arrow-down fa-fw"></i> Ventas <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Seleccione</li>
            <li><a href="buy-product.php"><i class="fa fa-cart-plus fa-fw"></i> Nueva Venta</a></li>
            <li><a href="orders.php"><i class="fa fa-file-text-o fa-fw"></i> Facturas</a></li>
            <li><a href="quotations.php"><i class="fa fa-edit fa-fw"></i> Cotizaciones</a></li>
          </ul>
        </li>

        <?php if (checkAdmin() || checkManager()) : ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-usd fa-fw"></i> Contabilidad <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">Seleccione</li>
              <li><a href="financials.php"><i class="fa fa-money fa-fw"></i> Caja</a></li>
              <li><a href="saldo.php"><i class="fa fa-bank fa-fw"></i> Creditos</a></li>
              <li><a href="saldo-history.php"><i class="fa fa-calculator fa-fw"></i> Historial Creditos</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sort-alpha-asc fa-fw"></i> Productos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Seleccione</li>
            <li><a href="add-item.php"><i class="fa fa-plus-square fa-fw"></i> Nuevo Producto</a></li>
            <li><a href="items.php"><i class="fa fa-cubes fa-fw"></i> Inventario</a></li>
            <li><a href="stockin.php"><i class="fa fa-stack-overflow fa-fw"></i> Entradas</a></li>
            <li><a href="brands.php"><i class="fa fa-creative-commons fa-fw"></i> Marcas</a></li>
            <li><a href="warranties.php"><i class="fa fa-search fa-fw"></i> Garantias</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle fa-fw"></i> Clientes <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Seleccione</li>
            <li><a href="add-client.php"><i class="fa fa-user-plus fa-fw"></i> Nuevo Cliente</a></li>
            <li><a href="clients.php"><i class="fa fa-user-circle-o fa-fw"></i> Lista Clientes</a></li>
          </ul>
        </li>

        <?php if (checkAdmin() || checkManager()) : ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-vcard-o fa-fw"></i> Poveedores <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">Seleccione</li>
              <li><a href="add-supplier.php"><i class="fa fa-user-plus fa-fw"></i> Nuevo Proveedor</a></li>
              <li><a href="suppliers.php"><i class="fa fa-user-circle-o fa-fw"></i> Lista Proveedores</a></li>
              <li><a href="purchases.php"><i class="fa fa-check-square-o fa-fw"></i> Compras</a></li>
              <li><a href="balances.php"><i class="fa fa-book fa-fw"></i> Saldos</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i> Usuarios <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">Seleccione</li>
              <li><a href="add-user.php"><i class="fa fa-user-o fa-fw"></i> Nuevo Usuario</a></li>
              <li><a href="users.php"><i class="fa fa-users fa-fw"></i> Lista Usuarios</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (checkAdmin()) : ?>
          <li>
            <a href="timelog.php"><i class="fa fa-bar-chart fa-fw"></i> Planilla</a>
          </li>
        <?php endif; ?>

        <?php if (checkAdmin()) : ?>
          <li>
            <a href="notifications.php"><i class="fa fa-warning fa-fw"></i> Alertas</a>
          </li>
        <?php endif; ?>
        <?php if (checkAdmin()) : ?>
          <li>
            <a href="settings.php"><i class="fa fa-gear fa-fw"></i> Ajustes</a>
          </li>
        <?php endif; ?>

        <li>
          <a href="#" id="aboutInfo" class="hamburger is-closed" data-toggle="offcanvas"><i class="fa fa-info-circle fa-fw"></i> Acerca de</a>
        </li>
      </ul>
    </nav>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
        <span class="hamb-top"></span>
        <span class="hamb-middle"></span>
        <span class="hamb-bottom"></span>
      </button>
      <div class="container container-user">