<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
</head>

<body>
    <div class="modal fade" id="editar<?php echo $fila['idempleado']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Editar el registro de <?php echo $fila['usuario']; ?></h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <form action="actualizarUsu.php" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="usuario" class="form-label">Usuario:</label>
                                <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo $fila['usuario']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="contrasenia" class="form-label">Contraseña:</label>
                                <input type="text" id="contrasenia" name="contrasenia" class="form-control" value="<?php echo $fila['contrasenia']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="rol" class="form-label">Rol:</label>
                                <select name="rol" id="rol" class="form-control" required>
                                    <?php
                                    require_once("conexion.php");
                                    $con = new conexion();
                                    $sql = "SELECT idrol, descripcion FROM roles";
                                    $resultado = $con->consultaUsuarios($sql);
                                    foreach ($resultado as $filaRol) {
                                        echo '<option value="' . $filaRol['idrol'] . '"' . ($filaRol['idrol'] == $fila['idrol'] ? ' selected' : '') . '>' . $filaRol['descripcion'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="idempleado" value="<?php echo $fila['idempleado']; ?>">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
