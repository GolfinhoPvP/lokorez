/*
Created		1/12/2011
Modified		1/12/2011
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS parcelas;
drop table IF EXISTS averbacao;
drop table IF EXISTS status;
drop table IF EXISTS parametros;
drop table IF EXISTS servidor;
drop table IF EXISTS verbas;
drop table IF EXISTS produtos;
drop table IF EXISTS bancos;
drop table IF EXISTS empresas;


Create table empresas (
	emp_codigo Int NOT NULL AUTO_INCREMENT,
	emp_descricao Varchar(100),
 Primary Key (emp_codigo)) ENGINE = MyISAM;

Create table bancos (
	ban_codigo Varchar(3) NOT NULL,
	ban_descricao Varchar(100),
	ban_contato Varchar(100),
	ban_fone Varchar(12),
 Primary Key (ban_codigo)) ENGINE = MyISAM;

Create table produtos (
	pro_codigo Int NOT NULL AUTO_INCREMENT,
	pro_descricao Varchar(100),
	pro_prazo_maximo Int,
 Primary Key (pro_codigo)) ENGINE = MyISAM;

Create table verbas (
	emp_codigo Int NOT NULL,
	ban_codigo Varchar(3) NOT NULL,
	pro_codigo Int NOT NULL,
	ver_verba Varchar(10) NOT NULL,
	ver_descricao Varchar(100),
 Primary Key (emp_codigo,ban_codigo,pro_codigo,ver_verba)) ENGINE = MyISAM;

Create table servidor (
	emp_codigo Int NOT NULL,
	ser_matricula Varchar(20) NOT NULL,
	ser_nome Varchar(100),
	ser_cpf Varchar(14),
	ser_admissao Date,
	ser_cargo Varchar(100),
	ser_vinculo Varchar(100),
	ser_consignavel Double,
	ser_utilizada Double,
	ser_disponivel Double,
 Primary Key (emp_codigo,ser_matricula)) ENGINE = MyISAM;

Create table parametros (
	par_periodo Varchar(7) NOT NULL,
	sta_codigo Int NOT NULL,
	par_data_corte Date,
 Primary Key (par_periodo)) ENGINE = MyISAM;

Create table status (
	sta_codigo Int NOT NULL AUTO_INCREMENT,
	sta_nome Varchar(25),
	sta_descricao Varchar(50),
 Primary Key (sta_codigo)) ENGINE = MyISAM;

Create table averbacao (
	ave_numero_externo Varchar(100) NOT NULL,
	emp_codigo Int NOT NULL,
	ser_matricula Varchar(20) NOT NULL,
	ban_codigo Varchar(3) NOT NULL,
	pro_codigo Int NOT NULL,
	par_periodo Varchar(7) NOT NULL,
	sta_codigo Int NOT NULL,
	ave_data Date,
	ave_numero_parcelas Int,
	ave_montante Double,
	ave_taxa_juros Double,
 Primary Key (ave_numero_externo)) ENGINE = MyISAM;

Create table parcelas (
	ave_numero_externo Varchar(100) NOT NULL,
	par_numero_parcela Int NOT NULL AUTO_INCREMENT,
	sta_codigo Int NOT NULL,
	par_periodo_parcela Varchar(7),
	par_valor Double,
 Primary Key (ave_numero_externo,par_numero_parcela)) ENGINE = MyISAM;


Alter table verbas add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete  restrict on update  restrict;
Alter table servidor add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete  restrict on update  restrict;
Alter table verbas add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update  restrict;
Alter table averbacao add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update  restrict;
Alter table verbas add Foreign Key (pro_codigo) references produtos (pro_codigo) on delete  restrict on update  restrict;
Alter table averbacao add Foreign Key (pro_codigo) references produtos (pro_codigo) on delete  restrict on update  restrict;
Alter table averbacao add Foreign Key (emp_codigo,ser_matricula) references servidor (emp_codigo,ser_matricula) on delete  restrict on update  restrict;
Alter table averbacao add Foreign Key (par_periodo) references parametros (par_periodo) on delete  restrict on update  restrict;
Alter table parametros add Foreign Key (sta_codigo) references status (sta_codigo) on delete  restrict on update  restrict;
Alter table averbacao add Foreign Key (sta_codigo) references status (sta_codigo) on delete  restrict on update  restrict;
Alter table parcelas add Foreign Key (sta_codigo) references status (sta_codigo) on delete  restrict on update  restrict;
Alter table parcelas add Foreign Key (ave_numero_externo) references averbacao (ave_numero_externo) on delete  restrict on update  restrict;


