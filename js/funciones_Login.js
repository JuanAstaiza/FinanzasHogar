
$(document).ready(function(){  

    $("#btn_passwordRegistro").click(function(){
        var cambio = document.getElementById("txtPasswordRegistro");
        if(cambio.type == "text"){
            cambio.type = "password";
            $('.icon').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }else{
            cambio.type = "text";
            $('.icon').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        }
    
    });

    $("#btn_password").click(function(){
        var cambio = document.getElementById("txtPassword");
        if(cambio.type == "text"){
            cambio.type = "password";
            $('.icon').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }else{
            cambio.type = "text";
            $('.icon').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        }
    
    });
    
    
    $("#frmRegistro").submit(function(evt){
         evt.preventDefault();
        $.ajax({
            url: "paginas/clientesActualizar.php?accion=A",
            type: "post",
            data: $("#frmRegistro").serialize(),
            beforeSend: function(){
                $("#divres").html("<img src='img/ajax-loader.gif'>");
            },
            success: function(datos){
                console.log(datos); //Mostrar datos en la consola
                $("#divres").html(datos);
                $("#frmRegistro")[0].reset();   
                $("#divresU").html("")             
            }
        }); 

    });

    $("#btn_buscadorUsuarios").click(function(evt){
        var usuario = $("#txtUsuarioRegistro").val();
        $.ajax({
           url: "paginas/clientesActualizar.php?accion=B&usuario="+usuario,
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



    
});
