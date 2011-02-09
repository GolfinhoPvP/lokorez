// JavaScript Document
function showReference(id1, id2, val){
	valList = val.split(":");
	for(x=0; x<valList.length; x++){
		if(document.getElementById(id1).value == valList[x]){
			document.getElementById(id2).className = "visible";
			break;
		}else{
			document.getElementById(id2).className = "invisible";
		}
	}
}
function getCityes(from, to){
	loadContent("utils/getCityes.php?uf="+document.getElementById(from).value, to);
}
function hideAutoComplete(time){
	setTimeout("document.getElementById('autoComplete').style.visibility = 'hidden'",time);
}
function getSource(source, target){
	text = document.getElementById(target).value;
	if(((text.length % 3) == 0) || target == "slCidade"  || target == "slUFEnd"){
		div = document.getElementById("autoComplete");
		t = document.getElementById(target);
		div.style.top =  (findPosY(t)+3)+"px";
		div.style.left = (findPosX(t)+2)+"px";
		div.style.visibility = "visible";
		uf = document.getElementById("slUFEnd").value;
		cep = document.getElementById("tfCEP").length < 10 ? "%" : document.getElementById("tfCEP").value;
		bairro = urlencode(document.getElementById("tfBairro").value);
		logradouro = urlencode(document.getElementById("tfTipoLog").value);
		cidade = urlencode(document.getElementById("slCidade").value);
		
		loadContent("utils/"+source+".php?uf="+uf+"&cep="+cep+"&cidade="+cidade+"&bairro="+bairro+"&logradouro="+logradouro+"&text="+text, "autoComplete");
	}
}
function setLogradouto(id, target){
	document.getElementById(target).value = document.getElementById(id).innerHTML;
	document.getElementById("tfEndID").value = id;
	hideAutoComplete(0);
}
function setaFoco(elemento, e)  {
	var evento 	= (window.event) ? event : e;
	var keyCode = evento.keyCode ? evento.keyCode : evento.which ? evento.which : evento.charCode;
	if (keyCode == 13) {  
		var i;  
		for (i = 0; i < elemento.form.elements.length; i++)  
			if (elemento == elemento.form.elements[i])  
				break;  
		i = (i + 1) % elemento.form.elements.length;  
		elemento.form.elements[i].focus();  
		evento.preventDefault();  
		return false;  
	}  
	return false;  
}

function validarForm(id){
	switch(id){
		case "tfNomePai" :
			case "tfEndBairro" :
			case "tfEndTipLog" :
			case "tfNomeMae" :
			case "tfEndereco":
			case "tfFormac" :
			case "tfVincFund" :
			case "tfDispos" :
			case "tfCargCont" :
			case "tfFuncExer" :
			case "tfUnid" :
			case "tfNomeServ" : descricaoExpReg = /^([a-zA-Z0-9]| |[ÁáÉéÍíÔôÚúÊêçãõ]|[-_\.]){4,150}$/; break;
		case "tfCartTrabSerie" :
			case "tfCartResRM" :
			case "tfCartResCSM" :
			case "tfNomeConj" :
			case "tfEndQuad" :
			case "tfCartAbilit" :
			case "tfRegProfSigla" :
			case "tfRegProfRegi" :
			case "tfUnidMicAre" :
			case "tfUnidPSF" :
			case "tfCartTrab" : descricaoExpReg = /^([a-zA-Z0-9]| |[ÁáÉéÍíÔôÚúÊêçãõ]|[-_\.\\\/]){0,150}$/; break;
		case "tfNIT" :
			case "tfRGOrgExep" :
			case "tfTitEleit" :
			case "tfCartRes" : descricaoExpReg = /^([a-zA-Z0-9]| |[-_\.\\\/]){2,150}$/; break;
		case "tfBanc" :
			case "tfRegProf" :
			case "tfBancCont" :
			case "tfCertCiv" :
			case "tfCertCivTermo" :
			case "tfCertCivFolha" :
			case "tfCertCivLivro" :
			case "tfBancAgen" : descricaoExpReg = /^([a-zA-Z0-9]| |[-_\.\\\/]){0,150}$/; break;
		case "tfTitEleitZonSec" : descricaoExpReg = /^[0-9]{2,6}\/[0-9]{2,6}$/; break;
		case "tfEndCEP" : descricaoExpReg = /^[0-9]{5,5}-[0-9]{2,2}$/; break;
		case "tfRG" : descricaoExpReg = /^([ ]{0,30}|([0-9]|\.|-){0,30})$/; break;
		case "tfCPF" : descricaoExpReg = /^([ ]{0,14}|[0-9]{3,3}\.[0-9]{3,3}\.[0-9]{3,3}-[0-9]{2,2})$/; break;
		case "tfEndFone" : descricaoExpReg = /^[0-9]{2,2}-[0-9]{4,4}-[0-9]{4,4}$/; break;
		case "slCartTrabUf" :
			case "slSexo" :
			case "slEstadCivi" :
			case "slTitEleitUF" :
			case "slDatNascUF" :
			case "slDatNascNatural" :
			case "slEndUF" :
			case "slEndCida" :
			case "slEndResDesMes" :
			case "slGrauInst" : descricaoExpReg = /[^---]/; break;
		case "tfCartTrabDatEmis" :
			case "tfNITDatEmis" :
			case "tfRGDatEmis" : descricaoExpReg = /^( |[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4})$/; break;
		case "tfDatNasc" : descricaoExpReg = /^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/; break;
		case "tfEndNumCas" : descricaoExpReg = /^[0-9]{1,30}$/; break;
		case "tfEndResDesAno" : descricaoExpReg = /^[0-9]{0,30}$/; break;
		default : return true;
	}
	
	if(document.getElementById(id).value.match(descricaoExpReg)){
		document.getElementById(id).style.background = "#FFFFFF";
		return true;
	}else{
		document.getElementById(id).style.background = "#FF0000";
	}
	return false;
}

function validarCadastro(){
	lista = new Array("tfNomePai", "tfNomeMae", "tfEndereco", "tfFormac", "tfVincFund", "tfDispos", "tfCargCont", "tfFuncExer", "tfUnid", "tfNomeServ", "tfCartTrabSerie", "tfCartResRM", "tfCartResCSM", "tfNomeConj", "tfEndTipLog", "tfEndQuad", "tfEndBairro", "tfCartAbilit", "tfRegProfSigla", "tfRegProfRegi", "tfUnidMicAre", "tfUnidPSF", "tfCartTrab", "tfNIT", "tfRGOrgExep", "tfTitEleit", "tfCartRes", "tfBanc", "tfRegProf", "tfBancCont", "tfCertCiv", "tfCertCivTermo", "tfCertCivFolha", "tfCertCivLivro", "tfBancAgen", "tfTitEleitZonSec", "tfEndCEP", "tfRG", "tfCPF", "tfEndFone", "slCartTrabUf", "slSexo", "slEstadCivi", "slTitEleitUF", "slDatNascUF", "slDatNascNatural", "slEndUF", "slEndCida", "slEndResDesMes", "slGrauInst", "tfCartTrabDatEmis", "tfNITDatEmis", "tfRGDatEmis", "tfDatNasc", "tfEndNumCas", "tfEndResDesAno");
	
	for(x=0; x<lista.length; x++){
		if(!validarForm(lista[x]))
			return false;
	}
	return true;
}