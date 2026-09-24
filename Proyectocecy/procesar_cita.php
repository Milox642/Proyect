<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Usamos tu conexión original porque esa ya tiene la contraseña correcta de tu MySQL
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $dispositivo = mysqli_real_escape_string($conexion, $_POST['dispositivo']);
    $servicio = mysqli_real_escape_string($conexion, $_POST['servicio']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $hora = mysqli_real_escape_string($conexion, $_POST['hora']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);

    // CORRECCIÓN FINAL: Cambiamos 'hora' por 'hora_cita' para que coincida exactamente con tu Workbench
    $insertar = "INSERT INTO citas (nombre_completo, email, telefono, dispositivo, servicio, fecha_cita, hora_cita, descripcion) 
                 VALUES ('$nombre', '$email', '$telefono', '$dispositivo', '$servicio', '$fecha', '$hora', '$descripcion')";

    if ($conexion->query($insertar) === TRUE) {
        echo "<script>
            localStorage.setItem('tecnoHighLoggedIn', '1');
            alert('¡Tu cita ha sido agendada con éxito en Tecno High!');
            window.location.href = 'index.html';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error en la consulta SQL: " . mysqli_real_escape_string($conexion, $conexion->error) . "');
            window.history.back();
        </script>";
    }
}

$conexion->close();
?>