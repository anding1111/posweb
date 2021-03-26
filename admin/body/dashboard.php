
                <div class="col-lg-12 col-md-18">
                    <div class="panel panel-greenf w3-card-4 main-card">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <div class="huge"><b style="font-size:52px; font-family:Helvetica, Arial, sans-serif;">TEINNOVA</b><br>Comunicaciones</div>                               -->
                                    <div class="huge"><span class="title-card"><?php echo $shop->shName ?></span><br><span class="sec-title"><?php echo $shop->shAuxName ?></h2></div>                              
                                </div>
                            </div>
                        </div>
                        <a href="https://www.saedi.com.co">
                            <div class="panel-footer">
                                <span class="pull-left">Desarrollado por SAEDI.COM.CO</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>			
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-blue w3-card-4">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">								
                                    <i class="fa fa-cart-arrow-down fa-5x"></i>									
                                </div>
								<?php
									$qry = getTotalCustomers();									
									?>
								
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $qry;?></div>
                                    <div>VENTAS</div>
                                </div>
                            </div>
                        </div>
                        <a href="customers.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>						
                        </a>
						<a href="buy-product.php">
						 <div class=" panel-footer pull-center">
                                <span><i class="fa fa-plus-circle fa-3x"></i></span>
                                <div class="clearfix"></div>
                            </div>
						</a>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow w3-card-4">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-address-book fa-5x"></i>
                                </div>
								<?php
									$qry = getTotalCategories();									
									?>
								
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $qry;?></div>
                                    <div>CLIENTES</div>
                                </div>
                            </div>
                        </div>
                        <a href="clients.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
						<a href="add-client.php">
						 <div class=" panel-footer pull-center">
                                <span><i class="fa fa-plus-circle fa-3x"></i></span>
                                <div class="clearfix"></div>
                            </div>
						</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-purple w3-card-4">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-barcode fa-5x"></i>
                                </div>
								<?php
									$qry = getTotalItems();									
									?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $qry;?></div>
                                    <div>PRODUCTOS</div>
                                </div>
                            </div>
                        </div>
                        <a href="items.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
						<a href="add-item.php">
						 <div class=" panel-footer pull-center">
                                <span><i class="fa fa-plus-circle fa-3x"></i></span>
                                <div class="clearfix"></div>
                            </div>
						</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red w3-card-4">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
								<?php
									$qry = getTotalUsers();									
									?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $qry;?></div>
                                    <div>USUARIOS</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
						<a href="add-user.php">
						 <div class=" panel-footer pull-center">
                                <span><i class="fa fa-plus-circle fa-3x"></i></span>
                                <div class="clearfix"></div>
                            </div>
						</a>
                    </div>
                </div>
			