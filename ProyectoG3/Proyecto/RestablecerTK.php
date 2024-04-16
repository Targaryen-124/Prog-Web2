<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body>
<div class="modal fade" id="consultar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Consultar Tickets Atendidos</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                            </tr>   
                        </thead>
                        <tbody>
                        <?php
                        
                            if (isset($_SESSION['toastr_success'])) {
                                echo "<script>toastr.success('" . $_SESSION['toastr_success'] . "', 'Notificacion');</script>";
                                unset($_SESSION['toastr_success']);
                            }
                            $con = new conexion();
                            $sql = "SELECT codigo FROM transaccion WHERE estado= 'Finalizado' AND DATE(fecha) = CURDATE()";
                            $resultado = $con->consulta($sql);

                            foreach ($resultado as $fila) {
                        ?>
                        <tr>
                            <td><?php echo $fila['codigo']; ?></td>
                            <td>
                            <form action="restaurarTicket.php" method="POST">
                                <input type="hidden" name="codigo" value="<?php echo $fila['codigo']; ?>">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa-solid fa-rotate-left"></i> Restaurar
                                </button>
                            </form>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
