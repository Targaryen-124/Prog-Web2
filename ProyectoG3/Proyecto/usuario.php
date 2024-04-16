<?php 
include'encabezado.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        
        <br>
        <br>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar </button>
        <?php include "agregarUsuarios.php"; ?>
        <br>
        <br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['toastr_success'])) {
                    echo "<script>toastr.success('" . $_SESSION['toastr_success'] . "', 'Notificacion');</script>";
                    unset($_SESSION['toastr_success']);
                }
                $con = new conexion();
                $sql = "SELECT idempleado, usuario, contrasenia, idrol FROM usuarios";
                $resultado = $con->consultaUsuarios($sql);

                foreach ($resultado as $fila) {
                    $idEmpleado = $fila['idempleado'];
                    $sql2 = "SELECT nombre FROM empleado WHERE idempleado = $idEmpleado";
                    $regP = $con->consultaUsuarios($sql2);
                    $nombreEmpleado = $regP[0]['nombre'];

                    $idRol = $fila['idrol'];
                    $sql3 = "SELECT descripcion FROM roles WHERE idrol = $idRol";
                    $regR = $con->consultaUsuarios($sql3);
                    $descripcionRol = $regR[0]['descripcion'];
                ?>
                    <tr>
                        <td><?php echo $nombreEmpleado; ?></td>
                        <td><?php echo $fila['usuario']; ?></td>
                        <td><?php echo $fila['contrasenia']; ?></td>
                        <td><?php echo $descripcionRol; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['idempleado']; ?>">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar<?php echo $fila['idempleado']; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <?php include "EditarUsuarios.php"; ?>
                    <?php include "eliminarUsuarios.php"; ?>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
