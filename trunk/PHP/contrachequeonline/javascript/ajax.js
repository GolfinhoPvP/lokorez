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

function loadContent(page, target){
	xmlRequest = getXMLHttp();

	xmlRequest.open("GET",page,true);
	
	if (xmlRequest.readyState == 1) {
		document.getElementById("loading").innerHTML = "<img src='images/rotating_arrow.gif' width='20px' height='20px' />";
	}
	
	xmlRequest.onreadystatechange = function () { if (xmlRequest.readyState == 4){
		document.getElementById("loading").innerHTML = "";
		document.getElementById(target).innerHTML = xmlRequest.responseText;
	}
	}
	
	xmlRequest.send(null);
}