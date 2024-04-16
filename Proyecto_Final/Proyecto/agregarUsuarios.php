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
    <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Registrar Nuevo Usuario</h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <form action="agregarUsu.php" method="POST" onsubmit="return validarFormulario()">
                        <div class="col-12">
                            <label for="empleado" class="form-label">Empleado: </label>
                            <select name="empleado" id="empleado" class="form-control" required>
                                <?php
                                require_once("conexion.php");
                                $con = new conexion();
                                $sql = "SELECT idempleado, nombre FROM empleado";
                                $resultado = $con->consultaUsuarios($sql);
                                foreach ($resultado as $filaEmpleado) {
                                    echo '<option value="' . $filaEmpleado['idempleado'] . '">' . $filaEmpleado['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="usuario" class="form-label">Usuario: </label>
                                <input type="text" id="usuario" name="usuario" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="contrasenia" class="form-label">Contraseña: </label>
                                <input type="password" id="contrasenia" name="contrasenia" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="rol" class="form-label">Rol: </label>
                            <select name="rol" id="rol" class="form-control" required>
                                <?php
                                $sql = "SELECT idrol, descripcion FROM roles";
                                $resultado = $con->consultaUsuarios($sql);
                                foreach ($resultado as $filaRol) {
                                    echo '<option value="' . $filaRol['idrol'] . '">' . $filaRol['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validarFormulario() {
            var empleadoSeleccionado = document.getElementById("empleado").value;
            if (empleadoSeleccionado === "") {
                toastr.error('Debes seleccionar un empleado.', 'Error');
                return false;
            }
            return true;
        }
    </script>

    <?php

    if (isset($_SESSION['toastr_error'])) {
        echo "<script>toastr.error('" . $_SESSION['toastr_error'] . "', 'Error');</script>";
        unset($_SESSION['toastr_error']);
    }
    ?>

</body>

</html>

