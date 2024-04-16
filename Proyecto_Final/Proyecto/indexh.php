<?php 
include'encabezado.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Transacciones</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
</head>
<body>
    <div class="container-reportes">
    <h1>Consulta de Transacciones</h1>

    <!-- Formulario de búsqueda por fecha, usuario, tipo de transacción y reportes -->
    <form action="indexh.php" method="GET" class="form-group display-7">
        <label class="h3" for="tipo_busqueda">Seleccione el tipo de búsqueda:</label>
        <select id="tipo_busqueda" name="tipo_busqueda" onchange="mostrarOcultarCampos()" class="form-control-lg mx-4 my-4">
            <option value="">Seleccionar...</option>
            <option value="fecha">Buscar por fecha</option>
            <option value="usuario">Buscar por usuario</option>
            <option value="tipo_transaccion">Buscar por tipo de transacción</option>
            <option value="reporte_diario">Reporte Diario</option>
            <option value="reporte_semanal">Reporte Semanal</option>
            <option value="reporte_mensual">Reporte Mensual</option>
        </select>

        <!-- Campo de fecha oculto al principio -->
        <div id="div_fecha" style="display:none;" >
            <label class="h4" for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha">
        </div>

        <!-- Campo de nombre de usuario oculto al principio -->
        <div id="div_usuario" style="display:none;" class="form-group display-7">
            <label class="h4" for="nombre_usuario">Nombre de Usuario:</label>
            <select id="nombre_usuario" name="nombre_usuario" class="form-control-lg">
                <?php
                // Consulta SQL para obtener los nombres de usuario desde la base de datos
                require_once "conexion.php";
                $con = new conexion();
                $sql_usuarios = "SELECT usuario FROM usuarios";
                $statement_usuarios = $con->getConnection()->query($sql_usuarios);
                $usuarios = $statement_usuarios->fetchAll(PDO::FETCH_COLUMN);
                // Iterar sobre los nombres de usuario y mostrarlos como opciones
                foreach ($usuarios as $usuario) {
                    echo "<option value='$usuario'>$usuario</option>";
                }
                ?>
            </select>
        </div>

        <!-- Campo de tipo de transacción oculto al principio -->
        <div id="div_tipo_transaccion" style="display:none;" class="form-group display-7">
            <label class="h3" for="tipo_transaccion">Tipo de Transacción:</label>
            <select id="tipo_transaccion" name="tipo_transaccion" class="form-control-lg">
                <?php
                // Consulta SQL para obtener los tipos de transacción desde la base de datos
                $sql_tipos_transaccion = "SELECT descripcion FROM tipotransaccion";
                $statement_tipos_transaccion = $con->getConnection()->query($sql_tipos_transaccion);
                $tipos_transaccion = $statement_tipos_transaccion->fetchAll(PDO::FETCH_COLUMN);
                // Iterar sobre los tipos de transacción y mostrarlos como opciones
                foreach ($tipos_transaccion as $tipo_transaccion) {
                    echo "<option value='$tipo_transaccion'>$tipo_transaccion</option>";
                }
                ?>
            </select>
        </div>

        <!-- Campo de selección de mes y año para el reporte mensual -->
        <div id="div_mes" style="display:none; ">
            <label class="h4" for="mes">Mes:</label>
            <select id="mes" name="mes" class="form-control-sm">
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <label class="h4" for="anio">Año:</label>
            <input type="number" id="anio" name="anio" min="1900" max="2099" step="1" value="<?php echo date('Y'); ?>">
        </div>

        <button type="submit" class="btn-lg btn-success"> Buscar</button>
        <button type="button" class="btn-lg btn-primary" onclick="expPdf()" id="generar">PDF</button>
        <button type="button" class="btn-lg btn-primary"><a id="download_xlsx" href="#" style="text-decoration: none; color:white;">Excel</a></button>
        <a id="download_xls" download="filename.xls" href="#" hidden="true">Export to Excel</a>
        <a id="download_csv" download="filename.csv" href="#" hidden="true">Export to CSV</a>
        <a id="download_xlsx" download="filename.xlsx" href="#" hidden="true">Export to CSV</a>

    </form>

    <?php
    // Incluir archivo de conexión
    require_once "conexion.php";

    // Definir título por defecto
    $titulo = "Resultados de búsqueda";

    // Definir la consulta SQL base
    $sql = "SELECT 
                transaccion.codigo,
                tipotransaccion.descripcion AS tipo_transaccion,
                mesas.descripcion AS nombre_mesa,
                usuarios.usuario AS nombre_usuario,
                empleado.nombre AS nombre_empleado,
                transaccion.fecha
            FROM 
                transaccion
            INNER JOIN 
                tickect ON transaccion.idtransaccion = tickect.idtransaccion
            INNER JOIN 
                mesas ON tickect.idmesa = mesas.idmesa
            INNER JOIN 
                usuarios ON tickect.idusuario = usuarios.idusuario
            INNER JOIN 
                empleado ON usuarios.idempleado = empleado.idempleado
            INNER JOIN 
                tipotransaccion ON transaccion.idtipotransaccion = tipotransaccion.idtipotransaccion";

    // Verificar si se ha enviado un formulario
    if (isset($_GET['tipo_busqueda']) && !empty($_GET['tipo_busqueda'])) {
        $opcion = $_GET['tipo_busqueda'];

        // Determinar el título y construir la consulta SQL según la opción seleccionada
        switch ($opcion) {
            case 'fecha':
                $titulo = "Resultados de la Búsqueda por Fecha";
                $sql .= " WHERE DATE(transaccion.fecha) = :fecha";
                break;
            case 'usuario':
                $titulo = "Resultados de la Búsqueda por Usuario";
                $sql .= " WHERE usuarios.usuario = :nombre_usuario";
                break;
            case 'tipo_transaccion':
                $titulo = "Resultados de la Búsqueda por Tipo de Transacción";
                $sql .= " WHERE tipotransaccion.descripcion = :tipo_transaccion";
                break;
            case 'reporte_diario':
                $titulo = "Reporte Diario";
                $sql .= " WHERE DATE(transaccion.fecha) = CURDATE()";
                break;
            case 'reporte_semanal':
                $titulo = "Reporte Semanal";
                // Obtener el número de semana actual
                $semana_actual = date('W');
                // Obtener el año actual
                $anio_actual = date('Y');
                $sql .= " WHERE WEEK(transaccion.fecha, 1) = :semana AND YEAR(transaccion.fecha) = :anio";
                break;
            case 'reporte_mensual':
                $titulo = "Reporte Mensual";
                $sql .= " WHERE MONTH(transaccion.fecha) = :mes AND YEAR(transaccion.fecha) = :anio";
                break;
            default:
                $titulo = "Seleccione una opción de búsqueda";
                break;
        }
    }

    // Preparar la consulta SQL
    $statement = $con->getConnection()->prepare($sql);

    // Vincular los parámetros según la opción de búsqueda seleccionada
    if (isset($opcion)) {
        switch ($opcion) {
            case 'fecha':
                $fecha = $_GET['fecha'];
                $statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                break;
            case 'usuario':
                // El nombre de usuario ya está seleccionado desde el formulario
                $nombre_usuario = $_GET['nombre_usuario'];
                $statement->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
                break;
            case 'tipo_transaccion':
                // El tipo de transacción ya está seleccionado desde el formulario
                $tipo_transaccion = $_GET['tipo_transaccion'];
                $statement->bindParam(':tipo_transaccion', $tipo_transaccion, PDO::PARAM_STR);
                break;
            case 'reporte_semanal':
                // Vincular la semana y el año actuales
                $statement->bindParam(':semana', $semana_actual, PDO::PARAM_INT);
                $statement->bindParam(':anio', $anio_actual, PDO::PARAM_INT);
                break;
            case 'reporte_mensual':
                $mes = $_GET['mes'];
                $anio = $_GET['anio'];
                $statement->bindParam(':mes', $mes, PDO::PARAM_INT);
                $statement->bindParam(':anio', $anio, PDO::PARAM_INT);
                break;
            default:
                break;
        }
    }

    // Ejecutar la consulta SQL
    $statement->execute();

    // Obtener los resultados
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar el título de la búsqueda
    echo "<h2>$titulo</h2>";

    // Mostrar la tabla de resultados si hay registros
    if (count($rows) > 0) {
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th>Código de Transacción</th>
                        <th>Tipo de Transacción</th>
                        <th>Nombre de Mesa</th>
                        <th>Nombre de Usuario</th>
                        <th>Nombre de Empleado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>";
        // Iterar a través de los resultados y mostrar en la tabla
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row["codigo"] . "</td>";
            echo "<td>" . $row["tipo_transaccion"] . "</td>";
            echo "<td>" . $row["nombre_mesa"] . "</td>";
            echo "<td>" . $row["nombre_usuario"] . "</td>";
            echo "<td>" . $row["nombre_empleado"] . "</td>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        // Mostrar un mensaje si no hay resultados
        echo "<p>No se encontraron resultados para los criterios de búsqueda seleccionados.</p>";
    }
    echo "<div id='bar_chart' style='width: 800px; height: 500px;'></div>";
    echo "<div id='pie_chart' style='width: 800px; height: 500px;'></div>";
    // Obtener datos para el gráfico de barras si la opción seleccionada es reporte diario
