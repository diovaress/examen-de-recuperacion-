<?php
$servidor = "127.0.0.1";
$puerto = "3306";
$baseDatos = "Lotificacion";
$usuario = "root";
$contrasena = "";
$charset = "utf8";

$conexion = mysqli_connect($servidor, $usuario, $contrasena, $baseDatos, $puerto);

if (!$conexion) {
    echo "Error al conectar con la base de datos";
    exit();
}

mysqli_set_charset($conexion, $charset);
?>
