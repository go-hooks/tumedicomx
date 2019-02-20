function validateFields(name) {
	//alert("amos");
    var elements = document.forms[name].elements;
	for (var i = 0; i < elements.length; i++){
		if (elements[i].className == "checkRequired" || elements[i].className == "error"){
			if(elements[i].name != "email"){
				valor = elements[i].value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					elements[i].className = "error";
					elements[i].focus();
					return false;
				}else{
					elements[i].className = "checkRequired";
				}
			}else{
				valor = elements[i].value;
				if(valor == ""){
					elements[i].className = "checkRequired";
					continue;
				}
				if( !(/^\w+@\w+(\.\w{3})$/.test(valor)) ) {
					elements[i].className = "error";
					elements[i].focus();
					return false;
				}else{
					elements[i].className = "checkRequired";
				}
			}
		}
	}
	return true;
}// JavaScript Document