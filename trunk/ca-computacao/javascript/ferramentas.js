var codigoCM = new String();
var xmlRequest;
var xmlHttp;

function calculaDeslocamento(){
	var larguraDeslocamento = new String();
	
	larguraDeslocamento = "0px";
	
	if(window.screen.availWidth > 800){
		larguraDeslocamento = ((window.screen.availWidth - 800) / 2) + 'px';
	}
	
	return larguraDeslocamento;
}

function centralizador(){
	var larguraDeslocamento = new String();
	
	if(window.screen.availWidth > 800){
		larguraDeslocamento = ((window.screen.availWidth - 800) / 2) + 'px';
		document.getElementById('centro').style.left = larguraDeslocamento;
	}
}

function principal(){
	centralizador();
	document.getElementById('aviso_1').style.left = "-"+calculaDeslocamento();
	fechar('aviso_1');
}

function abrir(identificador){
	document.getElementById(identificador).style.left = "-"+calculaDeslocamento();
}

function fechar(identificador){
	var aux = new String();
	aux = (-432 - ((window.screen.availWidth - 800) / 2)) + 'px';
	document.getElementById(identificador).style.left = aux;
}

function mostrar(identificador){
	document.getElementById(identificador).style.visibility = 'visible';
}

function esconder(identificador){
	document.getElementById(identificador).style.visibility = 'hidden';
}

function validadorcadastroForm(){
	var formNome;
	
	formNome = document.getElementById('cadastroForm');
	if (formNome.matriculaCad.value.length == 0 || formNome.matriculaCad.value.length < 7){
        formNome.matriculaCad.focus();
		alert("Número de matrícula inválido!");
        return false;
	}
	if (formNome.nomeCad.value.length == 0){
        formNome.nomeCad.focus();
		alert("Nome inválido!");
        return false;
   }
   if (formNome.emailCad.value.length == 0 || formNome.emailCad.value.length < 5){
        formNome.emailCad.focus();
		alert("Email inválido!");
        return false;
   }
   if (formNome.emailCad.value.length > 4){
	   	var aux = new String();
		var contem = 0;
		
		aux = formNome.emailCad.value;
		
	   	for(x=0; x < formNome.emailCad.value.length; x++){
			if(aux.charAt(x) == '@' || aux.charAt(x) == '.'){
				contem++;
			}
		}
		
		if(contem < 2){
			formNome.emailCad.focus();
			alert("Email inválido!");
			return false;
		}
   }
   if (formNome.usuarioCad.value.length == 0){
        formNome.usuarioCad.focus();
		alert("Nome de usuário inválido!");
        return false;
   }
   
   if (formNome.senha1Cad.value.length == 0){
        formNome.senha1Cad.focus();
		alert("Senha inválida!");
        return false;
	}
	if (formNome.senha2Cad.value.length == 0){
        formNome.senha2Cad.focus();
		alert("Senha inválida!");
        return false;
   }
   if (formNome.senha1Cad.value.length != formNome.senha2Cad.value.length){
        formNome.senha1Cad.focus();
		alert("Senha inválida!");
        return false;
   }
   if (formNome.telefone1Cad.value.length != 0 && formNome.telefone1Cad.value.length < 14){
        formNome.telefone1Cad.focus();
		alert("Telefone inválido!");
        return false;
	}
	if (formNome.telefone2Cad.value.length != 0 && formNome.telefone2Cad.value.length < 14){
        formNome.telefone2Cad.focus();
		alert("Telefone inválido!");
        return false;
	}
	esconder('telaCadLog');
	return true;
}

function validaTelefone(identificador){
	var aux = new String();
	var aux2 = new String();
	var tam;
	
	aux = document.getElementById(identificador).value;
	tam = document.getElementById(identificador).value.length;
	
	if( (aux.charAt(tam-1) != 0) && (aux.charAt(tam-1) != 1) && (aux.charAt(tam-1) != 2) && (aux.charAt(tam-1) != 3) && (aux.charAt(tam-1) != 4) && (aux.charAt(tam-1) != 5) && (aux.charAt(tam-1) != 6) && (aux.charAt(tam-1) != 7) && (aux.charAt(tam-1) != 8) && (aux.charAt(tam-1) != 9) && (aux.charAt(tam-1) != "(") && (aux.charAt(tam-1) != ")") && (aux.charAt(tam-1) != "-") ){
		for(x=0; x < tam-1; x++){
			aux2 = aux2 + aux.charAt(x);
		}
		document.getElementById(identificador).value = aux2;
	}else{
		if( (tam != 1 && aux.charAt(tam-1) == "(") || (tam != 4 && aux.charAt(tam-1) == ")") || (tam != 5 && aux.charAt(tam-1) == " ") || (tam != 10 && aux.charAt(tam-1) == "-") ){
											for(x=0; x < tam-1; x++){
												aux2 = aux2 + aux.charAt(x);
											}
											document.getElementById(identificador).value = aux2;
											return true;
		}
		if(tam == 4 && aux.charAt(tam-1) != " "){
			aux2 = aux + " ";
			document.getElementById(identificador).value = aux2;
			return true;
		}
		if(tam == 1){
			aux2 = "(" + aux;
			document.getElementById(identificador).value = aux2;
			return true;
		}
		if(tam == 3){
			aux2 = aux + ") ";
			document.getElementById(identificador).value = aux2;
			return true;
		}
		if(tam == 9){
			aux2 = aux + "-";
			document.getElementById(identificador).value = aux2;
			return true;
		}
		if( tam == 14 && ( (aux.charAt(0) != "(") || (aux.charAt(3) != ")") || (aux.charAt(4) != " ") || (aux.charAt(9) != "-") ) ){
			document.getElementById(identificador).value = "";
			return true;
		}
	}
	return true;
}

