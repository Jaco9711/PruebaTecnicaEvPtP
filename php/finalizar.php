<?php
if(!isset($_SESSION)) 
{session_start();}

/******************ELIMINAMOS LAS VARIABLES DE SESION USADAS****************************/
unset($_SESSION['requestId']);
unset($_SESSION['urlPay']);

/*****************POSTERIOR VOLVEMOS AL A VENTANA DE INICIO*****************/
?>
<script>
window.location.replace("../");
</script>