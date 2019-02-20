
function subcategorias(categoria) {

var sel = document.getElementById("subcategoria_id");

for(i=(sel.length-1); i>=0; i--)
{
   aBorrar = sel.options[i];
   aBorrar.parentNode.removeChild(aBorrar);
}

if(categoria!= 0)
{
            $.ajax({
                url : 'index.php?request=ajax/hospitalSubcategoria',
                data: {categoria : categoria}, 
                dataType: 'json',
                type : 'get',
                success: function(response){                   
                                        
                    //console.info(response);
                    
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
