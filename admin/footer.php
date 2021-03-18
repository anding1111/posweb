                   
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->   
<?php
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = "$_SERVER[REQUEST_URI]";
?>
<?php if($actual_link <> "/admin/buy-product.php") : ?>
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
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
   
    <!-- DataTables 1.10.22 Script -->
    <script type="text/javascript" src="../bower_components/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/DataTables-1.10.22/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Buttons-1.6.4/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="../bower_components/datatables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>
    <!-- <script type="text/javascript" src="../bower_components/datatables/media/js/datatables.min.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Impresora JavaScript -->
    <script src="../dist/js/Impresora.js"></script>   
    
    <!-- JS Color Picker -->
    <script src="../dist/js/jscolor.min.js"></script>   

    <script>

    //Funcion para convertir un numero en moneda separada por miles
    function numMiles(num){
                    var numero = Number(num).toLocaleString('es-CO');;
                    return numero;
                }; 

    // Funcion para obtener el numero de un string 
    function numInt( i ) {
        var num = Number(i.replace(/[\$,\.]/g, '')*1);
        return num;
    };    

    $(document).ready(function() {  

        $('.cViewInv').each(function(e){
            if($(this).val() == 1){
                $(this).attr("checked", "checked");
            }
        }); 

        $('table.display').DataTable({
            responsive: true,
            scrollX: true,
			"language": {
                "url": "../bower_components/datatables/Spanish.json"                    
            }
        });

        // Tabla recibos
        $('#dataTables-recibos').DataTable( {
            responsive: true,
            scrollX: true,
            "language": {
                "url": "../bower_components/datatables/Spanish.json"
                
            },            
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };    
            
                // Total over this page
                pageTotal = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );                
    
                // Update footer
                $( api.column( 2 ).footer() ).html(
                    '$'+numMiles(pageTotal)
                );                
            }
                
        });

        // Tablas credito y compras
        $('#dataTables-credito-compra').DataTable( {
            responsive: true,
            scrollX: true,
            "language": {
                "url": "../bower_components/datatables/Spanish.json"
                
            },            
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };    
               
                // Total over this page
                pageTotal = api
                    .column( 1, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );                
    
                // Update footer
                $( api.column( 1 ).footer() ).html(
                    '$' + numMiles(pageTotal) 
                );
                
            }
            
        });

        // Tablas Historial compras
        $('#dataTables-all-compra').DataTable( {
            responsive: true,
            scrollX: true,
            "language": {
                "url": "../bower_components/datatables/Spanish.json"
                
            },            
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };    
               
                // Total over this page
                pageTotal = api
                    .column( 1, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );                
                // Abono over this page
                pageAbono = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );                
                // Saldo over this page
                pageSaldo = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );                
    
                // Update footer
                $( api.column( 1 ).footer() ).html(
                    '$' + numMiles(pageTotal) 
                );
                $( api.column( 2 ).footer() ).html(
                    '$' + numMiles(pageAbono) 
                );
                $( api.column( 3 ).footer() ).html(
                    '$' + numMiles(pageSaldo) 
                );
                
            }
            
        });
        // Tablas Historial credito
        $('#dataTables-all-credito').DataTable( {
            responsive: true,
            scrollX: true,
            "language": {
                "url": "../bower_components/datatables/Spanish.json"
                
            },            
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };   
               
                              
                // Abono over this page
                pageAbono = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );  
    
                // Update footer               
                $( api.column( 3 ).footer() ).html(
                    '$' + numMiles(pageAbono) 
                );
                
                
            }
            
        });

        // Tabla inventarios
        $('#dataTables-inventario').DataTable( {
            responsive: true,
            scrollX: true,
            "language": {
                "url": "../bower_components/datatables/Spanish.json"
                
            },            
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };    
               
                // Total qty
                pageQty = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Total unitario
                pageMountUnit = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                // Total total
                pageMountTotal = api
                        .column( 5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
          

                // Update footer
                $( api.column( 3 ).footer() ).html(
                    numMiles(pageQty) + ' Unidades');
                $( api.column( 4 ).footer() ).html(
                    '$' + numMiles(pageMountUnit));              
                $( api.column( 5 ).footer() ).html(
                    '$' + numMiles(pageMountTotal) 
                );
                
            }
            
        });

            $('.input-daterange').datepicker({
                todayBtn:'linked',
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

            fetch_data('no');

            function fetch_data(is_date_search, start_date='', end_date='', radio='1', checkbox='0') {
            
                var st_date = $("#start_date").val();
                var en_date = $("#end_date").val();            
                
                var dataTable = $('#order_data').DataTable({
                    "scrollY": "200px",
                    "scrollX": true,
                    "scrollCollapse": true,
                    "paging": false,
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "ajax" : {
                        url:"fetch.php",
                        type:"POST",
                        data:{
                        is_date_search:is_date_search, start_date:start_date, end_date:end_date, radio:radio, checkbox:checkbox
                        }
                    },
                    "language": {
                        "url": "../bower_components/datatables/Spanish.json"                
                    },             
                    'sDom': 't',
                    //"pageLength": 25,
                    // "columnDefs": [
                    //                     {
                    //                         "targets": [ 3 ],
                    //                         "visible": false,
                    //                         "searchable": false
                    //                     }
                    //         ],                
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,\.]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total Qty
                        pageQty = api
                            .column( 1, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 ); 
                        
                        // Total Mount
                        pageTotal = api
                            .column( 2, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Total Saldo              
                        // pageAbono = api                    
                        //     .cell(0, 3, { page: 'current'})
                        //     .data();               

                        // Update footer
                        $( api.column( 1 ).footer() ).html(
                            pageQty + ' Unidades');
                        $( api.column( 2 ).footer() ).html(
                            '$' + numMiles(pageTotal)); 

                        // Update Total   
                        var efectivo = data[0][4];                
                        $("#totales").html('Total Caja: $' + numMiles(efectivo));                   
                        // $("#totales").html('Total Caja: $' + numMiles(pageAbono));                   
                    
                    }
                
                });                      
           
            } 

            $('#search').click(function(){
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                //var radio = $('#radio').val();
                var radio = $('.radio:checked').val();
                var checkbox = $('#checkbox').val();
                $('#order_data').DataTable().destroy();
                fetch_data('yes', start_date, end_date, radio, checkbox);
                // if(start_date != '' || end_date !='') {
                //     $('#order_data').DataTable().destroy();
                //     fetch_data('yes', start_date, end_date, radio);
                // } else {
                //     alert("Ambas Fechas son Requeridas!");
                // }
            });
    });
    </script>

<!-- </body>

</html> -->

   