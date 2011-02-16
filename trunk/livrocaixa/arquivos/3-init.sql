INSERT INTO status VALUES (1, "Pendente"),
				(2, "Quitada"),
				(3, "Parcialmente paga");

INSERT INTO tipos VALUES (1, "Banco"),
				(2, "Cofre");

INSERT INTO niveis VALUES (1, "Super Administrdos"),
				(2, "Administrador"),
				(3, "Super Funcionário"),
				(4, "funcionário");

INSERT INTO operacoes VALUES (1, "Conectou"),
				(2, "Desconectou"),
				(3, "Cadastrou"),
				(4, "Alterou"),
				(5, "Deletou"),
				(6, "Incluiu"),
				(7, "Excluiu"),
				(8, "Averbou");

INSERT INTO alvos VALUES (1, "IN-OUT"),
				(2, "Clientes"),
				(3, "Pessoas"),
				(4, "Emails"),
				(5, "Teelfones"),
				(6, "Funcionarios"),
				(7, "Empresas"),
				(8, "Classe"),
				(9, "Forma Pagamento"),
				(10, "Servidores"),
				(11, "Lançamentos"),
				(12, "Plano Conta"),
				(13, "Serviços"),
				(14, "Solicitações"),
				(15, "Tecnicos"),
				(16, "Produtos"),
				(17, "Sangrias"),
				(18, "Bancos");

INSERT INTO pessoas (pes_nome, pes_cpf, pes_rg)
	VALUES ("Super Administrador", "000.000.000-00", "00000");

INSERT INTO clientes (pes_codigo, niv_codigo, cli_codigo_pai, cli_nome_usuario, cli_senha) 
	VALUES (1, 1, 1, "superadmin", "c3VwZXJBZG1pbg==");
