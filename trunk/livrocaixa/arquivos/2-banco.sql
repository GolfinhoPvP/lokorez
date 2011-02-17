/*
Created		1/19/2011
Modified		2/16/2011
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS tipos;
drop table IF EXISTS bancos;
drop table IF EXISTS sangria_banco;
drop table IF EXISTS sangria_cofre;
drop table IF EXISTS sangrias;
drop table IF EXISTS convenios;
drop table IF EXISTS status;
drop table IF EXISTS classe;
drop table IF EXISTS niveis;
drop table IF EXISTS funcionarios;
drop table IF EXISTS forma_pagamento;
drop table IF EXISTS alvos;
drop table IF EXISTS logs;
drop table IF EXISTS operacoes;
drop table IF EXISTS tecnicos;
drop table IF EXISTS plano_conta;
drop table IF EXISTS solicitacoes;
drop table IF EXISTS lancamentos;
drop table IF EXISTS servicos;
drop table IF EXISTS produtos;
drop table IF EXISTS emails;
drop table IF EXISTS telefones;
drop table IF EXISTS pessoas;
drop table IF EXISTS empresas;
drop table IF EXISTS clientes;


Create table clientes (
	cli_codigo Serial NOT NULL AUTO_INCREMENT,
	pes_codigo Bigint UNSIGNED NOT NULL,
	niv_codigo Smallint NOT NULL,
	cli_codigo_pai Bigint UNSIGNED NOT NULL,
	cli_nome_usuario Varchar(15),
	cli_senha Varchar(25),
	UNIQUE (cli_nome_usuario),
 Primary Key (cli_codigo)) ENGINE = InnoDB;

Create table empresas (
	emp_codigo Serial NOT NULL AUTO_INCREMENT,
	emp_nome Varchar(100),
 Primary Key (emp_codigo)) ENGINE = InnoDB;

Create table pessoas (
	pes_codigo Serial NOT NULL AUTO_INCREMENT,
	pes_nome Varchar(150),
	pes_cpf Varchar(14),
	pes_rg Varchar(30),
	UNIQUE (pes_cpf),
	UNIQUE (pes_rg),
 Primary Key (pes_codigo)) ENGINE = InnoDB;

Create table telefones (
	tel_codigo Serial NOT NULL AUTO_INCREMENT,
	pes_codigo Bigint UNSIGNED NOT NULL,
	tel_numero Varchar(12),
	tel_nota Varchar(50),
 Primary Key (tel_codigo)) ENGINE = InnoDB;

Create table emails (
	ema_codigo Serial NOT NULL AUTO_INCREMENT,
	pes_codigo Bigint UNSIGNED NOT NULL,
	ema_email Varchar(50),
	ema_nota Varchar(50),
	UNIQUE (ema_email),
 Primary Key (ema_codigo)) ENGINE = InnoDB;

Create table produtos (
	pro_codigo Serial NOT NULL AUTO_INCREMENT,
	emp_codigo Bigint UNSIGNED NOT NULL,
	pro_descricao Varbinary(150) NOT NULL,
	pro_modelo Varchar(25),
	pro_valor_venda Double NOT NULL,
 Primary Key (pro_codigo)) ENGINE = InnoDB;

Create table servicos (
	ser_codigo Serial NOT NULL AUTO_INCREMENT,
	cli_codigo Bigint UNSIGNED NOT NULL,
	ser_descricao Varchar(100),
 Primary Key (ser_codigo)) ENGINE = InnoDB;

Create table lancamentos (
	lan_codigo Varchar(12) NOT NULL,
	tec_codigo Bigint UNSIGNED,
	pro_codigo Bigint UNSIGNED NOT NULL,
	pc_codigo Bigint UNSIGNED,
	ser_codigo Bigint UNSIGNED,
	for_codigo Bigint UNSIGNED,
	lan_datahora Datetime NOT NULL,
	lan_quantidade_item Smallint NOT NULL DEFAULT 1,
	lan_valor_produto Double NOT NULL,
	lan_val_servico Varchar(20),
	lan_checado Bool DEFAULT 0,
 Primary Key (lan_codigo)) ENGINE = InnoDB;

Create table solicitacoes (
	sol_codigo Serial NOT NULL AUTO_INCREMENT,
	sta_codigo Tinyint NOT NULL,
	cli_codigo Bigint UNSIGNED NOT NULL,
	emp_codigo Bigint UNSIGNED NOT NULL,
	sol_descricao Varchar(100) NOT NULL,
	sol_vencimento Date NOT NULL,
	sol_valor Double NOT NULL,
	sol_codigo_barras Varchar(200) NOT NULL,
	sol_valor_pago Double NOT NULL,
 Primary Key (sol_codigo)) ENGINE = InnoDB;

Create table plano_conta (
	pc_codigo Serial NOT NULL AUTO_INCREMENT,
	cli_codigo Bigint UNSIGNED NOT NULL,
	pc_descricao Varchar(25),
 Primary Key (pc_codigo)) ENGINE = InnoDB;

Create table tecnicos (
	tec_codigo Serial NOT NULL AUTO_INCREMENT,
	ban_codigo Bigint UNSIGNED NOT NULL,
	pes_codigo Bigint UNSIGNED NOT NULL,
	cla_codigo Bigint UNSIGNED NOT NULL,
	tec_descricao Varchar(50),
	tec_numero_agencia Varchar(20),
	tec_numero_conta Varchar(20),
 Primary Key (tec_codigo)) ENGINE = InnoDB;

Create table operacoes (
	ope_codigo Smallint NOT NULL,
	ope_descricao Varchar(25) NOT NULL,
 Primary Key (ope_codigo)) ENGINE = InnoDB;

Create table logs (
	log_codigo Serial NOT NULL AUTO_INCREMENT,
	cli_codigo Bigint UNSIGNED,
	ope_codigo Smallint NOT NULL,
	alv_codigo Smallint NOT NULL,
	log_data_hora Datetime NOT NULL,
	log_nome_maquina Varchar(50) NOT NULL,
	log_ip_rede Varchar(15) NOT NULL,
	log_descricao Varchar(100) NOT NULL,
 Primary Key (log_codigo)) ENGINE = InnoDB;

Create table alvos (
	alv_codigo Smallint NOT NULL,
	alv_descricao Varbinary(30),
 Primary Key (alv_codigo)) ENGINE = InnoDB;

Create table forma_pagamento (
	for_codigo Serial NOT NULL AUTO_INCREMENT,
	cli_codigo Bigint UNSIGNED NOT NULL,
	for_periodo Smallint NOT NULL,
	for_descricao Varchar(50) NOT NULL,
 Primary Key (for_codigo)) ENGINE = InnoDB;

Create table funcionarios (
	emp_codigo Bigint UNSIGNED NOT NULL,
	cli_codigo Bigint UNSIGNED NOT NULL,
 Primary Key (emp_codigo,cli_codigo)) ENGINE = InnoDB;

Create table niveis (
	niv_codigo Smallint NOT NULL AUTO_INCREMENT,
	niv_descricao Varchar(25),
 Primary Key (niv_codigo)) ENGINE = InnoDB;

Create table classe (
	cla_codigo Serial NOT NULL AUTO_INCREMENT,
	cli_codigo Bigint UNSIGNED NOT NULL,
	cla_descricao Varchar(30),
	cla_porcentagem Double,
 Primary Key (cla_codigo)) ENGINE = InnoDB;

Create table status (
	sta_codigo Tinyint NOT NULL,
	sta_descricao Varchar(30) NOT NULL,
 Primary Key (sta_codigo)) ENGINE = InnoDB;

Create table convenios (
	con_codigo Serial NOT NULL AUTO_INCREMENT,
	cli_codigo Bigint UNSIGNED NOT NULL,
	con_descricao Varchar(50),
 Primary Key (con_codigo)) ENGINE = InnoDB;

Create table sangrias (
	san_codigo Serial NOT NULL AUTO_INCREMENT,
	emp_codigo Bigint UNSIGNED NOT NULL,
	tip_codigo Bigint UNSIGNED NOT NULL,
	san_data Date,
	san_valor Double,
 Primary Key (san_codigo)) ENGINE = InnoDB;

Create table sangria_cofre (
	san_codigo Bigint UNSIGNED NOT NULL,
	san_numero_envelope Varchar(100),
 Primary Key (san_codigo)) ENGINE = InnoDB;

Create table sangria_banco (
	san_codigo Bigint UNSIGNED NOT NULL,
	ban_codigo Bigint UNSIGNED NOT NULL,
 Primary Key (san_codigo)) ENGINE = InnoDB;

Create table bancos (
	ban_codigo Serial NOT NULL AUTO_INCREMENT,
	ban_nome Varchar(50),
 Primary Key (ban_codigo)) ENGINE = InnoDB;

Create table tipos (
	tip_codigo Serial NOT NULL,
	tip_descricao Varchar(20),
 Primary Key (tip_codigo)) ENGINE = InnoDB;


Alter table clientes add Foreign Key (cli_codigo_pai) references clientes (cli_codigo) on delete  restrict on update  restrict;
Alter table solicitacoes add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete cascade on update cascade;
Alter table logs add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete set null on update cascade;
Alter table funcionarios add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete cascade on update cascade;
Alter table classe add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete cascade on update cascade;
Alter table forma_pagamento add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete cascade on update cascade;
Alter table servicos add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete cascade on update cascade;
Alter table plano_conta add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete cascade on update cascade;
Alter table convenios add Foreign Key (cli_codigo) references clientes (cli_codigo) on delete  restrict on update  restrict;
Alter table produtos add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete cascade on update cascade;
Alter table solicitacoes add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete cascade on update cascade;
Alter table funcionarios add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete cascade on update cascade;
Alter table sangrias add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete cascade on update cascade;
Alter table telefones add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table emails add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table clientes add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table tecnicos add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table lancamentos add Foreign Key (pro_codigo) references produtos (pro_codigo) on delete cascade on update cascade;
Alter table lancamentos add Foreign Key (ser_codigo) references servicos (ser_codigo) on delete set null on update cascade;
Alter table lancamentos add Foreign Key (pc_codigo) references plano_conta (pc_codigo) on delete set null on update cascade;
Alter table lancamentos add Foreign Key (tec_codigo) references tecnicos (tec_codigo) on delete set null on update cascade;
Alter table logs add Foreign Key (ope_codigo) references operacoes (ope_codigo) on delete cascade on update cascade;
Alter table logs add Foreign Key (alv_codigo) references alvos (alv_codigo) on delete cascade on update cascade;
Alter table lancamentos add Foreign Key (for_codigo) references forma_pagamento (for_codigo) on delete set null on update cascade;
Alter table clientes add Foreign Key (niv_codigo) references niveis (niv_codigo) on delete cascade on update cascade;
Alter table tecnicos add Foreign Key (cla_codigo) references classe (cla_codigo) on delete cascade on update cascade;
Alter table solicitacoes add Foreign Key (sta_codigo) references status (sta_codigo) on delete cascade on update cascade;
Alter table sangria_cofre add Foreign Key (san_codigo) references sangrias (san_codigo) on delete cascade on update cascade;
Alter table sangria_banco add Foreign Key (san_codigo) references sangrias (san_codigo) on delete cascade on update cascade;
Alter table tecnicos add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update cascade;
Alter table sangria_banco add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update cascade;
Alter table sangrias add Foreign Key (tip_codigo) references tipos (tip_codigo) on delete cascade on update cascade;


