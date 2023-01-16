<?php
if(!isset($_SESSION)) 
{session_start();}

 /************VALIDAR SI EXISTE UNA SESION ACTIVA***************/
function validar(){
    if (!empty($_SESSION['requestId'])){
          return true;   
    }
    else {
        return false;
    }
    
}

/************PREPARAR EL JSON PARA INICIAR UNA SESIÓN***************/

function preparejson($reference,$description,$currency,$total){

    include 'config.php';

    $secret = base64_encode(sha1($nonce.$seed.$secretkey,true));
    $nonce64 = base64_encode($nonce);
    
        $json = '{
              "locale": "es_CO",
              "auth": {
                "login": "'.$login.'",
                "tranKey": "'.$secret.'",
                "nonce": "'.$nonce64.'",
                "seed": "'.$seed.'"
              },
          "payment": {
                "reference": "'.$reference.'",
                "description": "'.$description.'",
                "amount": {
                  "currency": "'.$currency.'",
                  "total": '.$total.'
            }
          },'; 
          /*******PERSONAL DATA****** */
          if ($personal == true && !empty($personal)){
          $json = $json.'"payer": {
            "document": "'.$document.'",
            "documentType": "'.$documentType.'",
            "name": "'.$name.'",
            "surname": "'.$surname.'",
            "email": "'.$email.'",
            "mobile": "+57'.$mobile.'"
            },'; 
        }
        $json= $json.
        '"expiration": "'.$expiration.'",
          "returnUrl": "'.$returnUrl.'",
          "ipAddress": "127.0.0.1",
          "userAgent": "PlacetoPay Sandbox"
          
        }';

         
return $json;
}


/************PREPARAR JSON PARA UNA CONSULTA ***************/
function preparejsonconsulta(){
    
    include 'config.php';
    
    $secret = base64_encode(sha1($nonce.$seed.$secretkey,true));
    $nonce64 = base64_encode($nonce);
        $json = '{
              "auth": {
                "login": "'.$login.'",
                "tranKey": "'.$secret.'",
                "nonce": "'.$nonce64.'",
                "seed": "'.$seed.'"
              }
            }';
    return $json;
}
 
/************DEVOLVER AL INICIO EN CASO DE PRESENTARSE ERROR AL CREAR LA PETICION***************/    
function error_procesar($message){
    $err='
        <script>
        alert("Se ha presentado un error intente nuevamente: \n\r '.$message.'");
        setTimeout(location.href="../",10000);
        </script>
    ';
    return $err;
}    

/************DEVOLVER AL INICIO EN CASO DE PRESENTARSE CAMPOS VACIOS AL CREAR LA PETICION***************/  
function campos_vacios(){
    $err='
        <script>
        alert("Datos incompletos diligencie de nuevo");
        setTimeout(location.href="../",8000);
        </script>
    ';
    return $err;
} 
?>