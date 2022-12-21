$(document).ready(function(){

     // ::::::::::::::::: OJO DE INPUT PASSWORD :::::::::::::::::
   
     
    $("#btn_passwordRegistroUsuarios").click(function(){
        var cambio = document.getElementById("txtPasswordRegistroUsuarios");
        if(cambio.type == "text"){
            cambio.type = "password";
            $('.icon').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }else{
            cambio.type = "text";
            $('.icon').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        }
    
    });


    //:::::::::::::::::: PERFIL ::::::::::::::::::

    $("#btn_editarPerfil").click(function(){
        $("#nombres").removeAttr("readonly");
        $("#apellidos").removeAttr("readonly");
        $("#telefono").removeAttr("readonly");
        $("#email").removeAttr("readonly");
        $("#rol").removeAttr("readonly");
        $("#txtPasswordRegistroUsuarios").removeAttr("readonly");
    });


    // ::::::::::::::::: CLIENTES :::::::::::::::::

    $("#frmRegistroCliente").submit(function(evt){
        evt.preventDefault();
        var accion = $("#accion").val();
       $.ajax({
           url: "paginas/clientesActualizar.php?accion="+accion,
           type: "post",
           data: $("#frmRegistroCliente").serialize(),
           beforeSend: function(){
               $("#divresR").html("<img src='img/ajax-loader.gif'>");
           },
           success: function(datos){
            console.log(datos); //Mostrar datos en la consola
            $("#divresR").html(datos);
            $("#nombres").attr('readonly','readonly');
            $("#apellidos").attr('readonly','readonly');
            $("#telefono").attr('readonly','readonly');
            $("#email").attr('readonly','readonly');
            $("#rol").attr('readonly','readonly');
            $("#txtPasswordRegistroUsuarios").attr('readonly','readonly');
           },error: function (e) {
               console.log(e.message);
       }
       });

    });


     // ::::::::::::::::: MIEMBROS :::::::::::::::::

     $("#frmRegistroMiembros").submit(function(evt){
        evt.preventDefault();
        var accion = $("#accion").val();
       $.ajax({
           url: "paginas/clientesActualizarMiembros.php?accion="+accion,
           type: "post",
           data: $("#frmRegistroMiembros").serialize(),
           beforeSend: function(){
               $("#divres").html("<img src='img/ajax-loader.gif'>");
           },
           success: function(datos){
            console.log(datos); //Mostrar datos en la consola
            $("#divres").html(datos);            
           },error: function (e) {
               console.log(e.message);
       }
       });

    });
    
    $("#btn_buscadorUsuariosM").click(function(evt){
        var usuario = $("#txtUsuarioRegistro").val();
        $.ajax({
           url: "paginas/clientesActualizarMiembros.php?accion=B&usuario="+usuario,
           type: "post",
           data: $("#btn_buscadorUsuarios").serialize(),
           beforeSend: function(){
               $("#divresU").html("<img src='img/ajax-loader.gif'>");
           },
           success: function(datos){
               console.log(datos); //Mostrar datos en la consola
               $("#divresU").html(datos);
           }
       }); 
   });

   $("#frmBusquedaUsuariosMiembros").keyup(function(){
    $.ajax({
   url: "paginas/clientesActualizarMiembros.php?accion=BU",
   type: "post",
   data: $("#frmBusquedaUsuariosMiembros").serialize(),
   beforeSend: function(){
       $("#divresBU").html("<img src='img/ajax-loader.gif'>");
   },
   success: function(datos){
        //console.log(datos); //Mostrar datos en la consola
        //captura datos y almacenarlos    
        $datosUsuario=datos.split("]]")[0];
        $("#listadoUsuarios").html($datosUsuario); //aviso
        $aviso=datos.split("]]")[1];
        $("#divresBU").html($aviso); //aviso
   },error: function (e) {
       console.log(e.message);
}
});      

});

   //:::::::::::::::::    GASTOS ::::::::::::::::::::::
   var contAbono=0;
   var miArray = new Array(1);
   $('#tipoGasto').change(function() {
    contAbono++;
    if(contAbono==1){
        var listaDespegable= $("#listadespegable").html();
        miArray[0] = listaDespegable; 
    }

    var tipo=$("#tipoGasto").val();
    var texto=""
        if(tipo=="Abono Proyección"){
            $("#descripcion").html(""); 
            $("#listadespegable").html(miArray[0]); 
            $("#objetivos").removeAttr('disabled');
        }else{
            texto+="<label for='exampleFormControlTextarea1' class='form-label'><b>Descripción:</b></label>";
            texto+="<textarea name='descripcion' class='form-control' id='exampleFormControlTextarea1' rows='2' required></textarea>";
            texto+="</div>";            
            $("#descripcion").html(texto); 
            $("#listadespegable").html(""); 
        }

        

    
});

    $("#frmRegistroGastos").submit(function(evt){
        evt.preventDefault();

        var fechaGasto =  new Date($("#fecha").val());   
        var fechaActual = new Date();
        
        var difference= Math.abs(fechaGasto-fechaActual);
        var days = difference/(1000 * 3600 * 24);


        if(Math.round(days-1)>30){
            var aviso="<div class='alert alert-danger' role='alert'>Ha excedido. Fecha limite de ingreso de datos maximo 30 dias.</div>";
            $("#divresR").html(aviso); 
            //$("#frmRegistroGastos")[0].reset();                
        }else if(fechaGasto>fechaActual){
            var aviso="<div class='alert alert-danger' role='alert'>No es posible ingresar un gasto a futuro.La Fecha debe ser menor o igual a la ACTUAL.</div>";
            $("#divresR").html(aviso); 
            //$("#frmRegistroGastos")[0].reset();                
        }else{
            var accion = $("#accion").val();
            $.ajax({
                url: "paginas/gastosActualizar.php?accion="+accion,
                type: "post",
                data: $("#frmRegistroGastos").serialize(),
                beforeSend: function(){
                    $("#divresR").html("<img src='img/ajax-loader.gif'>");
                },
                success: function(datos){
                     console.log(datos); //Mostrar datos en la consola
                     //captura datos y almacenarlos en imput    
                         $("#divresR").html(datos); //aviso
                         $("#frmRegistroGastos")[0].reset();                
                },error: function (e) {
                    console.log(e.message);
            }
            });
        }       
    

    });

    //:::::::::::::::::    INGRESOS  ::::::::::::::::::::::
    
    $("#frmRegistroIngreso").submit(function(evt){
        evt.preventDefault();

        var fechaIngresado =  new Date($("#fecha").val());   
        var fechaActual = new Date();
     
        var difference= Math.abs(fechaIngresado-fechaActual);
        var days = difference/(1000 * 3600 * 24);

        if(Math.round(days-1)>30){
            var aviso="<div class='alert alert-danger' role='alert'>Ha excedido. Fecha limite de ingreso de datos maximo 30 dias.</div>";
            $("#divresR").html(aviso); 
            //$("#frmRegistroGastos")[0].reset();                
        }else if(fechaIngresado>fechaActual){
                var aviso="<div class='alert alert-danger' role='alert'>No es posible ingresar un ingreso a futuro.La Fecha debe ser menor o igual a la ACTUAL.</div>";
            $("#divresR").html(aviso); 
            //$("#frmRegistroGastos")[0].reset();                
        }else{
            var accion = $("#accion").val();
            $.ajax({
                url: "paginas/ingresosActualizar.php?accion="+accion,
                type: "post",
                data: $("#frmRegistroIngreso").serialize(),
                beforeSend: function(){
                    $("#divresR").html("<img src='img/ajax-loader.gif'>");
                },
                success: function(datos){
                     console.log(datos); //Mostrar datos en la consola
                     //captura datos y almacenarlos en imput    
                         $("#divresR").html(datos); //aviso
                         $("#frmRegistroIngreso")[0].reset();                
                },error: function (e) {
                    console.log(e.message);
            }
            });
        }       
    


    });
  

       //:::::::::::::::::    OBJETIVOS  ::::::::::::::::::::::
    
       $("#frmRegistroObjetivo").submit(function(evt){
        evt.preventDefault();
        var accion = $("#accion").val();
       $.ajax({
           url: "paginas/objetivosActualizar.php?accion="+accion,
           type: "post",
           data: $("#frmRegistroObjetivo").serialize(),
           beforeSend: function(){
               $("#divresR").html("<img src='img/ajax-loader.gif'>");
           },
           success: function(datos){
                console.log(datos); //Mostrar datos en la consola
                //captura datos y almacenarlos en imput    
                    $("#divresR").html(datos); //aviso
                    $("#frmRegistroObjetivo")[0].reset();                
           },error: function (e) {
               console.log(e.message);
       }
       });

    });
                
 


});
