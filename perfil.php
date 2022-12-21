<?php

$accion = "M";

require_once 'clasesPrincipales/Conector.php';
$bd = conectar();
if (!$bd) return;

if ($rol == "Editor") {

    $sql1 = "select  * from miembros where usuario_mb='$usuario'";
    $bloqueados = "disabled";
    $res1 = mysqli_query($bd, $sql1);
    $arr1 = mysqli_fetch_array($res1);
    $nombres = $arr1[2];
    $apellidos = $arr1[3];
    $celular = $arr1[4];
    $email = $arr1[5];
    $rol = $arr1[8];
    $usuario = $arr1[6];
    $clave = $arr1[7];
} elseif ($rol == "Administrador") {
    $sql = "select  * from usuarios_principales where usuario_admin='$usuario'";
    $bloqueados = "";
    $res = mysqli_query($bd, $sql);
    $arr = mysqli_fetch_array($res);
    $nombres = $arr[1];
    $apellidos = $arr[2];
    $celular = $arr[3];
    $email = $arr[4];
    $rol = $arr[7];
    $usuario = $arr[5];
    $clave = $arr[6];
}

mysqli_close($bd);



?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-5 py-5">
        <h1>
            <center><b><mark>DATOS PERSONALES</mark></b></center>
        </h1>
        <br>
        <hr>
        <form class="p-5 border rounded-3 bg-light" id="frmRegistroCliente" method="post">
            <div class="form-floating mb-3">
                <input type="text" name='nombres' id="nombres" class="form-control" placeholder="Nombres" value="<?= $nombres ?>" required readonly>
                <label for="floatingInput"><b>Nombres:</b></label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name='apellidos' id='apellidos' class="form-control" placeholder="Apellidos" value="<?= $apellidos  ?>" required readonly>
                <label for="floatingInput"><b>Apellidos:</b></label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name='telefono' id='telefono' class="form-control" placeholder="Telefono o celular" value="<?= $celular  ?>" required readonly>
                <label for="floatingInput"><b>Telefono o Celular:</b></label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name='email' id='email' class="form-control" placeholder="Email" value="<?= $email  ?>" required readonly>
                <label for="floatingInput"><b>Email:<b></label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name='rol' name='rol' class="form-control" placeholder="Rol" value="<?= $rol  ?>" required readonly>
                <label for="floatingInput"><b>Rol:<b></label>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="bi-person-fill"></i></span>
                </div>
                <input type="text" name="usuario" id="txtUsuario" class="form-control input_user" placeholder="Usuario" value="<?= $usuario  ?>" required readonly>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="bi-key"></i></span>
                </div>
                <input type="password" id="txtPasswordRegistroUsuarios" name="clave" class="form-control input_pass" value="<?= $clave  ?>" placeholder="Contraseña" required readonly>
                <div class="input-group-append">
                    <button id="btn_passwordRegistroUsuarios" class="btn btn-dark" type="button"> <span class="bi-eye-fill icon"></span> </button>
                </div>

            </div>
            <div class="input-group mb-2">
                <div class="input-group-append">
                    <br>
                    <button id="btn_editarPerfil" class="btn btn-dark" type="button" <?= $bloqueados ?>>Editar</button>
                </div>
                <br>
            </div>
            <div id=divresR></div>
            <hr>

            <input type="hidden" name="accion" id="accion" value="<?= $accion ?>" />
            <input type="hidden" name="id" value="<?= $arr[0] ?>" />
            <button class="btn btn-primary" type="submit" <?= $bloqueados ?>>Corregir</button>&nbsp;&nbsp;
        </form>
    </div>
</div>
</div>