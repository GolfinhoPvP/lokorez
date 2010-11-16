insert into 
	cadastros 
	VALUES 
	("045352", "001", "03502", "1983-12-10", "", "4", "B4", "", "", "", "", "00", "", "000", "", "", "", "", "", "", "", "", "", 9, "15/8/1983", "", 278,23, 0,"", 317,5, "", "", "", "", 1);

INSERT INTO Pessoal (matricula, nome, sexo, CPF, PIS_PASEP, data_nascimento, ultimo_nome, codigo) VALUES ('099714', 'MARIA LENI RODRIGUES DA SILVA ', ' ', ' ', ' ', '0000-00-00', 'SILVA ', 1)
SHOW WARNINGS

SELECT * FROM Cadastros c 
	INNER JOIN inf_bancaria ib
		ON c.matricula = ib.matricula
	INNER JOIN pessoal p
		ON c.matricula = p.matricula
	INNER JOIN rg
		ON c.matricula = rg.matricula
	ORDER BY c.matricula
	

select * from cadastros