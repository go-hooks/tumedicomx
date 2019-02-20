
function invasivos(localizacion) {


var sel = document.getElementById("tipo");

for(i=(sel.length-1); i>=0; i--)
{
   aBorrar = sel.options[i];
   aBorrar.parentNode.removeChild(aBorrar);
}

if(localizacion!= '')
{
                    
   if(localizacion=='home' || localizacion=='blog' || localizacion=='medicos' || localizacion=='hospitales' || localizacion=='laboratorios' || localizacion=='servicios' || localizacion=='proveedores' )    
   {
        option = document.createElement("OPTION");
        option.value = 1;
        option.text = 'Banner 1 (800 x 500)';
        sel.add(option);                    
   }

   
}

}
