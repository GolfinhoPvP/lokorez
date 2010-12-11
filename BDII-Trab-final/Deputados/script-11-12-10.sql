/*
Created		11/12/2010
Modified		11/12/2010
Project		
Model		
Company		
Author		
Version		
Database		MS SQL 7 
*/


Drop table [uf-zona] 
go
Drop table [tipo] 
go
Drop table [zona] 
go
Drop table [uf] 
go
Drop table [coligacao] 
go
Drop table [partido] 
go
Drop table [situacao] 
go
Drop table [sexo] 
go
Drop table [candidato] 
go
Drop table [ano] 
go
Drop table [municipio] 
go
Drop table [votos] 
go


Create table [votos] (
	[mun_codigo] Integer NOT NULL,
	[ano_codigo] Integer NOT NULL,
	[cand_codigo] Integer NOT NULL,
	[votos] Integer NULL
) 
go

Create table [municipio] (
	[mun_codigo] Integer Identity(0,1) NOT NULL,
	[mun_descricao] Varchar(50) NULL,
Primary Key  ([mun_codigo])
) 
go

Create table [ano] (
	[ano_codigo] Integer Identity(0,1) NOT NULL,
	[ano_descricao] Char(10) NULL,
Primary Key  ([ano_codigo])
) 
go

Create table [candidato] (
	[cand_codigo] Integer Identity(0,1) NOT NULL,
	[sexo_codigo] Integer NOT NULL,
	[situ_codigo] Integer NOT NULL,
	[part_codigo] Integer NOT NULL,
	[tipo_codigo] Integer NOT NULL,
	[cand_nome] Varchar(75) NULL,
	[cand_nome_urna] Varchar(45) NULL,
Primary Key  ([cand_codigo])
) 
go

Create table [sexo] (
	[sexo_codigo] Integer Identity(0,1) NOT NULL,
	[sexo_descricao] Char(1) NULL,
Primary Key  ([sexo_codigo])
) 
go

Create table [situacao] (
	[situ_codigo] Integer Identity(0,1) NOT NULL,
	[situ_descricao] Char(1) NULL,
Primary Key  ([situ_codigo])
) 
go

Create table [partido] (
	[part_codigo] Integer Identity(0,1) NOT NULL,
	[uf_codigo] Integer NOT NULL,
	[colig_codigo] Integer NOT NULL,
	[part_sigla] Varchar(10) NULL,
Primary Key  ([part_codigo])
) 
go

Create table [coligacao] (
	[colig_codigo] Integer Identity(0,1) NOT NULL,
	[uf_codigo] Integer NOT NULL,
	[colig_descricao] Varchar(150) NULL,
Primary Key  ([colig_codigo])
) 
go

Create table [uf] (
	[uf_codigo] Integer Identity(0,1) NOT NULL,
	[uf_sigla] Char(2) NULL,
Primary Key  ([uf_codigo])
) 
go

Create table [zona] (
	[zona_codigo] Integer Identity(0,1) NOT NULL,
	[zona_numero] Integer NULL,
Primary Key  ([zona_codigo])
) 
go

Create table [tipo] (
	[tipo_codigo] Integer Identity(0,1) NOT NULL,
	[tipo_classe] Char(1) NULL,
Primary Key  ([tipo_codigo])
) 
go

Create table [uf-zona] (
	[uf-zona_codigo] Integer Identity(0,1) NOT NULL,
	[zona_codigo] Integer NOT NULL,
	[uf_codigo] Integer NOT NULL,
Primary Key  ([uf-zona_codigo])
) 
go


Alter table [votos] add  foreign key([mun_codigo]) references [municipio] ([mun_codigo]) 
go
Alter table [votos] add  foreign key([ano_codigo]) references [ano] ([ano_codigo]) 
go
Alter table [votos] add  foreign key([cand_codigo]) references [candidato] ([cand_codigo]) 
go
Alter table [candidato] add  foreign key([sexo_codigo]) references [sexo] ([sexo_codigo]) 
go
Alter table [candidato] add  foreign key([situ_codigo]) references [situacao] ([situ_codigo]) 
go
Alter table [candidato] add  foreign key([part_codigo]) references [partido] ([part_codigo]) 
go
Alter table [partido] add  foreign key([colig_codigo]) references [coligacao] ([colig_codigo]) 
go
Alter table [partido] add  foreign key([uf_codigo]) references [uf] ([uf_codigo]) 
go
Alter table [coligacao] add  foreign key([uf_codigo]) references [uf] ([uf_codigo]) 
go
Alter table [uf-zona] add  foreign key([uf_codigo]) references [uf] ([uf_codigo]) 
go
Alter table [uf-zona] add  foreign key([zona_codigo]) references [zona] ([zona_codigo]) 
go
Alter table [candidato] add  foreign key([tipo_codigo]) references [tipo] ([tipo_codigo]) 
go


Set quoted_identifier on
go

Set quoted_identifier off
go


