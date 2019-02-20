function addOnload(newFunction){
	var oldOnload = window.onload;
	if(typeof oldOnload == "function"){
		window.onload = function(){
			if(oldOnload){
				oldOnload();
			}
			newFunction();
		}
	}else{
		window.onload = newFunction;
	}
}

/* <a href="" onclick="return Popup.open({url:this.href});">link</a> */
var Popup = {
    open: function(options) {
        this.options = {
            url: '#',
            width: 600,
            height: 500,
            name: "_blank",
            location: "no",
            menubar: "no",
            toolbar: "no",
            status: "yes",
            scrollbars: "yes",
            resizable: "yes",
            left: "",
            top: "",
            normal: false
        }

        Object.extend(this.options, options || {});

        if (this.options.normal){
            this.options.menubar  = "yes";
            this.options.status   = "yes";
            this.options.toolbar  = "yes";
            this.options.location = "yes";
        }

        this.options.width = 
            (this.options.width < screen.availWidth) ? 
                this.options.width : screen.availWidth;

        this.options.height = 
            (this.options.height < screen.availHeight) ?
                this.options.height:screen.availHeight;
                
        if (this.options.left == "" && this.options.top == "") {
            this.options.left = (screen.availWidth / 2)
                              - (this.options.width / 2);
            this.options.top = (screen.availHeight / 2)
                              - (this.options.height / 2);
        }

        var openoptions = 'width='       + this.options.width
                        + ',height='     + this.options.height
                        + ',location='   + this.options.location
                        + ',menubar='    + this.options.menubar
                        + ',toolbar='    + this.options.toolbar 
                        + ',scrollbars=' + this.options.scrollbars
                        + ',resizable='  + this.options.resizable
                        + ',status='     + this.options.status;

        if (this.options.top != "")  { openoptions += ",top=" + this.options.top; }
        if (this.options.left != "") { openoptions += ",left=" + this.options.left; }

        window.open(this.options.url, this.options.name,openoptions );
        return false;
    }
}


function URLDecode(cadena){
   // Replace + with ' '
   // Replace %xx with equivalent character
   // Put [ERROR] in output if %xx is invalid.
   var HEXCHARS = "0123456789ABCDEFabcdef";
   var encoded = cadena;  // document.URLForm.F2.value;
   var plaintext = "";
   var i = 0;
   while (i < encoded.length) {
       var ch = encoded.charAt(i);
	   if (ch == "+") {
	       plaintext += " ";
		   i++;
	   } else if (ch == "%") {
			if (i < (encoded.length-2)
					&& HEXCHARS.indexOf(encoded.charAt(i+1)) != -1
					&& HEXCHARS.indexOf(encoded.charAt(i+2)) != -1 ) {
				plaintext += unescape( encoded.substr(i,3) );
				i += 3;
			} else {
				alert( 'Bad escape combination near ...' + encoded.substr(i) );
				plaintext += "%[ERROR]";
				i++;
			}
		} else {
		   plaintext += ch;
		   i++;
		}
	} // while
   return plaintext;
}


function mostrar_ocultar(id, muestra, oculta)
{
    
    if($("#"+id).css('display') == 'none'){
       $("#"+id).show();
    }else{
       $("#"+id).hide();
    }
    $("#"+muestra).show();
    $("#"+oculta).hide();
}

function muestra_oculta(id)
{
    if($("#"+id).css('display') == 'none'){
       $("#"+id).show();
    }else{
       $("#"+id).hide();
    }
}



function popup_pagina (pagina) {
    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=750, height=600, top=0, left=0";
    window.open(pagina,"",opciones);
}