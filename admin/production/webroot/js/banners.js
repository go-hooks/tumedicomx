
function banners(localizacion) {


var sel = document.getElementById("tipo");

for(i=(sel.length-1); i>=0; i--)
{
   aBorrar = sel.options[i];
   aBorrar.parentNode.removeChild(aBorrar);
}


if(localizacion!= '')
{
                    
   if(localizacion=='inicio' || localizacion=='medicos' || localizacion=='hospitales' || localizacion=='laboratorios' || localizacion=='servicios' || localizacion=='empresa' || localizacion=='contacto' || localizacion=='resultados')    
   {
        option = document.createElement("OPTION");
        option.value = 1;
        option.text = 'Banner 1 (960 x 130)';
        sel.add(option);                    
   }

   if(localizacion=='inicio') 
   {
        option = document.createElement("OPTION");
        option.value = 2;
        option.text = 'Banner 2 (960 x 220)';
        sel.add(option);                    
   }

   if(localizacion=='inicio')    
   {
        option = document.createElement("OPTION");
        option.value = 3;
        option.text = 'Banner 3 (400 x 375)';
        sel.add(option);                    
   }

   if(localizacion=='inicio')    
   {
        option = document.createElement("OPTION");
        option.value = 4;
        option.text = 'Banner 4 (400 x 275)';
        sel.add(option);                    
   }

   if(localizacion=='inicio')    
   {
        option = document.createElement("OPTION");
        option.value = 5;
        option.text = 'Banner 5 (400 x 140)';
        sel.add(option);                    
   }
   
   if(localizacion=='blog') 
   {
        option = document.createElement("OPTION");
        option.value = 6;
        option.text = 'Banner 6 (830 x 250)';
        sel.add(option);                    
   }
   
   if(localizacion=='blog') 
   {
        option = document.createElement("OPTION");
        option.value = 7;
        option.text = 'Banner 6 (830 x 110)';
        sel.add(option);                    
   }
   
}

}
