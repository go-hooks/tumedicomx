function validacion(correo,pass1,pass2) 
{
         
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(correo.value) )
    {
        alert("Error: La dirección de correo " + correo.value + " es incorrecta.");
        return false;
    }           
    
    if(pass1.value != pass2.value)
    {
        alert("Error: Las contraseñas no coinciden.");
        return false;        
    }
    
    return true;
}    
   