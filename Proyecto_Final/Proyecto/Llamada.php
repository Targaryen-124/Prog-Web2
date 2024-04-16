<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo_tv.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
<body>

<div class="modal fade" id="llamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="ventanaModal" class="modal">
            <?php
            include("conexion.php");
            $codigo="";
            
            $con = new conexion();
            $sql = "SELECT  m.descripcion, tr.codigo
                    FROM tickect t
                    JOIN mesas m ON t.idmesa = m.idmesa
                    JOIN transaccion tr ON t.idtransaccion = tr.idtransaccion
                    WHERE  estado='Mostrando' AND DATE(tr.fecha) = CURDATE() LIMIT 1";
            $resultado = $con->consulta($sql);

            foreach ($resultado as $dato) {
                ?>
                <div class="contenido-modal">
                    <div class="sup">
                        <h1>TURNO</h1>
                        <h2 id="modal-id"><?php echo $dato['codigo']; ?></h2>
                    </div>
                    <div class="inf">
                        <h1>ESCRITORIO </h1>
                        <h2><?php echo $dato['descripcion']; ?></h2>
                    </div>
                </div>
            <?php
                $codigo=$dato['codigo'];
                $sql2 = "UPDATE transaccion SET estado = 'Llamado' WHERE codigo = '$codigo'";
                $resultadoEmp = $con->actualizar($sql2);
                $codigo="";

            ?>
            <?php 
            } 
            ?>
            <script>
                $(document).ready(function(){
                    setTimeout(function() {
                        $('#llamar').modal('hide');
                    }, 6000);
                });
            </script>
        </div>
    </div>
</div>
</script>
</body>
</html>
