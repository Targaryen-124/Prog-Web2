<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>

</head>
<body>
<div class="modal fade" id="eliminar<?php echo $fila['idempleado']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Confirmacion de Eliminar</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="eliminiarUsu.php" method="POST">

                    <div class="row">
                        <div class="col-sm-16"> 
                                <label for="nombre" class="form-label">¿Estas seguro que deseas eliminar este registro?</label>
                        </div>
                    </div>

                    <input type="hidden" name="idempleado" value="<?php echo $fila['idempleado']; ?>">
                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Si. Eliminar</button>
                        <button type="button" class="btn btn-primaryr" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