if (isset($opcion) && ($opcion === 'reporte_diario' || $opcion === 'reporte_semanal' || $opcion === 'reporte_mensual')) {
    // Consulta SQL para obtener el nombre de usuario de las transacciones diarias
    $sql_usuarios_reporte_diario = "SELECT usuarios.usuario
                                    FROM transaccion
                                    INNER JOIN tickect ON transaccion.idtransaccion = tickect.idtransaccion
                                    INNER JOIN usuarios ON tickect.idusuario = usuarios.idusuario
                                    WHERE ";
    if ($opcion === 'reporte_diario') {
        $sql_usuarios_reporte_diario .= "DATE(transaccion.fecha) = CURDATE()";
    } elseif ($opcion === 'reporte_semanal') {
        $sql_usuarios_reporte_diario .= "WEEK(transaccion.fecha, 1) = :semana AND YEAR(transaccion.fecha) = :anio";
    } elseif ($opcion === 'reporte_mensual') {
        $sql_usuarios_reporte_diario .= "MONTH(transaccion.fecha) = :mes AND YEAR(transaccion.fecha) = :anio";
    }
    $statement_usuarios_reporte_diario = $con->getConnection()->prepare($sql_usuarios_reporte_diario);
    if ($opcion === 'reporte_semanal') {
        $statement_usuarios_reporte_diario->bindParam(':semana', $semana_actual, PDO::PARAM_INT);
        $statement_usuarios_reporte_diario->bindParam(':anio', $anio_actual, PDO::PARAM_INT);
    } elseif ($opcion === 'reporte_mensual') {
        $statement_usuarios_reporte_diario->bindParam(':mes', $mes, PDO::PARAM_INT);
        $statement_usuarios_reporte_diario->bindParam(':anio', $anio, PDO::PARAM_INT);
    }
    $statement_usuarios_reporte_diario->execute();
    $usuarios_reporte_diario = $statement_usuarios_reporte_diario->fetchAll(PDO::FETCH_COLUMN);
?>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawBarChart);

    function drawBarChart() {
        var data = google.visualization.arrayToDataTable([
            ['Usuario', 'Cantidad'],
            <?php
            // Generar los datos para el gráfico
            $usuarios_js = json_encode($usuarios_reporte_diario);
            $usuarios_counts = array_count_values($usuarios_reporte_diario);
            if (!empty($usuarios_counts)) {
                foreach ($usuarios_counts as $usuario => $cantidad) {
                    echo "['$usuario', $cantidad],";
                }
            } else {
                echo "['Sin datos', 0]";
            }
            ?>
        ]);

        var options = {
            title: 'Transacciones por Usuario',
            width: 800,
            legend: { position: 'none' },
            chart: {
                title: 'Transacciones por Usuario',
                subtitle: 'Cantidad de transacciones' 
            },
            axes: {
                x: {
                    0: { side: 'top', label: 'Usuario'} // Top x-axis.
                }
            },
            bar: { groupWidth: "90%" }
        };

        var chart = new google.visualization.BarChart(document.getElementById('bar_chart'));

        chart.draw(data, options);
    }
