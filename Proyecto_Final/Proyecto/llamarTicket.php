<?php

include 'encabezado.php';
require_once 'conexion.php';


$conexion = new Conexion();
$pdo = $conexion->conectar();

global $idTransaccionPendiente;
$idTicketAtendido = "";
$validar = 0;

$idtrans = null;


function obtenerPrimerTicketPendiente() {
    global $conexion, $idTransaccionPendiente;
    try {
        $sql = "SELECT * FROM transaccion WHERE estado = 'Pendiente' ORDER BY idtransaccion ASC LIMIT 1";
        $result = $conexion->consulta($sql);
        if ($result && count($result) > 0) {
            $_SESSION['idtrans'] = $result[0]['idtransaccion'];
            $idtrans = $_SESSION['idtrans'];

            return $result[0]; 
        } else {
            return null; 
        }
    } catch(PDOException $e) {
        echo "Error al obtener el primer ticket pendiente: " . $e->getMessage();
    }
}





function iniciar() {
    global $conexion;
    $idtrans = $_SESSION['idtrans'];
    try {
        $sql = "SELECT * FROM transaccion WHERE estado = 'Llamado' AND idtransaccion = '".$idtrans ."' ";
        $result = $conexion->consulta($sql);
        if ($result && count($result) > 0) {
            return $result[0]; 
        } else {
            return null; 
        }
    } catch(PDOException $e) {
        echo "Error al obtener el primer ticket pendiente: " . $e->getMessage();
    }
}


function finalizar() {
    global $conexion;
    $idtrans = $_SESSION['idtrans'];
    try {
        $sql = "SELECT * FROM transaccion WHERE estado = 'Atendiendo' AND idtransaccion = '".$idtrans ."' ";
        $result = $conexion->consulta($sql);
        if ($result && count($result) > 0) {
            return $result[0]; 
        } else {
            return null; 
        }
    } catch(PDOException $e) {
        echo "Error al obtener el primer ticket pendiente: " . $e->getMessage();
    }
}

function finalizarNS() {
    global $conexion;
    $idtrans = $_SESSION['idtrans'];
    try {
        $sql = "SELECT * FROM transaccion WHERE   estado = 'Llamado' AND idtransaccion = '".$idtrans ."' ";
        $result = $conexion->consulta($sql);
        if ($result && count($result) > 0) {
            return $result[0]; 
        } else {
            return "No se p"; 
        }
    } catch(PDOException $e) {
        echo "Error al obtener el primer ticket pendiente: " . $e->getMessage();
    }
}


if (isset($_POST['llamar_proximo'])) {

    $primerTicket = obtenerPrimerTicketPendiente();
    if ($primerTicket) {

        $conexion->cambiarEstadoTicket($primerTicket['idtransaccion'], 'Mostrando');

        $putaa = $primerTicket['estado'];
        $idTicketAtendido = $primerTicket['codigo'];
        $idUsuario = $_SESSION['idus'];
        $idMesa = obtenerIdMesaPorUsuario($idUsuario, $conexion->conectar());
        
        if ($idMesa) {
            $idTransaccion = $primerTicket['idtransaccion'];
            insertarTicket($idMesa, $idTransaccion, $idUsuario);
        }
        $validar =1;
    }
   
}



if (isset($_POST['iniciar_atencion'])) {

    $ticketin = iniciar();
    
    if ($ticketin !== null) {
        $conexion->cambiarEstadoTicket($ticketin['idtransaccion'], 'Atendiendo');
        $idTicketAtendido = $ticketin['codigo'];

        if ($idTicketAtendido !== "") {
            $_POST['iniciar_atencion'] = null;
        }
        $validar = 2;
    } else {
        
        echo "No se encontró ningún ticket para iniciar la atención.";
        
    }
}

if (isset($_POST['finalizar_atencion'])) {
    
    $ticketfin = finalizar();
    
    $conexion->cambiarEstadoTicket($ticketfin['idtransaccion'], 'Finalizado');
    
        $idTicketAtendido = "";
        $validar =3;
    
}

if (isset($_POST['no_se_presento'])) {
    
    $ticketfin = finalizarNS();
    
    $conexion->cambiarEstadoTicket($ticketfin['idtransaccion'], 'Finalizado');
    
        $idTicketAtendido = "";
        $validar =3;
    
}

function obtenerIdMesaPorUsuario($idUsuario, $conexion) {
    try {
        $sql = "SELECT mesas.idmesa FROM mesas 
                INNER JOIN empleado ON mesas.idempleado = empleado.idempleado
                INNER JOIN usuarios ON empleado.idempleado = usuarios.idempleado
                WHERE usuarios.idusuario = :idUsuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            echo "No se encontró ninguna mesa asociada a este usuario.";
            return null;
        }
        
        return $result['idmesa'];
    } catch(PDOException $e) {
        echo "Error al obtener el ID de la mesa: " . $e->getMessage();
        return null;
    }
}

