// JavaScript Document
function centralizador(id, w, h){
	document.getElementById(id).style.top = ((screen.availHeight*0.9 - h)/2)+"px";
	document.getElementById(id).style.left = ((screen.availWidth*0.9 - w)/2)+"px";
}