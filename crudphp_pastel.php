<?php

$servername = "127.0.0.1";
$username = "root";
$password = "bigtimerush12345!!@@#";
$dbname = "Pasteleria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//crud
//insertar

if(isset($_POST['submit'])){
    $nombre_pastel = $_POST['nombre'];
    $precio_pastel = $_POST['precio'];
    
    $sql = "INSERT INTO pasteles (nombre, precio) VALUES ('$nombre', '$precio')";
    
    if ($conn->query($sql) === TRUE) {
        echo "El pastel agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
//leer

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM tabla";
    $resultado = $conn->query($sql);
    $rows = array();
    if ($resultado->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    echo json_encode($rows);
}


//mostar pasteles


$sql = "SELECT * FROM pasteles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Precio: $" . $row["precio"]. "<br>";
    }
}

//borrar inf.


if(isset($_POST['delete'])){
    $id = $_POST['id'];
    
    $sql = "DELETE FROM pasteles WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Eleccion eliminado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}




if(isset($_POST['submit'])){
    $pastel_id = $_POST['pastel_id'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    
    // Verificar que la cantidad sea un número válido
    if (!is_numeric($cantidad)) {
        echo "La cantidad debe ser valida.";
        exit();
    }
    
    // Insertar el ingrediente en la base de datos
    $sql = "INSERT INTO ingredientes (pastel_id, nombre, cantidad) VALUES ('$pastel_id', '$nombre', '$cantidad')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Ingrediente agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

