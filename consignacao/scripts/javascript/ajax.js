// JavaScript Document
var xmlRequest;

function getXMLHttp() {
	var xmlHttp;
	
    if(navigator.appName == "Microsoft Internet Explorer") {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }else {
        xmlHttp = new XMLHttpRequest();
    }
	
    return xmlHttp;
}

function loadContent(page, target, toRoot){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",page,true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("carregando").innerHTML = "<img src='"+toRoot+"imagens/rotating_arrow.gif' width='20px' height='20px' />";
	}
	
	xmlRequest.onreadystatechange = function () {
			if (xmlRequest.readyState == 4){
				document.getElementById("carregando").innerHTML = "";
				document.getElementById(target).innerHTML = xmlRequest.responseText;
			}
	}
	xmlRequest.send(null);
}