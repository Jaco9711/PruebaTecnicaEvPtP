<?php
date_default_timezone_set('America/Bogota');
/************ZONA HORARIA***************/

/***************DATOS PARA JSON**********************/
$returnUrl = 'http://localhost/public_html/';

$login='6dd490faf9cb87a9862245da41170ff2';

$nonce = random_bytes(16);

$seed = date('c');

$secretkey='iQhxZqnRbJe';

/***********TIEMPO DE EXPIRACION**************/
$expiration = strtotime ( '+17 minute' , strtotime ($seed) ) ; 
$expiration = date ( 'c' , $expiration); 

/***********DATOS DE USUARIO OPCIONALES para no diligenciar en la pasarela****************** */
$personal=false; // true - false en caso de false se manda la peticion sencilla  
$document = '1000435000';
$documentType = 'CC';
$name = 'Jhonatan';
$surname = 'Castillo';
$email = 'jaco9711@gmail.com';
$mobile = '3182222232';

?>