<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['contrasena'];
    $confirmPassword = $_POST['confirmar-contrasena'];

    if ($password !== $confirmPassword) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        exit;
    }

    $password_encriptada = password_hash($password, PASSWORD_BCRYPT);

    $buscar = "SELECT * FROM clientes WHERE usuario = '$usuario' OR email = '$email'";
    $resultado = $conexion->query($buscar);

    if ($resultado->num_rows > 0) {
        echo "<script>alert('El usuario o correo ya existen.'); window.history.back();</script>";
    } else {
        $insertar = "INSERT INTO clientes (usuario, email, password) VALUES ('$usuario', '$email', '$password_encriptada')";
        
        if ($conexion->query($insertar) === TRUE) {
            echo "<script>alert('¡Cuenta creada con éxito!'); window.location.href='sesion.html';</script>";
        } else {
            echo "<script>alert('Error: " . $conexion->error . "'); window.history.back();</script>";
        }
    }
}
$conexion->close();
?>