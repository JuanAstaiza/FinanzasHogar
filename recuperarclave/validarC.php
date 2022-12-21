<?php
session_start();

require_once '../clasesPrincipales/Conector.php';


$correo=$_POST['txtcorreo'];
   // include("conexion.php");
    $bd = conectar();
    if (!$bd) return;
    $sql = "select c.correo_cli  from clientes as c UNION select a.correo_admin from administradores as a;";
    $res = mysqli_query($bd,$sql);

    if ($res->num_rows==0){
        echo "Correo incorrecto usted no esta registrado en el Sistema (i)";
       // header("Location: ../recuperarclave.php?mensajeI");
    }else{
        $buscador="";
        while($reg=mysqli_fetch_array($res)){  //mientras haya registros -> $reg
            echo$reg[0];
            if($reg[0]==$correo){
                $buscado="Encontrado.";
                break;
            }else{
                $buscado="No encontrado.";
            }
        }
        echo  $buscado;
        if($buscado=="Encontrado."){
          //  echo "PASO Correo encontrado usted esta registrado en el Sistema (i)";
           header("Location: ../recuperarclave.php?mensajeC&correo=$correo");
        }else{
          //  echo "Correo incorrecto usted no esta registrado en el Sistema (i)";
           header("Location: ../recuperarclave.php?mensajeI");
        }
        
    }
    mysqli_close($bd);



?>