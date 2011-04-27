/*
Created		25/11/2009
Modified		15/12/2009
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table pessoa (
	idPessoa Int NOT NULL AUTO_INCREMENT,
	nome Varchar(100) NOT NULL,
	email Varchar(50) NOT NULL,
	telefone_1 Varchar(14),
	telefone_2 Varchar(14),
	UNIQUE (idPessoa),
	UNIQUE (email)) ENGINE = MyISAM;

Create table curso (
	idCurso Int NOT NULL AUTO_INCREMENT,
	idMinistrante Int NOT NULL,
	nome Varchar(250) NOT NULL,
	numeroParticipantes Int NOT NULL,
	cargaHoraria Int NOT NULL,
	valorInscricao Int NOT NULL,
	UNIQUE (idCurso)) ENGINE = MyISAM;

Create table aluno (
	idAluno Int NOT NULL AUTO_INCREMENT,
	idPessoa Int NOT NULL,
	matricula Varchar(8) NOT NULL,
	usuario Varchar(25) NOT NULL,
	senha Varchar(100) NOT NULL,
	bloco Varchar(6) NOT NULL,
	situacao Int NOT NULL,
	UNIQUE (idAluno),
	UNIQUE (idPessoa),
	UNIQUE (matricula)) ENGINE = MyISAM;

Create table ministrante (
	idMinistrante Int NOT NULL AUTO_INCREMENT,
	idPessoa Int NOT NULL,
	descricao Text,
	UNIQUE (idMinistrante),
	UNIQUE (idPessoa)) ENGINE = MyISAM;

Create table curso_aluno (
	idAluno Int NOT NULL,
	idCurso Int NOT NULL,
	frequencia Char(3),
	media Int,
	condicao Int NOT NULL) ENGINE = MyISAM;

Create table Horario (
	idHorario Int NOT NULL AUTO_INCREMENT,
	idCurso Int NOT NULL,
	data_hora Datetime NOT NULL,
	UNIQUE (idHorario)) ENGINE = MyISAM;

Create table administrador (
	idAdministrador Int NOT NULL AUTO_INCREMENT,
	idAluno Int NOT NULL,
	cargo Varchar(100) NOT NULL,
	UNIQUE (idAdministrador)) ENGINE = MyISAM;

Create table nota (
	idNota Int NOT NULL AUTO_INCREMENT,
	idAluno Int NOT NULL,
	nota Varchar(200) NOT NULL,
	data Datetime NOT NULL,
	hierarquia Int NOT NULL,
	UNIQUE (idNota)) ENGINE = MyISAM;

Create table tome_nota (
	idTomeNota Int NOT NULL AUTO_INCREMENT,
	idPessoa Int NOT NULL,
	categoria Int,
	data Datetime,
	nota Varchar(200),
	UNIQUE (idTomeNota)) ENGINE = MyISAM;


