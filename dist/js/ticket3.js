const $impresoraSeleccionada = document.querySelector("#shPrinter").value;
const $btnImprimir = document.querySelector("#btnImprimir");

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

$btnImprimir.addEventListener("click", async () => {
    readTable();

    const printerType = document.querySelector("#printerType").value;
    let impresora = new Impresora();

    // CONFIGURACIÓN AUTOMÁTICA
    const logoMaxWidth = printerType == "1" ? 280 : 384;
    const qrCellSize = printerType == "1" ? 3 : 4;
    const lineWidth = printerType == "1" ? 32 : 42;

    // INICIO IMPRESIÓN
    impresora.setFontSize(2, 2);
    impresora.setAlign("center");
    impresora.setEmphasize(1);

    // LOGO (opcional)
    const logoValue = document.querySelector("#logoEmpresa").getAttribute("data-print") || "1";
    if (logoValue != "0") {
        const logoBase64 = await convertLogoToBase64(document.querySelector("#logoEmpresa"), logoMaxWidth);
        if (logoBase64) {
            impresora.image(logoBase64);
        }
    }

    // Nombre comercio
    impresora.setFontSize(2, 2);
    impresora.setAlign("center");
    impresora.setEmphasize(1);
    impresora.write(document.querySelector("#printShopName").textContent + "\n");

    // Datos comercio
    impresora.setFontSize(1, 1);
    impresora.setEmphasize(0);
    impresora.write(document.querySelector("#printShopDesc").textContent + "\n");
    impresora.write(document.querySelector("#printShopDoc").textContent + "\n");
    impresora.write(document.querySelector("#printShopDir").textContent + "\n\n");

    // Datos factura
    impresora.setAlign("left");
    impresora.write("Factura:    " + document.querySelector("#printFacturaNum").textContent + "\n");
    impresora.write("Fecha:      " + document.querySelector("#printFacturaFech").textContent + "\n");
    impresora.write("Hora:       " + document.querySelector("#printFacturaHor").textContent + "\n");
    impresora.write("Cliente:    " + document.querySelector("#printFacturaClient").textContent + "\n");
    impresora.write("Documento:  " + document.querySelector("#printFacturaDoc").textContent + "\n");
    impresora.write("Celular:    " + document.querySelector("#printFacturaCel").textContent + "\n");
    impresora.write("Direccion:  " + document.querySelector("#printFacturaDir").textContent + "\n\n");

    // Encabezado tabla productos
    impresora.setEmphasize(1);
    impresora.write("Producto                    Cant VrUnit VrTotal\n");
    impresora.setEmphasize(0);

    // Productos
    const numItems = document.querySelector("#numItems").value;
    for (let index = 0; index < numItems; index++) {
        const row = invoiceTableArray[index];
        impresora.write(
            row[0].padEnd(26).substring(0, 26) + " " +
            row[1].padStart(3) + " " +
            row[2].padStart(6) + " " +
            row[3].padStart(7) + "\n"
        );
    }

    // Totales
    impresora.setEmphasize(1);
    impresora.write("-".repeat(lineWidth) + "\n");

    const viewCredits = parseInt(document.querySelector("#viewCredits").value);
    const typeOrderText = (viewCredits === 0) ? "Total:" : "SubTotal:";
    const printSubTotal = document.querySelector("#printSubTotal").textContent.trim();

    printLabelAndValue(impresora, typeOrderText, printSubTotal, lineWidth);

    if (viewCredits === 1) {
        printLabelAndValue(impresora, "Saldo Anterior:", document.querySelector("#printOldSaldo").textContent.trim(), lineWidth);
        printLabelAndValue(impresora, "Total:", document.querySelector("#printTotal").textContent.trim(), lineWidth);
        printLabelAndValue(impresora, "Abona:", document.querySelector("#printAbona").textContent.trim(), lineWidth);
        printLabelAndValue(impresora, "Nuevo Saldo:", document.querySelector("#printNewSaldo").textContent.trim(), lineWidth);
    }

    impresora.write("-".repeat(lineWidth) + "\n");

    // QR (opcional)
    const qrValue = document.querySelector("#printQR").getAttribute("data-print") || "1";
    if (qrValue != "0") {
        const urlTicket = document.querySelector("#printQR").getAttribute("data-url") || "https://mipos.pro";
        const qrBase64 = await generateQRCodeBase64(urlTicket, qrCellSize);
        if (qrBase64) {
            impresora.image(qrBase64);
        }
    }

    // Footer
    impresora.setAlign("center");
    impresora.setFontSize(1, 1);
    impresora.write("\nGracias por su compra\n");
    impresora.write("www.mipos.pro\n\n");

    // Corte
    impresora.cut();

    // Enviar a la impresora
    await impresora.imprimirEnImpresora($impresoraSeleccionada);
});

// ------- FUNCIONES AUXILIARES ---------

function printLabelAndValue(impresora, label, value, lineWidth) {
    const labelPart = label.padEnd(lineWidth - 12);
    const valuePart = value.padStart(12);
    impresora.write(labelPart + valuePart + "\n");
}

async function convertLogoToBase64(imgElement, maxWidth) {
    return new Promise((resolve) => {
        if (!imgElement || !imgElement.src) {
            resolve(null);
            return;
        }

        const img = new Image();
        img.crossOrigin = "Anonymous";
        img.src = imgElement.src;

        img.onload = function() {
            const canvas = document.createElement("canvas");
            const scale = maxWidth / img.width;
            canvas.width = maxWidth;
            canvas.height = img.height * scale;

            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

            const dataURL = canvas.toDataURL("image/png");
            resolve(dataURL);
        };

        img.onerror = function() {
            resolve(null);
        };
    });
}

async function generateQRCodeBase64(text, size) {
    return new Promise((resolve) => {
        const qr = qrcode(0, "H");
        qr.addData(text);
        qr.make();

        const cellSize = size || 4;
        const margin = 4;

        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        const qrSize = qr.getModuleCount();
        const canvasSize = (qrSize + margin * 2) * cellSize;

        canvas.width = canvas.height = canvasSize;

        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect(0, 0, canvasSize, canvasSize);

        ctx.fillStyle = "#000000";
        for (let r = 0; r < qrSize; r++) {
            for (let c = 0; c < qrSize; c++) {
                if (qr.isDark(r, c)) {
                    ctx.fillRect(
                        (c + margin) * cellSize,
                        (r + margin) * cellSize,
                        cellSize,
                        cellSize
                    );
                }
            }
        }

        const dataURL = canvas.toDataURL("image/png");
        resolve(dataURL);
    });
}
