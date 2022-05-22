$(document).ready(function () {
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
        isClosed = false;

    trigger.click(function () {
        hamburger_cross();
    });

    function hamburger_cross() {

        if (isClosed == true) {
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
    });
});

// JS Alert Custom
var janelaPopUp = new Object();
janelaPopUp.abre = function (id, classes, titulo, corpo, functionCancelar, functionEnviar, textoCancelar, textoEnviar) {
    var cancelar = (textoCancelar !== undefined) ? textoCancelar : 'OK';
    var enviar = (textoEnviar !== undefined) ? textoEnviar : 'Continuar';
    classes += ' ';
    var classArray = classes.split(' ');
    classes = '';
    classesFundo = '';
    var classBot = '';
    $.each(classArray, function (index, value) {
        switch (value) {
            case 'alert': classBot += ' alert '; break;
            case 'blue': classesFundo += this + ' ';
            case 'green': classesFundo += this + ' ';
            case 'red': classesFundo += this + ' ';
            case 'white': classesFundo += this + ' ';
            case 'orange': classesFundo += this + ' ';
            case 'purple': classesFundo += this + ' ';
            default: classes += this + ' '; break;
        }
    });
    var popFundo = '<div id="popFundo_' + id + '" class="popUpFundo ' + classesFundo + '"></div>'
    var janela = '<div id="' + id + '" class="popUp ' + classes + '"><h1>' + titulo + "</h1><div><span>" + corpo + "</span></div><button class='puCancelar " + classBot + "' id='" + id + "_cancelar' data-parent=" + id + ">" + cancelar + "</button><button class='puEnviar " + classBot + "' data-parent=" + id + " id='" + id + "_enviar'>" + enviar + "</button></div>";
    $("window, body").css('overflow', 'hidden');

    $("body").append(popFundo);
    $("body").append(janela);
    $("body").append(popFundo);
    $("#popFundo_" + id).fadeIn("fast");
    $("#" + id).addClass("popUpEntrada");

    $("#" + id + '_cancelar').on("click", function () {
        if ((functionCancelar !== undefined) && (functionCancelar !== '')) {
            functionCancelar();

        } else {
            janelaPopUp.fecha(id);
        }
    });
    $("#" + id + '_enviar').on("click", function () {
        if ((functionEnviar !== undefined) && (functionEnviar !== '')) {
            functionEnviar();
        } else {
            janelaPopUp.fecha(id);
        }
    });

};
janelaPopUp.fecha = function (id) {
    if (id !== undefined) {
        $("#" + id).removeClass("popUpEntrada").addClass("popUpSaida");

        $("#popFundo_" + id).fadeOut(1000, function () {
            $("#popFundo_" + id).remove();
            $("#" + $(this).attr("id") + ", #" + id).remove();
            if (!($(".popUp")[0])) {
                $("window, body").css('overflow', 'auto');
            }
        });


    }
    else {
        $(".popUp").removeClass("popUpEntrada").addClass("popUpSaida");

        $(".popUpFundo").fadeOut(1000, function () {
            $(".popUpFundo").remove();
            $(".popUp").remove();
            $("window, body").css('overflow', 'auto');
        });


    }
}

var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function () { div.style.display = "none"; }, 600);
    }
}

// Alert Pay
function closePay() {
    var x = document.getElementsByClassName("alertPay");
    x[0].style.display = "none";
}


//Datatables Ajax Response
var ordersTbl = '';
$(function () {
    // draw function [called if the database updates]
    function draw_data() {
        if ($.fn.dataTable.isDataTable('#dataTables-recibos') && ordersTbl != '') {
            ordersTbl.draw(true)
        } else {
            load_data();
        }
    }

    function load_data() {
        ordersTbl = $('#dataTables-recibos').DataTable({

            "processing": true,
            "serverSide": true,
            "language": {
                "url": "../bower_components/datatables/Spanish.json"
            },
            "ajax": {
                url: "./fetch-orders.php",
                method: 'POST'
            },
            columns: [{
                data: 'id',
            },
            {
                data: 'name',
            },
            {
                data: 'total_order',
                render: $.fn.dataTable.render.number('.', ',', 0),
                className: 'text-right',
            },
            {
                data: 'order_date',
            },
            {
                data: null,
                orderable: false,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    return '<a href="invoice.php?invId=' + (row.id) + '&type=1" class="btn btn-default">Ver</a><a href="#null_modal" class=" invoiceInfo btn btn-default btn-small" id="invId" data-toggle="modal" data-id="' + (row.id) + '">Anular</a>';
                }
            }
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over this page
                pageTotal = api
                    .column(2, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(2).footer()).html(
                    '$' + numMiles(pageTotal)
                );
            },
            drawCallback: function (settings) {
                $('.invoiceInfo').click(function () {
                    var userid = $(this).data('id');
                    // AJAX request
                    $.ajax({
                        url: 'fetch-invoice.php',
                        type: 'post',
                        data: { userid: userid },
                        success: function (response) {
                            // Add response in Modal body
                            $('.modal-body').html(response);
                            // Display Modal
                            $('#null_modal').modal('show');
                        }
                    });
                });
                $("#null-confirm").click(function () {
                    var id = $('#numInvoice').val();
                    //var saldo = $('#saAbona').val(); 
                    $.ajax({
                        url: "body/null-invoice.php",
                        type: "post",
                        data: { invId: id }
                    }).done(function (msg) {
                        window.location.reload();
                    });
                });
            },

            "order": [
                [0, "desc"]
            ],
            initComplete: function (settings) {
                $('.paginate_button').addClass('p-1')
            }
        });
    }
    load_data()

});