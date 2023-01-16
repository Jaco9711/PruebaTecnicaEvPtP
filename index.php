<?php
include './php/functions.php';
/*********IMPORTAR FUNCIONES************/
if (validar()== false){/*****VALIDACION SI EXISTE UNA TRANSACCION PENDIENTE********/
    include 'iniciarproc.html';
    //SI NO EXISTE PENDIENTE INICIA NUEVA TRANSACCION
    
}
else{
    include 'estado.html';
    //EN CASO DE ENCONTRAR UN PROCESO EXISTENTE REMITIRA A VER SU ESTADO 
}
?>