<!--VISTA DIRIGIR AL USUARIO A SU PAGO EN PLACETOPAY--->
<html>
  <head>
    <title>Proceder a pago</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  
  <body>
        <div id="navbar">
        <img src="https://static.placetopay.com/placetopay-logo.svg" width="250" height="70">
        </div>
     <div class='center'>
         <h1>Recuerde que:</h1>
         <p>Debe contar con el valor de: <br><b> <?=$_POST['total']?> <?=$_POST['currency']?> </b> <br>Disponibles en su cuenta/tarjeta para proceder a realizar el pago.</p>
        <p>Para continuar con el proceso de pago por favor de clic en el siguiente boton:</p>
        <button id="open" class='btn btn-success'>Realizar pago</button>
    </div>
   </body>
   
  <!--SCRIPT ABRE UNA NUEVA VENTANA CON EL LINK DE PAGO ENTREGADO POR PLACETOPAY-->
     <script>
      function abrirNuevoTab(url) {
        // Abrir nuevo tab
        var win = window.open(url, '_blank');
        // Cambiar el foco al nuevo tab (punto opcional)
        win.focus();
      }
      $('#open').click(function(){
        abrirNuevoTab('<?=$_SESSION['urlPay']?>')
        
        location.replace("../");
      })
     </script> 
    
</html>