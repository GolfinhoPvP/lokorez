// JavaScript Document
var xmlRequest 	= null;
var arrayLoad 	= new Array();
var carregando	= false;

var XMLHTTPREQUEST_MS_PROGIDS = new Array(
  	"Msxml2.XMLHTTP.7.0",
  	"Msxml2.XMLHTTP.6.0",
 	"Msxml2.XMLHTTP.5.0",
  	"Msxml2.XMLHTTP.4.0",
  	"MSXML2.XMLHTTP.3.0",
  	"MSXML2.XMLHTTP",
  	"Microsoft.XMLHTTP"
);

function getXMLHttp() {
	var xmlHttp;
	
    /*if(navigator.appName == "Microsoft Internet Explorer") {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }else {
        xmlHttp = new XMLHttpRequest();
    }*/
	
	if (window.XMLHttpRequest != null) {
    		xmlHttp = new window.XMLHttpRequest();
	}else if (window.ActiveXObject != null) {
   		var success = false;
		for(var i = 0; i < XMLHTTPREQUEST_MS_PROGIDS.length && !success; i++){
			try{
				xmlHttp = new ActiveXObject(XMLHTTPREQUEST_MS_PROGIDS[i]);
				success = true;
			}catch(ex){}
		}
  	}else{
		print("Seu navegador não tem a tecnologia necessária para esse sistema! Tente outro navegador!")
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
				document.getElementById(target).innerHTML 		= xmlRequest.responseText;
				eval(arrayLoad[0][3]);
				arrayLoad.shift();
				carregando = false;
				if(arrayLoad.length != 0){
					carregar(null);
				}
			}
	}
	xmlRequest.send(null);
}

function carregar($arrayC){
	if(arrayLoad.length != 0)
		carregando = true;
	else
		carregando = false;
		
	if($arrayC != null)
		arrayLoad.push($arrayC);
	
	if(carregando == false){
		carregando = true;
		p 	= arrayLoad[0][0];
		t	= arrayLoad[0][1];
		tR	= arrayLoad[0][2];
		loadContent(p, t, tR);
	}
}