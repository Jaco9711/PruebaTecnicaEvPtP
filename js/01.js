//******************************
//       Ajax of 
//*****************************+
  // mostrar info de cualquier php

    function consultar_estado(){
        $.ajax({
            url: "./php/consultar_estado.php",
            method: "POST",
            success: function(data){
                $("#estadoactual").html(data)
            }
                
        })
    }