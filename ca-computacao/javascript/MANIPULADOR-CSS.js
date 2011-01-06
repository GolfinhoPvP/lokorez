// JavaScript Document
// JavaScript Document
var isIE = (/\bmsie\b/i.test(navigator.userAgent) // � Internet Explorer?
            && document.all && !(/\bopera\b/i.test(navigator.userAgent)));

// propriedades que mudam de nome do IE para o Mozilla...
var rulesName = isIE ? 'rules' : 'cssRules';
//Outra forma � usar o atributo owningElement (IE) / ownerNode (Moz), que aponta para uma refer�ncia ao n�dulo DOM relativo � TAG em quest�o. Da� basta usar o atributo tagName.
var domNode = isIE ? 'owningElement' : 'ownerNode';
var stl = document.styleSheets;

function showCSS() {
	for(var i = 0; i < stl.length; i++) { // para cada elemento de estilo na p�gina
		alert('Elemento '+i+': '+stl[i][domNode].tagName+'\nRegras: '+stl[i][rulesName].length);
    	for(var g = 0; g < stl[i][rulesName].length; g++) { // para cada regra desse elemento
    		alert(stl[i][rulesName][g].selectorText+' {\n'+ // o seletor
          	// o cssText (os replaces apenas colocam quebras de linha e um 
          	// ponto-e-v�rgula no final, caso n�o exista)
          	stl[i][rulesName][g].style.cssText.replace(/;?\s*$/, ';').replace(/;\s*/g, ';\n')+'}');
    	}
  	}
}

/*
var csst = "background-color:#FFC; color:#F60"; font:13px 'trebuchet MS',verdana;";
document.styleSheets[0][rulesName][0].style.cssText = csst; 
*/

function ajustaFundo(){
	var altura = new String();
	var largura = new String();
	
	altura = window.screen.availHeight + 'px';
	largura = window.screen.availWidth + 'px';
	
	document.styleSheets[0][rulesName][3].style.width = largura;
	document.styleSheets[0][rulesName][3].style.height = altura;
	
	return true;
}