   <?php

    $accion = "A";

    ?>

   <div class="container col-xl-10 col-xxl-8 px-4 py-5">
     <div class="row align-items-center g-5 py-5">
       <h1>
         <center><b><mark>ADICIONAR INGRESO</mark></b></center>
       </h1>
       <br>
       <hr>
       <form id="frmRegistroIngreso" method="post">
         <div class="form-floating 3">
           <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha" required>
           <label for="floatingInput"><b>Fecha:</b></label>
         </div>
         <div class="form-floating 3">
           <input type="number" name="valor" class="form-control" placeholder="Valor" min="10000" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" required>
           <label for="floatingInput"><b>Valor:</b></label>
         </div>
         <div class="mb-3">
           <label for="floatingInput"><b>Tipo de Ingreso:</b></label>
           <select class="form-select" name="tipoIngreso" aria-label="Default select example" required>
             <option value="Salario">Salario</option>
             <option value="Regalías">Regalías</option>
             <option value="Comisiones">Comisiones</option>
             <option value="Herencia">Herencia</option>
             <option value="Empresa">Empresa</option>
             <option value="Ayuda del Gobierno">Ayuda del Gobierno</option>
             <option value="Otros">Otros</option>
           </select>
         </div>
         <div class="mb-3">
           <label for="exampleFormControlTextarea1" class="form-label"><b>Descripción:</b></label>
           <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1" rows="2" required></textarea>
         </div>
         <div id="divresR"></div>
         <div class="modal-footer">
           <input type="hidden" name="id" id="id" value="<?= $id ?>" />
           <input type="hidden" name="accion" id="accion" value="<?= $accion ?>" />
           <button type="reset" class="btn btn-secondary">Limpiar</button>
           <button type="submit" class="btn btn-primary">Guardar cambios</button>
           <a class="btn btn-dark" href="principal.php?CONTENIDO=ingresos.php" role="button">Volver</a>
           <div class="d-flex justify-content-center links">
           </div>
         </div>
       </form>
     </div>
   </div>
   </div>