<?php
require_once __DIR__ . "/conexion.php";


include("conexion.php");

$totalClientes = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) AS total FROM cliente"));
$totalLotes = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) AS total FROM lote"));
$totalFinanciamientos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) AS total FROM financiamiento"));
$totalCobros = mysqli_fetch_assoc(mysqli_query($conexion, "select SUM(monto) as total from cobro"));
$cobrado = $totalCobros["total"];
if ($cobrado == null) {
    $cobrado = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lotificacion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("cabecera.php"); ?>
<div class="contenedor">
    <div class="caja">
        <h2>Inicio</h2>
        <p>Clientes registrados: <?php echo $totalClientes["total"]; ?></p>
        <p>Lotes registrados: <?php echo $totalLotes["total"]; ?></p>
        <p>Financiamientos registrados: <?php echo $totalFinanciamientos["total"]; ?></p>
        <p>Total cobrado: <?php echo number_format($cobrado, 2); ?></p>
    </div>



</div>
<script src="script.js"></script>

       <br>
   <p1> INGE HAGAME GANAR PORFA SIIII NO ME HAGA PERDER</p1> <BR>
          <P2> sea misecordioso conmigo :(   </P2>
    



</body>
</html>


