const $impresoraSeleccionada = document.querySelector("#shPrinter").value,
      $btnImprimir = document.querySelector("#btnImprimir");

var invoiceTableArray = [];

function readTable() {
    $("#printers tr").each(function() {
        var arrayOfThisRow = [];
        var tableData = $(this).find('td');
        if (tableData.length > 0) {
            tableData.each(function() { arrayOfThisRow.push($(this).text().trim()); });
            invoiceTableArray.push(arrayOfThisRow);
        }
    });
}

// Obtiene Datos Impresora
var printerType = document.querySelector("#printerType").value;

// Definir anchos de columnas según tipo impresora
var productWidth, qtyWidth, unitWidth, totalWidth, lineDivider;

if (printerType == "1") {
    // 58mm (sin cambios)
    productWidth = 14;
    qtyWidth = 4;
    unitWidth = 7;
    totalWidth = 7;
    lineDivider = "------------------------------------------\n";
} else {
    // 80mm (optimizado para aprovechar más espacio)
    productWidth = 30;
    qtyWidth = 6;
    unitWidth = 10;
    totalWidth = 10;
    lineDivider = "--------------------------------------------------------\n";
}

// Eliminar símbolo $ y espacios en blanco
function replaceSym(sym) {
    return sym.replace(/[\$,\s]/g, '');
}

// Formatea un texto a longitud fija (izquierda)
function formatField(text, length) {
    text = text.toString();
    return text.length > length ? text.substring(0, length) : text + " ".repeat(length - text.length);
}

// Formatea número alineado a la derecha en campo fijo
function formatNumber(text, length) {
    text = text.toString();
    return text.length > length ? text.substring(0, length) : " ".repeat(length - text.length) + text;
}

// Imprime línea con etiqueta izquierda y número a la derecha (para totales)
function printLabelAndValue(impresora, label, value, totalWidthLine) {
    const labelPart = formatField(label, totalWidthLine - 12); // espacio para número
    const valuePart = formatNumber(value, 12); // mayor claridad en totales
    impresora.write(labelPart + valuePart + "\n");
}

var numItems = document.querySelector("#numItems").value;

// Datos Tienda
var printShopName = document.querySelector("#printShopName").textContent;
var printShopDesc = document.querySelector("#printShopDesc").textContent;
var printShopDoc = document.querySelector("#printShopDoc").textContent;
var printShopDir = document.querySelector("#printShopDir").textContent;

// Datos Factura
var InvoiceType = "Cotizacion No.: ";
var printFacturaNum = document.querySelector("#printFacturaNum").textContent;
var printFacturaFech = document.querySelector("#printFacturaFech").textContent;
var printFacturaHor = document.querySelector("#printFacturaHor").textContent;
var printFacturaClient = document.querySelector("#printFacturaClient").textContent;
var printFacturaDoc = document.querySelector("#printFacturaDoc").textContent;
var printFacturaCel = document.querySelector("#printFacturaCel").textContent;
var printFacturaDir = document.querySelector("#printFacturaDir").textContent;

// Valores Totales
var typeOrder = replaceSym(document.getElementById("typeOrder").textContent);
var printSubTotal = replaceSym(document.getElementById("printSubTotal").textContent);

if (typeOrder == "SubTotal:") {
    InvoiceType = document.querySelector("#InvoiceType").textContent;
    var printOldSaldo = replaceSym(document.querySelector("#printOldSaldo").textContent);
    var printTotal = replaceSym(document.querySelector("#printTotal").textContent);
    var printAbona = replaceSym(document.querySelector("#printAbona").textContent);
    var printNewSaldo = replaceSym(document.querySelector("#printNewSaldo").textContent);
    var printSerial = document.querySelector("#printSerial").textContent;
}

$btnImprimir.addEventListener("click", () => {
    readTable();

    let impresora = new Impresora();
    impresora.setFontSize(2, 2);
    impresora.setAlign("center");
    impresora.setEmphasize(1);
    impresora.write(printShopName + "\n");
    impresora.setFontSize(1, 1);
    impresora.write(printShopDesc + "\n");
    impresora.setFont("B");
    impresora.setEmphasize(0);
    impresora.write(printShopDoc + "\n");
    impresora.write(printShopDir + "\n\n");
    impresora.setAlign("left");
    impresora.write(InvoiceType + printFacturaNum + "\n");
    impresora.write("Fecha:      " + printFacturaFech + "\n");
    impresora.write("Hora:       " + printFacturaHor + "\n");
    impresora.write("Cliente:    " + printFacturaClient + "\n");
    impresora.write("Documento:  " + printFacturaDoc + "\n");
    impresora.write("Celular:    " + printFacturaCel + "\n");
    impresora.write("Direccion:  " + printFacturaDir + "\n\n");

    // Encabezado alineado
    impresora.setEmphasize(1);
    impresora.write(
        formatField("Producto", productWidth) +
        formatNumber("Cant", qtyWidth) + " " +
        formatNumber("Vr Unit", unitWidth) + " " +
        formatNumber("Vr Total", totalWidth) + "\n"
    );
    impresora.setEmphasize(0);

    // Productos
    for (let index = 0; index < numItems; index++) {
        impresora.write(
            formatField(invoiceTableArray[index][0], productWidth) +
            formatNumber(invoiceTableArray[index][1], qtyWidth) + " " +
            formatNumber(invoiceTableArray[index][2], unitWidth) + " " +
            formatNumber(invoiceTableArray[index][3], totalWidth) + "\n"
        );
    }

    impresora.setEmphasize(1);
    impresora.write(lineDivider);
    impresora.setEmphasize(0);

    // Totales alineados
    printLabelAndValue(impresora, typeOrder, printSubTotal, productWidth + qtyWidth + unitWidth + totalWidth);

    if (typeOrder == "SubTotal:") {
        impresora.setEmphasize(1);
        printLabelAndValue(impresora, "Saldo Anterior:", printOldSaldo, productWidth + qtyWidth + unitWidth + totalWidth);
        printLabelAndValue(impresora, "Total:", printTotal, productWidth + qtyWidth + unitWidth + totalWidth);
        printLabelAndValue(impresora, "Abona:", printAbona, productWidth + qtyWidth + unitWidth + totalWidth);
        printLabelAndValue(impresora, "Nuevo Saldo:", printNewSaldo, productWidth + qtyWidth + unitWidth + totalWidth);
        impresora.setEmphasize(0);
        impresora.write(lineDivider);
        impresora.setEmphasize(0);
        impresora.write("OBSERVACIONES: " + printSerial + "\n");
    }

    impresora.setAlign("center");
    impresora.write("\n\nSistema POS Web | WWW.MIPOS.PRO");
    impresora.feed(2);
    impresora.cut();
    impresora.cutPartial();
    impresora.cash();
    impresora.imprimirEnImpresora($impresoraSeleccionada);
    impresora.imprimirEnImpresora("MIPOS-RED");
});
