
function municipios(estado) {

var sel = document.getElementById("municipio_id");

for(i=(sel.length-1); i>=0; i--)
{
   aBorrar = sel.options[i];
   aBorrar.parentNode.removeChild(aBorrar);
}

if(estado!= 0)
{
            $.ajax({
                url : 'ajax.php',
                data: {funcion: 'municipios', estado : estado}, 
                dataType: 'json',
                type : 'get',
                success: function(response){                   
                                        
//                    console.info(response);
//                    alert(response);
                    for (var i=0;i<response.length; i++) {                                                
                      
                        option = document.createElement("OPTION");
                        option.value = response[i].id;
                        option.text = response[i].municipio;
                        sel.add(option);                    
                    
                    }
  
                    
                    
                },
                error: function (){
                  
                }
            });

}

}