function validaMatricula(){
	var aux = new String();
	var aux2 = new String();
	var tam;
	
	aux = document.getElementById('matriculaCad').value;
	tam = document.getElementById('matriculaCad').value.length;
	
	if( (aux.charAt(tam-1) != 0) && (aux.charAt(tam-1) != 1) && (aux.charAt(tam-1) != 2) && (aux.charAt(tam-1) != 3) && (aux.charAt(tam-1) != 4) && (aux.charAt(tam-1) != 5) && (aux.charAt(tam-1) != 6) && (aux.charAt(tam-1) != 7) && (aux.charAt(tam-1) != 8) && (aux.charAt(tam-1) != 9) ){
		for(x=0; x < tam-1; x++){
			aux2 = aux2 + aux.charAt(x);
		}
		document.getElementById('matriculaCad').value = aux2;
	}
	
	if(tam == 8){
		for(x=0; x < tam; x++){
			if( (aux.charAt(x) != 1) && (aux.charAt(x) != 2) && (aux.charAt(x) != 3) && (aux.charAt(x) != 4) && (aux.charAt(x) != 5) && (aux.charAt(x) != 6) && (aux.charAt(x) != 7) && (aux.charAt(x) != 8) && (aux.charAt(x) != 9) && (aux.charAt(x) != 0) ){
				document.getElementById('matriculaCad').value = "";
			}
		}
	}
}

function validaMensagem(){
	var quantidade;
	var aux = new String();
	
	quantidade = document.getElementById("mensagemTF").value.length;
	aux = 200 - quantidade;
	document.getElementById("char_alert").innerHTML = "caracteres dispon&iacute;veis "+aux;
	
	if((200 - quantidade) <= 0){
		document.getElementById("char_alert").innerHTML = "limite m&aacute;ximo! Nada al&eacute;m disso ser&aacute; salvo!";
	}
}

function limpar(string){
	document.getElementById(string).value = "";
}

function geraCodigo(){
	codigoCM = parseInt(Math.random() * 1000);
	document.getElementById("cod").innerHTML = codigoCM;
}

function validaCodigo(){
	var valor;
	valor = document.getElementById("codigoTF").value;
	if(valor == codigoCM){
		document.getElementById("notaForm").submit();
	}else{
			alert("Código inválido!");
			geraCodigo();
	}
}

function validaQuantMensa(){
	if(document.getElementById("mensagemTF").value.length > 200){
		document.getElementById("mensagemTF").value = document.getElementById("mensagemTF").value.substring(0,199);
	}
}

function mudarFundo(alvo, valor){
	//document.getElementById(alvo).style.bgColor = valor;
}

function GetXMLHttp() {
    if(navigator.appName == "Microsoft Internet Explorer") {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }else {
        xmlHttp = new XMLHttpRequest();
    }
    return xmlHttp;

}

function carregaPagina(pagina, posicao){
	xmlRequest = GetXMLHttp();
	var url = pagina;
	//xmlRequest.onreadystatechange = mudancaEstado;
	xmlRequest.open("GET",url,true);
	switch(posicao){
		case "telaCadastro" : xmlRequest.onreadystatechange = mudancaEstado1; break;
		case "telaCadLog" : xmlRequest.onreadystatechange = mudancaEstado2; break;
		case "telaPostBox" : xmlRequest.onreadystatechange = mudancaEstado3; break;
		case "telaConfBox" : xmlRequest.onreadystatechange = mudancaEstado4; break;
		case "telaQuemSomos" : xmlRequest.onreadystatechange = mudancaEstado5; break;
		case "telaNota" : xmlRequest.onreadystatechange = mudancaEstado6; break;
	}
	xmlRequest.send(null);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById(posicao).innerHTML = "<img src='imagens/akuma05.gif' width='100' height='82' />";
	}
	return url;
}

function mudancaEstado1(){
	if (xmlRequest.readyState == 4){
		document.getElementById("telaCadastro").innerHTML = xmlRequest.responseText;
	}
}

function mudancaEstado2(){
	if (xmlRequest.readyState == 4){
		document.getElementById("telaCadLog").innerHTML = xmlRequest.responseText;
	}
}

function mudancaEstado3(){
	if (xmlRequest.readyState == 4){
		document.getElementById("telaPostBox").innerHTML = xmlRequest.responseText;
	}
}

function mudancaEstado4(){
	if (xmlRequest.readyState == 4){
		document.getElementById("telaConfBox").innerHTML = xmlRequest.responseText;
		//ESPECIAL
		geraCodigo();
	}
}

function mudancaEstado5(){
	if (xmlRequest.readyState == 4){
		document.getElementById("telaQuemSomos").innerHTML = xmlRequest.responseText;
	}
}

function mudancaEstado6(){
	if (xmlRequest.readyState == 4){
		document.getElementById("telaNota").innerHTML = xmlRequest.responseText;
	}
}