INSERT INTO niveis VALUES (1, "Servidor Master"),
				(2, "Servidor Consultor"),
				(3, "Banco Master"),
				(4, "Banco Averbador");

INSERT INTO administradores (niv_codigo, adm_nome, adm_nome_usuario, adm_senha) 
	VALUES (1, "Super Administrador", "superadmin", "c3VwZXJBZG1pbg==");

INSERT INTO operacoes VALUES (1, "Conectou"),
				(2, "Desconectou"),
				(3, "Cadastrou"),
				(4, "Deletou"),
				(5, "Incluiu"),
				(6, "Excluiu"),
				(7, "Averbou");