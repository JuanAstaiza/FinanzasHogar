<?php
require_once 'clasesPrincipales/Conector.php';

$bd = conectar();
if (!$bd) return;
//TRANSACCIONES EN BD CON SQL 
$listaClientes = "";

$sql = "SELECT g.fecha,dg.valor,dg.tipo_gasto,dg.descripcion FROM  gastos as g, detalles_gasto as dg WHERE g.id_admin=$id and g.id=dg.id_gasto;";
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
    $agregar = "<a class='btn btn-success' href='principal.php?CONTENIDO=paginas/formularioGastos.php' role='button' >Agregar</a>";
}

?>

<div class="container col-xl-10 ">
    <div class="row align-items-center g-5 py-5">
        <h1>
            <center><b><mark>LISTA DE GASTOS</mark></b></center>
        </h1>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Tipo Gasto</th>
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