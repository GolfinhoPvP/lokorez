/*
Created		11/12/2010
Modified		14/8/2010
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
Drop table [zona] 
go



Create table [votos] (
	[mun_codigo] Integer NOT NULL,
	[cand_nome_urna] Varchar(100) NOT NULL,
	[cand_numero] Integer NOT NULL,
	[part_codigo] Integer NOT NULL,
	[colig_codigo] Varchar(150) NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
	[ano_codigo] Varchar(10) NOT NULL,
	[votos] Integer NULL,
Primary Key  ([mun_codigo],[cand_nome_urna],[cand_numero],[part_codigo],[colig_codigo],[uf_sigla],[zona_numero])
) 
go

Create table [municipio] (
	[mun_codigo] Integer NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
	[mun_descricao] Varchar(200) NULL,
Primary Key  ([mun_codigo],[uf_sigla],[zona_numero])
) 
go

Create table [ano] (
	[ano_codigo] Varchar(10) NOT NULL,
	[ano_data] Varchar(15) NULL,
Primary Key  ([ano_codigo])
) 
go

Create table [candidato] (
	[cand_nome_urna] Varchar(100) NOT NULL,
	[cand_numero] Integer NOT NULL,
	[part_codigo] Integer NOT NULL,
	[colig_codigo] Varchar(150) NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
	[sexo_codigo] Integer NOT NULL,
	[situ_codigo] Integer NOT NULL,
	[cargo_codigo] Integer NOT NULL,
	[cand_nome] Varchar(110) NULL,
Primary Key  ([cand_nome_urna],[cand_numero],[part_codigo],[colig_codigo],[uf_sigla],[zona_numero])
) 
go

Create table [sexo] (
	[sexo_codigo] Integer NOT NULL,
	[sexo_descricao] Varchar(50) NULL,
Primary Key  ([sexo_codigo])
) 
go

Create table [situacao] (
	[situ_codigo] Integer NOT NULL,
	[situ_descricao] Varchar(50) NULL,
Primary Key  ([situ_codigo])
) 
go

Create table [partido] (
	[part_codigo] Integer NOT NULL,
	[colig_codigo] Varchar(150) NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
	[part_sigla] Varchar(50) NULL,
Primary Key  ([part_codigo],[colig_codigo],[uf_sigla],[zona_numero])
) 
go

Create table [coligacao] (
	[colig_codigo] Varchar(150) NOT NULL,
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
	[colig_descricao] Varchar(300) NULL,
Primary Key  ([colig_codigo],[uf_sigla],[zona_numero])
) 
go

Create table [uf] (
	[uf_sigla] Char(2) NOT NULL,
	[zona_numero] Integer NOT NULL,
Primary Key  ([uf_sigla],[zona_numero])
) 
go

Create table [zona] (
	[zona_numero] Integer NOT NULL,
Primary Key  ([zona_numero])
) 
go

Create table [cargo] (
	[cargo_codigo] Integer NOT NULL,
	[cargo_descricao] Varchar(50) NULL,
Primary Key  ([cargo_codigo])
) 
go


Alter table [votos] add  foreign key([ano_codigo]) references [ano] ([ano_codigo]) 
go
Alter table [votos] add  foreign key([cand_nome_urna],[cand_numero],[part_codigo],[colig_codigo],[uf_sigla],[zona_numero]) references [candidato] ([cand_nome_urna],[cand_numero],[part_codigo],[colig_codigo],[uf_sigla],[zona_numero]) 
go
Alter table [candidato] add  foreign key([sexo_codigo]) references [sexo] ([sexo_codigo]) 
go
Alter table [candidato] add  foreign key([situ_codigo]) references [situacao] ([situ_codigo]) 
go
Alter table [candidato] add  foreign key([part_codigo],[colig_codigo],[uf_sigla],[zona_numero]) references [partido] ([part_codigo],[colig_codigo],[uf_sigla],[zona_numero]) 
go
Alter table [partido] add  foreign key([colig_codigo],[uf_sigla],[zona_numero]) references [coligacao] ([colig_codigo],[uf_sigla],[zona_numero]) 
go
Alter table [municipio] add  foreign key([uf_sigla],[zona_numero]) references [uf] ([uf_sigla],[zona_numero]) 
go
Alter table [uf] add  foreign key([zona_numero]) references [zona] ([zona_numero]) 
go
Alter table [candidato] add  foreign key([cargo_codigo]) references [cargo] ([cargo_codigo]) 
go


Set quoted_identifier on
go

Set quoted_identifier off
go