</script>

<div id="bar_chart" style="width: 800px; height: 500px;"></div>
<?php } ?>

<?php
// Obtener datos para el gráfico de pastel si la opción seleccionada es reporte diario
if (isset($opcion) && ($opcion === 'reporte_diario' || $opcion === 'reporte_semanal' || $opcion === 'reporte_mensual')) {
    // Consulta SQL para obtener la distribución de tipos de transacción
    $sql_tipos_transaccion = "SELECT tipotransaccion.descripcion, COUNT(*) AS cantidad
                                FROM transaccion
                                INNER JOIN tipotransaccion ON transaccion.idtipotransaccion = tipotransaccion.idtipotransaccion
                                WHERE ";
    if ($opcion === 'reporte_diario') {
        $sql_tipos_transaccion .= "DATE(transaccion.fecha) = CURDATE()";
    } elseif ($opcion === 'reporte_semanal') {
        $sql_tipos_transaccion .= "WEEK(transaccion.fecha, 1) = :semana AND YEAR(transaccion.fecha) = :anio";
    } elseif ($opcion === 'reporte_mensual') {
        $sql_tipos_transaccion .= "MONTH(transaccion.fecha) = :mes AND YEAR(transaccion.fecha) = :anio";
    }
    $sql_tipos_transaccion .= " GROUP BY tipotransaccion.descripcion";
    $statement_tipos_transaccion = $con->getConnection()->prepare($sql_tipos_transaccion);
    if ($opcion === 'reporte_semanal') {
        $statement_tipos_transaccion->bindParam(':semana', $semana_actual, PDO::PARAM_INT);
        $statement_tipos_transaccion->bindParam(':anio', $anio_actual, PDO::PARAM_INT);
    } elseif ($opcion === 'reporte_mensual') {
        $statement_tipos_transaccion->bindParam(':mes', $mes, PDO::PARAM_INT);
        $statement_tipos_transaccion->bindParam(':anio', $anio, PDO::PARAM_INT);
    }
    $statement_tipos_transaccion->execute();
    $tipos_transaccion = $statement_tipos_transaccion->fetchAll(PDO::FETCH_ASSOC);
?>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawPieChart);

    function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tipo de Transacción', 'Cantidad'],
            <?php
            // Generar los datos para el gráfico
            if (!empty($tipos_transaccion)) {
                foreach ($tipos_transaccion as $tipo_transaccion) {
                    echo "['" . $tipo_transaccion['descripcion'] . "', " . $tipo_transaccion['cantidad'] . "],";
                }
            } else {
                echo "['Sin datos', 0]";
            }
            ?>
        ]);

        var options = {
            title: 'Distribución de Tipos de Transacción',
            width: 800,
            chartArea: {width: '50%'},
            pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
    }
