//const RUTA_API = "http://localhost:8000";
// const $impresoraSeleccionada = "POS-80C",
//Configura la impresora
//const $impresoraSeleccionada = document.querySelector("#shPrinter").value;

//$btnImprimir = document.querySelector("#btnImprimir");

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

//Obtiene Datos Impresora
var printerType = document.querySelector("#printerType").value;
//Configura Valores Impresora
var spaceNumber = 10;
var tabTitles = "\t\t\t";
var productString = "Producto";
var quantityString = "Cantidad";
var tabProducts ="\t\t";
var tabProductsMin ="\t";
var tabNumbers ="\t";
var lineDivider = "----------------------------------------------------------------\n";
var largeMinString = 11;
var largeMaxString = 23;
var largeCutString = 22;
if (printerType == 1) {
    spaceNumber = 9;
    tabTitles = "\t  ";
    var productString = "Prod.";
    var quantityString = "Cant.";
    tabProducts = "\t";
    tabProductsMin ="   ";
    tabNumbers = "\t";
    lineDivider = "------------------------------------------\n";
    largeMinString = 6;
    largeMaxString = 10;
    largeCutString = 9;
}

//Eliminar simbolo $ y espacios en blanco
function replaceSym(sym) {
    var num = sym.replace(/[\$,\s]/g, '');
    return num;
}

//Ajustar los numeros a la izquierda
function justifyNum(num){
    var n = spaceNumber - num.length;
    var mi = " ";    
    return mi.repeat(n).concat(num);    
}

//Cortar una cadena en un largo dado
var arrayString = new Array;
function sliceString(str, length) {
    arrayString[0] = str.slice(0, length);
    arrayString[1] = str.slice(length);       
}


//Alinear el contenido del recibo
function alignData(str) { 
    if (str.length < largeMinString) {
        strPart = str.concat(tabProducts);
    }else if (str.length < largeMaxString) {
        strPart = str.concat(tabProducts); 
    }else { 
        sliceString(str, largeCutString);
        strParcial += arrayString[0] + "-\n";
        alignData(arrayString[1]); 
    }
    strComplete = strParcial.concat(strPart);
}

var numItems = document.querySelector("#numItems").value;


//Obtiene Datos Tienda
var printShopName = document.querySelector("#printShopName").textContent;
var printShopDesc = document.querySelector("#printShopDesc").textContent;
var printShopDoc = document.querySelector("#printShopDoc").textContent;
var printShopDir = document.querySelector("#printShopDir").textContent;

//Obtiene Datos Factura
var InvoiceType = "Cotizacion No.: ";
var printFacturaNum = document.querySelector("#printFacturaNum").textContent;
var printFacturaFech = document.querySelector("#printFacturaFech").textContent;
var printFacturaHor = document.querySelector("#printFacturaHor").textContent;
var printFacturaClient = document.querySelector("#printFacturaClient").textContent;
var printFacturaDoc = document.querySelector("#printFacturaDoc").textContent;
var printFacturaCel = document.querySelector("#printFacturaCel").textContent;
var printFacturaDir = document.querySelector("#printFacturaDir").textContent;

//Obtiene Valores Totales
var typeOrder = replaceSym(document.getElementById("typeOrder").textContent);
var printSubTotal = replaceSym(document.getElementById("printSubTotal").textContent);
if (typeOrder == "SubTotal:") {
    var InvoiceType = document.querySelector("#InvoiceType").textContent;
    var printOldSaldo = replaceSym(document.querySelector("#printOldSaldo").textContent);
    var printTotal = replaceSym(document.querySelector("#printTotal").textContent);
    var printAbona = replaceSym(document.querySelector("#printAbona").textContent);
    var printNewSaldo = replaceSym(document.querySelector("#printNewSaldo").textContent);
    var printSerial = document.querySelector("#printSerial").textContent;
}
    


