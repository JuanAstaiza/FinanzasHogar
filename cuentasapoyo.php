<?php
require_once 'clasesPrincipales/Conector.php';

if (isset($_GET['mensajeC'])) {
  $mensaje2 = "<div class='alert alert-success' role='alert'>Registro eliminado con éxito!!</div>";
} else if (isset($_GET['mensajeI'])) {
  $mensaje2 = "<div class='alert alert-danger' role='alert'>No se permite eliminar el registro porque el cliente tienen registros importantes.</div>";
} else {
  $mensaje2 = "";
}


$bd = conectar();
if (!$bd) return;
//TRANSACCIONES EN BD CON SQL 
$listaClientes = "";

$sql = "SELECT * FROM  miembros WHERE id_admin=$id and archivado='NO';";
$datos = mysqli_query($bd, $sql);
$cont = 0;
while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
  $cont++;
  $listaClientes .= "<tr>";
  $listaClientes .= "<th scope='col'>$cont</th>";
  $listaClientes .= "<td>$reg[2]</td>";
  $listaClientes .= "<td>$reg[3]</td>";
  $listaClientes .= "<td>$reg[4]</td>";
  $listaClientes .= "<td>$reg[5]</td>";
  $listaClientes .= "<td>$reg[6]</td>";
  $listaClientes .= "<td>$reg[7]</td>";
  $listaClientes .= "<td>$reg[8]</td>";
  $listaClientes .= "<td>";
  $listaClientes .= "
      <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#ClienteModal_$cont'>
        Archivar
      </button>
      <!-- Modal -->
      <div class='modal fade' id='ClienteModal_$cont' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Confirmación</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
            Esta seguro que desea Archivar este Usuario: $reg[2] $reg[3]  del registro?
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-outline-primary' data-bs-dismiss='modal'>Salir</button>
              <a class='btn btn-outline-warning' href='principal.php?CONTENIDO=paginas/clientesActualizarMiembros.php&id=$reg[0]&accion=MA' role='button'>Aceptar</a></th>
            </div>
          </div>
        </div>
      </div>";
  $listaClientes .= "</td>";
  $listaClientes .= "</tr>";
}
mysqli_close($bd);

?>

<div class="container col-xl-10 ">
  <div class="row align-items-center g-5 py-5">
    <h1>
      <center><b><mark>LISTA DE MIEMBROS</mark></b></center>
    </h1>
    <hr>
    <form id="frmBusquedaUsuariosMiembros" method="post">
      <div>
        <input type="text" name='BuscarUsuario' class="form-control" placeholder="Buscar Miembros (Nombre Completo)">
      </div>
    </form>
    <div><?= $mensaje2 ?></div>
    <div id="divresBU"></div>
    <br>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombres</th>
          <th scope="col">Apellidos</th>
          <th scope="col">Telefono</th>
          <th scope="col">Email</th>
          <th scope="col">Usuario</th>
          <th scope="col">Contraseña</th>
          <th scope="col">Rol</th>
          <th scope="col"><a class="btn btn-success" href="principal.php?CONTENIDO=paginas/formularioClientes.php" role="button">Agregar</a></th>
        </tr>
      </thead>
      <tbody id="listadoUsuarios">
        <?= $listaClientes ?>
      </tbody>
    </table>
  </div>
</div>