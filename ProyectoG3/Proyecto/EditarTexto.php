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
<div class="modal fade" id="editar-texto<?php echo $fila['idtexto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar el Registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="actualizarTex.php" method="POST">

                    <div class="row">
                        <div class="col-sm-16"> 
                                <label for="descripcion" class="form-label">TEXTO DEL ANUNCIO: </label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $fila['descripcion']; ?>" required>   
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="estado" class="form-label">Estado: </label>
                        <select name="estado" id="estado" class="form-control" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

        
                
                    <input type="hidden" name="idtexto" value="<?php echo $fila['idtexto']; ?>">
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
