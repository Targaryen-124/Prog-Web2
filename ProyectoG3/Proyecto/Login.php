<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket | UTH</title>
    <link rel="stylesheet" href="estilos.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="logoUTH.png" type="img/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
</head>

<body>
    <div class="logoUTH">
        <img src="https://uth.hn/canvas/img/UTH2.png" alt="logouth" width="200px" height="150px">
    </div>
    <div class="wrapper">
        <form action="" method="post">
            <h2>Inicio de sesión</h2>
            <div class="input-box">
                <input type="text" id="usuario" name="usuario" placeholder="Usuario">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" id="contraseña" name="contrasenia" placeholder="Contraseña">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" id="recordarme">Recordarme</label>
            </div>
            
            <button type="submit" class="btn">Acceder</button>
            
            

        </form>
    </div>

    <script>
        toastr.options = {
            "positionClass": "toast-top-right",
        }
    </script>

    <style>
        .toast{
            top: 20px;
        }
    </style>

    <?php
    session_start(); 
    if($_POST){

   require("conexion.php");
    $con = new conexion();

    $usuario = $_POST['usuario'];
    $pass = $_POST['contrasenia'];
    

    $sql = "SELECT idrol, nombre, idusuario FROM usuarios us INNER JOIN empleado em ON us.idempleado = em.idempleado WHERE USUARIO = '".$usuario."' AND contrasenia = '".$pass ."'";
    $resultado = $con->consulta($sql);

    if(count($resultado) > 0)
    {
 
        $_SESSION['usuario'] = $usuario;
        $_SESSION['passw'] = $pass;
        $_SESSION['idus'] = $resultado[0]['idusuario'];
        $_SESSION['idrol'] = $resultado[0]['idrol'];
        $_SESSION['nombre'] = $resultado[0]['nombre'];

        header("location:Principal.php");
        exit(); 
    }
    else{
        echo "<script>toastr.error('Usuario/contraseña incorrectos', 'Aviso');</script>";
    }
}

?>


</body>

</html>