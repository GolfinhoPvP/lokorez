USE contrachequeonline;


/*
	Starter Admin named "admin" and password "fmssuperadmin"
*/
INSERT INTO 
	administradores (usuario, senha) 
	VALUES 
	('admin', 'ff744c5f4cdf0d3c6dd01178bc595418');


/*
	Starter Folhas
*/

INSERT INTO
	Folhas
	VALUES
	(1, "FDCS", "Folha de disposição, comissionados e serviços prestados"),
	(2, "FMSA", "Fundação Municipal de Saúde - Ativo"),
	(3, "FPUM", "Folha de unidades municipalizadas"),
	(4, "PACS", "Folha de agentes comunitários de saúde.");