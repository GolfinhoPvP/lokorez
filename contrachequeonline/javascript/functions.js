// JavaScript Document
function getUserDate(){
	var today = new Date();
	var dateCamps = new Array(3);
	
	dateCamps[0] = today.getDate();
	dateCamps[1] = today.getMonth();
	dateCamps[2] = today.getFullYear();
	
	return dateCamps[0]+"-"+dateCamps[1]+"-"+dateCamps[2];
}