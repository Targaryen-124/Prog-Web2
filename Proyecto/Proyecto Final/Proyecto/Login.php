<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket | UTH</title>
    <link rel="stylesheet" href="estilos.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="logoUTH.png" type="img/png">
</head>

<body>
    <div class="logoUTH">
        <img src="https://uth.hn/canvas/img/UTH2.png" alt="logouth" width="200px" height="150px">
    </div>
    <div class="wrapper">
        <form action="">
            <h2>Inicio de sesión</h2>
            <div class="input-box">
                <input type="text" id="usuario" placeholder="Usuario">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" id="contraseña" placeholder="Contraseña">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" id="recordarme">Recordarme</label>
            </div>

            <a href="Principal.php" class="btn">Acceder</a>

        </form>
    </div>
</body>

</html>