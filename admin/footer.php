                   </div>
                   <!-- /#page-content-wrapper -->

                   </div>
                   <!-- /#wrapper -->

                   <!-- Modal About -->
                   <div class="modal fade" id="about_modal" role="dialog">
                       <div class="modal-dialog about_modal">
                           <!-- Modal content-->
                           <div class="modal-content" style="border-radius:10px;">
                               <div class="modal-header" style="background-color:#287890;border-radius:6px 6px 0px 0px;">
                                   <label class="modal-title" style=" text-align:center;color:#fff; font-size:18px; width:95%;">miPOS</label>
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                               </div>
                               <div class="modal-body" style="text-align: center; color:#5C5C5C;">
                                   <span style="font-size:26px; font-weight:100;">¡Apoyamos tu negocio!<br></span>
                                   Desarrollado<br>por<br>
                                   <a href="https://saedi.com.co"><i class="fa fa-globe fa-fw"></i>www.saedi.com.co</a>

                               </div>
                               <div class="modal-footer" style="text-align:center;padding:0px;background-color:#287890;border-radius:0px 0px 6px 6px;">
                                   <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="color:#fff;background-color:#287890;width:100%;border-color:#287890;">OK</button>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- Fin Modal Anulacion -->

                   <?php
                    // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $actual_link = "$_SERVER[REQUEST_URI]";
                    ?>
                   <?php if ($actual_link <> "/admin/buy-product.php") : ?>
                       <!--Floating Button-->
                       <a href="buy-product.php" class="float">
                           <i class="fa fa-cart-plus fa-2x my-float"></i>
                       </a>
                       <!--/Floating Button-->
                   <?php endif; ?>

                   <!-- </div> -->
                   <!-- /#wrapper -->

                   <!-- jQuery UI 1.12.1 -->
                   <script src="../bower_components/jqueryui/dist/js/jquery-ui.min.js"></script>

                   <!-- Bootstrap Core JavaScript -->
                   <!-- <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->

                   <!-- DataTables 1.10.22 Script -->
                   <!-- <script type="text/javascript" src="../bower_components/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/DataTables-1.10.22/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script> -->
                   <!-- <script ESTE NO type="text/javascript" src="../bower_components/datatables/media/js/datatables.min.js"></script> -->
                   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.4/js/dataTables.scroller.min.js"></script>
                   <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/filtering/type-based/accent-neutralise.js"></script>

                   <!-- Timer Picker JS -->
                   <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

                   <!-- Custom Theme JavaScript -->
                   <!-- <script src="../dist/js/sb-admin-2.js"></script> -->

                   <!-- Impresora JavaScript -->
                   <script src="../dist/js/Impresora.js"></script>

                   <!-- JS Color Picker -->
                   <script src="../dist/js/jscolor.min.js"></script>

                   <!-- Select Store JS -->
                   <script type="text/javascript" src="../dist/js/jquery.dropdown.js"></script>
                   <script type="text/javascript">
                       $(function() {
                           $('#cd-dropdown').dropdown({
                               gutter: 5,
                               stack: false,
                               delay: 100,
                               slidingIn: 100
                           });
                       });
                   </script>

                   <script>
                       $(document).ready(function() {

                           $('#aboutInfo').click(function() {
                               $('#about_modal').modal('show');
                           });

                           $('.cViewInv').each(function(e) {
                               if ($(this).val() == 1) {
                                   $(this).attr("checked", "checked");
                               }
                           });

                           $("#start_time").val("00:00:00");
                           $("#end_time").val("23:59:59");

                           $('#timer').click(function() {
                               var showTimer = $('#timerState').data('timer'); //getter
                               if (showTimer == 0) {
                                   $('.viewTimer').show("swing");
                                   $("#start_time").val("06:00:00");
                                   $("#end_time").val("14:00:00");
                                   $('#timerState').data('timer', 1); //setter
                               } else {
                                   $('.viewTimer').hide("swing");
                                   $("#start_time").val("00:00:00");
                                   $("#end_time").val("23:59:59");
                                   $('#timerState').data('timer', 0); //setter

                               }
                           });
                           $('.input-timerstart').timepicker({
                               timeFormat: 'HH:mm:ss',
                               interval: 30,
                               minTime: '06:00',
                               maxTime: '22:00',
                               defaultTime: '00:00:00',
                               startTime: '06:00',
                               dynamic: true,
                               dropdown: true,
                               scrollbar: true
                           });
                           $('.input-timerend').timepicker({
                               timeFormat: 'HH:mm:ss',
                               interval: 30,
                               minTime: '06:00',
                               maxTime: '22:00',
                               defaultTime: '23:00:59',
                               startTime: '14:00',
                               dynamic: true,
                               dropdown: true,
                               scrollbar: true
                           });

                           $('table.display').DataTable({
                               responsive: true,
                               scrollX: true,
                               "language": {
                                   "url": "../bower_components/datatables/Spanish.json"
                               }
                           });

                           // Tablas credito y compras
                           $('#dataTables-credito-compra').DataTable({
                               responsive: true,
                               scrollX: true,
                               "language": {
                                   "url": "../bower_components/datatables/Spanish.json"

                               },
                               "footerCallback": function(row, data, start, end, display) {
                                   var api = this.api(),
                                       data;

                                   // Remove the formatting to get integer data for summation
                                   var intVal = function(i) {
                                       return typeof i === 'string' ?
                                           i.replace(/[\$,]/g, '') * 1 :
                                           typeof i === 'number' ?
                                           i : 0;
                                   };

                                   // Total over this page
                                   pageTotal = api
                                       .column(1, {
                                           page: 'current'
                                       })
                                       .data()
                                       .reduce(function(a, b) {
                                           return intVal(a) + intVal(b);
                                       }, 0);

                                   // Update footer
                                   $(api.column(1).footer()).html(
                                       '$' + numMiles(pageTotal)
                                   );

                               }

                           });

                           // Tablas Historial credito
                           $('#dataTables-all-credito').DataTable({
                               responsive: true,
                               scrollX: true,
                               "language": {
                                   "url": "../bower_components/datatables/Spanish.json"

                               },
                               "footerCallback": function(row, data, start, end, display) {
                                   var api = this.api(),
                                       data;

                                   // Remove the formatting to get integer data for summation
                                   var intVal = function(i) {
                                       return typeof i === 'string' ?
                                           i.replace(/[\$,]/g, '') * 1 :
                                           typeof i === 'number' ?
                                           i : 0;
                                   };


                                   // Abono over this page
                                   pageAbono = api
                                       .column(3, {
                                           page: 'current'
                                       })
                                       .data()
                                       .reduce(function(a, b) {
                                           return intVal(a) + intVal(b);
                                       }, 0);

                                   // Update footer               
                                   $(api.column(3).footer()).html(
                                       '$' + numMiles(pageAbono)
                                   );

                               }

                           });

                           // Tabla inventarios
                           $('#dataTables-inventario').DataTable({
                               responsive: true,
                               scrollX: true,
                               "language": {
                                   "url": "../bower_components/datatables/Spanish.json"

                               },
                               "footerCallback": function(row, data, start, end, display) {
                                   var api = this.api(),
                                       data;

                                   // Remove the formatting to get integer data for summation
                                   var intVal = function(i) {
                                       return typeof i === 'string' ?
                                           i.replace(/[\$,]/g, '') * 1 :
                                           typeof i === 'number' ?
                                           i : 0;
                                   };

                                   // Total qty
                                   pageQty = api
                                       .column(3, {
                                           page: 'current'
                                       })
                                       .data()
                                       .reduce(function(a, b) {
                                           return intVal(a) + intVal(b);
                                       }, 0);
                                   // Total unitario
                                   pageMountUnit = api
                                       .column(4, {
                                           page: 'current'
                                       })
                                       .data()
                                       .reduce(function(a, b) {
                                           return intVal(a) + intVal(b);
                                       }, 0);
                                   // Total total
                                   pageMountTotal = api
                                       .column(5, {
                                           page: 'current'
                                       })
                                       .data()
                                       .reduce(function(a, b) {
                                           return intVal(a) + intVal(b);
                                       }, 0);


                                   // Update footer
                                   $(api.column(3).footer()).html(
                                       numMiles(pageQty) + ' Unidades');
                                   $(api.column(4).footer()).html(
                                       '$' + numMiles(pageMountUnit));
                                   $(api.column(5).footer()).html(
                                       '$' + numMiles(pageMountTotal)
                                   );

                               }

                           });

                           $('.input-daterange').datepicker({
                               todayBtn: 'linked',
                               //format: "yyyy-mm-dd",
                               autoclose: true,
                               closeText: 'Cerrar',
                               prevText: '<Ant',
                               nextText: 'Sig>',
                               currentText: 'Hoy',
                               monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                               monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                               dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                               dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                               dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                               weekHeader: 'Sm',
                               dateFormat: 'yy-mm-dd',
                               firstDay: 1,
                               isRTL: false,
                               showMonthAfterYear: false,
                               yearSuffix: ''
                           });

                           //Section Financials
                           fetch_data('no');

                           function fetch_data(is_date_search, start_date = '', end_date = '', start_time = '00:00:00', end_time = '23:59:59', radio = '1', checkbox = '0') {

                               var st_date = $("#start_date").val();
                               var en_date = $("#end_date").val();
                               var dataTable = $('#order_data').DataTable({
                                   "scrollY": "200px",
                                   "scrollX": true,
                                   "scrollCollapse": true,
                                   "paging": false,
                                   "processing": true,
                                   "serverSide": true,
                                   "order": [],
                                   "ajax": {
                                       url: "fetch.php",
                                       type: "POST",
                                       data: {
                                           is_date_search: is_date_search,
                                           start_date: start_date,
                                           end_date: end_date,
                                           start_time: start_time,
                                           end_time: end_time,
                                           radio: radio,
                                           checkbox: checkbox
                                       }
                                   },
                                   columns: [{
                                           title: "Nombre",
                                       },
                                       {
                                           title: "Cantidad",
                                           render: $.fn.dataTable.render.number('.', ',', 0),
                                           className: 'text-right',
                                       },
                                       {
                                           title: "Valor($)",
                                           render: $.fn.dataTable.render.number('.', ',', 0),
                                           className: 'text-right',

                                       }
                                   ],
                                   "language": {
                                       "url": "../bower_components/datatables/Spanish.json"
                                   },
                                   dom: "<'row'<'col-sm-12't>>" +
                                       "<'row'<'col-sm-12 col-centered text-center'B>>",

                                   buttons: [{
                                       text: 'COPIAR&nbsp;&nbsp;<i class="fa fa-lg fa-copy"></i>',
                                       extend: 'copy',
                                       title: 'REPORTE DE VENTAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                       filename: function() {
                                           var currentDate = new Date();
                                           var d = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '_' + currentDate.getHours() + "-" + currentDate.getMinutes() + "-" + currentDate.getSeconds();
                                           return d;
                                       }
                                   }, {
                                       text: 'EXCEL&nbsp;&nbsp;<i class="fa fa-lg fa-file-excel-o"></i>',
                                       extend: 'excel',
                                       exportOptions: {
                                           orthogonal: 'export'
                                       },
                                       title: 'REPORTE DE VENTAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                       filename: function() {
                                           var currentDate = new Date();
                                           var d = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '_' + currentDate.getHours() + "-" + currentDate.getMinutes() + "-" + currentDate.getSeconds();
                                           return d;
                                       }
                                   }, {
                                       text: 'PDF&nbsp;&nbsp;<i class="fa fa-lg fa-file-pdf-o"></i>',
                                       extend: 'pdf',
                                       title: 'REPORTE DE VENTAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                       filename: function() {
                                           var currentDate = new Date();
                                           var d = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '_' + currentDate.getHours() + "-" + currentDate.getMinutes() + "-" + currentDate.getSeconds();
                                           return d;
                                       }
                                   }, {
                                       text: 'IMPRIMIR&nbsp;&nbsp;<i class="fa fa-lg fa-print"></i>',
                                       extend: 'print',
                                       title: 'REPORTE DE VENTAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                   }],
                                   "footerCallback": function(row, data, start, end, display) {
                                       var api = this.api(),
                                           data;
                                       // Remove the formatting to get integer data for summation
                                       var intVal = function(i) {
                                           return typeof i === 'string' ?
                                               i.replace(/[\$,\.]/g, '') * 1 :
                                               typeof i === 'number' ?
                                               i : 0;
                                       };

                                       // Total Qty
                                       pageQty = api
                                           .column(1, {
                                               page: 'current'
                                           })
                                           .data()
                                           .reduce(function(a, b) {
                                               return intVal(a) + intVal(b);
                                           }, 0);

                                       // Total Mount
                                       pageTotal = api
                                           .column(2, {
                                               page: 'current'
                                           })
                                           .data()
                                           .reduce(function(a, b) {
                                               return intVal(a) + intVal(b);
                                           }, 0);

                                       // Total Saldo              
                                       // pageAbono = api                    
                                       //     .cell(0, 3, { page: 'current'})
                                       //     .data();               

                                       // Update footer
                                       $(api.column(1).footer()).html(
                                           pageQty + ' Unidades');
                                       $(api.column(2).footer()).html(
                                           '$' + numMiles(pageTotal));

                                       // Update Total 
                                       var efectivo = 0;
                                       try {
                                           console.log(data[0][4]);
                                           var efectivo = data[0][4];
                                       } catch (e) {
                                           console.error(e.message, " porque no existe el objeto");
                                       }
                                       $("#totales").html('Total Caja: $' + numMiles(efectivo));

                                   }

                               });

                           };

                           $('#search').click(function() {
                               var start_date = $('#start_date').val();
                               var end_date = $('#end_date').val();
                               var start_time = $('#start_time').val();
                               var end_time = $('#end_time').val();
                               var radio = $('.radio:checked').val();
                               var checkbox = $('#checkbox').val();
                               $('#order_data').DataTable().destroy();
                               fetch_data('yes', start_date, end_date, start_time, end_time, radio, checkbox);
                           });

                           //Section Purchases
                           fetch_data_purchases('no');

                           function fetch_data_purchases(is_date_search, start_date = '', end_date = '') {

                               var st_date = $("#start_date").val();
                               var en_date = $("#end_date").val();
                               var dataTable = $('#dataTables-all-compra').DataTable({
                                   "scrollY": "200px",
                                   "scrollX": true,
                                   "scrollCollapse": true,
                                   // "paging": false,
                                   "processing": true,
                                   "serverSide": true,
                                   "order": [],
                                   "ajax": {
                                       url: "fetch-purchases.php",
                                       type: "POST",
                                       data: {
                                           is_date_search: is_date_search,
                                           start_date: start_date,
                                           end_date: end_date
                                       }
                                   },
                                   columns: [{
                                           title: "Proveedor",
                                       },
                                       {
                                           title: "Total($)",
                                           render: $.fn.dataTable.render.number('.', ',', 0),
                                           className: 'text-right',
                                       },
                                       {
                                           title: "Abono($)",
                                           render: $.fn.dataTable.render.number('.', ',', 0),
                                           className: 'text-right',

                                       },
                                       {
                                           title: "Saldo($)",
                                           render: $.fn.dataTable.render.number('.', ',', 0),
                                           className: 'text-right',

                                       },
                                       {
                                           title: "Fecha",

                                       },
                                       {
                                           title: "Factura",

                                       },
                                       {
                                           title: "Detalle",

                                       }
                                   ],
                                   "language": {
                                       "url": "../bower_components/datatables/Spanish.json"
                                   },
                                   dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                                       "<'row'<'col-sm-12'tr>>" +
                                       "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                                       "<'row'<'col-sm-12 col-centered text-center'B>>",
                                   "lengthMenu": [
                                       [-1, 10, 25, 50],
                                       ["Todo", 10, 25, 50]
                                   ],

                                   buttons: [{
                                       text: 'COPIAR&nbsp;&nbsp;<i class="fa fa-lg fa-copy"></i>',
                                       extend: 'copy',
                                       title: 'REPORTE DE COMPRAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                       filename: function() {
                                           var currentDate = new Date();
                                           var d = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '_' + currentDate.getHours() + "-" + currentDate.getMinutes() + "-" + currentDate.getSeconds();
                                           return d;
                                       }
                                   }, {
                                       text: 'EXCEL&nbsp;&nbsp;<i class="fa fa-lg fa-file-excel-o"></i>',
                                       extend: 'excel',
                                       exportOptions: {
                                           orthogonal: 'export'
                                       },
                                       title: 'REPORTE DE COMPRAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                       filename: function() {
                                           var currentDate = new Date();
                                           var d = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '_' + currentDate.getHours() + "-" + currentDate.getMinutes() + "-" + currentDate.getSeconds();
                                           return d;
                                       }
                                   }, {
                                       text: 'PDF&nbsp;&nbsp;<i class="fa fa-lg fa-file-pdf-o"></i>',
                                       extend: 'pdf',
                                       title: 'REPORTE DE COMPRAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                       filename: function() {
                                           var currentDate = new Date();
                                           var d = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '_' + currentDate.getHours() + "-" + currentDate.getMinutes() + "-" + currentDate.getSeconds();
                                           return d;
                                       }
                                   }, {
                                       text: 'IMPRIMIR&nbsp;&nbsp;<i class="fa fa-lg fa-print"></i>',
                                       extend: 'print',
                                       title: 'REPORTE DE COMPRAS  -  miPOS',
                                       className: 'dt-button btn-export',
                                   }],
                                   "footerCallback": function(row, data, start, end, display) {
                                       var api = this.api(),
                                           data;
                                       // Remove the formatting to get integer data for summation
                                       var intVal = function(i) {
                                           return typeof i === 'string' ?
                                               i.replace(/[\$,\.]/g, '') * 1 :
                                               typeof i === 'number' ?
                                               i : 0;
                                       };

                                       // Total
                                       pageTotalPurchases = api
                                           .column(1, {
                                               page: 'current'
                                           })
                                           .data()
                                           .reduce(function(a, b) {
                                               return intVal(a) + intVal(b);
                                           }, 0);

                                       // Total Abono
                                       pageAbonoPurchases = api
                                           .column(2, {
                                               page: 'current'
                                           })
                                           .data()
                                           .reduce(function(a, b) {
                                               return intVal(a) + intVal(b);
                                           }, 0);

                                       // Total Saldo
                                       pageSaldoPurchases = api
                                           .column(3, {
                                               page: 'current'
                                           })
                                           .data()
                                           .reduce(function(a, b) {
                                               return intVal(a) + intVal(b);
                                           }, 0);

                                       // Update footer
                                       $(api.column(1).footer()).html(
                                           '$' + numMiles(pageTotalPurchases));
                                       $(api.column(2).footer()).html(
                                           '$' + numMiles(pageAbonoPurchases));
                                       $(api.column(3).footer()).html(
                                           '$' + numMiles(pageSaldoPurchases));

                                       // Update Total 
                                       var efectivo = 0;
                                       try {
                                           console.log(data[0][4]);
                                           var efectivo = data[0][4];
                                       } catch (e) {
                                           console.error(e.message, " porque no existe el objeto");
                                       }
                                       $("#totales").html('Total Caja: $' + numMiles(efectivo));

                                   }

                               });

                           }

                           $('#search_purchases').click(function() {
                               var start_date = $('#start_date').val();
                               var end_date = $('#end_date').val();
                               $('#dataTables-all-compra').DataTable().destroy();
                               fetch_data_purchases('yes', start_date, end_date);
                           });

                       });
                   </script>

                   <!-- </body>

</html> -->