</script>

<div id="pie_chart" style="width: 800px; height: 500px;"></div>
<?php } ?>

    <?php
    // Obtener datos para el gráfico de pastel si la opción seleccionada es reporte diario
    if (isset($opcion) && ($opcion === 'reporte_diario' || $opcion === 'reporte_semanal' || $opcion === 'reporte_mensual')) {
        // Consulta SQL para obtener la distribución de tipos de transacción
        $sql_tipos_transaccion = "SELECT tipotransaccion.descripcion, COUNT(*) AS cantidad
                                    FROM transaccion
                                    INNER JOIN tipotransaccion ON transaccion.idtipotransaccion = tipotransaccion.idtipotransaccion
                                    WHERE ";
        if ($opcion === 'reporte_diario') {
            $sql_tipos_transaccion .= "DATE(transaccion.fecha) = CURDATE()";
        } elseif ($opcion === 'reporte_semanal') {
            $sql_tipos_transaccion .= "WEEK(transaccion.fecha, 1) = :semana AND YEAR(transaccion.fecha) = :anio";
        } elseif ($opcion === 'reporte_mensual') {
            $sql_tipos_transaccion .= "MONTH(transaccion.fecha) = :mes AND YEAR(transaccion.fecha) = :anio";
        }
        $sql_tipos_transaccion .= " GROUP BY tipotransaccion.descripcion";
        $statement_tipos_transaccion = $con->getConnection()->prepare($sql_tipos_transaccion);
        if ($opcion === 'reporte_semanal') {
            $statement_tipos_transaccion->bindParam(':semana', $semana_actual, PDO::PARAM_INT);
            $statement_tipos_transaccion->bindParam(':anio', $anio_actual, PDO::PARAM_INT);
        } elseif ($opcion === 'reporte_mensual') {
            $statement_tipos_transaccion->bindParam(':mes', $mes, PDO::PARAM_INT);
            $statement_tipos_transaccion->bindParam(':anio', $anio, PDO::PARAM_INT);
        }
        $statement_tipos_transaccion->execute();
        $tipos_transaccion = $statement_tipos_transaccion->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawPieChart);

        function drawPieChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo de Transacción', 'Cantidad'],
                <?php
                // Generar los datos para el gráfico
                foreach ($tipos_transaccion as $tipo_transaccion) {
                    echo "['" . $tipo_transaccion['descripcion'] . "', " . $tipo_transaccion['cantidad'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Distribución de Tipos de Transacción'
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

            chart.draw(data, options);
        }
    </script>

    <div id="pie_chart" style="width: 800px; height: 500px;"></div>
    <?php } ?>

    <script>
        // Función para mostrar y ocultar campos según el tipo de búsqueda seleccionada
        function mostrarOcultarCampos() {
            var tipoBusqueda = document.getElementById("tipo_busqueda").value;
            var divFecha = document.getElementById("div_fecha");
            var divUsuario = document.getElementById("div_usuario");
            var divTipoTransaccion = document.getElementById("div_tipo_transaccion");
            var divMes = document.getElementById("div_mes");

              // Mostrar u ocultar campos según la opción seleccionada
              switch (tipoBusqueda) {
                case "fecha":
                    divFecha.style.display = "block";
                    divUsuario.style.display = "none";
                    divTipoTransaccion.style.display = "none";
                    divMes.style.display = "none";
                    break;
                case "usuario":
                    divFecha.style.display = "none";
                    divUsuario.style.display = "block";
                    divTipoTransaccion.style.display = "none";
                    divMes.style.display = "none";
                    break;
                case "tipo_transaccion":
                    divFecha.style.display = "none";
                    divUsuario.style.display = "none";
                    divTipoTransaccion.style.display = "block";
                    divMes.style.display = "none";
                    break;
                case "reporte_diario":
                    divFecha.style.display = "none";
                    divUsuario.style.display = "none";
                    divTipoTransaccion.style.display = "none";
                    divMes.style.display = "none";
                    break;
                case "reporte_semanal":
                    divFecha.style.display = "none";
                    divUsuario.style.display = "none";
                    divTipoTransaccion.style.display = "none";
                    divMes.style.display = "none";
                    break;
                case "reporte_mensual":
                    divFecha.style.display = "none";
                    divUsuario.style.display = "none";
                    divTipoTransaccion.style.display = "none";
                    divMes.style.display = "block";
                    break;
                default:
                    divFecha.style.display = "none";
                    divUsuario.style.display = "none";
                    divTipoTransaccion.style.display = "none";
                    divMes.style.display = "none";
                    break;
            }
        }
    </script>
    </div>
    
