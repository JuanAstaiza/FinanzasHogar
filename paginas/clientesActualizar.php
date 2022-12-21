<?php

foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;

if ($accion == "A" || $accion == "A_R" ||  $accion == "M" ||  $accion == "B" ||  $accion == "BU") {
    require_once '../clasesPrincipales/Conector.php';
} else {
    require_once 'clasesPrincipales/Conector.php';
}

$bd = conectar();
if (!$bd) return;

switch ($accion) {
    case 'A': //Adicionar Cliente
        $sqlUsuario = "INSERT INTO usuarios_principales (nombres_admin,apellidos_admin,telefono_admin,correo_admin,usuario_admin,clave_admin,rol_familiar_admin) VALUES ('$nombres','$apellidos','$telefono','$email','$usuario','$clave','Administrador')";
        $datosU = mysqli_query($bd, $sqlUsuario);
        $datosC = "";
        if ($datosU) {
            echo "<div class='alert alert-success' role='alert'>Registro adicionado con éxito!!</div>";
        } else {
            echo  "<div class='alert alert-danger' role='alert'>Error al guardar el registro.Usted tiene el Usuario o correo en uso.</div>";
            //echo "Error al guardar el registro";
            //echo  mysqli_error($bd);
        }
        //CERRAR CONEXION
        mysqli_close($bd);
        break;
    case 'M': //Modificar Cliente
        $sqlUsuario = "UPDATE usuarios_principales SET nombres_admin='$nombres',apellidos_admin='$apellidos',telefono_admin='$telefono',correo_admin='$email',usuario_admin='$usuario',clave_admin='$clave',rol_familiar_admin='$rol' WHERE id_admin=$id";
        $datosU = mysqli_query($bd, $sqlUsuario);
        $datosC = "";
        if ($datosU) {
            echo "<div class='alert alert-success' role='alert'>Registro modificado con éxito!!</div>";
        } else {
            echo  "<div class='alert alert-danger' role='alert'>Error al modificar el registro.Usted tiene el correo en uso.</div>";
            //echo "Error al guardar el registro";
            //echo  mysqli_error($bd);
        }
        //CERRAR CONEXION
        mysqli_close($bd);
        break;
        /*case 'E': //Eliminar Cliente
        $sqlClientes = "DELETE FROM clientes WHERE id_usuario='$id';";
        $sqlClientes = mysqli_query($bd, $sqlClientes);
        $sqlUsuario = "DELETE FROM usuarios WHERE id='$id'";
        $sqlUsuario = mysqli_query($bd, $sqlUsuario);
        if ($sqlClientes && $sqlUsuario) {
            header("Location: principal.php?CONTENIDO=clientes.php&mensajeC");
            echo "<div class='alert alert-success' role='alert'>Registro eliminado con éxito!!</div>";
        } else {
            header("Location: principal.php?CONTENIDO=clientes.php&mensajeI");
            echo "<div class='alert alert-danger' role='alert'>No se permite eliminar el registro porque tiene Asiganadas unas ventas.</div>";
            echo  mysqli_error($bd);
        }
        //CERRAR CONEXION
        mysqli_close($bd);
        break;*/
    case 'B': //Buscar usuario para creación de El usuario
        $sql = "SELECT m.usuario_mb from miembros as m where m.usuario_mb='$usuario';";
        $datos = mysqli_query($bd, $sql);
        $cont = 0;
        while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
            $cont++;
        }
        $sql2 = "SELECT u.usuario_admin from usuarios_principales as u where u.usuario_admin='$usuario';";
        $datos = mysqli_query($bd, $sql2);
        while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
            $cont++;
        }
        if ($cont > 0) {
            echo "<div class='alert alert-danger' role='alert'>El Nombre de Usuario se encuentra en uso.</div>";
        } else {
            echo "<div class='alert alert-success' role='alert'>Nombre de Usuario disponible.</div>";
            // echo  mysqli_error($bd);
        }
        //CERRAR CONEXION
        mysqli_close($bd);
        break;
        /* case 'BU': //Buscar registros Menu Clientes 
        if ($BuscarUsuario == null) {
            $sql = "SELECT c.id_cli,c.nombres_cli,c.apellidos_cli,c.telefono_cli,c.direccion_cli,c.correo_cli,u.usuario,u.clave_usuario
                    FROM clientes as c INNER JOIN usuarios as  u ON c.id_usuario = u.id where  u.rol='Cliente' order by c.nombres_cli;";
        } else if ($BuscarUsuario != null) {
            $sql = "SELECT c.id_cli,c.nombres_cli,c.apellidos_cli,c.telefono_cli,c.direccion_cli,c.correo_cli,u.usuario,u.clave_usuario
                    FROM clientes as c INNER JOIN usuarios as  u ON c.id_usuario = u.id where  u.rol='Cliente' and  MATCH(c.nombres_cli,c.apellidos_cli) AGAINST('$BuscarUsuario');";
        }
        //echo "$sql";
        $datos = mysqli_query($bd, $sql);
        $cont = 0;
        $datoA = "";
        $usuarioEncontrado = "";
        while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
            $cont++;
            $usuarioEncontrado .= "<tr><th scope='col'>$cont</th><td>$reg[0]</td><td>$reg[1]</td><td>$reg[2]</td><td>$reg[3]</td><td>$reg[4]</td><td>$reg[5]</td><td>$reg[6]</td><td>$reg[7]</td>
                    <th>
                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#ClienteModal_$cont'>
                      Eliminar
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
                          Esta seguro que desea Eliminar este Usuario: $reg[1] $reg[2]  del registro?
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-outline-primary' data-bs-dismiss='modal'>Salir</button>
                            <a class='btn btn-outline-danger' href='principal.php?CONTENIDO=paginas/usuariosActualizar.php&id=$reg[0]&accion=E' role='button'>Aceptar</a></th>
                          </div>
                        </div>
                      </div>
                    </div></th></tr>";
        }
        if ($cont == 0) {
            $datoA = "<div class='alert alert-danger' role='alert'>No se ha encontrado este Cliente.</div>";
            echo $usuarioEncontrado . "]]" . $datoA;
        } else if ($cont >= 1 && $BuscarUsuario != null) {
            $datoA = "<div class='alert alert-success' role='alert'>Se ha encontrado este Cliente.</div>";
            echo  $usuarioEncontrado . "]]" . $datoA;
        } else if ($cont >= 1 && $BuscarUsuario == null) {
            $datoA = "<div></div>";
            echo  $usuarioEncontrado . "]]" . $datoA;
        }
        //CERRAR CONEXION
        mysqli_close($bd);
        break;*/
    default:
        break;
}
