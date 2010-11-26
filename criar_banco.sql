/*
Created		26/11/2010
Modified		26/11/2010
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS cliente;
drop table IF EXISTS endereco;
drop table IF EXISTS condominio;
drop table IF EXISTS status;
drop table IF EXISTS plano;
drop table IF EXISTS RA;
drop table IF EXISTS mensalidade;


Create table mensalidade (
	cliente_id Int NOT NULL,
	plano_id Int NOT NULL,
	dia_vencimento Int NOT NULL) ENGINE = MyISAM;

Create table RA (
	protocolo Varchar(50) NOT NULL,
	cliente_id Int NOT NULL,
	status_id Int NOT NULL DEFAULT 1,
	data Datetime NOT NULL,
	reclamaçao Text NOT NULL,
	soluçao Text,
	anotaçoes Text,
 Primary Key (protocolo)) ENGINE = MyISAM;

Create table plano (
	plano_id Int NOT NULL AUTO_INCREMENT,
	descriçao Varchar(50) NOT NULL,
	velocidade Int NOT NULL,
	valor Float NOT NULL,
 Primary Key (plano_id)) ENGINE = MyISAM;

Create table status (
	status_id Int NOT NULL AUTO_INCREMENT,
	descriçao Varchar(10) NOT NULL,
 Primary Key (status_id)) ENGINE = MyISAM;

Create table condominio (
	condominio_id Int NOT NULL AUTO_INCREMENT,
	bloco Varchar(20),
	apartamento Int NOT NULL,
	nome Char(1) NOT NULL,
	endereco_id Int NOT NULL,
 Primary Key (condominio_id)) ENGINE = MyISAM;

Create table endereco (
	endereco_id Int NOT NULL AUTO_INCREMENT,
	numero Int,
	rua Varchar(50) NOT NULL,
	cep Varchar(9),
	bairro Varchar(40) NOT NULL,
	cidade Varchar(40) NOT NULL,
	estado Char(2) NOT NULL,
	pais Varchar(40) NOT NULL,
	flag Char(1) NOT NULL,
 Primary Key (endereco_id)) ENGINE = MyISAM;

Create table cliente (
	cliente_id Int NOT NULL AUTO_INCREMENT,
	nome Varchar(50) NOT NULL,
	telefone Varchar(12) NOT NULL,
	ip Varchar(15),
	endereco_id Int NOT NULL,
	UNIQUE (cliente_id),
 Primary Key (cliente_id)) ENGINE = MyISAM;


