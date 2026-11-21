function calcularCuota()
{
    var precio=document.getElementById("precio");
    var mensual=document.getElementById("mensual");
    var meses=document.getElementById("meses");
    var resultado=document.getElementById("resultado");

    if (precio && mensual && meses && resultado) {
        var p = Number(precio.value);
        var m = Number(meses.value);
        if (p > 0 && m > 0) {
            var cuota = p / m;
            mensual.value = cuota.toFixed(2);
            resultado.innerHTML = "Cuota aproximada: " + cuota.toFixed(2);
        }
    }
}
