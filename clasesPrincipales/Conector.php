<?php
    
    function conectar(){
        $bd = mysqli_connect("localhost","root","","finanzas");
        //conectar            servidor   usuario password   base_de_datos

        if (!$bd){
            echo "<h3>Conexión a base de datos fallida<h3>";
            return NULL;
        }
        else{
            return $bd;
        }
    }
