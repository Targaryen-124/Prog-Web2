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
<div class="modal fade" id="editar<?php echo $fila['identidad']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar el registro de <?php echo $fila['nombre']; ?></h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="actualizarEmp.php" method="POST">

                    <div class="row">
                        <div class="col-sm-16"> 
                                <label for="nombre" class="form-label">Nombre: </label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" required>   
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="direccion" class="form-label">Direccion: </label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $fila['direccion']; ?>" >
                    </div>

                
                    <div class="col-12">
                        <label for="telefono" class="form-label">Telefono: </label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $fila['telefono']; ?>" >
                    </div>

                    <div class="col-12">
                        <label for="profesion" class="form-label">Profesion: </label>
                        <select name="profesion" id="profesion" class="form-control" required>

                        <?php
                            require_once("conexion.php");
                            $con = new conexion();
                            $sql = "SELECT idProfesion, descripcion FROM profesion";
                            $resultado = $con->consulta($sql);
                            foreach ($resultado as $filaProfesion) {
                                echo '<option value="' . $filaProfesion['idProfesion'] . '"' . ($filaProfesion['idProfesion'] == $fila['idProfesion'] ? ' selected' : '') . '>' . $filaProfesion['descripcion'] . '</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <input type="hidden" name="identidad" value="<?php echo $fila['identidad']; ?>">
                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="actualizar">Actulizar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
