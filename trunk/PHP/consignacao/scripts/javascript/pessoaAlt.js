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
			}
	}
	xmlRequest.send(null);						
}
function carregarAlteracoes(){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",'../pesquisar/getBancosPessoasLista.php?ordem='+document.getElementById('slTipo').value+'&key='+document.getElementById('slPesRef').value,true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("alt").innerHTML = xmlRequest.responseText;
				carregarPessoa();
			}
	}
	xmlRequest.send(null);						
}

function carregarPessoa(){
	xmlRequest2 = getXMLHttp();

	xmlRequest2.open("GET",'../pesquisar/getPessoaAlt.php?key='+document.getElementById('slPesRef').value,true);
	
	if (xmlRequest2.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest2.onreadystatechange = function () {
			if (xmlRequest2.readyState == 4){
				limpar();
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("alt").innerHTML += xmlRequest2.responseText;
				document.getElementById("tfNome").value = document.getElementById("B").innerHTML;
				document.getElementById("tfCPF").value = document.getElementById("C").innerHTML;
				carregarTelefones();
			}
	}
	xmlRequest2.send(null);
}

function carregarTelefones(){
	xmlRequest1 = getXMLHttp();

	xmlRequest1.open("GET",'../pesquisar/getTelefonesLista.php?key='+document.getElementById('slPesRef').value,true);
	
	if (xmlRequest1.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest1.onreadystatechange = function () {
			if (xmlRequest1.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("bancosAlt").innerHTML = xmlRequest1.responseText;
				contador = parseInt(document.getElementById("TQuantidade").innerHTML);
				for(x=1; x<=contador; x++){
					document.getElementById("fonesAuto").innerHTML += '<span class="texto2">Telefone para contato: </span><input name="tfPesFone'+x+'" type="text" class="tf1" id="tfPesFone'+x+'" size="12" maxlength="12" onkeyup="javascript: validarBancoForm(\'tfPesFone'+cont+'\');"/><label class="alerta1"> Ex: XX-XXXX-XXXX </label><br />';
					
					//'Telefone para contato: <input name="tfTelRef'+x+'" type="text" id="tfTelRef'+x+'" size="12" maxlength="12" onkeyup="javascript: validarPessoaForm(\'tfPesFone\');"/> Ex: XX-XXXX-XXXX <br/>';
					document.getElementById(("tfTelRef"+x)).value = document.getElementById(("tN"+x)).innerHTML;
				}
				carregarBancos();
			}
	}
	xmlRequest1.send(null);
}

function carregarBancos(){
	xmlRequest3 = getXMLHttp();

	xmlRequest3.open("GET",'../pesquisar/getBancosSL.php',true);
	
	if (xmlRequest3.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	xmlRequest3.onreadystatechange = function () {
			if (xmlRequest3.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById("bancosAlt").innerHTML = xmlRequest3.responseText;
				contador = parseInt(document.getElementById("BPQuantidade").innerHTML);
				for(x=1; x<=contador; x++){
					document.getElementById("bancoAuto").innerHTML += '<span class="texto2">&Eacute; contato do banco: </span><select name="slBancRef'+x+'" id="slBancRef'+x+'" class="tf1" onchange="javascript: validarPessoaForm(\'slBancRef\');">'+xmlRequest3.responseText+'</select>';
					document.getElementById(("slBancRef"+x)).value = document.getElementById(("cB"+x)).innerHTML;
				}
			}
	}
	xmlRequest3.send(null);
}

function limpar(){
	document.getElementById("bancoAuto").innerHTML = "";
	document.getElementById("fonesAuto").innerHTML = "";
	document.getElementById("telefone").innerHTML = "";
	document.getElementById("banco").innerHTML = "";
}