function obtenerNombreMesaPorUsuario($idUsuario, $conexion) {
    try {
        $sql = "SELECT mesas.descripcion FROM mesas 
                INNER JOIN empleado ON mesas.idempleado = empleado.idempleado
                INNER JOIN usuarios ON empleado.idempleado = usuarios.idempleado
                WHERE usuarios.idusuario = :idUsuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            echo "No se encontró ninguna mesa asociada a este usuario.";
            return null;
        }
        
        return $result['descripcion'];
    } catch(PDOException $e) {
        echo "Error al obtener el ID de la mesa: " . $e->getMessage();
        return null;
    }
}

function insertarTicket($idMesa, $idTransaccion, $idUsuario) {
    global $conexion;
    try {
        $sql = "INSERT INTO tickect (idmesa, idtransaccion, idusuario) VALUES (:idMesa, :idTransaccion, :idUsuario)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idMesa', $idMesa, PDO::PARAM_INT);
        $stmt->bindParam(':idTransaccion', $idTransaccion, PDO::PARAM_INT);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Error al insertar el ticket: " . $e->getMessage();
    }
}


$tickets_pendientes = $conexion->obtenerTicketsPendientes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    
<div class="container">
  <h1><i class="fa-solid fa-comment-dots"></i>Atención</h1>
  <p>Realizar la llamada por ticket de cliente para cada servicio</p>
  <div class="ventanilla">
    <div class="numero">
    
    <h2>Mesa</h2>
    <div class="num-ventanilla"><?php  $idUsuario = $_SESSION['idus'];  $idMesa = obtenerNombreMesaPorUsuario($idUsuario, $conexion->conectar());echo $idMesa ?></div>
    
    </div>
    <div class="atencion">
        <h2>Atencion</h2>
        ticket: <span><?php echo $idTicketAtendido; ?></span>
    </div>
        
       
  </div>
  <div class="botones">

  <form method="POST">
        <button type="submit" name="llamar_proximo" <?php if($idTicketAtendido !== "") echo "disabled"; ?>><i class="fa-solid fa-bullhorn" class="icon-button"></i><br>Llamar Próximo</button>
    </form>
    <form method="POST">
        <button type="submit" name="iniciar_atencion" <?php if($idTicketAtendido === "" || $validar==2) echo "disabled"; ?>><i class="fa-regular fa-circle-play"></i><br>Iniciar Atención</button>
    </form>
    <form method="POST">
        <button type="submit" name="finalizar_atencion" <?php if($idTicketAtendido === "" || isset($_POST['llamar_proximo'])) echo "disabled"; ?>><i class="fa-solid fa-rectangle-xmark"></i><br>Finalizar Atención</button>
    </form>
    <form method="POST">
        <button type="submit" name="no_se_presento" <?php if($idTicketAtendido === "" || $validar==2) echo "disabled"; ?>><i class="fa-solid fa-user-xmark"></i><br>No se presento</button>
    </form>
  </div>
  
  <div class="tabla-pendientes">
        <h1>Tickets Pendientes</h1>
        <table>
            <thead>
                
            </thead>
            <tbody>
                <?php foreach ($tickets_pendientes as $ticket): ?>
                    <tr>
                        
                        <td><?php echo "<i class='fa-solid fa-user'></i>       ". $ticket['codigo']; ?></td>
                                                
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
  
</div>

</body>

</html>



<style>
    td{
        color: #13646f;
    }
    td i{
        color: #555;
    }
    button i{
        
        font-size: 2em;
    }
    button{
        width: 200px;
        height: 60px;
        border: none;
        font-size: 1em;
    }
    .botones{
        display: flex;
        justify-content: space-around;
        width: 65%;
        margin: 80px auto;
    }
    h2{
        
        margin: 0;
    }
    .num-ventanilla{
        
        font-size: 2em;
        font-weight: bold;
    }
    
    .atencion{
        margin-left: 40px;
        width: 400px;
        display: inline-block;
    }
    span{
        font-weight: bold;
        font-size: 2em;
    }
.container {
    width: 80%;
  margin: 0 auto;
  
}

.numero{
    display: inline-block;
   text-align: center;
   background: #45a049;
   width: 180px;
}

.ventanilla {
    margin-top: 20px;
    display: flex;
    
  
 
  margin-bottom: 20px;
}




button:hover {
  background-color: #45a049;
}
</style>
