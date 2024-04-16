<?php
    require("conexion.php");
    $con = new conexion();  
    $sql = "SELECT idtipotransaccion, descripcion FROM tipotransaccion";
    $transacciones = $con->consulta($sql);
    $sql = "SELECT idtransaccion,codigo FROM transaccion WHERE date(fecha)=CURDATE()";
    $tkdia = $con->consulta($sql);
    $tdia= count($tkdia);
    if ($tdia > 0){
        $tAnt = $tkdia[$tdia-1]['codigo'];
        $corTxt = substr($tAnt,-3);
        $corNum = intval($corTxt);
        $nCor = $corNum + 1;
        if (strlen($nCor) == 1){
            $nt = "TK-00" . strval($nCor);
        }
        if (strlen($nCor) == 2){
            $nt = "TK-0" . strval($nCor);
        }
        if (strlen($nCor) == 3){
            $nt = "TK-" . strval($nCor);
        }

        //echo "Ticket hay ticket " .$nt;
    }else{
        $nt = "TK-001";
        //echo "Ticket no hay ticket";
    }

    session_start();
    $_SESSION['ticket'] = $nt;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket | UTH</title>
    <link rel="stylesheet" href="styleUF.css">
    <script src="logicaUF.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="imagenes/logoUTH.png" type="img/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <div class="logoUTH">
        <img src="imagenes/UTH2.png" alt="logouth" width="200px" height="150px">
    </div>
    <div class="wrapper">
        <form method="POST" action="crearTicket.php">
            <h3 id="rotulo">Transaccion a Realizar:</h3>
            <select class="form-select form-select-lg mb-3" name="transac" id="transac">
                <?php
                if (!empty($transacciones)) {
                    foreach ($transacciones as $transaccion) {
                        echo "<option value='" . $transaccion['idtipotransaccion'] . "'>" . $transaccion['descripcion'] . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" class="btn btn-warning btn-lg" id="generar" name="submit">Generar</button>
        </form>
    </div>
    <br>
    <script>
        toastr.options = {
            "positionClass": "toast-top-right",
        }
    </script>

    <style>
        .toast {
            top: 20px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>