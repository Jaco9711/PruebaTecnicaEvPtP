<?php
if(!isset($_SESSION)) 
{session_start();}

include 'functions.php';
include 'curl.php';


/**********************VALIDACION DATOS NO VACIOS PARA CONTINUAR*****************************/    
if (!empty ($_POST['reference']) && !empty ($_POST['description']) && !empty ($_POST['currency']) && !empty ($_POST['total']) ){

    
/*************************SE INVOCA LA FUNCION PARA PREPARAR EL JSON EN FUNCTIONS.PHP*************************************/
$json = preparejson($_POST['reference'],$_POST['description'],$_POST['currency'],$_POST['total']);


/********SE ESTABLECE EL PARAMETRO CON EL JSON Y SE EJECUTA LA PETICION******/
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
curl_close($ch);


/************SE ESTABLECE VARIABLE DE SESION PARA IDENTIFICAR QUE HAY UNA TRANSACCION ACTIVA***************/
$data = json_decode($result,true);

/************SI NOSE SE PRESENTA ERROR EN LA PETICION DIRIGE A VER EL BOTON DE PAGO***************/
if ( $data['status']['status'] == 'OK' || $data['status']['status'] == 'PENDING'){
    
/************SI LA PETICION FUE EXITOSA SE PROCEDE A CREAR LA VARIABLE DE SESSION***************/
$_SESSION['requestId'] = $data['requestId'];

!empty ($_SESSION['urlPay']) == true ? : ($_SESSION['urlPay'] = $data['processUrl']);

            /*******AÑADIR A LOG********/
            $fecha= date('dmY');
            $file = fopen("../logs/reg-$fecha.log", "a");
            fwrite($file, date('d/m/Y h:i A').' | '.$_SESSION['requestId'] .'|'.$_POST['reference']. PHP_EOL);
            fclose($file);
            /*******FIN AÑADIR A LOG********/

include '../payment.php';


}else{
/************SI SE PRESENTA ERROR EN LA PETICION SE DEVUELVE AL INICIO INDICANDO EL ERROR***************/
     echo $data['status']['status'].' | '.$data['status']['message'];
     //echo error_procesar();
       
    }
    
}else{
/************EN CASO DE VENIR CAMPOS VACIOS / EXISTIR UNA SESION SE LLAMA LA FUNCION Y SE DEVUELVE AL INICIO***************/
 echo campos_vacios();
    
}    
?>