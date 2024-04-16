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
<div class="modal fade" id="mostrar<?php echo $fila['idpublicidad']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Mostrar Publicidad</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <h1> <?php $fila['idpublicidad'] ?></h1>
                <?php
                    $id=($fila['idpublicidad']);
                    $con = new conexion();
                    $sql = "SELECT * FROM publicidad WHERE idpublicidad='$id'";
                    $resultado = $con->consulta($sql);

                    foreach ($resultado as $data) {

                        if($data['formato']==="Video"){?>
                            <center>
                                <div class="form-group">
                                    <video id="videoPlayer" muted autoplay style="width: 100%; height: 100%; object-fit: cover; border-radius: 45px;">
                                        <source src="<?php echo $data['imagen'] ?>" type="video/mp4">
                                    </video> 
                                </div>
                            </center>
                        <?php
                        }else{?>
                            <center>
                                <div class="form-group">
                                    <img src="<?php echo $data['imagen']?>" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 45px;">
                                </div>
                            </center> 
                        <?php
                        } 
                    }
                ?>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                    
                </div>
 
            </div>
    </div>
</div>
</body>
</html>