</body>
<style>
    .container-reportes{
        width: 80%;
        margin: 0 auto;
    }
</style>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/excellentexport@3.4.3/dist/excellentexport.min.js"></script>
    <script>
        
        let download_xls = document.querySelector("#download_xls")
        download_xls.addEventListener("click", ()=>{                     
            ExcellentExport.excel(download_xls, 'dataTable')
        })

        let download_csv = document.querySelector("#download_csv")
        download_csv.addEventListener("click", ()=>{                     
            ExcellentExport.csv(download_csv, 'dataTable');
        })

        let download_xlsx = document.querySelector("#download_xlsx")
        download_xlsx.addEventListener("click", ()=>{                     
            ExcellentExport.convert({ anchor: download_xlsx, filename: 'Reporte', format: 'xlsx'},[{name: 'Sheet Name Here 1', from: {table: 'dataTable'}}])
        })

    </script>

<script>
    window.jsPDF = window.jspdf.jsPDF;
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof jsPDF !== 'undefined') {
            window.jsPDF = window.jspdf.jsPDF;
        } else {
            console.error('Error: jsPDF library not found.');
        }
    });
    function expPdf() {
  var doc = new jsPDF('landscape');

  // Obtener los encabezados de la tabla
  var tableHeaders = [];
  var headerWidths = [];
  var thead = document.querySelectorAll("#dataTable thead tr")[0];
  var headerCells = thead.querySelectorAll("th");
  headerCells.forEach(function (cell) {
    var headerText = cell.textContent.trim();
    tableHeaders.push(headerText);
    // Calcular el ancho de la columna basado en la longitud del texto del encabezado
    var cellWidth = doc.getStringUnitWidth(headerText) * 4; // Ajustar el factor según el tamaño de la fuente
    headerWidths.push(cellWidth);
  });

  // Agregar los encabezados de la tabla al PDF
  var rowData = [];
  var rows = document.querySelectorAll("#dataTable tbody tr");
  rows.forEach(function (row) {
    var cells = row.querySelectorAll("td");
    var cellData = [];
    cells.forEach(function (cell, index) {
      var cellText = cell.textContent.trim();
      cellData.push(cellText);
      // Actualizar el ancho de la columna si el texto actual es más ancho
      var cellWidth = doc.getStringUnitWidth(cellText) * 4; // Ajustar el factor según el tamaño de la fuente
      if (cellWidth > headerWidths[index]) {
        headerWidths[index] = cellWidth;
      }
    });
    rowData.push(cellData);
  });

  // Establecer los anchos de columna basados en la longitud del contenido más ancho en cada columna
  var columnStyles = {};
  headerWidths.forEach(function (width, index) {
    columnStyles[index] = { columnWidth: width };
  });

  // Agregar los encabezados y los datos de la tabla al PDF
  doc.autoTable({
    startY: 10, // Empieza en la posición vertical 10
    head: [tableHeaders],
    body: rowData,
    headStyles: { fontSize: 10 },
    bodyStyles: { fontSize: 8 },
    columnStyles: columnStyles,
  });

  doc.addPage();

// Obtener la imagen de la primera sección
html2canvas(document.querySelector("#bar_chart")).then(function (canvas1) {
  var img1 = canvas1.toDataURL("image/png");
  doc.addImage(img1, "JPEG", 20, 20);


  
doc.addPage();

  // Obtener la imagen de la segunda sección
  html2canvas(document.querySelector("#pie_chart")).then(function (canvas2) {
    var img2 = canvas2.toDataURL("image/png");
    doc.addImage(img2, "JPEG", 20, 20);

      // Guardar el PDF
      doc.save("test.pdf");
    });
  });
}

    </script>

</html>
