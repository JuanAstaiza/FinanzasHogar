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
    case 'A': //Adicionar Objetivo
        $sql = "INSERT INTO objetivos (id_admin,nombre,valor,descripcion) VALUES ('$id','$nombre','$valor','$descripcion');";
        $datosU = mysqli_query($bd, $sql);
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
    default:
        break;
}
