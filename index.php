<?php


if (isset($_GET['mensajeC'])) {
	$aviso = 'text-warning';
	$mensaje = 'Usuario y/o contraseña correcta.';
} else if (isset($_GET['mensajeI'])) {
	$aviso = 'text-danger';
	$mensaje = 'Usuario y/o contraseña incorrecta.';
} else if (isset($_GET['mensajeE'])) {
	session_start();
	session_unset();
	session_destroy();
	$aviso = 'text-success';
	$mensaje = 'Usted ha salido del sistema.';
} else if (isset($_GET['mensajeD'])) {
	session_start();
	session_unset();
	session_destroy();
	$aviso = 'text-secondary';
	$mensaje = 'Debe iniciar sesión.';
} else {
	$aviso = '';
	$mensaje = '';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/login.css" rel="stylesheet">
	<link href="css/icons/bootstrap-icons.css" rel="stylesheet">
	<link href="css/bootstrap//bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap/bootstrap.bundle.min.js"></script>

	<script src="js/bootstrap/popper.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/funciones_Login.js"></script>
	<link href="img/icono.jpg" rel="shortcut icon">


	<title>Finanzas del Hogar</title>
</head>
<!--Coded with love by Mutiullah Samim-->

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="img/logoLogin.png" class="brand_logo" alt="Logo" title="Electronics">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action="clasesPrincipales/validar.php" method="POST" data-ajax="false">
						<div class="d-flex justify-content-center text-dark">
							<h1><b>BIENVENIDO</b></h1>
						</div>
						<br>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text bg-dark"><i class="bi-person-fill"></i></span>
							</div>
							<input type="text" name="txtUsuario" class="form-control input_user" value="" placeholder="Usuario" required>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text bg-dark"><i class="bi-key"></i></span>
							</div>
							<input type="password" id="txtPassword" name="txtPassword" class="form-control input_pass" value="" placeholder="Contraseña" required>
							<div class="input-group-append">
								<button id="btn_password" class="btn btn-dark" type="button"> <span class="bi-eye-fill icon"></span> </button>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" name="button" class="btn btn-dark">Iniciar Sesión</button>
						</div>
					</form>
				</div>

				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						¿No tienes Cuenta?
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
							<b>Registrate</b>
						</button>
					</div>
					<div class="d-flex justify-content-center links">
						<p class="<?= $aviso ?>"><b><?= $mensaje ?></b></p>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registrarse</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="frmRegistro" method="post">
					<div class="modal-body">
						<div class="form-floating 3">
							<input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
							<label for="floatingInput"><b>Nombres:</b></label>
						</div>
						<div class="form-floating 3">
							<input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
							<label for="floatingInput"><b>Apellidos:</b></label>
						</div>
						<div class="form-floating 3">
							<input type="telefono" name="telefono" class="form-control" placeholder="Telefono" required>
							<label for="floatingInput"><b>Telefono:</b></label>
						</div>
						<div class="form-floating 3">
							<input type="email" name="email" class="form-control" placeholder="Email" required>
							<label for="floatingInput"><b>Email:</b></label>
						</div>
						<label><b>Usuario:</b></label>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="bi-person-fill"></i></span>
							</div>
							<input type="text" name="usuario" id="txtUsuarioRegistro" class="form-control input_user" required>
							<div class="input-group-append">
								<button id="btn_buscadorUsuarios" class="btn btn-dark" type="button" title="Buscar Usuario"> <span class="bi bi-search icon"></span> </button>
							</div>
						</div>
						<div class="input-group mb-3">
							<label><b>Contraseña:</b></label>
							<div class="input-group mb-2">
								<div class="input-group-append">
									<span class="input-group-text"><i class="bi-key"></i></span>
								</div>
								<input type="password" name="clave" id="txtPasswordRegistro" class="form-control input_pass" value="" required>
								<div class="input-group-append">
									<button id="btn_passwordRegistro" class="btn  btn-dark" type="button"> <span class="bi-eye-fill icon"></span> </button>
								</div>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" required>
								<label class="form-check-label" for="aceptacion">
									Acepto los Términos de servicio y la Política de privacidad. </label>
							</div>
						</div>
						<div id="divres"></div>
						<div id="divresU"></div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-secondary">Limpiar</button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">Guardar cambios</button>
							<div class="d-flex justify-content-center links">
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>