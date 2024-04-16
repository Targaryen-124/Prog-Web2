<?php
    require("conexion.php");
    $con = new conexion();  
    $sql = "SELECT idpublicidad, direccion, formato FROM publicidad";
    $resultado = $con->consulta($sql);
    echo "Conectado";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/es.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/resp/bootstrap.min.js"></script>

    <title>Usuarios</title>
</head>
<br>
<div class="container is-fluid">


    <div class="col-xs-12">
        <h1>Bienvenido Administrador</h1>

        <h1>Lista de Archivos</h1>
        <br>

        <div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                <span class="glyphicon glyphicon-plus"></span> Nuevo usuario <i class="fa fa-plus"></i> </a></button>
        </div>


        <br>


        <table class="table table-striped table-dark table_id" id="table_id">


            <thead>
                <tr>
                    <th>Id</th>
                    <th>Formato</th>
                    <th>Imagen</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php

foreach ($resultado as $resul) {
    
?>
                <tr>
                    <td><?php echo $resul['idpublicidad']; ?></td>
                    <td><?php echo $resul['formato']; ?></td>
                    <td><img src="imgs/<?php echo $resul['direccion']; ?>" onerror=this.src="imgs/noimage.png" width="50"
                            heigth="70"></td>

                    <td>

                        <a class="btn btn-danger btn-del" href="/views/eliminar.php?id=<?php echo $resul['idpublicidad']?> ">
                            <i class="fa fa-trash"></i></a>
                    </td>
                </tr>


                <?php }?>

                </body>
        </table>

        <script>
        $('.btn-del').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'Estas seguro de eliminar?',
                text: "¡No podrás revertir esto!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Eliminado!',
                            'El archivo fue eliminado.',
                            'success'
                        )
                    }

                    document.location.href = href;
                }

            })
        })
        </script>
        <!-- <div id="paginador" class=""></div>-->
        <script src="package/dist/sweetalert2.all.js"></script>
        <script src="package/dist/sweetalert2.all.min.js"></script>
        <script src="package/jquery-3.6.0.min.js"></script>

        <script type="text/javascript" src="DataTables/js/datatables.min.js"></script>
        <script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>
        <script src="DataTables/js/dataTables.bootstrap4.min.js"></script>

        <script src="js/page.js"></script>
        <script src="js/buscador.js"></script>
        <script src="js/user.js"></script>


</html>