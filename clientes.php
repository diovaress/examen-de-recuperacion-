<?php
require_once __DIR__ . "/conexion.php";


include("conexion.php");

if (isset($_POST["guardar"])) {

    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $dpi = mysqli_real_escape_string($conexion, $_POST["dpi"]);
    $telefono = mysqli_real_escape_string($conexion, $_POST["telefono"]);
    $direccion = mysqli_real_escape_string($conexion, $_POST["direccion"]);

    $consulta = "INSERT INTO cliente (nombre, dpi, telefono, direccion)
        VALUES ('$nombre', '$dpi', '$telefono', '$direccion')";
    mysqli_query($conexion, $consulta);

    }


if (isset($_GET["borrar"])) {
    $id = intval($_GET["borrar"]);
    mysqli_query($conexion, "DELETE FROM cliente WHERE id_cliente=$id");


}

$clientes = mysqli_query($conexion, "SELECT * FROM cliente");
?>


<!DOCTYPE html>
<html>
<head>


    <meta charset="utf-8">
    <title>Clientes</title>
    <link rel="stylesheet" href="style.css">


</head>
<body>

<?php include("cabecera.php"); ?>

<div class="contenedor">
    <div class="caja">
      
        <h2>Clientes</h2>

        <form method="post" class="formulario">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="dpi" placeholder="DPI">
            <input type="text" name="telefono" placeholder="Telefono">
            <input type="text" name="direccion" placeholder="Direccion">
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </div>

    <div class="caja">
        <table>


            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Accion</th>
            </tr>
            <?php while ($fila = mysqli_fetch_assoc($clientes)) { ?>


            <tr>
                    <td><?php echo $fila["id_cliente"]; ?></td>
                        <td><?php echo $fila["nombre"]; ?></td>
                        <td><?php echo $fila["dpi"]; ?></td>
                            <td><?php echo $fila["telefono"]; ?></td>
                                <td><?php echo $fila["direccion"]; ?></td>
                                <td><a href="clientes.php?borrar=<?php echo $fila["id_cliente"]; ?>" onclick="return confirm('Eliminar cliente?')">Eliminar</a></td>
          
          
              </tr>


            <?php } ?>


        </table>
    </div>
</div>



 <footer>
   
    <p> VAMOS INGE  <BR> HAGAME GANAR INGE PLISSSSS</p>
    
  
  
</footer>     



</body>
</html>
