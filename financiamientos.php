<?php
require_once __DIR__ . "/conexion.php";


include("conexion.php");

if (isset($_POST["guardar"])) {
    $lote = intval($_POST["lote"]);
    $cliente = intval($_POST["cliente"]);
    $meses = intval($_POST["meses"]);
    $cuota = mysqli_real_escape_string($conexion, $_POST["cuota"]);
    $fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);

    $datosLote = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT precio FROM lote WHERE id_lote=$lote"));
    $saldo = $datosLote["precio"];

    $nuevoFin = "INSERT INTO financiamiento (id_lote, id_cliente, meses, cuota_mensual, fecha_inicio, saldo)
        VALUES ('$lote', '$cliente', '$meses', '$cuota', '$fecha', '$saldo')";
    mysqli_query($conexion, $nuevoFin);
    mysqli_query($conexion, "UPDATE lote SET estado='Vendido' WHERE id_lote=$lote");
}

if (isset($_GET["borrar"])) {
    $id = intval($_GET["borrar"]);
    mysqli_query($conexion, "DELETE FROM financiamiento WHERE id_financiamiento=$id");
}

$lotes = mysqli_query($conexion, "SELECT * FROM lote WHERE estado='Disponible'");
$clientes = mysqli_query($conexion, "SELECT * FROM cliente");
$financiamientos = mysqli_query($conexion, "SELECT financiamiento.*,
                                            lote.codigo AS lote,
                                            cliente.nombre AS cliente
                                            FROM financiamiento
                                            INNER JOIN lote ON financiamiento.id_lote=lote.id_lote
                                            INNER JOIN cliente ON financiamiento.id_cliente=cliente.id_cliente");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Financiamientos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("cabecera.php"); ?>
<div class="contenedor">
    <div class="caja">
        <h2>Financiamientos</h2>
        <form method="post" class="formulario">
            <select name="lote">
                <?php while ($fila = mysqli_fetch_assoc($lotes)) { ?>
                <option value="<?php echo $fila["id_lote"]; ?>"><?php echo $fila["codigo"]." - ".$fila["precio"]; ?></option>
                <?php } ?>
            </select>
            <select name="cliente">
                <?php while ($fila = mysqli_fetch_assoc($clientes)) { ?>
                <option value="<?php echo $fila["id_cliente"]; ?>"><?php echo $fila["nombre"]; ?></option>
                <?php } ?>
            </select>
            <input type="number" name="meses" placeholder="Meses" required>
            <input type="text" name="cuota" placeholder="Cuota mensual" required>
            <input type="date" name="fecha" required>
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </div>
    <div class="caja">
        <table>
            <tr>
                <th>ID</th>
                <th>Lote</th>
                <th>Cliente</th>
                <th>Meses</th>
                <th>Cuota mensual</th>
                <th>Saldo</th>
                <th>Accion</th>
            </tr>
            
            <?php while ($fila = mysqli_fetch_assoc($financiamientos)) { ?>
            
            <tr>
                <td><?php echo $fila["id_financiamiento"]; ?></td>
                <td><?php echo $fila["lote"]; ?></td>
                <td><?php echo $fila["cliente"]; ?></td>
                <td><?php echo $fila["meses"]; ?></td>
                <td><?php echo $fila["cuota_mensual"]; ?></td>
                <td><?php echo $fila["saldo"]; ?></td>
                <td><a href="financiamientos.php?borrar=<?php echo $fila["id_financiamiento"]; ?>">Eliminar</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
