<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $password_ingresada = $_POST['contrasena'];

    // Buscamos en tu tabla 'clientes'
    $buscar = "SELECT * FROM clientes WHERE usuario = '$usuario' OR email = '$usuario'";
    $resultado = $conexion->query($buscar);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        
        // Verificamos la contraseña encriptada de la base de datos
        if (password_verify($password_ingresada, $fila['password'])) {
            
            // CORRECCIÓN CLAVE: Activamos el permiso que tus HTML originales piden en el localStorage
            echo "<script>
                localStorage.setItem('tecnoHighLoggedIn', '1');
                localStorage.setItem('tecnoHighAccount', JSON.stringify({ username: '" . $fila['usuario'] . "', email: '" . $fila['email'] . "' }));
                alert('¡Bienvenido a Tecno High!');
                window.location.href = 'index.html';
            </script>";
            exit();
            
        } else {
            echo "<script>alert('La contraseña es incorrecta. Inténtalo de nuevo.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('El usuario o correo no está registrado.'); window.history.back();</script>";
    }
}
$conexion->close();
?>