<?php
// Copyright (c) 2020, Altiria TIC SL
// All rights reserved.
// El uso de este c�digo de ejemplo es solamente para mostrar el uso de la pasarela de env�o de SMS de Altiria
// Para un uso personalizado del c�digo, es necesario consultar la API de especificaciones t�cnicas, donde tambi�n podr�s encontrar
// m�s ejemplos de programaci�n en otros lenguajes y otros protocolos (http, REST, web services)
// https://www.altiria.com/api-envio-sms/

// XX, YY y ZZ se corresponden con los valores de identificacion del
// usuario en el sistema.

include('httpPHPAltiria.php');

require_once '../clasesPrincipales/Conector.php'; 

$altiriaSMS = new AltiriaSMS();

$altiriaSMS->setLogin('jhonatan.e.lopez123@gmail.com');
$altiriaSMS->setPassword('9bg5ahxy');

$altiriaSMS->setDebug(true);

//Use this ONLY with Sender allowed by altiria sales team
//$altiriaSMS->setSenderId('TestAltiria');
//Concatenate messages. If message length is more than 160 characters. It will consume as many credits as the number of messages needed
//$altiriaSMS->setConcat(true);
//Use unicode encoding (only value allowed). Can send ����� but message length reduced to 70 characters
//$altiriaSMS->setEncoding('unicode');

//$sDestination = '346xxxxxxxx';
$sDestination = '57'.$_POST['celular'];
//$sDestination = array('346xxxxxxxx','346yyyyyyyy');

//Generamos una nueva clave
$nuevaClave=rand();
//Generamos el mensaje
$mensaje='Sistema de la Distribuidora Bakery: Su nueva contraseña de ingreso es: '.$nuevaClave;

//ACTUALIZAMOS la clave en la BD.
$bd = conectar();
if (!$bd) return;

$correo=$_POST['correo'];

//BUSCAMOS EL ID DEL USUARIO ATRAVEZ DEL CORREO
$idUSUARIO="SELECT u.id,c.correo_cli  FROM clientes as c, usuarios as u WHERE c.id_usuario=u.id
 UNION SELECT u.id,a.correo_admin FROM administradores as a,usuarios as u WHERE a.id_usuario=u.id";
$res = mysqli_query($bd,$idUSUARIO);
if ($res->num_rows!==0){
    $id="";
    while($reg=mysqli_fetch_array($res)){  //mientras haya registros -> $reg
        if($reg[1]==$correo){
            $id=$reg[0];
            break;
        }
    }
    
    $sql= "UPDATE usuarios SET clave_usuario='$nuevaClave' WHERE id='$id'";
    $datos = mysqli_query($bd,$sql);
    if ($datos){
      $response = $altiriaSMS->sendSMS($sDestination, $mensaje);
        if (!$response){
          echo "<div class='alert alert-danger' role='alert'>El envio ha terminado en error.</div>";
        }else{
          echo "<div class='alert alert-success' role='alert'>Se ha generado nueva clave. Por favor verifique su celular.</div>";
        }
    }else{
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar el registro.</div>";
        echo  mysqli_error($bd);
    }   

}

?>

