
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
                    <li><a href="customers.php"><i class="fa fa-money fa-fw"></i> Recibos</a></li>                    
                  </ul>
                </li>
                
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money fa-fw"></i> Contabilidad <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Seleccione</li>
                    <li><a href="financials.php"><i class="fa fa-usd fa-fw"></i> Ventas</a></li>
                    <li><a href="saldo.php"><i class="fa fa-calculator fa-fw"></i> Creditos</a></li> 
                    <li><a href="saldo-history.php"><i class="fa fa-calculator fa-fw"></i> Historial Creditos</a></li> 
                  </ul>
                </li>
                 
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sort-alpha-asc fa-fw"></i> Productos <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Seleccione</li>
                    <li><a href="add-item.php"><i class="fa fa-plus-square fa-fw"></i> Nuevo Producto</a></li>
                    <li><a href="brands.php"><i class="fa fa-creative-commons fa-fw"></i> Marcas</a></li>  
                    <li><a href="items.php"><i class="fa fa-list-ul fa-fw"></i> Inventario</a></li> 
                    <li><a href="stockin.php"><i class="fa fa-stack-overflow fa-fw"></i> Entradas</a></li>
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

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle fa-fw"></i> Poveedores <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Seleccione</li>
                    <li><a href="add-supplier.php"><i class="fa fa-user-plus fa-fw"></i> Nuevo Proveedor</a></li>
                    <li><a href="suppliers.php"><i class="fa fa-user-circle-o fa-fw"></i> Lista Proveedores</a></li>   
                    <li><a href="purchases.php"><i class="fa fa-book fa-fw"></i> Lista Compras</a></li>
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

                <?php if(checkAdmin()) : ?>
                <li>
                    <a href="timelog.php"><i class="fa fa-bar-chart fa-fw"></i> Planilla</a>
                </li>
                <?php endif; ?>

                <?php if(checkAdmin()) : ?>
                <li>
                    <a href="notifications.php"><i class="fa fa-warning fa-fw"></i> Alertas</a>
                </li>
                <?php endif; ?>
                <?php if(checkAdmin()) : ?>
                <li>
                    <a href="settings.php?shId=<?php echo $shop->shId; ?> "><i class="fa fa-gear fa-fw"></i> Ajustes</a>
                    
                </li>
                <?php endif; ?>
                
                <li>               
                    <a href="https://saedi.com.co"><i class="fa fa-info-circle fa-fw"></i> Acerca de</a>
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
                 