
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Publicidad</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<style>
    .imagen {
        max-width: 100px; 
        max-height: 100px;
    }
</style>
<div class="container">
<?php
include "encabezado.php";
?>
    <br>
        <div class="text-center">
                <h1>Registros de Publicidad</h1>
                <br>
                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#agregar"> Agregar </button> 
                <button type="button" class="btn btn-primary mb-3" id="btnUpdateImagenes">Presentar Imágenes</button>
                <button type="button" class="btn btn-secondary mb-3" id="btnUpdateVideos">Presentar Videos</button>
                <br>

                <script>
                    $(document).ready(function() {
                        $("#btnUpdateImagenes").click(function() {
                            $.ajax({
                                url: "actualizarMostrar.php",
                                method: "POST",
                                data: { formato: "Imagen" },
                                success: function(response) {
                                    location.reload();
                                }
                            });
                        });

                        $("#btnUpdateVideos").click(function() {
                            $.ajax({
                                url: "actualizarMostrar.php",
                                method: "POST",
                                data: { formato: "Video" },
                                success: function(response) {
                                    location.reload();
                                }
                            });
                        });
                    });
                </script>
                <h2>Registros de Imagenes</h2>
        
            <table class="table table-bordered ms-3" id="dataTable" width="100%" cellspacing="0">  
                <?php include "agregarImg.php";?>
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($_SESSION['toastr_success'])) {
                        echo "<script>toastr.success('" . $_SESSION['toastr_success'] . "', 'Notificacion');</script>";
                        unset($_SESSION['toastr_success']);
                    }
                    require_once'conexion.php';
                    $con = new conexion();
                    $sql = "SELECT * FROM publicidad WHERE formato='Imagen'";
                    $resultado = $con->consulta($sql);

                    foreach ($resultado as $fila) {
                    ?>
                        <tr>

                            <td><?php echo $fila['imagen']; ?></td>

                            <td><?php echo $fila['estado']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['idpublicidad']; ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar<?php echo $fila['idpublicidad']; ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#mostrar<?php echo $fila['idpublicidad']; ?>">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                
                            </td>
                        </tr>

                        <?php include "EditarImg.php"; ?>
                        <?php include "MostrarPublicidad.php"; ?>
                        <?php include "eliminarPubli.php"; ?>

                    <?php }?>
                </tbody>
            </table>
            <br>
            <h2>Registros de Video</h2>

            <table class="table table-bordered ms-3" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con = new conexion();
                    $sql = "SELECT * FROM publicidad WHERE formato='Video'";
                    $resultado = $con->consulta($sql);

                    foreach ($resultado as $fila) {
                    ?>
                        <tr>

                            <td><?php echo $fila['imagen']; ?></td>

                            <td><?php echo $fila['estado']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['idpublicidad']; ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar<?php echo $fila['idpublicidad']; ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#mostrar<?php echo $fila['idpublicidad']; ?>">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                
                            </td>
                        </tr>

                        <?php include "EditarImg.php"; ?>
                        <?php include "MostrarPublicidad.php"; ?>
                        <?php include "eliminarPubli.php"; ?>

                    <?php }?>
                </tbody>
            </table>
    </div>
</div>

<div class="text-center ">
    <?php include "texto.php"; ?>
</div>

    </body>
</html>