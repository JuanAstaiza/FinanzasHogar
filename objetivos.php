<?php
require_once 'clasesPrincipales/Conector.php';

$bd = conectar();
if (!$bd) return;
//TRANSACCIONES EN BD CON SQL 
$listaClientes = "";


//GASTOS
$sqlG = "SELECT dg.valor FROM  gastos as g, detalles_gasto as dg WHERE g.id_admin=$id and g.id=dg.id_gasto;";
$datosG = mysqli_query($bd, $sqlG);
$totalGastos = 0;
while ($regG = mysqli_fetch_array($datosG)) { //mientras haya registros -> $reg
    $totalGastos = $totalGastos + $regG[0];
}
//INGRESOS
$sqlI = "SELECT di.valor FROM  ingresos as i, detalles_ingreso as di WHERE i.id_admin=$id and i.id=di.id_ingreso;";
$datosI = mysqli_query($bd, $sqlI);
$totalIngresos = 0;
while ($regI = mysqli_fetch_array($datosI)) { //mientras haya registros -> $reg
    $totalIngresos = $totalIngresos + $regI[0];
}

$totalGanancias = $totalIngresos - $totalGastos;
$aviso = "";
if ($totalGanancias < 0) {
    $aviso = "(Deuda)";
}
$sqlO = "SELECT ob.nombre,ob.valor,ob.descripcion FROM  objetivos as ob WHERE ob.id_admin=$id;";
$datosO = mysqli_query($bd, $sqlO);
$numeroO = 0;
while ($regO = mysqli_fetch_array($datosO)) { //mientras haya registros -> $reg
    $numeroO++;
}


$sqlO = "SELECT ob.nombre,ob.valor,ob.descripcion FROM  objetivos as ob WHERE ob.id_admin=$id;";
$datosO = mysqli_query($bd, $sqlO);
$cont = 0;
$valorTotalObjetivos = 0;
$totalsaldoN = 0;
$totalabonos = 0;
while ($regO = mysqli_fetch_array($datosO)) { //mientras haya registros -> $reg
    $cont++;
    $sql = "SELECT dg.descripcion,dg.valor FROM  gastos as g, detalles_gasto as dg WHERE g.id_admin=$id and g.id=dg.id_gasto and dg.tipo_gasto='Abono Proyección' and dg.descripcion='$regO[0]';";
    $datos = mysqli_query($bd, $sql);
    $abono = 0;
    while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
        $abono = $abono + $reg[1];
    }
    $totalabonos = $totalabonos + $abono;
    if ($abono >= $regO[1]) {
        $saldoNuevo = 0;
    } else {
        $saldoNuevo = $abono - $regO[1];
        $saldoNuevo = abs(round($saldoNuevo, 2));
    }

    $estado = "";
    if ($abono >= $regO[1]) {
        $estado = "<img src='img/check.png'  title='Se ha completado la PROYECCION.'>";
    } else if ($abono < $regO[1]) {
        $estado = "<img src='img/x.png' title='Aun no ha completado la PROYECCION.'>";
    }
    $abono = round($abono, 2);

    $valorTotalObjetivos =  $valorTotalObjetivos + $regO[1];
    $totalsaldoN = $totalsaldoN + $saldoNuevo;

    $listaClientes .= "<tr>";
    $listaClientes .= "<th scope='col'>$cont</th>";
    $listaClientes .= "<td><textarea class='form-control' id='exampleFormControlTextarea1' rows='3' disabled>$regO[0]</textarea></td>";
    $listaClientes .= "<td>$regO[1]</td>";
    $listaClientes .= "<td>$abono</td>";
    $listaClientes .= "<td>$saldoNuevo</td>";
    $listaClientes .= "<td><center>$estado </center></td>";
    $listaClientes .= "<td><textarea class='form-control' id='exampleFormControlTextarea2' rows='3' disabled>$regO[2]</textarea></td>";
    $listaClientes .= "</tr>";
}
mysqli_close($bd);

?>

<div class="container col-xl-10 ">
    <div class="row align-items-center g-5 py-5">
        <h1>
            <center><b><mark>LISTA DE OBJETIVOS</mark></b></center>
        </h1>
        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col">Numero de Objetivos</th>
                    <th scope="col">Ingresos</th>
                    <th scope="col">Gastos</th>
                    <th scope="col">Fondos disponibles</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $numeroO ?></td>
                    <td><?= $totalIngresos ?></td>
                    <td><?= $totalGastos ?></td>
                    <td><?= $totalGanancias ?><?= $aviso ?></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <center>Proyección</center>
                    </th>
                    <th scope="col">
                        <center>Valor</center>
                    </th>
                    <th scope="col">
                        <center>Abono</center>
                    </th>
                    <th scope="col">
                        <center>Saldo Pendiente</center>
                    </th>
                    <th scope="col">
                        <center>Estado</center>
                    </th>
                    <th scope="col">
                        <center>Descripción</center>
                    </th>
                    <th scope="col">
                        <center><a class="btn btn-success" href="principal.php?CONTENIDO=paginas/formularioObjetivo.php" role="button">Agregar</a></center>
                    </th>
                </tr>
            </thead>
            <tbody id="listadoUsuarios">
                <?= $listaClientes ?>
                <td colspan="2" align="right"><b>Total:</b></td>
                <td><?= $valorTotalObjetivos ?></td>
                <td><?= $totalabonos ?></td>
                <td><?= $totalsaldoN ?></td>
            </tbody>
        </table>
    </div>
</div>