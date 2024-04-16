<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket | UTH</title>
    <link rel="stylesheet" href="styleUF.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-text/1.6.0/html-to-text.min.js"></script> <!-- Incluimos la biblioteca html-to-text -->

</head>

<body>
    <div class="logoUTH" id="content1">
        <img src="imagenes/UTH2.png" alt="logouth" width="200px" height="150px">
    </div>
    <div class="wrapper" id="content2">
        <form action="">
            <h2 id="rotulo">Su ticket Generado es</h2>
            <h1 id="ticket">TK</h1>
            <button type="button" class="btn btn-success btn-lg" onclick="expPdf()" id="generar">Descargar</button>
		</form>
    </div>
    <table id="myTable" border="1">
    <thead>
        <tr>
            <th>Encabezado 1</th>
            <th>Encabezado 2</th>
            <th>Encabezado 3</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Dato 1</td>
            <td>Dato 2</td>
            <td>Dato 3</td>
        </tr>
        <tr>
            <td>Dato 4</td>
            <td>Dato 5</td>
            <td>Dato 6</td>
        </tr>
    </tbody>
</table>

    <script>
        function capture() {
            html2canvas(document.getElementById('content')).then(function(canvas) {
                var img = canvas.toDataURL('image/jpeg');
                // Crea un enlace para descargar la imagen
                var link = document.createElement('a');
                link.download = 'captured_image.jpg';
                link.href = img;
                link.click();
            });
        }
    </script>

<script>
        window.jsPDF = window.jspdf.jsPDF;
        function capture2() {
            console.log('Activa');
            html2canvas(document.getElementById('content')).then(function(canvas) {
                var img = canvas.toDataURL('image/jpeg');
                // Crea un objeto jsPDF
                var doc = new jsPDF();
                // Agrega la imagen al documento PDF
                doc.addImage(img, 'JPEG', 10, 10);
                // Descarga el documento PDF
                doc.save('ticket.pdf');
            });
        }
    </script>

<script>
    
window.onload = function() {
    if (typeof jsPDF !== 'undefined') {
        window.jsPDF = window.jspdf.jsPDF;
    } else {
        console.error('Error: jsPDF library not found.');
    }
};

function expPdf() {
    var doc = new jsPDF();

    // Agregar los datos de la tabla al PDF
    var tableData = [];
    var rows = document.querySelectorAll("#myTable tbody tr");
    rows.forEach(function(row) {
        var rowData = [];
        var cells = row.querySelectorAll("td");
        cells.forEach(function(cell) {
            rowData.push(cell.textContent.trim());
        });
        tableData.push(rowData.join("\t"));
    });
    doc.text(tableData.join("\n"), 10, 10);

    // Obtener la imagen de la primera sección
    html2canvas(document.querySelector("#content1"), {
        onrendered: function(canvas1) {
            var img1 = canvas1.toDataURL('image/png');
            doc.addImage(img1, 'JPEG', 20, 60, 170, 100); // Ajusta la posición y el tamaño según tus necesidades

            // Obtener la imagen de la segunda sección
            html2canvas(document.querySelector("#content2"), {
                onrendered: function(canvas2) {
                    var img2 = canvas2.toDataURL('image/png');
                    doc.addPage(); // Agrega una nueva página para la segunda imagen
                    doc.addImage(img2, 'JPEG', 20, 20, 170, 100); // Ajusta la posición y el tamaño según tus necesidades

                    // Guardar el PDF
                    doc.save('test.pdf');
                }
            });
        }
    });
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" on></script>
</body>

</html>
