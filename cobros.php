<?php
require_once __DIR__ . "/conexion.php";

include("conexion.php");

if (isset($_POST["guardar"])) {
    $financiamiento = intval($_POST["financiamiento"]);
    $fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);
    $monto = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $capital = mysqli_real_escape_string($conexion, $_POST["capital"]);
    $interes = mysqli_real_escape_string($conexion, $_POST["interes"]);

    $insertCobro = "INSERT INTO cobro (id_financiamiento, fecha, monto, capital, interes)
        VALUES ('$financiamiento', '$fecha', '$monto', '$capital', '$interes')";
    mysqli_query($conexion, $insertCobro);

    $dato = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT saldo FROM financiamiento WHERE id_financiamiento=$financiamiento"));
    $nuevoSaldo = $dato["saldo"] - $capital;
    if ($nuevoSaldo < 0) {
        $nuevoSaldo = 0;
    }
    mysqli_query($conexion, "UPDATE financiamiento SET saldo='$nuevoSaldo' WHERE id_financiamiento=$financiamiento");
}

$financiamientos = mysqli_query($conexion, "SELECT financiamiento.id_financiamiento,
                                            lote.codigo,
                                            cliente.nombre,
                                            financiamiento.saldo
                                             FROM financiamiento
                                                 INNER JOIN lote ON financiamiento.id_lote=lote.id_lote
                                                     INNER JOIN cliente ON financiamiento.id_cliente=cliente.id_cliente");




$cobros = mysqli_query($conexion, "SELECT cobro.*, lote.codigo AS lote, cliente.nombre AS cliente
                                   FROM cobro
                                       INNER JOIN financiamiento ON cobro.id_financiamiento=financiamiento.id_financiamiento
                                           INNER JOIN lote ON financiamiento.id_lote=lote.id_lote
                                               INNER JOIN cliente ON financiamiento.id_cliente=cliente.id_cliente");


?>
<!DOCTYPE html>
<html>
<head>



    <meta charset="utf-8">
    <title>Cobros</title>
    <link rel="stylesheet" href="style.css">



</head>
<body>


<?php include("cabecera.php"); ?>
        <div class="contenedor">
         <div class="caja">
                <h2>Cobros</h2>
        
        
        <form method="post" class="formulario">
            <select name="financiamiento">
                <?php while ($fila = mysqli_fetch_assoc($financiamientos)) { ?>
                <option value="<?php echo $fila["id_financiamiento"]; ?>">
                    <?php echo $fila["codigo"]." - ".$fila["nombre"]." - Saldo ".$fila["saldo"]; ?>
                </option>
                <?php } ?>
            </select>
            <input type="date" name="fecha" required>
             <input type="text" name="monto" placeholder="Monto total" required>
                 <input type="text" name="capital" placeholder="Capital" required>
                     <input type="text" name="interes" placeholder="Interes" required>
                         <button type="submit" name="guardar">Guardar cobro</button>
                 </form>

    </div>
    <div class="caja">
         <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Lote</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Capital</th>
                <th>Interes</th>
            </tr>
            <?php while ($fila = mysqli_fetch_assoc($cobros)) { ?>
            <tr>
                <td><?php echo $fila["id_cobro"]; ?></td>
                    <td><?php echo $fila["cliente"]; ?></td>
                    <td><?php echo $fila["lote"]; ?></td>
                        <td><?php echo $fila["fecha"]; ?></td>
                    <td><?php echo $fila["monto"]; ?></td>
                        <td><?php echo $fila["capital"]; ?></td>
                            <td><?php echo $fila["interes"]; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

 <footer>
   
    <p> VAMOS INGE  <BR> HAGAME GANAR INGE PLISSSSS</p>
    
  <p>  <br> lo hice practicando desde la noche que subio notas :(  </p>

  
  
</footer>     
    



</body>
</html>
