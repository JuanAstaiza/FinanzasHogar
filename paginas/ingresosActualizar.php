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
    case 'A':
        $sql = "INSERT INTO ingresos (id_admin,fecha) VALUES ('$id','$fecha');";
        $datosU = mysqli_query($bd, $sql);
        if ($datosU) {
            $sql1 = "SELECT max(u.id) FROM ingresos as u;";
            $datos = mysqli_query($bd, $sql1);
            while ($reg = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
                $idingreso = $reg[0];
            }
            $sql2 = "INSERT INTO detalles_ingreso (id_ingreso,valor,tipo_ingreso,descripcion) VALUES ('$idingreso','$valor','$tipoIngreso','$descripcion');";
            $datosIng = mysqli_query($bd, $sql2);
            if ($datosIng) {
                echo "<div class='alert alert-success' role='alert'>Registro adicionado con éxito!!</div>";
            } else {
                echo  "<div class='alert alert-danger' role='alert'>Error al guardar el registro.Usted tiene el Usuario o correo en uso.</div>";
            }
        } else {
            echo  "<div class='alert alert-danger' role='alert'>Error al guardar el registro.Usted tiene el Usuario o correo en uso.</div>";
            //echo "Error al guardar el registro";
            //echo  mysqli_error($bd);
        }
        //CERRAR CONEXION
        mysqli_close($bd);
        break;
    default:
        break;
}
