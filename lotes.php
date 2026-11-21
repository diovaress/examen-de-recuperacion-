<?php
require_once __DIR__ . "/conexion.php";


include("conexion.php");

if (isset($_POST["guardar"])) {
    $codigo = mysqli_real_escape_string($conexion, $_POST["codigo"]);
    $proyecto = intval($_POST["proyecto"]);
    $area = mysqli_real_escape_string($conexion, $_POST["area"]);
    $precio = mysqli_real_escape_string($conexion, $_POST["precio"]);
    $estado = mysqli_real_escape_string($conexion, $_POST["estado"]);

    $consultaLote = "INSERT INTO lote (codigo, id_proyecto, area, precio, estado)

        VALUES ('$codigo', '$proyecto', '$area', '$precio', '$estado')";
    mysqli_query($conexion, $consultaLote);
}

if (isset($_GET["borrar"])) {
    $id = intval($_GET["borrar"]);
    mysqli_query($conexion, "DELETE FROM lote WHERE id_lote=$id");
}

$proyectos = mysqli_query($conexion, "SELECT * FROM proyecto");
$lotes = mysqli_query($conexion, "SELECT lote.*, proyecto.nombre AS proyecto
                                  FROM lote
                                  LEFT JOIN proyecto ON lote.id_proyecto=proyecto.id_proyecto");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lotes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("cabecera.php"); ?>
<div class="contenedor">
    <div class="caja">
        <h2>Lotes</h2>
        <form method="post" class="formulario">
            <input type="text" name="codigo" placeholder="Codigo" required>
            <select name="proyecto">
                <?php while ($fila = mysqli_fetch_assoc($proyectos)) { ?>
                <option value="<?php echo $fila["id_proyecto"]; ?>"><?php echo $fila["nombre"]; ?></option>
                <?php } ?>
            </select>
            <input type="text" name="area" placeholder="Area">
            <input type="text" name="precio" id="precio" placeholder="Precio" onkeyup="calcularCuota()">
            <select name="estado">
                <option value="Disponible">Disponible</option>
                <option value="Vendido">Vendido</option>
                <option value="Reservado">Reservado</option>
            </select>
            <input type="text" name="meses" id="meses" placeholder="Meses" onkeyup="calcularCuota()">
            <input type="text" name="mensual" id="mensual" placeholder="Cuota mensual" readonly>
            <p id="resultado"></p>
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </div>
    <div class="caja">
        <table>
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Proyecto</th>
                <th>Area</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
            <?php while ($fila = mysqli_fetch_assoc($lotes)) { ?>
            <tr>
                <td><?php echo $fila["id_lote"]; ?></td>
                <td><?php echo $fila["codigo"]; ?></td>
                <td><?php echo $fila["proyecto"]; ?></td>
                <td><?php echo $fila["area"]; ?></td>
                <td><?php echo $fila["precio"]; ?></td>
                <td><?php echo $fila["estado"]; ?></td>
                <td><a href="lotes.php?borrar=<?php echo $fila["id_lote"]; ?>" onclick="return confirm('Eliminar lote?')">Eliminar</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script src="script.js"></script>
           <br>
   <p1> INGE HAGAME GANAR PORFA SIIII </p1> <BR>
          <P2> sea misecordioso conmigo :(   </P2>


</body>
</html>
