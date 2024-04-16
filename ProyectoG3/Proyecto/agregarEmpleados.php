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
                <h3 class="modal-title" id="exampleModalLabel">Registrar Nuevo Empleados</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="agregarEmp.php" method="POST">

                    <div class="row">
                        <div class="col-sm-16"> 
                                <label for="nombre" class="form-label">Identidad: </label>
                                <input type="text" id="identidad" name="identidad" class="form-control" required>   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-16"> 
                                <label for="nombre" class="form-label">Nombre: </label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>   
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="direccion" class="form-label">Direccion: </label>
                        <input type="text" name="direccion" id="direccion" class="form-control" >
                    </div>

                
                    <div class="col-12">
                        <label for="telefono" class="form-label">Telefono: </label>
                        <input type="text" name="telefono" id="telefono" class="form-control" >
                    </div>

                    <div class="col-12">
                        <label for="profesion" class="form-label">Profesion: </label>
                        <select name="profesion" id="profesion" class="form-control" required>
                        <?php
                            $con = new conexion();
                            $sql = "SELECT idProfesion, descripcion FROM profesion";
                            $resultado = $con->consulta($sql);
                            foreach ($resultado as $filaProfesion) {
                                echo '<option value="' . $filaProfesion['idProfesion'] . '">' . $filaProfesion['descripcion'] . '</option>';
                            }
                        ?>
                        
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
