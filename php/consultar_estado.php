<?php 
if(!isset($_SESSION)) 
{session_start();}

include 'curl.php';
include 'functions.php';

/************SE PREPARA EL JSON PARA LA CONSULTA************/
$json = preparejsonconsulta();

/********SE ESTABLECE EL PARAMETRO CON EL JSON Y SE EJECUTA LA PETICION******/
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);

$data = json_decode($result,true);
curl_close($ch);


/********SE MUESTRAN LOS DATOS DEVUELTOS POR EL SERVICIO AL REQUESTID ACTUAL******/
?>
<div>
    <b><label>Referencia plataforma:</label></b><br>
    <p><?=$data['request']['payment']['reference']?></p>
    
    <?=(!empty($data['payment'][0]['internalReference'])) ?  "<b><label>Referencia interna PlacetoPay:</label></b><br>": '' ; ?>
    <p><?= (!empty($data['payment'][0]['internalReference'])) ? $data['payment'][0]['internalReference'] : '' ;?></p>
    
    <b><label>Estado transaccion:</label></b><br>
    <p><?=(!empty($data['payment'][0]['status']['status'])) ? $data['payment'][0]['status']['status'] : $data['status']['status'] ; ?></p>
    <!--status del proceso general-->
    <!--<p><?=$data['status']['status']?></p>-->
    <!--mensaje del ultimo pago-->
    <!--<p><?=$data['payment'][0]['status']['message']?></p>-->
    <b><label>Total:</label></b><br>
    <p><?=$data['request']['payment']['amount']['total']?> <?=$data['request']['payment']['amount']['currency']?> </p>
    
    <form action='./php/finalizar.php' method='post'>
        <button class='btn btn-danger'>Finalizar</button>
    </form> 
    <!--POR SI SE DESEA VOLVER A LA PASARELA DE PAGO ACTUALMENTE ACTIVA--->
    <?php
    if (!empty($_SESSION["urlPay"] && $data['status']['status'] !='REJECTED')){
    echo "<a href='".$_SESSION['urlPay']."' target='_blank'<button class='btn btn-info'>volver a la pasarela.</button><a/>";
    }
    ?>
    
</div>