/*
Created		21/10/2010
Modified		11/2/2011
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS equipe_psf;
drop table IF EXISTS micro_area;
drop table IF EXISTS Local;
drop table IF EXISTS funcao;
drop table IF EXISTS cargo_contratado;
drop table IF EXISTS disposicao;
drop table IF EXISTS vinculo;
drop table IF EXISTS certidao_civil;
drop table IF EXISTS Banco;
drop table IF EXISTS conta;
drop table IF EXISTS formacao;
drop table IF EXISTS grau_instrucao;
drop table IF EXISTS registro_profissional;
drop table IF EXISTS categoria;
drop table IF EXISTS carteira_habilitacao;
drop table IF EXISTS moradia;
drop table IF EXISTS titulo_eleitoral;
drop table IF EXISTS rg2;
drop table IF EXISTS nit;
drop table IF EXISTS carteira_reservista;
drop table IF EXISTS estado_civil;
drop table IF EXISTS sexo;
drop table IF EXISTS estados;
drop table IF EXISTS cep;
drop table IF EXISTS tipo_logradouro;
drop table IF EXISTS bairros;
drop table IF EXISTS logradouros;
drop table IF EXISTS cidades;
drop table IF EXISTS carteria_trabalho;
drop table IF EXISTS Servidor;
drop table IF EXISTS Niveis;
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
	descricao_cargo Varchar(50) NOT NULL,
	tipo Varchar(1),
	vencimento Double,
 Primary Key (cargo)) ENGINE = InnoDB;

Create table Lotacoes (
	lotacao Varchar(5) NOT NULL,
	descricao_lotacao Varchar(50) NOT NULL,
	secretaria Varchar(50) NOT NULL,
 Primary Key (lotacao)) ENGINE = InnoDB;

Create table Especialidades (
	codigo_esp Varchar(3) NOT NULL,
	descricao_especialidade Varchar(50) NOT NULL,
	cargo Varchar(3) NOT NULL,
 Primary Key (codigo_esp)) ENGINE = InnoDB;

Create table Eventos (
	codigo_eve Varchar(3) NOT NULL,
	descricao_evento Varchar(50) NOT NULL,
	IRRF Varchar(1),
	IPMT Varchar(1),
	FAL Varchar(1),
	FIXO Varchar(1),
	TEMP Varchar(1),
	valor_eve Double,
	GRAT Varchar(1),
	FGTS Varchar(1),
	desconto Double,
	nivel_eve Varchar(1),
	INSS Varchar(1),
 Primary Key (codigo_eve)) ENGINE = InnoDB;

Create table Cadastros (
	matricula Varchar(6) NOT NULL,
	cargo Varchar(3) NOT NULL,
	lotacao Varchar(5) NOT NULL,
	data_admissao Date,
	vinculo Varchar(1),
	previdencia Varchar(1),
	nivel Varchar(2),
	dep_imp_re Varchar(2),
	hora_sem Varchar(2),
	instrucao Varchar(1),
	data_afastamento Date,
	sindical Varchar(1),
	dp_sal_fam Varchar(2),
	hora_ponto Varchar(10),
	vale_transporte Varchar(5),
	data_promocao Date,
	tipo Varchar(1),
	situacao Varchar(1),
	descontar Varchar(1),
	receber Varchar(1),
	funcao Varchar(3),
	maior_360 Varchar(1),
	prof_40h Varchar(1),
	vlt_ver Varchar(3),
	val_niv Double,
	data_FGTS Date,
	permanente Varchar(1),
	remuneracao_bruto Double,
	vencimento Double,
	flag Varchar(1),
	entrada Varchar(8),
	liquido Double,
	sobregrat Varchar(1),
	assistencia Varchar(1),
	medico Varchar(2),
	senha Varchar(50),
	codigo_fol Int NOT NULL,
 Primary Key (matricula,codigo_fol)) ENGINE = InnoDB;

Create table Calculos (
	valor Double NOT NULL,
	fol_codigo Int NOT NULL,
	eve_codigo Varchar(3) NOT NULL,
	matricula Varchar(6) NOT NULL,
	data Date NOT NULL,
 Primary Key (fol_codigo,eve_codigo,matricula,data)) ENGINE = InnoDB;

Create table Inf_Bancaria (
	matricula Varchar(6) NOT NULL,
	conta Varchar(10),
	banco Varchar(3),
	numero Varchar(20),
	codigo_fol Int NOT NULL,
	UNIQUE (matricula),
 Primary Key (matricula)) ENGINE = InnoDB;

Create table RG (
	matricula Varchar(6) NOT NULL,
	identidade Varchar(25),
	orgao_expedidor Varchar(15),
	codigo_fol Int NOT NULL,
	UNIQUE (matricula),
 Primary Key (matricula)) ENGINE = InnoDB;

Create table Pessoal (
	matricula Varchar(6) NOT NULL,
	nome Varchar(60),
	sexo Varchar(1),
	CPF Varchar(11),
	PIS_PASEP Varchar(15),
	data_nascimento Date,
	ultimo_nome Varchar(20),
	codigo_fol Int NOT NULL,
	UNIQUE (matricula),
 Primary Key (matricula)) ENGINE = InnoDB;

Create table Folhas (
	codigo_fol Int NOT NULL AUTO_INCREMENT,
	nome Varchar(30) NOT NULL,
	descricao Varchar(100),
	UNIQUE (nome),
 Primary Key (codigo_fol)) ENGINE = InnoDB;

Create table Administradores (
	id Int NOT NULL AUTO_INCREMENT,
	id_nivel Int NOT NULL,
	usuario Varchar(50) NOT NULL,
	senha Varchar(50) NOT NULL,
 Primary Key (id,id_nivel)) ENGINE = InnoDB;

Create table Niveis (
	id_nivel Int NOT NULL AUTO_INCREMENT,
	descricao_nivel Varchar(20) NOT NULL,
 Primary Key (id_nivel)) ENGINE = InnoDB;

Create table Servidor (
	ser_codigo Serial NOT NULL AUTO_INCREMENT,
	car_con_codigo Bigint UNSIGNED NOT NULL,
	dis_codigo Bigint UNSIGNED NOT NULL,
	est_civ_codigo Tinyint NOT NULL,
	est_codigo Bigint UNSIGNED NOT NULL,
	for_codigo Bigint UNSIGNED NOT NULL,
	fun_codigo Bigint UNSIGNED NOT NULL,
	loc_codigo Bigint UNSIGNED NOT NULL,
	cid_codigo Bigint UNSIGNED NOT NULL,
	sex_codigo Tinyint NOT NULL,
	vin_codigo Bigint UNSIGNED NOT NULL,
	ser_nome Varchar(150),
	ser_cpf Varchar(14),
	ser_data_nascimento Date,
	ser_nome_pai Varchar(150),
	ser_nome_mae Varchar(150),
	ser_nome_conjuge Varchar(150),
	ser_data_cadastro Datetime,
 Primary Key (ser_codigo)) ENGINE = InnoDB;

Create table carteria_trabalho (
	car_tra_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	ser_codigo Bigint UNSIGNED NOT NULL,
	car_tra_numero Varchar(20),
	car_tra_serie Varchar(10),
	car_tra_emissao Date,
	UNIQUE (car_tra_numero),
 Primary Key (car_tra_codigo)) ENGINE = InnoDB;

Create table cidades (
	cid_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	cid_nome Varchar(150) NOT NULL,
 Primary Key (cid_codigo,est_codigo)) ENGINE = InnoDB;

Create table logradouros (
	log_codigo Serial NOT NULL AUTO_INCREMENT,
	log_descricao Varchar(100) NOT NULL,
 Primary Key (log_codigo)) ENGINE = InnoDB;

Create table bairros (
	bai_codigo Serial NOT NULL AUTO_INCREMENT,
	bai_nome Varchar(100) NOT NULL,
 Primary Key (bai_codigo)) ENGINE = InnoDB;

Create table tipo_logradouro (
	tip_codigo Serial NOT NULL AUTO_INCREMENT,
	tip_descricao Varbinary(100) NOT NULL,
 Primary Key (tip_codigo)) ENGINE = InnoDB;

Create table cep (
	cep_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	cid_codigo Bigint UNSIGNED NOT NULL,
	bai_codigo Bigint UNSIGNED NOT NULL,
	tip_codigo Bigint UNSIGNED NOT NULL,
	log_codigo Bigint UNSIGNED NOT NULL,
	cep_cep Varchar(9) NOT NULL,
 Primary Key (cep_codigo)) ENGINE = InnoDB;

Create table estados (
	est_codigo Serial NOT NULL AUTO_INCREMENT,
	est_sigla Char(2) NOT NULL,
	est_nome Varchar(30) NOT NULL,
 Primary Key (est_codigo)) ENGINE = InnoDB;

Create table sexo (
	sex_codigo Tinyint NOT NULL,
	sex_descricao Varchar(20),
 Primary Key (sex_codigo)) ENGINE = InnoDB;

Create table estado_civil (
	est_civ_codigo Tinyint NOT NULL,
	est_civ_descricao Varchar(20),
 Primary Key (est_civ_codigo)) ENGINE = InnoDB;

Create table carteira_reservista (
	car_res_codigo Serial NOT NULL AUTO_INCREMENT,
	ser_codigo Bigint UNSIGNED NOT NULL,
	car_res_numero Varchar(30),
	car_res_csm Varchar(30),
	car_res_rm Varchar(30),
 Primary Key (car_res_codigo)) ENGINE = InnoDB;

Create table nit (
	nit_codigo Serial NOT NULL AUTO_INCREMENT,
	ser_codigo Bigint UNSIGNED NOT NULL,
	nit_numero Varchar(30),
	nit_emissao Date,
 Primary Key (nit_codigo)) ENGINE = InnoDB;

Create table rg2 (
	rg_codigo Varchar(30) NOT NULL,
	ser_codigo Bigint UNSIGNED NOT NULL,
	rg_numero Varchar(20),
	rg_orgao_expedidor Varchar(10),
	rg_emissao Date,
 Primary Key (rg_codigo)) ENGINE = InnoDB;

Create table titulo_eleitoral (
	tit_ele_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	ser_codigo Bigint UNSIGNED NOT NULL,
	tit_ele_numero Varchar(25),
	tit_ele_zona_sessao Varchar(20),
 Primary Key (tit_ele_codigo)) ENGINE = InnoDB;

Create table moradia (
	mor_codigo Serial NOT NULL AUTO_INCREMENT,
	ser_codigo Bigint UNSIGNED NOT NULL,
	cep_codigo Bigint UNSIGNED NOT NULL,
	mor_casa Varchar(10),
	mor_quadra Varchar(10),
	mor_fone Varchar(14),
	mor_reside Date,
 Primary Key (mor_codigo)) ENGINE = InnoDB;

Create table carteira_habilitacao (
	car_hab_numero Varchar(30) NOT NULL,
	cat_categoria Varchar(2) NOT NULL,
	ser_codigo Bigint UNSIGNED NOT NULL,
 Primary Key (car_hab_numero)) ENGINE = InnoDB;

Create table categoria (
	cat_categoria Varchar(2) NOT NULL,
 Primary Key (cat_categoria)) ENGINE = InnoDB;

Create table registro_profissional (
	reg_pro_codigo Varchar(100) NOT NULL,
	ser_codigo Bigint UNSIGNED NOT NULL,
	reg_pro_sigla Varchar(20),
	reg_pro_regiao Varchar(20),
 Primary Key (reg_pro_codigo)) ENGINE = InnoDB;

Create table grau_instrucao (
	gra_ins_codigo Serial NOT NULL AUTO_INCREMENT,
	gra_ins_descricao Varchar(30),
 Primary Key (gra_ins_codigo)) ENGINE = InnoDB;

Create table formacao (
	for_codigo Serial NOT NULL AUTO_INCREMENT,
	gra_ins_codigo Bigint UNSIGNED NOT NULL,
	for_descricao Varchar(30),
 Primary Key (for_codigo)) ENGINE = InnoDB;

Create table conta (
	con_codigo Serial NOT NULL AUTO_INCREMENT,
	ser_codigo Bigint UNSIGNED NOT NULL,
	ban_codigo Bigint UNSIGNED NOT NULL,
	con_conta Varchar(20),
	con_agencia Varchar(20),
 Primary Key (con_codigo)) ENGINE = InnoDB;

Create table Banco (
	ban_codigo Serial NOT NULL AUTO_INCREMENT,
	ban_nome Varchar(30),
 Primary Key (ban_codigo)) ENGINE = InnoDB;

Create table certidao_civil (
	cer_civ_codigo Varchar(100) NOT NULL,
	ser_codigo Bigint UNSIGNED NOT NULL,
	cer_civ_termo Varchar(20),
	cer_civ_folha Varchar(20),
	cer_civ_livro Varchar(20),
 Primary Key (cer_civ_codigo)) ENGINE = InnoDB;

Create table vinculo (
	vin_codigo Serial NOT NULL AUTO_INCREMENT,
	vin_descricao Varchar(30),
 Primary Key (vin_codigo)) ENGINE = InnoDB;

Create table disposicao (
	dis_codigo Serial NOT NULL AUTO_INCREMENT,
	dis_descricao Varchar(30),
 Primary Key (dis_codigo)) ENGINE = InnoDB;

Create table cargo_contratado (
	car_con_codigo Serial NOT NULL AUTO_INCREMENT,
	car_con_descricao Varchar(30),
 Primary Key (car_con_codigo)) ENGINE = InnoDB;

Create table funcao (
	fun_codigo Serial NOT NULL AUTO_INCREMENT,
	fun_descricao Varchar(30),
 Primary Key (fun_codigo)) ENGINE = InnoDB;

Create table Local (
	loc_codigo Serial NOT NULL AUTO_INCREMENT,
	eqp_codigo Bigint UNSIGNED NOT NULL,
	mic_codigo Bigint UNSIGNED NOT NULL,
	loc_local Varchar(30),
 Primary Key (loc_codigo)) ENGINE = InnoDB;

Create table micro_area (
	mic_codigo Serial NOT NULL AUTO_INCREMENT,
	mic_micro_area Varchar(20) NOT NULL,
 Primary Key (mic_codigo)) ENGINE = InnoDB;

Create table equipe_psf (
	eqp_codigo Serial NOT NULL AUTO_INCREMENT,
	eqp_equipe_psf Varchar(30) NOT NULL,
 Primary Key (eqp_codigo)) ENGINE = InnoDB;


Alter table Especialidades add Foreign Key (cargo) references Cargos (cargo) on delete  restrict on update  restrict;
Alter table Cadastros add Foreign Key (cargo) references Cargos (cargo) on delete  restrict on update  restrict;
Alter table Cadastros add Foreign Key (lotacao) references Lotacoes (lotacao) on delete  restrict on update  restrict;
Alter table Calculos add Foreign Key (eve_codigo) references Eventos (codigo_eve) on delete  restrict on update  restrict;
Alter table RG add Foreign Key (matricula,codigo_fol) references Cadastros (matricula,codigo_fol) on delete  restrict on update  restrict;
Alter table Inf_Bancaria add Foreign Key (matricula,codigo_fol) references Cadastros (matricula,codigo_fol) on delete  restrict on update  restrict;
Alter table Pessoal add Foreign Key (matricula,codigo_fol) references Cadastros (matricula,codigo_fol) on delete  restrict on update  restrict;
Alter table Calculos add Foreign Key (matricula,fol_codigo) references Cadastros (matricula,codigo_fol) on delete  restrict on update  restrict;
Alter table Cadastros add Foreign Key (codigo_fol) references Folhas (codigo_fol) on delete  restrict on update  restrict;
Alter table Administradores add Foreign Key (id_nivel) references Niveis (id_nivel) on delete  restrict on update  restrict;
Alter table nit add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table carteira_reservista add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table carteria_trabalho add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table titulo_eleitoral add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table moradia add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table carteira_habilitacao add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table registro_profissional add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table conta add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table rg2 add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table certidao_civil add Foreign Key (ser_codigo) references Servidor (ser_codigo) on delete  restrict on update cascade;
Alter table cep add Foreign Key (cid_codigo,est_codigo) references cidades (cid_codigo,est_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (cid_codigo,est_codigo) references cidades (cid_codigo,est_codigo) on delete  restrict on update cascade;
Alter table cep add Foreign Key (log_codigo) references logradouros (log_codigo) on delete  restrict on update cascade;
Alter table cep add Foreign Key (bai_codigo) references bairros (bai_codigo) on delete cascade on update cascade;
Alter table cep add Foreign Key (tip_codigo) references tipo_logradouro (tip_codigo) on delete  restrict on update cascade;
Alter table moradia add Foreign Key (cep_codigo) references cep (cep_codigo) on delete  restrict on update cascade;
Alter table cidades add Foreign Key (est_codigo) references estados (est_codigo) on delete cascade on update cascade;
Alter table carteria_trabalho add Foreign Key (est_codigo) references estados (est_codigo) on delete  restrict on update cascade;
Alter table titulo_eleitoral add Foreign Key (est_codigo) references estados (est_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (sex_codigo) references sexo (sex_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (est_civ_codigo) references estado_civil (est_civ_codigo) on delete  restrict on update cascade;
Alter table carteira_habilitacao add Foreign Key (cat_categoria) references categoria (cat_categoria) on delete  restrict on update cascade;
Alter table formacao add Foreign Key (gra_ins_codigo) references grau_instrucao (gra_ins_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (for_codigo) references formacao (for_codigo) on delete  restrict on update cascade;
Alter table conta add Foreign Key (ban_codigo) references Banco (ban_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (vin_codigo) references vinculo (vin_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (dis_codigo) references disposicao (dis_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (car_con_codigo) references cargo_contratado (car_con_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (fun_codigo) references funcao (fun_codigo) on delete  restrict on update cascade;
Alter table Servidor add Foreign Key (loc_codigo) references Local (loc_codigo) on delete  restrict on update cascade;
Alter table Local add Foreign Key (mic_codigo) references micro_area (mic_codigo) on delete  restrict on update cascade;
Alter table Local add Foreign Key (eqp_codigo) references equipe_psf (eqp_codigo) on delete  restrict on update cascade;


