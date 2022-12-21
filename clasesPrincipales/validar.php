<?php
session_start();

require_once 'Conector.php';
$usuario = $_POST['txtUsuario'];
$clave = $_POST['txtPassword'];

// include("conexion.php");
$bd = conectar();
if (!$bd) return;
//Administrador
$sql = "select  id_admin,usuario_admin,nombres_admin,apellidos_admin,rol_familiar_admin from usuarios_principales where usuario_admin='$usuario' and clave_admin='$clave'";
$res = mysqli_query($bd, $sql);
$arr = mysqli_fetch_array($res);

if ($res->num_rows == 0) {
    //Miembros
    $sql2 = "select id_admin,usuario_mb,nombres_mb,apellidos_mb,rol_familiar_mb from  miembros where usuario_mb='$usuario' and clave_mb='$clave' and archivado='NO' ";
    $res2 = mysqli_query($bd, $sql2);
    $arr2 = mysqli_fetch_array($res2);

    if ($res2->num_rows == 0) {
        //echo "Usuario y/o contraseña incorrecta (i)";
        header("Location: ../index.php?mensajeI");
    } else {
        //echo "Usuario y/o contraseña correcta (c)";
        $_SESSION["usuario"] = $arr2[1]; //registramos Usuario
        $_SESSION["rol"] = $arr2[4];  //registramos rol del Usuario
        $_SESSION["nombreCompleto"] = " " . $arr2[2]; //registramos Usuario
        $_SESSION["id"] = $arr2[0];

        header("Location: ../index.php?mensajeC");
        header('Location: ../principal.php?CONTENIDO=paginas/inicio.php');
    }
} else {

    //echo "Usuario y/o contraseña correcta (c)";
    $_SESSION["usuario"] = $arr[1]; //registramos Usuario
    $_SESSION["rol"] = $arr[4];  //registramos rol del Usuario
    $_SESSION["nombreCompleto"] = " " . $arr[2]; //registramos Usuario
    $_SESSION["id"] = $arr[0];

    header("Location: ../index.php?mensajeC");
    header('Location: ../principal.php?CONTENIDO=paginas/inicio.php');
}
mysqli_close($bd);
