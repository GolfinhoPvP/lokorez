USE contrachequeonline;

INSERT INTO niveis (descricao_nivel)
	VALUES
		("Master"),
		("Cadastrador");


/*
	Starter Admin named "admin" and password "fmssuperadmin"
*/
INSERT INTO 
	administradores (id_nivel, usuario, senha) 
	VALUES 
	(1, 'admin', 'ff744c5f4cdf0d3c6dd01178bc595418');


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

INSERT INTO
	estado_civil
	VALUES
	(1, "Solteiro(a)"),
	(2, "Casado(a)"),
	(3, "Divorciado(a)"),
	(4, "Viúvo(a)");

INSERT INTO
	sexo
	VALUES
	(1, "Masculino"),
	(2, "Feminino");

INSERT INTO
	categoria
	VALUES
	("A"),
	("AB"),
	("B"),
	("C"),
	("D"),
	("E");