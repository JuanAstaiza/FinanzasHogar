<?php
// Continuamos la sesión

session_start();


if (!isset($_SESSION['usuario'])) header('Location: index.php?mensajeD');
$infoUsuario = " " . $_SESSION['usuario'];
$usuario = $_SESSION['usuario'];
$rolTitulo = " " . $_SESSION['rol'];
$rol = $_SESSION['rol'];
$id = $_SESSION['id'];


//PERMISO ACCESO A MENU DE ACUERDO AL ROL
$menu = "";
$informacion = "";
if ($rol == "Editor") {
  $informacion = "
  <div class='btn-group'>
          <button type='button' class='dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
            <img src='img/editor.png' title='Miembro ($infoUsuario)'>
          </button>
          <ul class='dropdown-menu'>
            <li><a class='dropdown-item bi bi-person-badge' href='principal.php?CONTENIDO=perfil.php'> Perfil</a></li>
            <li><a class='dropdown-item bi bi-reception-4' href='principal.php?CONTENIDO=graficas.php'> Graficas</a></li>
          </ul>
        </div>";
  $menu = "  
  <div class='btn-group'>
            <button type='button' class='btn btn-outline-success bi bi-cash-stack dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
              Finanzas
            </button>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item bi bi-bar-chart-fill' href='principal.php?CONTENIDO=ingresos.php'> Ingresos</a></li>
              <li><a class='dropdown-item bi bi-bar-chart-steps' href='principal.php?CONTENIDO=gastos.php'> Gastos</a></li>
            </ul>
          </div>
          ";
} else if ($rol == "Administrador") {
  $informacion = "
  <div class='btn-group'>
          <button type='button' class='dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
            <img src='img/user.png' title='Administrador ($infoUsuario)'>
          </button>
          <ul class='dropdown-menu'>
            <li><a class='dropdown-item bi bi-person-badge' href='principal.php?CONTENIDO=perfil.php'> Perfil</a></li>
            <li><a class='dropdown-item bi bi-people-fill' href='principal.php?CONTENIDO=cuentasapoyo.php'> Cuentas de Apoyo</a></li>
            <li><a class='dropdown-item bi bi-wallet-fill' href='principal.php?CONTENIDO=cuentasapoyoarchivadas.php'> Cuentas Archivadas</a></li>
            <li><a class='dropdown-item bi bi-reception-4' href='principal.php?CONTENIDO=graficas.php'> Graficas</a></li>
           </ul>
        </div>";
  $menu = "  
  <div class='btn-group'>
            <button type='button' class='btn btn-outline-success bi bi-cash-stack dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
              Finanzas
            </button>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item bi bi bi-box-arrow-in-up' href='principal.php?CONTENIDO=ingresos.php'> Ingresos</a></li>
              <li><a class='dropdown-item bi bi-box-arrow-up-left' href='principal.php?CONTENIDO=gastos.php'> Gastos</a></li>
            </ul>
          </div>
          <div class='btn-group'>
          <a class='btn btn-outline-warning  bi bi-folder-fill' href='principal.php?CONTENIDO=objetivos.php' role='button'> Objetivos</a>
        </div>
          ";
} else {
  $menu = "";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/principal.css" rel="stylesheet">
  <link href="css/icons/bootstrap-icons.css" rel="stylesheet">
  <link href="css/bootstrap//bootstrap.min.css" rel="stylesheet">

  <script src="js/bootstrap/popper.min.js"></script>
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/funcionesPrincipal.js"></script>
  <script src="librerias/plotly-2.4.2.min.js"></script>
  <link href="img/icono.jpg" rel="shortcut icon">

  <title>Finanzas del Hogar</title>
</head>

<body>

  <div class="container">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="principal.php?CONTENIDO=paginas/inicio.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><img src="img/logoPrincipal.png" title="Finanzas del Hogar"></svg>
      </a>
      <br>
      <div class="row">
        <div class="col">
          <?= $informacion ?>
        </div>
      </div>
    </header>
    <div class="btn-group">
      <a class="btn btn-outline-primary  active bi bi-house-door" href="principal.php?CONTENIDO=paginas/inicio.php" role="button"> Inicio</a>
    </div>
    <?= $menu ?>
    <div class="btn-group">
      <button type="button" class="btn btn-outline-primary bi bi-file-earmark-medical dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Reportes
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item bi-file-earmark-bar-graph" href="reporte/reportesIngreso.php?id=<?= $id ?>" target="_blank"> Reporte Ingresos</a></li>
        <li><a class="dropdown-item bi bi-file-earmark-bar-graph-fill" href="reporte/reportesGastos.php?id=<?= $id ?>" target="_blank">Reporte Gastos</a></li>
      </ul>
    </div>
    <div class="btn-group">
      <a class="btn btn-outline-danger bi bi-door-open-fill" href="index.php?mensajeE" role="button"> Salir</a>
    </div>

  </div>

  <div>
    <?php include $_GET['CONTENIDO']; ?>
  </div>

  <div class="content text-center" style="background-color: black">
    <h7 class="fw-bold text-white">Proyecto desarrollado por:<br> JUAN CARLOS ASTAIZA, ANDRES FELIPE,DIANA CAROLINA,SEBASTIAN ALEXANDER Y LUIS GABRIEL<br> UNICESMAG<br>&copy; 2021</h7>
  </div>
</body>

</html>