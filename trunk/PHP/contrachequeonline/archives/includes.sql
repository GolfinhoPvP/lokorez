insert into 
	cadastros 
	VALUES 
	("045352", "001", "03502", "1983-12-10", "", "4", "B4", "", "", "", "", "00", "", "000", "", "", "", "", "", "", "", "", "", 9, "15/8/1983", "", 278,23, 0,"", 317,5, "", "", "", "", 1);

INSERT INTO Pessoal (matricula, nome, sexo, CPF, PIS_PASEP, data_nascimento, ultimo_nome, codigo) VALUES ('099714', 'MARIA LENI RODRIGUES DA SILVA ', ' ', ' ', ' ', '0000-00-00', 'SILVA ', 1)
SHOW WARNINGS

SELECT c.matricula, c.lotacao FROM Cadastros c 
	INNER JOIN inf_bancaria ib
		ON c.matricula = ib.matricula
	INNER JOIN pessoal p
		ON c.matricula = p.matricula
	INNER JOIN rg
		ON c.matricula = rg.matricula


SELECT * FROM Calculos cl 
	INNER JOIN Cadastros cd 
	ON cl.matricula = cd.matricula
	INNER JOIN Lotacoes lo
	ON cd.lotacao = lo.lotacao
	INNER JOIN Cargos cg
	ON cd.cargo = cg.cargo
	INNER JOIN Pessoal ps
	ON cd.matricula = ps.matricula
	INNER JOIN Eventos ev
	ON cl.eve_codigo = ev.codigo_eve
	where cl.matricula = "045352" and cl.data BETWEEN "2010-09-31" and "2010-11-01"


DELETE FROM calculos WHERE data = '2010-10-22'

INSERT INTO administradores (usuario, senha) VALUES ('admin', 'ff744c5f4cdf0d3c6dd01178bc595418');