
<?php

class Conexion {
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasenia = '';
    private $base_datos = 'db_ticket';
    private $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->base_datos}", $this->usuario, $this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function consulta($sql) {
        try {
            $statement = $this->conexion->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    }

    public function cambiarEstadoTicket($idTicket, $nuevoEstado) {
        try {
            $sql = "UPDATE transaccion SET estado = :nuevoEstado WHERE idtransaccion = :idTicket";
            $statement = $this->conexion->prepare($sql);
            $statement->bindParam(':idTicket', $idTicket, PDO::PARAM_INT);
            $statement->bindParam(':nuevoEstado', $nuevoEstado, PDO::PARAM_STR); // Cambiado a PDO::PARAM_STR
            $statement->execute();
        } catch(PDOException $e) {
            echo "Error al actualizar el estado del ticket: " . $e->getMessage();
        }
    }

    public function obtenerTicketsPendientes() {
        $sql = "SELECT * FROM transaccion WHERE estado = 'Pendiente'";
        return $this->consulta($sql);
    }
    public function asignarEmpleadoAMesa($idmesa, $idempleado) {
        try {
            $sql = "UPDATE mesas SET idempleado = :idempleado WHERE idmesa = :idmesa";
            $statement = $this->conexion->prepare($sql);
            $statement->bindParam(':idmesa', $idmesa, PDO::PARAM_INT);
            $statement->bindParam(':idempleado', $idempleado, PDO::PARAM_INT);
            $statement->execute();
        } catch(PDOException $e) {
            echo "Error al asignar empleado a mesa: " . $e->getMessage();
        }
    }
    public function desasignarEmpleadoDeMesa($idmesa) {
        try {
            $sql = "UPDATE mesas SET idempleado = NULL WHERE idmesa = :idmesa";
            $statement = $this->conexion->prepare($sql);
            $statement->bindParam(':idmesa', $idmesa, PDO::PARAM_INT);
            $statement->execute();
        } catch(PDOException $e) {
            echo "Error al desasignar empleado de mesa: " . $e->getMessage();
        }
    }
    public function escribirTicket($query){
        $statement = $this->conexion->prepare($query);
        $statement->execute();
        return $this->conexion->lastInsertId();
    }

    public function getConnection() {
        return $this->conexion;
    }


public function escribir($query){
    $this->conexion->exec($query);
    return $this->conexion->lastInsertId();
}

public function actualizar($query) {
    $resultado = $this->conexion->query($query);
    return $resultado ? true : false;
  }

  public function insertarProfesion($descripcion) {
    try {
        $sql = "INSERT INTO profesion (descripcion) VALUES (:descripcion)";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $statement->execute();
        echo "<script>alert('Se ha agregado la profesion correctamente');</script>";
    } catch(PDOException $e) {
        echo "Error al insertar la profesión: " . $e->getMessage();
    }
}
public function consultaEmpleado($sql) {
    try {
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
        // Puedes agregar código adicional aquí para manejar el error, como registrarlos en un archivo de registro.
    }
}

public function consultaUsuarios($sql) {
    try {
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error al ejecutar la consulta de usuarios: " . $e->getMessage();
        // Puedes agregar código adicional aquí para manejar el error, como registrarlos en un archivo de registro.
    }
}

public function consultaMesas($sql) {
    try {
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error al ejecutar la consulta de usuarios: " . $e->getMessage();
        // Puedes agregar código adicional aquí para manejar el error, como registrarlos en un archivo de registro.
    }
}

public function conectar() {
    return $this->conexion;
}
public function prepare($sql) {
    return $this->conexion->prepare($sql);
}


}


?>
