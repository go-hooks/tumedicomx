
function hospitales(categoria) {


var sel = document.getElementById("subcategoria_id");

for(i=(sel.length-1); i>=0; i--)
{
   aBorrar = sel.options[i];
   aBorrar.parentNode.removeChild(aBorrar);
}

if(categoria!= 0)
{
            $.ajax({
                url : 'ajax.php',
                data: {funcion: 'hospitales', categoria : categoria}, 
                dataType: 'json',
                type : 'get',
                success: function(response){                   
                                        
                    for (var i=0;i<response.length; i++) {                                                
                      
                        option = document.createElement("OPTION");
                        option.value = response[i].id;
                        option.text = response[i].nombre;
                        sel.add(option);                    
                    
                    }

                    
                },
                error: function (){
                  
                }
            });

}

}
