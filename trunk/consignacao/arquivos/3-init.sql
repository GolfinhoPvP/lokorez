INSERT INTO niveis VALUES (1, "Servidor Master"),
				(2, "Servidor Consultor"),
				(3, "Banco Master"),
				(4, "Banco Averbador");

INSERT INTO pessoas (pes_nome, pes_cpf)
	VALUES ("Super Administrdor", "000.000.000-00");

INSERT INTO administradores (pes_codigo, niv_codigo, adm_nome_usuario, adm_senha) 
	VALUES (1, 1, "superadmin", "c3VwZXJBZG1pbg==");

INSERT INTO operacoes VALUES (1, "Conectou"),
				(2, "Desconectou"),
				(3, "Cadastrou"),
				(4, "Alterou"),
				(5, "Deletou"),
				(6, "Incluiu"),
				(7, "Excluiu"),
				(8, "Averbou");

INSERT INTO alvos VALUES (1, "IN-OUT"),
				(2, "Empresas"),
				(3, "Bancos"),
				(4, "Produtos"),
				(5, "Pessoas");
