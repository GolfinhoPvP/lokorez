/*
Created		21/10/2010
Modified		11/11/2010
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS Administradores;
drop table IF EXISTS Folhas;
drop table IF EXISTS Pessoal;
drop table IF EXISTS RG;
drop table IF EXISTS Inf_Bancaria;
drop table IF EXISTS Calculos;
drop table IF EXISTS Cadastros;
drop table IF EXISTS Eventos;
drop table IF EXISTS Especialidades;
drop table IF EXISTS Lotacoes;
drop table IF EXISTS Cargos;


Create table Cargos (
	cargo Varchar(3) NOT NULL,
	descricao Varchar(50) NOT NULL,
	tipo Varchar(1),
	vencimento Double,
 Primary Key (cargo)) ENGINE = MyISAM;

Create table Lotacoes (
	lotacao Varchar(5) NOT NULL,
	descricao_lotacao Varchar(50) NOT NULL,
	secretaria Varchar(50) NOT NULL,
 Primary Key (lotacao)) ENGINE = MyISAM;

Create table Especialidades (
	codigo Varchar(3) NOT NULL,
	descricao Varchar(50) NOT NULL,
	cargo Varchar(3) NOT NULL,
 Primary Key (codigo,cargo)) ENGINE = MyISAM;

Create table Eventos (
	codigo Varchar(3) NOT NULL,
	descricao Varchar(50) NOT NULL,
	IRRF Varchar(1),
	IPMT Varchar(1),
	FAL Varchar(1),
	FIXO Varchar(1),
	TEMP Varchar(1),
	valor Double,
	GRAT Varchar(1),
	FGTS Varchar(1),
	desconto Double,
	nivel Varchar(1),
	INSS Varchar(1),
 Primary Key (codigo)) ENGINE = MyISAM;

Create table Cadastros (
	matricula Varchar(6) NOT NULL,
	cargo Varchar(3) NOT NULL,
	lotacao Varchar(5) NOT NULL,
	data_admissao Datetime,
	vinculo Varchar(1),
	previdencia Varchar(1),
	nivel Varchar(2),
	dep_imp_re Varchar(2),
	hora_sem Varchar(2),
	instrucao Varchar(1),
	data_afastamento Datetime,
	sindical Varchar(1),
	dp_sal_fam Varchar(2),
	hora_ponto Time,
	vale_transporte Int,
	data_promocao Datetime,
	tipo Varchar(1),
	situacao Varchar(1),
	descontar Bool,
	receber Varchar(1),
	funcao Varchar(3),
	maior_360 Bool,
	prof_40h Bool,
	vlt_ver Varchar(3),
	val_niv Double,
	data_FGTS Datetime,
	permanente Bool,
	remuneracao_bruto Double,
	vencimento Double,
	flag Bool,
	entrada Varchar(8),
	liquido Double,
	sobregrat Varchar(1),
	assistencia Varchar(1),
	medico Varchar(2),
	senha Varchar(50),
	codigo Int NOT NULL,
 Primary Key (matricula,cargo,lotacao,codigo)) ENGINE = MyISAM;

Create table Calculos (
	valor Double NOT NULL,
	eve_codigo Varchar(3) NOT NULL,
	fol_codigo Int NOT NULL,
	matricula Varchar(6) NOT NULL,
	lotacao Varchar(5) NOT NULL,
	cargo Varchar(3) NOT NULL,
	data Date NOT NULL,
 Primary Key (eve_codigo,fol_codigo,matricula,lotacao,cargo)) ENGINE = MyISAM;

Create table Inf_Bancaria (
	conta Varchar(10),
	matricula Varchar(6) NOT NULL,
	lotacao Varchar(5) NOT NULL,
	banco Varchar(3),
	numero Varchar(20),
	cargo Varchar(3) NOT NULL,
	codigo Int NOT NULL,
	UNIQUE (matricula),
 Primary Key (matricula)) ENGINE = MyISAM;

Create table RG (
	identidade Varchar(25),
	matricula Varchar(6) NOT NULL,
	lotacao Varchar(5) NOT NULL,
	orgao_expedidor Varchar(15),
	cargo Varchar(3) NOT NULL,
	codigo Int NOT NULL,
	UNIQUE (identidade),
	UNIQUE (matricula),
 Primary Key (matricula)) ENGINE = MyISAM;

Create table Pessoal (
	nome Varchar(60),
	matricula Varchar(6) NOT NULL,
	lotacao Varchar(5) NOT NULL,
	cargo Varchar(3) NOT NULL,
	sexo Varchar(1),
	CPF Varchar(11),
	PIS_PASEP Varchar(15),
	data_nascimento Date,
	ultimo_nome Varchar(20),
	codigo Int NOT NULL,
	UNIQUE (matricula),
	UNIQUE (CPF),
 Primary Key (matricula)) ENGINE = MyISAM;

Create table Folhas (
	codigo Int NOT NULL,
	nome Varchar(30) NOT NULL,
	descricao Varchar(50),
	UNIQUE (nome),
 Primary Key (codigo)) ENGINE = MyISAM;

Create table Administradores (
	id Int NOT NULL AUTO_INCREMENT,
	usuario Varchar(50) NOT NULL,
	senha Varchar(50) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;


Alter table Especialidades add Foreign Key (cargo) references Cargos (cargo) on delete  restrict on update  restrict;
Alter table Cadastros add Foreign Key (cargo) references Cargos (cargo) on delete  restrict on update  restrict;
Alter table Cadastros add Foreign Key (lotacao) references Lotacoes (lotacao) on delete  restrict on update  restrict;
Alter table Calculos add Foreign Key (eve_codigo) references Eventos (codigo) on delete  restrict on update  restrict;
Alter table RG add Foreign Key (matricula,cargo,lotacao,codigo) references Cadastros (matricula,cargo,lotacao,codigo) on delete  restrict on update  restrict;
Alter table Inf_Bancaria add Foreign Key (matricula,cargo,lotacao,codigo) references Cadastros (matricula,cargo,lotacao,codigo) on delete  restrict on update  restrict;
Alter table Pessoal add Foreign Key (matricula,cargo,lotacao,codigo) references Cadastros (matricula,cargo,lotacao,codigo) on delete  restrict on update  restrict;
Alter table Calculos add Foreign Key (matricula,cargo,lotacao,fol_codigo) references Cadastros (matricula,cargo,lotacao,codigo) on delete  restrict on update  restrict;
Alter table Cadastros add Foreign Key (codigo) references Folhas (codigo) on delete  restrict on update  restrict;


