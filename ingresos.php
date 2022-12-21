<?php
require_once 'clasesPrincipales/Conector.php';

$bd = conectar();
if (!$bd) return;
//TRANSACCIONES EN BD CON SQL 
$listaClientes = "";

$sql = "SELECT i.fecha,di.valor,di.tipo_ingreso,di.descripcion FROM  ingresos as i, detalles_ingreso as di WHERE i.id_admin=$id and i.id=di.id_ingreso;";
$datos = mysqli_query($bd, $sql);
$cont = 0;
while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
    $cont++;
    $listaClientes .= "<tr>";
    $listaClientes .= "<th scope='col'>$cont</th>";
    $listaClientes .= "<td>$reg[0]</td>";
    $listaClientes .= "<td>$reg[1]</td>";
    $listaClientes .= "<td>$reg[2]</td>";
    $listaClientes .= "<td><textarea class='form-control' id='exampleFormControlTextarea1' rows='3' disabled>$reg[3]</textarea></td>";
    $listaClientes .= "</tr>";
}
mysqli_close($bd);
$agregar = "";
if ($rol == "Editor") {
    $agregar = "";
} elseif ($rol == "Administrador") {
    $agregar = "<a class='btn btn-success' href='principal.php?CONTENIDO=paginas/formularioIngreso.php' role='button' >Agregar</a>";
}


?>

<div class="container col-xl-10 ">
    <div class="row align-items-center g-5 py-5">
        <h1>
            <center><b><mark>LISTA DE INGRESOS</mark></b></center>
        </h1>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Tipo Ingreso</th>
                    <th scope="col">Descripción</th>
                    <th scope="col"><?= $agregar ?></th>
                </tr>
            </thead>
            <tbody id="listadoUsuarios">
                <?= $listaClientes ?>
            </tbody>
        </table>
    </div>
</div>