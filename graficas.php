<?php
require_once 'clasesPrincipales/Conector.php';

$bd = conectar();
if (!$bd) return;
//TRANSACCIONES EN BD CON SQL 

$sqlI = "SELECT i.fecha,di.valor FROM  ingresos as i, detalles_ingreso as di WHERE i.id_admin=$id and i.id=di.id_ingreso ORDER by i.fecha ASC;";
$datosI = mysqli_query($bd, $sqlI);
$fechasIngresos = "";
$valorIngresos = "";

while ($regI = mysqli_fetch_array($datosI)) { //mientras haya registros -> $reg
    $fechasIngresos .= "'" . $regI[0] . "',";
    $valorIngresos .= $regI[1] . ",";
}

$fechasIngresos = rtrim($fechasIngresos, ",");
$valorIngresos = rtrim($valorIngresos, ",");

$sqlG = "SELECT g.fecha,dg.valor FROM  gastos as g, detalles_gasto as dg WHERE g.id_admin=$id and g.id=dg.id_gasto ORDER by g.fecha ASC;";
$datosG = mysqli_query($bd, $sqlG);
$fechasGastos = "";
$valorGastos = "";

while ($regG = mysqli_fetch_array($datosG)) { //mientras haya registros -> $reg
    $fechasGastos .= "'" . $regG[0] . "',";
    $valorGastos .= $regG[1] . ",";
}

$fechasGastos = rtrim($fechasGastos, ",");
$valorGastos = rtrim($valorGastos, ",");


mysqli_close($bd);

?>

<div class="container col-xl-10 ">
    <div class="row align-items-center g-5 py-5">
        <h1>
            <center><b><mark>GRAFICAS ESTADISTICAS</mark></b></center>
        </h1>

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <center>INGRESOS</center>
                    </th>
                    <th scope="col">
                        <center>GASTOS</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div id="ingresos" style="width:700px;max-width:700px"></div>
                    </td>
                    <td>
                        <div id="gastos" style="width:700px;max-width:700px"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    var datai = [{
        x: [<?= $fechasIngresos ?>],
        y: [<?= $valorIngresos ?>],
        type: 'scatter'
    }];
    // Display using Plotly
    Plotly.newPlot("ingresos", datai);


    var dataG = [{
        x: [<?= $fechasGastos ?>],
        y: [<?= $valorGastos ?>],
        type: 'scatter'
    }];
    // Display using Plotly
    Plotly.newPlot("gastos", dataG);
</script>