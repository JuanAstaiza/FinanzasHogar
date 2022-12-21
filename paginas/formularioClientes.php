   <?php

    $accion = "A";

    ?>

   <div class="container col-xl-10 col-xxl-8 px-4 py-5">
     <div class="row align-items-center g-5 py-5">
       <h1>
         <center><b><mark>ADICIONAR MIEMBRO</mark></b></center>
       </h1>
       <br>
       <hr>
       <form id="frmRegistroMiembros" method="post">
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
         <div class="form-floating 3">
           <select class="form-select" name="rol" aria-label="Default select example" disabled>
             <option value="Editor">Editor</option>
           </select>
           <label for="floatingInput"><b>Rol:</b></label>
         </div>
         <label><b>Usuario:</b></label>
         <div class="input-group mb-3">
           <div class="input-group-append">
             <span class="input-group-text"><i class="bi-person-fill"></i></span>
           </div>
           <input type="text" name="usuario" id="txtUsuarioRegistro" class="form-control input_user" required>
           <div class="input-group-append">
             <button id="btn_buscadorUsuariosM" class="btn btn-dark" type="button" title="Buscar Usuario"> <span class="bi bi-search icon"></span> </button>
           </div>
         </div>
         <div class="input-group mb-3">
           <label><b>Contraseña:</b></label>
           <div class="input-group mb-2">
             <div class="input-group-append">
               <span class="input-group-text"><i class="bi-key"></i></span>
             </div>
             <input type="password" name="clave" id="txtPasswordRegistroUsuarios" class="form-control input_pass" value="" required>
             <div class="input-group-append">
               <button id="btn_passwordRegistroUsuarios" class="btn  btn-dark" type="button"> <span class="bi-eye-fill icon"></span> </button>
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
           <input type="hidden" name="id" id="id" value="<?= $id ?>" />
           <input type="hidden" name="accion" id="accion" value="<?= $accion ?>" />
           <button type="reset" class="btn btn-secondary">Limpiar</button>
           <button type="submit" class="btn btn-primary">Guardar cambios</button>
           <a class="btn btn-dark" href="principal.php?CONTENIDO=cuentasapoyo.php" role="button">Volver</a>
           <div class="d-flex justify-content-center links">
           </div>
         </div>
       </form>
     </div>
   </div>
   </div>