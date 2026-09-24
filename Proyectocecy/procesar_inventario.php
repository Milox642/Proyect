<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Reutilizamos tu conexión original para heredar la contraseña correcta de MySQL
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos y sanitizamos los campos usando la misma técnica que en citas
    $nombre_producto = mysqli_real_escape_string($conexion, $_POST['nombre_producto']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
    $cantidad = intval($_POST['cantidad']); // Convertimos a entero por seguridad
    $precio = floatval($_POST['precio']);   // Convertimos a número con decimales

    // Sentencia SQL apuntando a la nueva tabla de inventario
    $insertar = "INSERT INTO inventario (nombre_producto, categoria, cantidad, precio) 
                 VALUES ('$nombre_producto', '$categoria', $cantidad, $precio)";

    if ($conexion->query($insertar) === TRUE) {
        // Alerta de éxito y te mantiene logueado sin romper la pantalla en blanco
        echo "<script>
            localStorage.setItem('tecnoHighLoggedIn', '1');
            alert('¡Producto registrado con éxito en el inventario!');
            window.location.href = 'index.html';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error al registrar producto: " . mysqli_real_escape_string($conexion, $conexion->error) . "');
            window.history.back();
        </script>";
    }
}

$conexion->close();
?>