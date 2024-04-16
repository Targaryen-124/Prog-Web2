
function getscreenshot(div , name) {
    html2canvas(document.getElementById(div), {
        onrendered: function (canvas) {
            var data = canvas.toDataURL();
            var docDefinition = {
                content: [{
                    image: data,
                    width: 500,
                }]
            };
            pdfMake.createPdf(docDefinition).download( name + ".pdf");
        }
    });
}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

function expPdf(){
    var img1 = '';
    var img2 = '';
    var doc = new jsPDF(); // Define jsPDF object here
    html2canvas(document.querySelector("#content1")).then(canvas => {
        img1 = canvas.toDataURL('image/png');
        html2canvas(document.querySelector("#content2")).then(canvas => {
            img2 = canvas.toDataURL('image/png');
            doc.addImage(img1, 'JPEG', 20, 20);
            doc.addPage();
            doc.addImage(img2, 'JPEG', 20, 20);
            doc.save('test.pdf');
        });
    }); 
}

<?php

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

if ( ! isset($_GET['pdf']) ) {
	$content = '<html>';
	$content .= '<head>';
	$content .= '<style>';
	$content .= 'body { font-family: DejaVu Sans; }';
	$content .= '</style>';
	$content .= '</head><body id="rotulo">';
	$content .= '<a href="index.php?pdf=1">Generar documento PDF</a>';
	$content .= '</body></html>';
	echo $content;
	exit;
}

$content = '<html>';
$content .= '<head>';
$content .= '<style>';
$content .= '</style>';
$content .= '</head><body>';
$content .= '<h2 id="rotulo">Hola</h2>';
/*$content .= 'Almacena en una variable todo el contenido que quieras incorporar ';
$content .= 'en el documento <b>formato HTML</b> para generar a partir de &eacute;ste ';
$content .= 'el documento PDF.<br><br>';
$content .= 'Ejemplo lista<br>';
$content .= '<ul><li>Uno</li><li>Dos</li><li>Tres</li></ul>';
$content .= 'Ejemplo imagen<br><br>';
$content .= '<img src="logo-openwebinars.png" alt="" />';*/
$content .= '</body></html>';

//echo $content; exit;

$dompdf = new Dompdf();
$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'landscape'); // (Opcional) Configurar papel y orientación
$dompdf->render(); // Generar el PDF desde contenido HTML
$pdf = $dompdf->output(); // Obtener el PDF generado
$dompdf->stream(); // Enviar el PDF generado al navegador
?>


window.onload = function() {
    if (typeof jsPDF !== 'undefined') {
        window.jsPDF = window.jspdf.jsPDF;
    } else {
        console.error('Error: jsPDF library not found.');
    }
};
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
    var img1 = '';
    var img2 = '';
    var doc = new jsPDF();

    html2canvas(document.querySelector("#content1")).then(canvas1 => {
        img1 = canvas1.toDataURL('image/png');
        html2canvas(document.querySelector("#content2")).then(canvas2 => {
            img2 = canvas2.toDataURL('image/png');
            doc.addImage(img1, 'JPEG', 20, 20);
            doc.addPage();
            doc.addImage(img2, 'JPEG', 20, 20);

            // Convertir la tabla HTML a una imagen y agregarla al PDF
            html2canvas(document.querySelector("#myTable")).then(canvas => {
                var imgData = canvas.toDataURL('image/jpeg');
                doc.addImage(imgData, 'JPEG', 10, 100);
                doc.save('test.pdf');
            });
        });
    });
}
