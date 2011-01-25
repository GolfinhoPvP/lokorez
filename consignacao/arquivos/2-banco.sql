/*
Created		12/1/2011
Modified		24/1/2011
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Drop index ver_emp_index on verbas;
Drop index ver_ban_index on verbas;
Drop index ver_pro_index on verbas;
Drop index ser_emp_index on servidores;
Drop index ser_pes_index on servidores;
Drop index par_sta_index on parametros;
Drop index ave_ser_index on averbacoes;
Drop index ave_ban_index on averbacoes;
Drop index ave_pro_index on averbacoes;
Drop index ave_per_index on averbacoes;
Drop index ave_sta_index on averbacoes;
Drop index par_ave_index on parcelas;
Drop index par_sta_index on parcelas;
Drop index adm_pes_index on administradores;
Drop index adm_niv_index on administradores;
Drop index log_pes_index on logs;
Drop index log_ope_index on logs;
Drop index log_niv_index on logs;
Drop index log_adm_index on logs;
Drop index log_alv_index on logs;
Drop index tel_pes_index on telefones;
Drop index ban_index on bancos_pessoas;
Drop index pes_index on bancos_pessoas;


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
 Primary Key (emp_codigo)) ENGINE = InnoDB;

Create table bancos (
	ban_codigo Varchar(3) NOT NULL,
	ban_descricao Varchar(100),
 Primary Key (ban_codigo)) ENGINE = InnoDB;

Create table produtos (
	pro_codigo Int NOT NULL AUTO_INCREMENT,
	pro_descricao Varchar(100),
	pro_prazo_maximo Int,
 Primary Key (pro_codigo)) ENGINE = InnoDB;

Create table verbas (
	ver_verba Varchar(10) NOT NULL,
	emp_codigo Int NOT NULL,
	ban_codigo Varchar(3) NOT NULL,
	pro_codigo Int NOT NULL,
	ver_descricao Varchar(100),
	UNIQUE (ver_verba),
 Primary Key (ver_verba,emp_codigo,ban_codigo,pro_codigo)) ENGINE = InnoDB;

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
 Primary Key (emp_codigo,pes_codigo,ser_matricula)) ENGINE = InnoDB;

Create table parametros (
	par_periodo Varchar(8) NOT NULL,
	sta_codigo Smallint NOT NULL,
	par_data_corte Date,
	par_link Varchar(100),
 Primary Key (par_periodo)) ENGINE = InnoDB;

Create table status (
	sta_codigo Smallint NOT NULL AUTO_INCREMENT,
	sta_descricao Varchar(25),
 Primary Key (sta_codigo)) ENGINE = InnoDB;

Create table averbacoes (
	ave_numero_externo Varchar(200) NOT NULL,
	adm_codigo_encerrador Int,
	emp_codigo Int,
	pes_codigo Int,
	ser_matricula Varchar(20),
	ban_codigo Varchar(3),
	pro_codigo Int NOT NULL,
	par_periodo Varchar(8),
	sta_codigo Smallint NOT NULL,
	ave_data_criacao Datetime,
	ave_data_encerramento Datetime,
	ave_numero_parcelas Int,
	ave_montante Double,
	ave_taxa_juros Double,
 Primary Key (ave_numero_externo)) ENGINE = InnoDB;

Create table parcelas (
	par_numero_parcela Int NOT NULL,
	ave_numero_externo Varchar(200) NOT NULL,
	sta_codigo Smallint NOT NULL,
	par_periodo_parcela Varchar(8),
	par_valor Double,
 Primary Key (par_numero_parcela,ave_numero_externo)) ENGINE = InnoDB;

Create table administradores (
	adm_codigo Int NOT NULL AUTO_INCREMENT,
	pes_codigo Int NOT NULL,
	niv_codigo Smallint NOT NULL,
	ban_codigo Varchar(3) NOT NULL,
	adm_nome_usuario Varchar(25) NOT NULL,
	adm_senha Varchar(20) NOT NULL,
	UNIQUE (adm_nome_usuario),
 Primary Key (adm_codigo)) ENGINE = InnoDB;

Create table niveis (
	niv_codigo Smallint NOT NULL,
	niv_descricao Varbinary(30) NOT NULL,
 Primary Key (niv_codigo)) ENGINE = InnoDB;

Create table logs (
	log_codigo Serial NOT NULL AUTO_INCREMENT,
	pes_codigo Int,
	ope_codigo Smallint NOT NULL,
	niv_codigo Smallint NOT NULL,
	adm_codigo Int,
	alv_codigo Smallint NOT NULL,
	log_data_tempo Datetime NOT NULL,
	log_nome_maquina Varchar(50) NOT NULL,
	log_ip_rede Varchar(15) NOT NULL,
	log_descricao Varchar(100) NOT NULL,
 Primary Key (log_codigo)) ENGINE = InnoDB;

Create table operacoes (
	ope_codigo Smallint NOT NULL,
	ope_descricao Varchar(25) NOT NULL,
 Primary Key (ope_codigo)) ENGINE = InnoDB;

Create table alvos (
	alv_codigo Smallint NOT NULL,
	alv_descricao Varbinary(30),
 Primary Key (alv_codigo)) ENGINE = InnoDB;

Create table pessoas (
	pes_codigo Int NOT NULL AUTO_INCREMENT,
	pes_nome Varchar(150),
	pes_cpf Varchar(14),
	pes_classe Char(1),
	UNIQUE (pes_codigo),
	UNIQUE (pes_cpf),
 Primary Key (pes_codigo)) ENGINE = InnoDB;

Create table telefones (
	tel_codigo Int NOT NULL AUTO_INCREMENT,
	pes_codigo Int NOT NULL,
	tel_numero Varchar(12),
 Primary Key (tel_codigo,pes_codigo)) ENGINE = InnoDB;

Create table bancos_pessoas (
	ban_codigo Varchar(3) NOT NULL,
	pes_codigo Int NOT NULL,
 Primary Key (ban_codigo,pes_codigo)) ENGINE = InnoDB;


Create Index ver_emp_index ON verbas (emp_codigo);
Create Index ver_ban_index ON verbas (ban_codigo);
Create Index ver_pro_index ON verbas (pro_codigo);
Create Index ser_emp_index ON servidores (emp_codigo);
Create Index ser_pes_index ON servidores (pes_codigo);
Create Index par_sta_index ON parametros (sta_codigo);
Create Index ave_ser_index ON averbacoes (emp_codigo,ser_matricula);
Create Index ave_ban_index ON averbacoes (ban_codigo);
Create Index ave_pro_index ON averbacoes (pro_codigo);
Create Index ave_per_index ON averbacoes (par_periodo);
Create Index ave_sta_index ON averbacoes (sta_codigo);
Create Index par_ave_index ON parcelas (ave_numero_externo);
Create Index par_sta_index ON parcelas (sta_codigo);
Create Index adm_pes_index ON administradores (pes_codigo);
Create Index adm_niv_index ON administradores (niv_codigo);
Create Index log_pes_index ON logs (pes_codigo);
Create Index log_ope_index ON logs (ope_codigo);
Create Index log_niv_index ON logs (niv_codigo);
Create Index log_adm_index ON logs (adm_codigo);
Create Index log_alv_index ON logs (alv_codigo);
Create Index tel_pes_index ON telefones (pes_codigo);
Create Index ban_index ON bancos_pessoas (ban_codigo);
Create Index pes_index ON bancos_pessoas (pes_codigo);


Alter table verbas add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete cascade on update cascade;
Alter table servidores add Foreign Key (emp_codigo) references empresas (emp_codigo) on delete cascade on update cascade;
Alter table verbas add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete  restrict on update  restrict;
Alter table bancos_pessoas add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete cascade on update cascade;
Alter table administradores add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete cascade on update cascade;
Alter table averbacoes add Foreign Key (ban_codigo) references bancos (ban_codigo) on delete set null on update cascade;
Alter table averbacoes add Foreign Key (pro_codigo) references produtos (pro_codigo) on delete cascade on update cascade;
Alter table averbacoes add Foreign Key (emp_codigo,pes_codigo,ser_matricula) references servidores (emp_codigo,pes_codigo,ser_matricula) on delete set null on update cascade;
Alter table averbacoes add Foreign Key (par_periodo) references parametros (par_periodo) on delete set null on update cascade;
Alter table parametros add Foreign Key (sta_codigo) references status (sta_codigo) on delete cascade on update cascade;
Alter table averbacoes add Foreign Key (sta_codigo) references status (sta_codigo) on delete cascade on update cascade;
Alter table parcelas add Foreign Key (sta_codigo) references status (sta_codigo) on delete cascade on update cascade;
Alter table parcelas add Foreign Key (ave_numero_externo) references averbacoes (ave_numero_externo) on delete cascade on update cascade;
Alter table logs add Foreign Key (adm_codigo) references administradores (adm_codigo) on delete set null on update cascade;
Alter table averbacoes add Foreign Key (adm_codigo_encerrador) references administradores (adm_codigo) on delete set null on update cascade;
Alter table administradores add Foreign Key (niv_codigo) references niveis (niv_codigo) on delete cascade on update cascade;
Alter table logs add Foreign Key (niv_codigo) references niveis (niv_codigo) on delete cascade on update cascade;
Alter table logs add Foreign Key (ope_codigo) references operacoes (ope_codigo) on delete cascade on update cascade;
Alter table logs add Foreign Key (alv_codigo) references alvos (alv_codigo) on delete cascade on update cascade;
Alter table telefones add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table bancos_pessoas add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table servidores add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table administradores add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete cascade on update cascade;
Alter table logs add Foreign Key (pes_codigo) references pessoas (pes_codigo) on delete set null on update cascade;


