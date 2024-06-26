<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso Empleado</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <?php
    
        include "encabezado.php";
        
    ?>
    <br>
    <br>
    <br>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar </button>
                <?php 
                include "agregarEmpleados.php"; ?>
                <br>
                <br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Identidad</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Profesion</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                
                    if (isset($_SESSION['toastr_success'])) {
                        echo "<script>toastr.success('" . $_SESSION['toastr_success'] . "', 'Notificacion');</script>";
                        unset($_SESSION['toastr_success']);
                    }
                    $con = new conexion();
                    $sql = "SELECT identidad, nombre, direccion, telefono, idProfesion FROM empleado";
                    $resultado = $con->consulta($sql);

                    foreach ($resultado as $fila) {
                        $idProfesion = $fila['idProfesion'];
                        $sql2 = ("SELECT descripcion FROM profesion WHERE idProfesion = $idProfesion");
                        $regP = $con->consulta($sql2);
                        $descripcionProfesion = $regP[0]['descripcion'];;
                ?>
                <tr>
                    <td><?php echo $fila['identidad']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $descripcionProfesion; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['identidad']; ?>">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar<?php echo $fila['identidad']; ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                
                <?php include "EditarEmpleados.php"; ?>
                <?php include "eliminarEmpleados.php"; ?>
            <?php }?>
        </tbody>
                </table>

            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>
</html>

