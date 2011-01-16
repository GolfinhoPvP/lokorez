/*
Created		12/1/2011
Modified		15/1/2011
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS bancos_pessoas;
drop table IF EXISTS telefones;
drop table IF EXISTS pessoas;
drop table IF EXISTS alvos;
drop table IF EXISTS operacoes;
drop table IF EXISTS logs;
drop table IF EXISTS niveis;
drop table IF EXISTS administradores;
drop table IF EXISTS parcelas;
drop table IF EXISTS averbacoes;
drop table IF EXISTS status;
drop table IF EXISTS parametros;
drop table IF EXISTS servidores;
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

Create table servidores (
	emp_codigo Int NOT NULL,
	pes_codigo Int NOT NULL,
	ser_matricula Varchar(20) NOT NULL,
	ser_admissao Date,
	ser_cargo Varchar(100),
	ser_vinculo Varchar(100),
	ser_consignavel Double,
	ser_utilizada Double,
	ser_disponivel Double,
 Primary Key (emp_codigo,pes_codigo,ser_matricula)) ENGINE = MyISAM;

Create table parametros (
	par_periodo Varchar(7) NOT NULL,
	sta_codigo Smallint NOT NULL,
	par_data_corte Date,
 Primary Key (par_periodo)) ENGINE = MyISAM;

Create table status (
	sta_codigo Smallint NOT NULL AUTO_INCREMENT,
	sta_nome Varchar(25),
	sta_descricao Varchar(50),
 Primary Key (sta_codigo)) ENGINE = MyISAM;

Create table averbacoes (
	ave_numero_externo Varchar(100) NOT NULL,
	emp_codigo Int NOT NULL,
	ser_matricula Varchar(20) NOT NULL,
	ban_codigo Varchar(3) NOT NULL,
	pro_codigo Int NOT NULL,
	par_periodo Varchar(7) NOT NULL,
	sta_codigo Smallint NOT NULL,
	ave_data Date,
	ave_numero_parcelas Int,
	ave_montante Double,
	ave_taxa_juros Double,
	pes_codigo Int NOT NULL,
 Primary Key (ave_numero_externo)) ENGINE = MyISAM;

Create table parcelas (
	ave_numero_externo Varchar(100) NOT NULL,
	par_numero_parcela Int NOT NULL AUTO_INCREMENT,
	sta_codigo Smallint NOT NULL,
	par_periodo_parcela Varchar(7),
	par_valor Double,
 Primary Key (ave_numero_externo,par_numero_parcela)) ENGINE = MyISAM;

Create table administradores (
	adm_codigo Int NOT NULL AUTO_INCREMENT,
	pes_codigo Int NOT NULL,
	niv_codigo Smallint NOT NULL,
	adm_nome_usuario Varchar(25) NOT NULL,
	adm_senha Varchar(20) NOT NULL,
	UNIQUE (adm_nome_usuario),
 Primary Key (adm_codigo,pes_codigo)) ENGINE = MyISAM;

Create table niveis (
	niv_codigo Smallint NOT NULL,
	niv_descricao Varbinary(30) NOT NULL,
 Primary Key (niv_codigo)) ENGINE = MyISAM;

Create table logs (
	log_codigo Serial NOT NULL AUTO_INCREMENT,
	pes_codigo Int NOT NULL,
	ope_codigo Smallint NOT NULL,
	niv_codigo Smallint NOT NULL,
	adm_codigo Int NOT NULL,
	alv_codigo Smallint NOT NULL,
	log_data_tempo Datetime NOT NULL,
	log_nome_maquina Varchar(50) NOT NULL,
	log_ip_rede Varchar(15) NOT NULL,
	log_descricao Varchar(100) NOT NULL,
 Primary Key (log_codigo)) ENGINE = MyISAM;

Create table operacoes (
	ope_codigo Smallint NOT NULL,
	ope_descricao Varchar(25) NOT NULL,
 Primary Key (ope_codigo)) ENGINE = MyISAM;

Create table alvos (
	alv_codigo Smallint NOT NULL,
	alv_descricao Varbinary(30),
 Primary Key (alv_codigo)) ENGINE = MyISAM;

Create table pessoas (
	pes_codigo Int NOT NULL AUTO_INCREMENT,
	pes_nome Varchar(150),
	pes_cpf Varchar(14),
	pes_classe Char(1),
	UNIQUE (pes_codigo),
	UNIQUE (pes_cpf),
 Primary Key (pes_codigo)) ENGINE = MyISAM;

Create table telefones (
	tel_codigo Int NOT NULL AUTO_INCREMENT,
	pes_codigo Int NOT NULL,
	tel_numero Varchar(12),
 Primary Key (tel_codigo,pes_codigo)) ENGINE = MyISAM;

Create table bancos_pessoas (
	ban_codigo Varchar(3) NOT NULL,
	pes_codigo Int NOT NULL,
 Primary Key (ban_codigo,pes_codigo)) ENGINE = MyISAM;


Alter table verbas add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete  restrict on update  restrict;
Alter table servidores add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete  restrict on update  restrict;
Alter table verbas add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update  restrict;
Alter table averbacoes add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update  restrict;
Alter table bancos_pessoas add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update  restrict;
Alter table verbas add Foreign Key (pro_codigo) references produtos (pro_codigo) on delete  restrict on update  restrict;
Alter table averbacoes add Foreign Key (pro_codigo) references produtos (pro_codigo) on delete  restrict on update  restrict;
Alter table averbacoes add Foreign Key (emp_codigo,pes_codigo,ser_matricula) references servidores (emp_codigo,pes_codigo,ser_matricula) on delete  restrict on update  restrict;
Alter table averbacoes add Foreign Key (par_periodo) references parametros (par_periodo) on delete  restrict on update  restrict;
Alter table parametros add Foreign Key (sta_codigo) references status (sta_codigo) on delete  restrict on update  restrict;
Alter table averbacoes add Foreign Key (sta_codigo) references status (sta_codigo) on delete  restrict on update  restrict;
Alter table parcelas add Foreign Key (sta_codigo) references status (sta_codigo) on delete  restrict on update  restrict;
Alter table parcelas add Foreign Key (ave_numero_externo) references averbacoes (ave_numero_externo) on delete  restrict on update  restrict;
Alter table logs add Foreign Key (adm_codigo,pes_codigo) references administradores (adm_codigo,pes_codigo) on delete  restrict on update  restrict;
Alter table administradores add Foreign Key (niv_codigo) references niveis (niv_codigo) on delete  restrict on update  restrict;
Alter table logs add Foreign Key (niv_codigo) references niveis (niv_codigo) on delete  restrict on update  restrict;
Alter table logs add Foreign Key (ope_codigo) references operacoes (ope_codigo) on delete  restrict on update  restrict;
Alter table logs add Foreign Key (alv_codigo) references alvos (alv_codigo) on delete  restrict on update  restrict;
Alter table telefones add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete  restrict on update  restrict;
Alter table bancos_pessoas add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete  restrict on update  restrict;
Alter table servidores add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete  restrict on update  restrict;
Alter table administradores add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete  restrict on update  restrict;


