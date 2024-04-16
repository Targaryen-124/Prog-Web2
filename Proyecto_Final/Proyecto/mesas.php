<?php

include'encabezado.php';
require_once'conexion.php'; 

$conexion = new Conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idmesa_desasignar'])) {
        $idmesa_desasignar = $_POST['idmesa_desasignar'];
        
        $conexion->desasignarEmpleadoDeMesa($idmesa_desasignar);
    } else {
        $idmesa = $_POST['idmesa'];
        $idempleado = $_POST['idempleado'];
        
        $conexion->asignarEmpleadoAMesa($idmesa, $idempleado);
    }
}

$sql_mesas_sin_empleado = "SELECT * FROM mesas WHERE idempleado IS NULL";
$mesas_sin_empleado = $conexion->consulta($sql_mesas_sin_empleado);


$sql_mesas_con_empleado = "SELECT m.idmesa, m.descripcion, e.nombre AS nombre_empleado FROM mesas m INNER JOIN empleado e ON m.idempleado = e.idempleado";
$mesas_con_empleado = $conexion->consulta($sql_mesas_con_empleado);


$sql_empleados_disponibles = "SELECT * FROM empleado";
$empleados_disponibles = $conexion->consulta($sql_empleados_disponibles);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Mesas sin Empleado Asignado</title>
</head>
<body>
    <div class="container-tablas">
    <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#agregar"> <i class="fa fa-edit" > Agregar</i></button>
    <?php include "agregarMesas.php"?>
    <h4>Mesas sin Empleado Asignado</h4>
    <table class="table table-striped table-bordered grilla">
        <thead>
            <tr>
                <th>ID Mesa</th>
                <th>Mesa</th>
                <th>Asignar empleado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($mesas_sin_empleado as $mesa): ?>
                <tr>
                    <td><?php echo $mesa['idmesa']; ?></td>
                    <td><?php echo $mesa['descripcion']; ?></td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="idmesa" value="<?php echo $mesa['idmesa']; ?>">
                            <select  required id="empleadoselect" name="idempleado"  onchange="habilitarBoton(this)" >
                                <option value="">Seleccione un empleado</option>
                                <?php foreach ($empleados_disponibles as $empleado): ?>
                                    <option value="<?php echo $empleado['idempleado']; ?>"><?php echo $empleado['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button id="asignar" type="submit"><i class="fa-solid fa-circle-check"></i>Asignar</button>
                        </button>
                        </button>
                        </form>
                    </td>
                    <td>
                    <button type="button" class="btn btn-warning m-2" data-toggle="modal" data-target="#editar<?php echo $mesa['idmesa']; ?>">
                            <i class="fa fa-edit"></i>
                    <button type="button" class="btn btn-danger m-2" data-toggle="modal" data-target="#eliminar<?php echo $mesa['idmesa']; ?>">
                            <i class="fas fa-trash-alt"></i>
                    </td>
                </tr>
                <?php include "editarMesas.php"?>
                <?php include "eliminarMesas.php"?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h4 id="asignado">Mesas con Empleado Asignado</h4>
    <table class="table table-striped table-bordered table-hover grilla">
        <thead>
            <tr>
                <th>ID Mesa</th>
                <th>Mesa</th>
                <th>Empleado asignado</th>
                <th>Desasignar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mesas_con_empleado as $mesa): ?>
                <tr>
                    <td><?php echo $mesa['idmesa']; ?></td>
                    <td><?php echo $mesa['descripcion']; ?></td>
                    <td><?php echo $mesa['nombre_empleado']; ?></td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="idmesa_desasignar" value="<?php echo $mesa['idmesa']; ?>">
                            <input id="desasignar" type="submit" value="Desasignar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>

<style>
a:hover{
    text-decoration: none;
    color: #fff;
} 
#desasignar{
    width: 150px;
    background: #600;
    border: none;
    border-radius: 5px;
    color: #ddd;
}
#asignar{
    width:  100px;
    border: none;
    font-size: 20px;
}
#asignado{
    margin-top: 200px;
}
.container-tablas{
    width: 90%;
    margin: 50px auto;
    margin-left: 15%;
}
    .grilla td, #grilla th{
    border: 1px solid #ddd;
}

.grilla{
    
    max-width: 50%;
    
}

.grilla th{
    background: #45a049; 
    
}

.grilla tr:nth-child(even){
    background-color: #f2f2f2f2;
}

.grilla td{
    background-color: #ddd;
}

</style>