$btnImprimir.addEventListener("click", () => {
    readTable();
    // let impresora = new Impresora(RUTA_API);  
    let impresora = new Impresora();   
    impresora.setFontSize(2, 2);   
    impresora.setAlign("center");
    impresora.setEmphasize(1);
    impresora.write(printShopName);
    impresora.write("\n");
    impresora.setFontSize(1, 1);
    impresora.write(printShopDesc); 
    impresora.write("\n");
    impresora.setFont("B");   
    impresora.setEmphasize(0);    
    impresora.write(printShopDoc);
    impresora.write("\n");
    impresora.write(printShopDir);
    impresora.write("\n\n");
    impresora.setAlign("left");
    impresora.write(InvoiceType);
    impresora.write(printFacturaNum);
    impresora.write("\n");
    impresora.write("Fecha:      ");
    impresora.write(printFacturaFech);
    impresora.write("\n");
    impresora.write("Hora:       ");
    impresora.write(printFacturaHor);
    impresora.write("\n");
    impresora.write("Cliente:    ");
    impresora.write(printFacturaClient);
    impresora.write("\n");
    impresora.write("Documento:  ");
    impresora.write(printFacturaDoc);
    impresora.write("\n");
    impresora.write("Celular:    ");
    impresora.write(printFacturaCel);
    impresora.write("\n");
    impresora.write("Direccion:  ");
    impresora.write(printFacturaDir);
    impresora.write("\n\n");    
    impresora.setEmphasize(1);
    impresora.write(productString + tabTitles + quantityString + "\tVr Unit\tVr Total\n");
    impresora.setEmphasize(0); 
    for (let index = 0; index < numItems; index++) {
        let stringProd = invoiceTableArray[index][0];
        strParcial = '';
        strComplete = '';
        alignData(stringProd);        
        impresora.write(strComplete);
        impresora.write(tabProductsMin);
        impresora.write(invoiceTableArray[index][1]);
        impresora.write(tabProductsMin);
        impresora.write(justifyNum(invoiceTableArray[index][2]));
        impresora.write(tabProductsMin);
        impresora.write(justifyNum(invoiceTableArray[index][3]));
        impresora.write("\n");    
    }
    impresora.setEmphasize(1); 
    impresora.write(lineDivider);
    impresora.setAlign("right");
    impresora.write(typeOrder);
    impresora.setEmphasize(0);
    impresora.write(justifyNum(printSubTotal));
    impresora.write("\n");
    if (typeOrder == "SubTotal:") {
    impresora.setEmphasize(1);
    impresora.write("Saldo Anterior: ");
    impresora.setEmphasize(0);
    impresora.write(justifyNum(printOldSaldo));
    impresora.write("\n");
    impresora.setEmphasize(1);
    impresora.write("Total: ");
    impresora.setEmphasize(0);
    impresora.write(justifyNum(printTotal));
    impresora.write("\n");
    impresora.setEmphasize(1);
    impresora.write("Abona: ");
    impresora.setEmphasize(0);
    impresora.write(justifyNum(printAbona));
    impresora.write("\n");
    impresora.setEmphasize(1);
    impresora.write("Nuevo Saldo: ");
    impresora.setEmphasize(0);
    impresora.write(justifyNum(printNewSaldo));
    impresora.write("\n");
    impresora.setEmphasize(1);
    impresora.write(lineDivider);
    impresora.setEmphasize(0);   
    impresora.write("OBSERVACIONES: ");
    impresora.write(printSerial);
    impresora.write("\n");
    }
    impresora.setAlign("center");
    impresora.write("\n\n");
    impresora.write("Sistema POS Web | WWW.MIPOS.PRO");    
    impresora.feed(2); // Feed 2 veces
    impresora.cut(); // Corta el papel
    impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial
    impresora.cash();
    impresora.imprimirEnImpresora($impresoraSeleccionada);
    impresora.imprimirEnImpresora("MIPOS-RED");
    // impresora.imprimirEnImpresoraConNombreEIp($impresoraSeleccionada, "192.168.0.20");
    // impresora.imprimirEnImpresoraConNombreEIp("POS-80C", "192.168.0.20");
    //impresora.end();
        // .then(valor => {
        //     loguear("Al imprimir: " + valor);
        // });
    //window.location.href='../../admin/buy-product.php';
});
