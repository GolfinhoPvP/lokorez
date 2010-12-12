/*
Created		11/12/2010
Modified		12/12/2010
Project		
Model		
Company		
Author		
Version		
Database		MS SQL 7 
*/

use [DW-Deputados]

Drop table [votos] 
go
Drop table [ano] 
go
Drop table [municipio] 
go
Drop table [candidato] 
go
Drop table [situacao] 
go
Drop table [sexo] 
go
Drop table [partido] 
go
Drop table [cargo] 
go
Drop table [coligacao] 
go
Drop table [uf] 
go
Drop table [macro] 
go
Drop table [zona] 
go


Create table [votos] (
	[mun_codigo] Integer NOT NULL,
	[ano_codigo] Varchar(10) NOT NULL,
	[cand_codigo] Integer NOT NULL,
	[votos] Integer NULL
) 
go

Create table [municipio] (
	[mun_codigo] Integer NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[mun_descricao] Varchar(100) NULL,
Primary Key  ([mun_codigo])
) 
go

Create table [ano] (
	[ano_codigo] Varchar(10) NOT NULL,
	[ano_data] Varchar(15) NULL,
Primary Key  ([ano_codigo])
) 
go

Create table [candidato] (
	[cand_codigo] Integer Identity(0,1) NOT NULL,
	[sexo_codigo] Integer NOT NULL,
	[situ_codigo] Integer NOT NULL,
	[part_codigo] Integer NOT NULL,
	[cargo_codigo] Integer NOT NULL,
	[cand_nome] Varchar(75) NULL,
	[cand_nome_urna] Varchar(45) NULL,
Primary Key  ([cand_codigo])
) 
go

Create table [sexo] (
	[sexo_codigo] Integer NOT NULL,
	[sexo_descricao] Varchar(10) NULL,
Primary Key  ([sexo_codigo])
) 
go

Create table [situacao] (
	[situ_codigo] Integer NOT NULL,
	[situ_descricao] Varchar(10) NULL,
Primary Key  ([situ_codigo])
) 
go

Create table [partido] (
	[part_codigo] Integer NOT NULL,
	[colig_codigo] Varchar(50) NOT NULL,
	[macro_codigo] Integer NOT NULL,
	[part_sigla] Varchar(10) NULL,
Primary Key  ([part_codigo])
) 
go

Create table [coligacao] (
	[colig_codigo] Varchar(50) NOT NULL,
	[colig_descricao] Varchar(150) NULL,
	[uf_sigla] Char(2) NOT NULL,
Primary Key  ([colig_codigo])
) 
go

Create table [uf] (
	[uf_sigla] Char(2) NOT NULL,
Primary Key  ([uf_sigla])
) 
go

Create table [zona] (
	[zona_numero] Integer NOT NULL,
Primary Key  ([zona_numero])
) 
go

Create table [cargo] (
	[cargo_codigo] Integer NOT NULL,
	[descricao_cargo] Varchar(20) NULL,
Primary Key  ([cargo_codigo])
) 
go

Create table [macro] (
	[macro_codigo] Integer Identity(0,1) NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
Primary Key  ([macro_codigo])
) 
go


Set quoted_identifier on
go

Set quoted_identifier off
go


