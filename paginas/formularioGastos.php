   <?php

    $accion = "A";

    require_once 'clasesPrincipales/Conector.php';

    $bd = conectar();
    if (!$bd) return;

    $sqlO = "SELECT ob.nombre,ob.valor,ob.descripcion FROM  objetivos as ob WHERE ob.id_admin=$id;";
    $datosO = mysqli_query($bd, $sqlO);
    $cont = 0;
    $listaobjetivos = "";
    while ($regO = mysqli_fetch_array($datosO)) { //mientras haya registros -> $reg
      $cont++;
      $listaobjetivos .=  "        
      <option value='$regO[0]'>$regO[0]</option>";
    }
    $opcion = "";
    if ($cont == 0) {
      $opcion = "<option value=''>No tiene proyecciónes en su lista de Objetivos</option>";
    } else {
      $opcion = "";
    }
    mysqli_close($bd);

    ?>

   <div class="container col-xl-10 col-xxl-8 px-4 py-5">
     <div class="row align-items-center g-5 py-5">
       <h1>
         <center><b><mark>ADICIONAR GASTO</mark></b></center>
       </h1>
       <br>
       <hr>
       <form id="frmRegistroGastos" method="post">
         <div class="form-floating 3">
           <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha" required>
           <label for="floatingInput"><b>Fecha:</b></label>
         </div>
         <div class="form-floating 3">
           <input type="number" name="valor" class="form-control" placeholder="Valor" min="1000" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" required>
           <label for="floatingInput"><b>Valor:</b></label>
         </div>
         <div class="mb-3">
           <label for="floatingInput"><b>Tipo de Gasto:</b></label>
           <select class="form-select" name="tipoGasto" id="tipoGasto" aria-label="Default select example" required>
             <option value="Servicio de agua">Servicio de agua</option>
             <option value="Servicio de luz">Servicio de luz</option>
             <option value="Servicio de gas domiciliario">Servicio de gas domiciliario</option>
             <option value="Alimentos">Alimentos</option>
             <option value="Productos de higiene">Productos de higiene</option>
             <option value="Productos de limpieza para el hogar">Productos de limpieza para el hogar</option>
             <option value="Pago de Deuda">Pago de Deuda</option>
             <option value="Abono Proyección">Abono Proyección</option>
             <option value="Otros">Otros</option>
           </select>
         </div>
         <div id="descripcion">

         </div>
         <div class="mb-3" id="listadespegable">
           <label for="floatingInput"><b>Tipo Objetivo (Descripción):</b></label>
           <select class="form-select" name="descripcion" id="objetivos" aria-label="Default select example" required disabled>
             <?= $listaobjetivos  ?>
             <?= $opcion  ?>
           </select>
         </div>
         <div id="divresR"></div>
         <div class="modal-footer">
           <input type="hidden" name="id" id="id" value="<?= $id ?>" />
           <input type="hidden" name="accion" id="accion" value="<?= $accion ?>" />
           <button type="reset" class="btn btn-secondary">Limpiar</button>
           <button type="submit" class="btn btn-primary">Guardar cambios</button>
           <a class="btn btn-dark" href="principal.php?CONTENIDO=gastos.php" role="button">Volver</a>
           <div class="d-flex justify-content-center links">
           </div>
         </div>
       </form>
     </div>
   </div>
   </div>