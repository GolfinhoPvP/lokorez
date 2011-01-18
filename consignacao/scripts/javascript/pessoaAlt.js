window.onload = function(){
	//carregarLista();
	//loadContent('../pesquisar/getNiveisSL.php', 'slNivel', '../../');
	switch(document.getElementById("tipo").innerHTML){
		case "contato" : document.getElementById("slTipo").value = "contato"; break;
		case "admin" : document.getElementById("slTipo").value = "admin"; break;
		default : document.getElementById("slTipo").value = "---"; break;
	}
	testarTipo();
}
function testarTipo(){
	switch(document.getElementById("slTipo").value){
		case "contato" :
			esconder("apenasAdmin");
			mostrar("apenasContato");
			mostrar("geral");
			break;
		case "admin" :
			esconder("apenasContato");
			mostrar("apenasAdmin");
			mostrar("geral");
			break;
		default :
			esconder("apenasAdmin");
			esconder("apenasContato");
			esconder("geral");
			break;
	}
	validarPessoaForm("slTipo");
}
function carregarLista(){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",'../pesquisar/getPessoasSL.php?classe='+document.getElementById('slTipo').value,true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("slPesRef").innerHTML = xmlRequest.responseText;
				//document.getElementById('slBancRef').value = document.getElementById("valor").innerHTML;
			}
	}
	xmlRequest.send(null);						
}
function carregarAlteracoes(){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",'../pesquisar/getBancosPessoasLista.php?classe='+document.getElementById('slTipo').value,true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("alt").innerHTML = xmlRequest.responseText;
				carregarBancos();
			}
	}
	xmlRequest.send(null);						
}
function carregarBancos(){
	xmlRequest2 = getXMLHttp();

	xmlRequest2.open("GET",'../pesquisar/getBancosSL.php',true);
	
	if (xmlRequest2.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest2.onreadystatechange = function () {
			if (xmlRequest2.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("bancosAlt").innerHTML = xmlRequest2.responseText;
				contador = parseInt(document.getElementById("BPQuantidade").innerHTML);
				for(x=1; x<=contador; x++){
					document.getElementById("bancoAuto").innerHTML += '&Eacute; contato do banco: <select name="slBancRef'+contador+'" id="slBancRef'+contador+'" onchange="javascript: validarPessoaForm(\'slBancRef\');">'+xmlRequest2.responseText+'</select>';
					document.getElementById(("slBancRef"+contador)).value = document.getElementById(("cB"+contador)).innerHTML;
				}
			}
	}
	xmlRequest2.send(null);
}
/*ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff*/
function carregarBancos(){
	xmlRequest2 = getXMLHttp();

	xmlRequest2.open("GET",'../pesquisar/getBancosSL.php',true);
	
	if (xmlRequest2.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest2.onreadystatechange = function () {
			if (xmlRequest2.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("bancosAlt").innerHTML = xmlRequest2.responseText;
				contador = parseInt(document.getElementById("BPQuantidade").innerHTML);
				for(x=1; x<=contador; x++){
					document.getElementById("bancoAuto").innerHTML += '&Eacute; contato do banco: <select name="slBancRef'+contador+'" id="slBancRef'+contador+'" onchange="javascript: validarPessoaForm(\'slBancRef\');">'+xmlRequest2.responseText+'</select>';
					document.getElementById(("slBancRef"+contador)).value = document.getElementById(("cB"+contador)).innerHTML;
				}
			}
	}
	xmlRequest2.send(null);
}